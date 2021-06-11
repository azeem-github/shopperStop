<?php
// session_start();
define('title', 'Checkout | E-shopper');
include 'header.php';
if(isset($_SESSION['cart'])){
}
if(isset($_POST['deleteAll'])){ 
	if(isset($_SESSION['cart'])){ 
	session_unset(); 
	echo "<script>alert('Cart is made empty!');</script>";
	}
}


if(isset($_POST['delete'])){
	if($_POST['id'] != ''){
		if(isset($_SESSION['cart'])){ 
			foreach($_SESSION['cart'] as $key => $value){
				//print_r($key)
				if($value['id'] == $_POST['id']){
					unset($_SESSION['cart'][$key]);
					unset($_SESSION['prodId']);
					echo "<script> alert('Item has been Removed'); </script>"; 
				}
			}
		}elseif(isset($_SESSION['prodId'])){
			echo "<script> alert('Session is not set'); </script>"; 
			unset($_SESSION['prodId']);
			session_unset();
		}
	}
}
$erroremail = '';
$errorpassword = '';

if(isset($_POST['login'])){
	$email = $_POST['email'];
	$password = $_POST['password'];

	if(empty($email)){
		$erroremail .= "E-mail Please";
	}

	if(empty($password)){
		$errorpassword .= "Password Please";
	}

$conn = mysqli_connect('localhost', 'root', '', 'tshopper');
//echo "SELECT * FROM user WHERE email= '$email' and password = '$password'"; 
//exit();


$query = myssqli_query($conn, "SELECT * FROM users WHERE email= '$email' and password = '$password'");
if(mysqli_num_rows($query) > 0){
	header("Location: index.php");
	echo "login Suucess";
}
}

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<style>
body {
   font-family: Arial;
   font-size: 15px;
   padding: 4px;
}
* {
   box-sizing: border-box;
}
.Fields {
   display: flex;
   flex-wrap: wrap;
   padding: 10px;
   justify-content: space-around;
}
.Fields div {
   margin-right: 10px;
}
label {
   margin: 15px;
}
.formContainer {
   margin: 10px;
   background-color: white;
   padding: 5px 20px 15px 20px;
   border: 1px solid rgb(191, 246, 250);
   border-radius: 3px;
}
input[type="text"] {
   display: inline-block;
   width: 100%;
   margin-bottom: 20px;
   padding: 9px;
   border: 1px solid #ccc;
   border-radius: 3px;
}
label {
   margin-left: 20px;
   display: block;
}
.icon-formContainer {
   margin-bottom: 20px;
   padding: 7px 0;
   font-size: 24px;
}
.checkout {
   background-color: orange;
   color : white;
   padding: 12px;
   margin: 10px 0;
   border: none;
   width: 100%;
   border-radius: 3px;
   cursor: pointer;
   font-size: 17px;
}
.checkout:hover {
   background-color: orange;
}
a {
   color: black;
}
span.price {
   float: right;
   color: grey;
}
@media (max-width: 800px) {
.Fields {
   flex-direction: column-reverse;
}
}
</style>
</head>
<body>

