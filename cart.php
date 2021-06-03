<?php
if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
require 'config/config.php';
include 'header.php';
define('title', 'Cart | E-Shopper');
// $status="";

// CheckOut
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
	echo "<script>alert('Item Removed !');</script>";
		  }
	   
		}
		
		}
	}else if(isset($_SESSION['cart'])){ echo 55;
	 		unset($_SESSION['prodId']);
		session_unset();
			 echo "session is not set";
	}
	} 
// Add to cart Funtionality
if(isset($_SESSION['prodId'])){ 
	$sql = mysqli_query($conn, "SELECT * FROM products WHERE id='$_SESSION[prodId]'"); 
			while($cartRows = mysqli_fetch_assoc($sql)){
        if(isset($_SESSION['cart'])){ 
			$items = array_column($_SESSION['cart'],'short_description'); 
			$prod = $cartRows['short_description']; 
			if(in_array($prod, $items)){			}
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
if(isset($_SESSION['cart'])){
    $total_price = 0;
?>	
<table class="table table-bordered table-striped text-center">
<thead style="background-color:orange; color:black;">
<tr>
<th>No.</th>
<th>Product</th>
<th>Description</th>
<th>Price</th>
<th>Quantity</th>
 <th >Action</th> 
<th>Total Price</th>
<tr>
</thead>
<?php		
 foreach($_SESSION['cart'] as $product){

?>
  <tbody style="background-color: white; color:black;"> 
 <tr>
<td align="left"><?php echo ++$n;?>.</td>
<td>
<img data-enlargeable style="cursor: zoom-in" src='images/Uploads/<?php echo $product["image"]; ?>' width="75" height="80" />
</td>
<td align="left" ><?php echo $product["short_description"]; ?><br />
</td>
<td align="left" ><?php echo "$".$product["mrp"]; ?></td>

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
<td align="center" >
<form method='post' action=''>
<input type='hidden' name="hId" value="<?php echo $product['id']; ?>" />
<button type='submit' name="delete" class="btn-sm btn-warning">Remove</button>
 <!-- <input type='hidden' name="prodId" value="<?php //echo $product['id']; ?>" /> -->
<!-- <input type='hidden' name='action' value="change" /> -->
<!-- <button type='submit' class="btn-sm btn-warning">Update</button>  -->
</td>
</form>
<!-- <a href="cart.php?action=delete&prodId=<?php //echo $product['prodId']; ?>"class="btn btn-danger btn-sm a-btn-slide-text" name="action">
            <span class="glyphicon"aria-hidden="true"></span>Remove</a> -->


 <td colspan="6"  align="right-center"><?php echo "$".$products["mrp"]*$product["quantity"]; ?></td>
</tr>
<?php
$mrp += ($product["mrp"]*$product["quantity"]);
}
?> 
<tr>
<td colspan="9" align="right">
<strong> GRAND TOTAL: <?php echo "$".$mrp; ?></strong>
</td>
</tbody>
</table>
</form>
</div>
<hr>
<br> 
	<form action="" method="post" enctype="multipart/form-data">
	<button type="submit" name="deleteAll" class="btn btn-danger" style="full-width">Delete all cart Items</button>
	</form>
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


				<br>
				<hr>		
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
						<form action="" method="post" enctype="multipart/form-data">
							<a class="btn btn-default update" href="">Update</a>
							<button type="submit" name="checkOut" class="btn btn-default check_out"> CheckOut</button>
							<img data-enlargeable style="cursor: zoom-in" src="images/shop/<?php echo $row1['image']; ?>" alt="" />
										<h2> <?php echo $row1['mrp']; ?></h2>
											<p><?php echo $row1['short_description']; ?></p>
											<input type="hidden" name="id" value="<?php echo $row1['id']; ?>">
										<!-- <button type="submit" name="checkOut" class="btn btn-warning"> CheckOut</button>
									</form> -->
							<!-- <a class="btn btn-default check_out"href="">Check Out</a> -->
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
	