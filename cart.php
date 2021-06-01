<?php
if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
require 'config/config.php';
include 'header.php';
define('title', 'Cart | E-Shopper');
$status="";

if(isset($_POST['deleteAll'])){ 
	if(isset($_SESSION['cart'])){ 
	session_unset(); 
	echo "<script>alert('Cart is made empty!');</script>";
	}
}

	if(isset($_POST['delete'])){
		
		if(isset($_SESSION['cart'])) { //echo 1;
		if($_POST['hId'] != ''){ //echo 2; 
			foreach($_SESSION['cart'] as $key => $product) { //echo 3;
		//   echo "<pre>"; print_r($product); exit();
			if($product['id'] == $_POST['hId']){ //echo 4;
	
	 
	unset($_SESSION['cart'][$key]); //echo "4.1";
	unset($_SESSION['prodId']);
		  $status = "<div class='box' style='color:red;'>
		  Product is removed from your cart!</div>";
		  }
	   
		}
		
		}
	}else if(isset($_SESSION['prodId'])){ echo 55;
		echo "session is not set"; 
		unset($_SESSION['id']); session_unset(); 
	}

	} 




// Add to cart Funtionality
if(isset($_SESSION['prodId'])){ //echo 0;
	$sql = mysqli_query($conn, "SELECT * FROM products WHERE id='$_SESSION[prodId]'"); //echo 1;
		// do{echo 2;
			while($cartRows = mysqli_fetch_assoc($sql)){
        if(isset($_SESSION['cart'])){ //echo 3;
			$items = array_column($_SESSION['cart']); //echo 4;
			$prod = $cartRows['short_description']; //echo 5;
			if(in_array($prod, $items)){			}
			else{ //echo 6;
				$count = count($_SESSION['cart']); //echo 7;
				$_SESSION["cartItems"]=$count+1; //echo 8;
				$_SESSION['cart'][$count] = $cartRows; //9;
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
        // while($cartRows = mysqli_fetch_assoc($sql));
	}

// // 	if (isset($_POST['action']) && $_POST['action']=="change"){
// // 		//   foreach($_SESSION["shopping_cart"] as &$value){
// // 			foreach($_SESSION["cart"] as &$product){
// // 			// if($value['code'] === $_POST["code"]){
// // 				if($product['prodId'] === $_POST["prodId"]){
		
// // 				$product['quantity'] = $_POST["quantity"];
// session_unset();
// // 				break; // Stop the loop after we've found the product
// // 			}
// // 		}
			  
// // 		}
// // ?>	

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
if(isset($_SESSION['cart'])){
    $total_price = 0;
?>	
<table class="table table-condensed">
<thead style="background-color:orange; color:black;">
<tr>
<th>No.</th>
<th>Product</th>
<th>Description</th>
<th>Price</th>
<th>Quantity</th>
 <th></th> 
<th></th>
<th>Total Price</th>
<tr>
</thead>
<?php		
 foreach($_SESSION['cart'] as $product){
	// $mrp = $product['quantity']*$product['mrp'];
?>
  <tbody style="background-color: white; color:black;"> 
 <tr>
<td><?php echo ++$n;?>. </td>
<td>
<img data-enlargeable style="cursor: zoom-in" src='images/Uploads/<?php echo $product["image"]; ?>' width="75" height="80" />
</td>
<td><?php echo $product["short_description"]; ?><br />
</td>
<td><?php echo "$".$product["mrp"]; ?></td>

<!-- <td>
<form method='post' action=''>
<input type="submit" class="minus" name="minus" value="-">
<input type="text" size="4" class="input-text qty text" title="Qty" value="<?php //echo $product['quantity'];?>" name="" max="29" min="0" step="1" >
<input type="submit" class="plus" name="plus" value="+">
</form> -->

<td>
<form method='post' action=''>
<select name='quantity' class='quantity' onChange="this.form.submit()">
<option <?php if($product["quantity"]==1) echo "selected";?>
value="1">1</option>
<option <?php if($product["quantity"]==2) echo "selected";?>
value="2">2</option>
<option <?php if($product["quantity"]==3) echo "selected";?>
value="3">3</option>
<option <?php if($product["quantity"]==4) echo "selected";?>
value="4">4</option>
<option <?php if($product["quantity"]==5) echo "selected";?>
value="5">5</option>
</select>
</form>

<td>
<form method='post' action=''>
<input type='hidden' name="hId" value="<?php echo $product['id']; ?>" />
<button type='submit' name="delete" class="btn-sm btn-danger">Remove</button>
 <input type='hidden' name="prodId" value="<?php echo $product['id']; ?>" />
<!-- <input type='hidden' name='action' value="change" /> -->
<!-- <button type='submit' class="btn-sm btn-warning">Update</button>  -->
</td>
</form>
<!-- <a href="cart.php?action=delete&prodId=<?php //echo $product['prodId']; ?>"class="btn btn-danger btn-sm a-btn-slide-text" name="action">
            <span class="glyphicon"aria-hidden="true"></span>Remove</a> -->

</td>

 <td><?php echo "$".$product["mrp"]*$product["quantity"]; ?></td>
</tr>
<?php
$mrp += ($product["mrp"]*$product["quantity"]);
}
?> 
<tr>
<td colspan="6" align="center">

<strong> GRAND TOTAL: <?php echo "$".$mrp; ?></strong><style="background-color:orange; color:black;">
<hr>
</td>
</tr>
</tbody>
</table>
</form>
</div>
	

<form action="" method="post">
	<button type="submit" name="deleteAll" class="btn-lg btn-danger" style="margin-left:40%;" >Delete all cart Items</button>
	</form>
<!-- <a href="cart.php?delete=<?php echo $product['prodId']; ?>"class="btn btn-danger btn-sm a-btn-slide-text" style="margin-left:45%" name="deleteA
            <span class="glyphicon"aria-hidden="true"></span>Remove All Cart Items</a> -->
  <?php
}else{ 
	// echo "<pre>"; print_r($_SESSION('cart')); echo "</pre>";
//  echo "<h2> Your cart is empty!</h2>";
echo "<h1 align=center style=color:orange>Your Cart Is Empty </h1> <br> ";
 }
 
?>
</div>
<div style="clear:both;"></div>

<div class="message_box" style="margin:10px 0px;">
<?php echo $status; ?>
</div>
						
	</section> </#cart_items-->

	 <section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>What would you like to do next?</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
				<div class="col-sm-6">
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
							<li class="single_field zip-field">
								<label>Zip Code:</label>
								<input type="text">
							</li>
						</ul>
						<a class="btn btn-default update" href="">Get Quotes</a>
						<a class="btn btn-default check_out" href="">Continue</a>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Cart Sub Total <span>$59</span></li>
							<li>Eco Tax <span>$2</span></li>
							<li>Shipping Cost <span>Free</span></li>
							<li>Total <span>$61</span></li>
						</ul>
							<a class="btn btn-default update" href="">Update</a>
							<a class="btn btn-default check_out" href="">Check Out</a>
					</div>
				</div>
			</div>
		</div>
	</section> 


<!-- <script>
// update quantity button listener
$('.update-quantity-form').on('submit', function(){
 
    // get basic information for updating the cart
    var id = $(this).find('.product-id').text();
    var quantity = $(this).find('.cart-quantity').val();
 
    // redirect to update_quantity.php, with parameter values to process the request
    window.location.href = "update_quantity.php?id=" + id + "&quantity=" + quantity;
    return false;
});
</script> -->
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
	


<!-- <td>
					<div class="quantity buttons_added">
					<form action="" method="post">
						<input type="submit" class="minus" name="minus" value="-">				
						<input type="text" size="4" class="input-text qty text" title="Qty" value="<?php //echo $qua;?>" name="" max="29" min="0" step="1" >
						<input type="submit" class="plus" name="plus" value="+">
					</form>					
					</div>
				</td>
				<td>
					<span class="amount">$ <?php //echo number_format($row['mrp'] * $qua); ?></span>
				</td>
				<td>
					<a class="remove remove_cart" href="#" dataid="<?php //echo $row['prodId']; ?>">×</a>
				</td> -->