<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active"></li>
				  </ol>
				  </div><!--/breadcrums-->

				  <?php if(isset($_SESSION['cart']) && count($_SESSION['cart'])>0){ ?>

				  <div class="shopper-informations">
				<div class="row">
					<div class="col-sm-3">
						<div class="shopper-info">
							<p>Shopper Information</p>
							<form>
								<input type="text" placeholder="Email">
								<input type="password" placeholder="Password">
							</form>
							<a class="btn btn-primary" href="">Get Quotes</a>
							<a class="btn btn-primary" href="checkout.php">Continue</a>
						</div>
					</div>
					<div class="col-sm-5 clearfix">
						<div class="bill-to">
							<p>Bill To</p>
							<div class="form-one">
								<form>
									<input type="text" placeholder="Email*">
									<input type="text" placeholder="First Name *">
									<input type="text" placeholder="Middle Name">
									<input type="text" placeholder="Last Name *">
									<input type="text" placeholder="Address *">
							
								</form>
							</div>
							<div class="form-two">
								<form>
									<input type="text" placeholder="Postal Code *">
									<input type="text" placeholder="Mobile Phone*">
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

			<div class="table-responsive cart_info">
				<table class="table table-condensed">
				<thead>
				<tr class="cart_menu">
			<td class="image">Product</td>
			<td class="description">Description</td>
			<td class="price">Price</td>
			<td class="quantity">Quantity</td>
			<td class="total">Total</td>
			<td>Action</td>
						</tr>
	</thead>
	<tbody>
	<?php 
	foreach($_SESSION['cart'] as $product){
		?>
		<tr>
		<td class="cart_product">
		<img data-enlargeable style="cursor: zoom-in" src="images/Uploads/<?php echo $product['image']; ?>" width="100" height="100" alt="">
		</td>
		<td class="cart_description">
		
		<?php echo $product['short_description'];?></p>
		</td>
		<td class="cart_price">
		<p>$<?php echo $product['mrp'];?></p>
		</td>
<td class="cart_quantity">
<div class="cart_quantity_button">
<p class="cart_quantity_input"> <?php echo $product['qty'];?></p>
</td>
<td class="cart_total itotal">
<p class="cart_quantity_input"> <?php echo $product['mrp']*$product['qty'];?></p>
			
			<td class="cart_delete">
				<form action="" method="POST">
				<input type="hidden" name="id" value="<?php echo $product['id']; ?>">
				<button type="submit" name="delete" class="cart_quantity_delete btn-danger"><i class="fa fa-times"></i> Delete</button>
				</form>

<tr>
<td colspan="2">&nbsp;</td>
<td colspan="2">
<table class="table table-condensed total-result">

									<tr>
										<td>Exo Tax</td>
										<td>$0</td>
									</tr>
									<tr class="shipping-cost">
										<td>Shipping Cost</td>
										<td>Free</td>										
									</tr>
									<td>Cart Total </td>
							<td>$130</td>
								</table>
						
						</tr>
						<?php } ?>
					</tbody>
				</table>
				<ol>
				<li class="cart_delete">
							<form action="" method="POST">
							<input type="hidden" name="prodId" value="<?php echo $product['id']; ?>">
								<button name="deleteAll" class="btn btn-danger" style=style="margin-left:90%;class="cart_quantity_delete btn-danger" style="margin-left:87%;" href=""> Clear All Items</button>
								</form>
							</li>
				</ol>
				<?php
			}else{ 
				echo "<h1 align=center style=color:orange>Your Cart Is Empty </h1> <br> ";
 } ?>
			</div>
			
			<a href="shopper.info"></a>
            <input type="button" class="btn btn-warning"  class="fa fa-cart" style="margin-left:1000px;" value="Checkout">
        
			<div class="payment-options">
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

				<h1 style="text-align: center;">Mode Of Payment</h1>

<div class="Fields">
<div>
<div class="formContainer">
<form>
<!-- <div class="Fields">
<div>
<h3>Billing Address :</h3>
<br>
<label for="fname">Full Name</label>
<input type="text" id="fname" name="firstname" />
<label for="email"> Email</label>
<input type="text" id="email" name="email" />
<label for="adr"> Address</label>
<input type="text" id="adr" name="address" />
</div> -->
<div>
<h3>Payment:</h3>
<br>
<label for="cname">Name on Card</label>
<input type="text" id="cname" name="cardname" placeholder="Name On Card" />
<label for="ccnum">Credit card number</label>
<input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-8888" />
<div class="Fields">
<div>
<label for="expyear">Expiration Year</label>
<select>
										<option> Exp Year </option>
										<option>2020</option>
										<option>2021</option>
										<option>2022</option>
										<option>2023</option>
										<option>2024</option>
										<option>2025</option>
										<option>2026</option>
										<option>2026</option>
									</select>
									</div>
									<div>
<label for="expyear">Expiration Month</label>
<select>
										<option> Exp month </option>
										<option>Jan</option>
										<option>Feb</option>
										<option>Mar</option>
										<option>Apr</option>
										<option>May</option>
										<option>Jun</option>
										<option>Jul</option>
										<option>Aug</option>
										<option>Sep</option>
										<option>Oct</option>
										<option>Nov</option>
										<option>Dec</option>
									</select>
									</div><br>
									<br>
									<br>
<div>
<label for="cvv">CVV</label>
<input type="text" id="cvv" name="cvv" placeholder="XXX9999"/>
</div>
</>
</div>
</div>
<input
type="submit"
value="Continue to checkout"
class="checkout"
/>
</form>
</div>
</div>

</div>
</body>
</html>
  
</div>
	</section> <!--/#cart_items-->
  
</div>
	</section> <!--/#cart_items-->
	</section> <!--/#cart_items-->
		</div>
	</section> <!--/#cart_items-->

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
	var iprice=document.getElementsByClassName('iprice');
	var iquantity=document.getElementsByClassName('iquantity');
	var itotal=document.getElementsByClassName('itotal');
	var cTotal=document.getElementById('cTotal');
	var ct=0; //cart total

	function subTotal(){
		ct=0;
		for ( i = 0; i < iprice.length; i++) {
			itotal[i].innerText = (iprice[i].value)*(iquantity[i].value);
			ct = ct + (iprice[i].value)*(iquantity[i].value);
		}
		cTotal.innerText = ct;
	} 

	subTotal();
</script>


