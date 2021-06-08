<?php
if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
require 'config/config.php';
include 'header.php';
define('title', 'Cart | E-Shopper');
// $status="";

// CheckOut Page
if(isset($_POST['checkOut'])){
	$_SESSION['prodId'] = $_POST['id'];
   echo "<script>window.location.href='checkout.php';</script>";

}

if (isset($_POST['prodId']) && $_POST['prodId']!=""){
   $prodId = $_POST['prodId'];
   $result = mysqli_query(
   $conn,
   "SELECT * FROM products WHERE id='$prodId'"
   );
   $row = mysqli_fetch_assoc($result);
   $image = $row['image'];
   $short_description = $row['short_description'];
   $mrp = $row['mrp'];
	$quantity = $row['qty'];
	
	
   
   $cartArray = array(
	   $prodId=>array(
	   'image'=>$image,
	   'short_description'=>$short_description,
	   'mrp'=>$mrp,
	   'quantity'=>1)
   );
   
	}

	//Empty Cart
if(isset($_POST['deleteAll'])){ 
	if(isset($_SESSION['cart'])){ 
	session_unset(); 
	echo "<script>alert('Cart is made empty!');</script>";
	}
}

	if(isset($_POST['delete'])){
		if($_POST['hId'] != ''){ 		
		if(isset($_SESSION['cart'])) { 
			foreach($_SESSION['cart'] as $key => $product) { 
			if($product['id'] == $_POST['hId']){ 
	 unset($_SESSION['cart'][$key]); 
	unset($_SESSION['prodId']);
		$status = "<div class='box' style='color:red;'>
		Product is removed from your cart!</div>";
		  }
	   
		}
		
		
	}elseif(isset($_SESSION['prodId'])){ 
		echo "<script> alert('Session is not set'); </script>"; 
	 		unset($_SESSION['prodId']);
		session_unset();
	}
	} 
}
//UPDATE THE TOTAL WITH INCREASE IN QUANTITY
if(isset($_POST['update'])){ 
	if($_POST['id'] != ''){ 
		if(isset($_SESSION['cart'])){ 
			foreach($_SESSION['cart'] as $key => $product) 
			{
				if($product['uId'] == $_POST['id']){  
					$_SESSION['cart'][$key]['qty'] = $_POST['quantity']; 
					($_SESSION['cart']); 
				}
			}
		}	}
}

// ADD TO CART FUNCTIONALITY
if(isset($_SESSION['prodId'])){ 
	$sql = mysqli_query($conn, "SELECT * FROM products WHERE id='$_SESSION[prodId]'"); 
			while($cartRows = mysqli_fetch_assoc($sql)){
        if(isset($_SESSION['cart'])){ 
			$items = array_column($_SESSION['cart'],'short_description'); 
			$prod = $cartRows['short_description']; 
			if(in_array($prod, $items)){	
				echo "<script>alert('Item already added');</script>";
					}
			else{ 
				$count = count($_SESSION['cart']); 
				$_SESSION["cartItems"]=$count+1; 
				$_SESSION['cart'][$count] = $cartRows; 
				echo "<script>
				alert('Item added to cart'); 
				</script>"; 
			}
		}
		else{ 
			$_SESSION["cartItems"] = 1;
			$_SESSION['cart']['0'] = $cartRows;
			echo "<script>
			alert('Item added to cart'); exit;       
			</script>"; 
		}
		}
	}

?>

<section id="cart_items">
		<div class="container">
		<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="index.php">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive">
			<div class="">
		
	
			<?php
			   $total= 0;
