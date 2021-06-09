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


?>
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active"></li>
				  </ol>
				  </div><!--/breadcrums-->

				  <?php if(isset($_SESSION['cart']) && count($_SESSION['cart'])>0){ }?>

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

			<div class="table-responsive cart_info">
				<table class="table table-condensed">
				<thead>
				<tr class="cart_menu">
			<td class="image">Item</td>
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
<?php  } ?>
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
					</tbody>
				</table>
			</div>
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


