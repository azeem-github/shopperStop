<?php
if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }

require 'config/config.php';
include 'header.php';
define('title', 'Cart | E-Shopper');

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
		
		}
	}else if(isset($_SESSION['prodId'])){ echo 55;
		echo "session is not set"; 
		unset($_SESSION['id']); session_unset(); 
	}

	} 


//CheckOut Functionality
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
				  <li><a href="#">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->

			<div class="step-one">
				<h2 class="heading">Step1</h2>
			</div>
			<div class="checkout-options">
				<h3>New User</h3>
				<p>Checkout options</p>
				<ul class="nav">
					<li>
						<label><input type="checkbox"> Register Account</label>
					</li>
					<li>
						<label><input type="checkbox"> Guest Checkout</label>
					</li>
					<li>
						<a href=""><i class="fa fa-times"></i>Cancel</a>
					</li>
				</ul>
			</div><!--/checkout-options-->

			<div class="register-req">
				<p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
			</div><!--/register-req-->

			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-3">
						<div class="shopper-info">
							<p>Shopper Information</p>
							<form>
								<input type="text" placeholder="Display Name">
								<input type="text" placeholder="User Name">
								<input type="password" placeholder="Password">
								<input type="password" placeholder="Confirm password">
							</form>
							<a class="btn btn-primary" href="">Get Quotes</a>
							<a class="btn btn-primary" href="">Continue</a>
						</div>
					</div>
					<div class="col-sm-5 clearfix">
						<div class="bill-to">
							<p>Bill To</p>
							<div class="form-one">
								<form>
									<input type="text" placeholder="Company Name">
									<input type="text" placeholder="Email*">
									<input type="text" placeholder="Title">
									<input type="text" placeholder="First Name *">
									<input type="text" placeholder="Middle Name">
									<input type="text" placeholder="Last Name *">
									<input type="text" placeholder="Address 1 *">
									<input type="text" placeholder="Address 2">
								</form>
							</div>
							<div class="form-two">
								<form>
									<input type="text" placeholder="Zip / Postal Code *">
									<select>
										<option>-- Country --</option>
										<option>United States</option>
										<option>Bangladesh</option>
										<option>UK</option>
										<option>India</option>
										<option>Pakistan</option>
										<option>Ucrane</option>
										<option>Canada</option>
										<option>Dubai</option>
									</select>
									<select>
										<option>-- State / Province / Region --</option>
										<option>United States</option>
										<option>Bangladesh</option>
										<option>UK</option>
										<option>India</option>
										<option>Pakistan</option>
										<option>Ucrane</option>
										<option>Canada</option>
										<option>Dubai</option>
									</select>
									<input type="password" placeholder="Confirm password">
									<input type="text" placeholder="Phone *">
									<input type="text" placeholder="Mobile Phone">
									<input type="text" placeholder="Fax">
								</form>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="order-message">
							<p>Shipping Order</p>
							<textarea name="message"  placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>
							<label><input type="checkbox"> Shipping to bill address</label>
						</div>	
					</div>					
				</div>
			</div>
			<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>
			<form action="" method="post">               
			<?php
if(isset($_SESSION['cart'])){
    $total_price = 0;
?>	
<button type="submit" name="deleteAll" class="btn btn-danger" style="margin-left:87%;">Delete all cart Items</button>
<table class="table table-bordered table-striped text-center">
<thead style="background-color:orange; color:black;">
<tr>
<th>No.</th>
<th>Product</th>
<th>Description</th>
<th>Price</th>
<th>Quantity</th>
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
<td colspan="6"  align="right-center"><?php echo "$".$product["mrp"]*$product["quantity"]; ?></td>
</tr>
<?php
$mrp += ($product["mrp"]*$product["quantity"]);
}
?> 

<br>
<tr>
										<td colspan="5" align="center">Cart Sub Total</td>
										<td>$</td>
									</tr>
									<tr>
										<td colspan="5" align="center">Exo Tax</td>
										<td>$</td>
									</tr>
								
										<td colspan="5" align="center">Shipping Cost</td>
										<td>Free</td>										
									</tr>
									<tr>
										<td style=color:orange colspan="5" align="center">Grand Total</td>
										<td style=color:orange><span>$</span></td>
									</tr>
									</tr>
</td>
</tbody>
</table>
</form>
<form action="" method="post">               
	<!-- <button type="submit" name="deleteAll" class="btn btn-danger" style="margin-left:20%;">Delete all cart Items</button> -->
<button class="btn btn-warning" style="margin-left:85%;">Place Order <i class="fa fa-shopping-cart"></i></button>
</tr>
<?php
}else{ 
	// echo "<pre>"; print_r($_SESSION('cart')); echo "</pre>";
//  echo "<h2> Your cart is empty!</h2>";
echo "<h1 align=center style=color:orange> Checkout Is Empty </h1> ";
echo "<p align=center style=color:red> Add Items to Cart </p><br> ";
 }
?>
</div>
</div>
</br>
<br>
		
			<!-- <div class="payment-options">
					<span>
						<label><input type="checkbox"> Direct Bank Transfer</label>
					</span>
					<span>
						<label><input type="checkbox"> Check Payment</label>
					</span>
					<span>
						<label><input type="checkbox"> Paypal</label>
					</span>
				</div>
		</div>
		</div>
	</section> /#cart_items -->

<?php include 'footer.php'; ?>