if(isset($_SESSION['cart'])){
    //$total_cart = 0;
?>	
<table class="table table-bordered table-striped text-center">
	<thead
	style="background-color:orange; color:black;">
	<th class="id"> S.no</th>
			<th class="image">Item</th>
			<th class="description">Description</th>
			<th class="price">Price</th>
			<th class="quantity">Quantity</th>
			<th class="total">Total</th>
			<!-- <td></td> -->
			<td>Action</td>

	</thead>
		<?php
		$n=1.;
		 foreach($_SESSION['cart'] as $product){
			 //$total=$total+$product['mrp'];
			 //$total_cart = $total_cart + $product['mrp'];
			 $product['qty'] = 1;

			// echo "<pre>";
			 //print_r($product);
        ?>
	<tbody
	style="background-color: white; color:black;">
		<tr>
		<td><?php echo $n; ?> . </td>
			<td class="cart_product">
				<img data-enlargeable style="cursor: zoom-in" src="images/Uploads/<?php echo $product['image']; ?>" width="100" height="100" alt="">
			</td>
			<td class="cart_description">
				<?php echo $product['short_description']; ?></p>
			</td>
			<td class="cart_price">
				<p>$<?php echo $product['mrp'];?></p>
					<input type="hidden" class="iprice" value="<?php echo $product['mrp']; ?>">
			</td>
			<td class="cart_quantity">
					<form method="POST">
						<input class="cart_quantity_input iquantity" onchange="subTotal()" type="number" name="quantity" value="<?php echo $product['qty']; ?>" min="1" max="100" style="width: 50px; margin-right:0px;">
						<input type="hidden" name="uId" value="<?php echo $product['id']; ?>">
						<button type="submit" name="update" class="cart_quantity_delete btn-warning" style="margin-left:0px;">Update</button>
					</form>
				<!-- <div class="cart_quantity_delete btn-success"> -->
      </div>
				</div>
				<td class="cart_total itotal" onchange="subTotal()" type="number" name="quantity" value="<?php echo $product['qty']; ?>" />
				<p><?php echo $product['qty']*$product['mrp'];?></p>
				<input type="hidden" class="iprice" value="<?php echo $product['mrp']; ?>">
			</td>
			<!-- <td> -->
				<!-- <form action="" method="POST">
				<input type="hidden" name="uId" value="<?php //echo $product['id']; ?>">
				<button type="submit" name="update" class="cart_quantity_delete btn-danger">Update</button>
				</form> -->
			<!-- </td> -->
			<td>
				<form action="" method="POST">
				<input type="hidden" name="hId" value="<?php echo $product['id']; ?>">
				<button type="submit" name="delete" class="cart_quantity_delete btn-danger">Delete</button>
				</form>
			</td>
			</tr>
			<?php 
	$n++;
		 }
			?>
			</tbody>
			</table>
			<ol>
				<li class="cart_delete">
							<form action="" method="POST">
							<input type="hidden" name="prodId" value="<?php echo $product['id']; ?>">
								<button name="deleteAll" class="btn btn-danger" style=style="margin-left:90%;class="cart_quantity_delete btn-danger" style="margin-left:87%;" href=""> Clear Cart</button>
								</form>
							</li>
				</ol>
				<?php
			}else{ 
				echo "<h1 align=center style=color:orange>Your Cart Is Empty </h1> <br> ";
 } ?>
			</div>
		</div>
	</section> <!--/#cart_items-->

	 <section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
				<div class="col-sm-8">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								<input type="checkbox">
								<label>Use Coupon Code</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Use Gift Voucher</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Estimate Shipping & Taxes</label>
							</li>
						</ul>
						<ul class="user_info">
							<li class="single_field">
								<label>Country:</label>
								<select>
									<option>United States</option>
									<option>Bangladesh</option>
									<option>UK</option>
									<option>India</option>
									<option>Pakistan</option>
									<option>Ucrane</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
								
							</li>
							<li class="single_field">
								<label>Region / State:</label>
								<select>
									<option>Select</option>
									<option>Dhaka</option>
									<option>London</option>
									<option>Dillih</option>
									<option>Lahore</option>
									<option>Alaska</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
								</li>
							<li class="single_field">
								<label>Region / State:</label>
								<select>
									<option>Select</option>
									<option>Dhaka</option>
									<option>London</option>
									<option>Dillih</option>
									<option>Lahore</option>
									<option>Alaska</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
							
							</li>
							<li class="single_field zip-field">
								<label>Zip Code:</label>
								<input type="text">
							</li>
						</ul>
						<a class="btn btn-default update" href="">Get Quotes</a>
						<a class="btn btn-default check_out" href="">Continue</a>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span>$59</span></li>
							<li>Eco Tax <span>$2</span></li>
							<li>Shipping Cost <span>Free</span></li>
							<li>Total <span>$61</span></li>
						</ul>
						<form action="" method="post" enctype="multipart/form-data">
							<!-- <a class="btn btn-default update" href="">Update</a> -->
						
							<img data-enlargeable style="cursor: zoom-in" src="images/shop/<?php echo $row1['image']; ?>" alt="" />
										<h2> <?php echo $row1['mrp']; ?></h2>
											<p><?php echo $row1['short_description']; ?></p>
											<input type="hidden" name="id" value="<?php echo $row1['id']; ?>">
											<a class="btn btn-default check_out" href="checkout.php">Update</a>
							<button type="submit" name="checkOut" class="btn btn-default check_out"> CheckOut</button>
					</div>
				</div>
			</div>
		</div>
	</section> 

<?php include 'footer.php'; ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script>
	$('img[data-enlargeable]').addClass('img-enlargeable').click(function() {
    var src = $(this).attr('src');
    var modal;
  
    function removeModal() {
	modal.remove();
	$('body').off('keyup.modal-close');
    }
    modal = $('<div>').css({
	background: 'RGBA(0,0,0,0.7) url(' + src + ') no-repeat center',
	backgroundSize: 'contain',
	width: '100%',
	height: '100%',
	position: 'fixed',
	zIndex: '10000',
	top: '0',
	left: '0',
	cursor: 'zoom-out'
    }).click(function() {
	removeModal();
    }).appendTo('body');
    //handling ESC
    $('body').on('keyup.modal-close', function(e) {
	if (e.key === 'Escape') {
	removeModal();
	}
    });
	});
	</script>
	
	<script>
	var gt=0;
	var iprice=document.getElementsByClassName('iprice');
	var iquantity=document.getElementsByClassName('iquantity');
	var itotal=document.getElementsByClassName('itotal');
	var gtotal=document.getElementsById('gtotal');
	var ct=0; //cart total

	function subTotal(){
		gt=0;
		for(i=0;i<iprice.length;i++) {
			itotal[i].innerText = (iprice[i].value)*
			(iquantity[i].value);
			ct = ct +(iprice[i].value)*(iquantity[i].
			value);
		}
		gtotal.innerText = gt;
	}
	subTotal();
	</script>

<script>
displayCart: function() {
    if( this.$formCart.length ) {
        var cart = this._toJSONObject( this.storage.getItem( this.cartName ) );
        var items = cart.items;
        var $tableCart = this.$formCart.find( ".shopping-cart" );
        var $tableCartBody = $tableCart.find( "tbody" );

        for( var i = 0; i < items.length; ++i ) {
            var item = items[i];
            var product = item.product;
            var price = this.currency + " " + item.price;
            var qty = item.qty;
            var html = "<tr><td class='pname'>" + product + "</td>" + "<td class='pqty'><input type='text' value='" + qty + "' class='qty'/></td>" + "<td class='pprice'>" + price + "</td></tr>";

            $tableCartBody.html( $tableCartBody.html() + html );
        }

        var total = this.storage.getItem( this.total );
        this.$subTotal[0].innerHTML = this.currency + " " + total;
    } else if( this.$checkoutCart.length ) {
        var checkoutCart = this._toJSONObject( this.storage.getItem( this.cartName ) );
        var cartItems = checkoutCart.items;
        var $cartBody = this.$checkoutCart.find( "tbody" );

        for( var j = 0; j < cartItems.length; ++j ) {
            var cartItem = cartItems[j];
            var cartProduct = cartItem.product;
            var cartPrice = this.currency + " " + cartItem.price;
            var cartQty = cartItem.qty;
            var cartHTML = "<tr><td class='pname'>" + cartProduct + "</td>" + "<td class='pqty'>" + cartQty + "</td>" + "<td class='pprice'>" + cartPrice + "</td></tr>";

            $cartBody.html( $cartBody.html() + cartHTML );
        }

        var cartTotal = this.storage.getItem( this.total );
        var cartShipping = this.storage.getItem( this.shippingRates );
        var subTot = this._convertString( cartTotal ) + this._convertString( cartShipping );

        this.$subTotal[0].innerHTML = this.currency + " " + this._convertNumber( subTot );
        this.$shipping[0].innerHTML = this.currency + " " + cartShipping;

    }
}
</script>