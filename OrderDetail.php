<?php
session_start();
require 'config/config.php';
define('title', 'Order placed | E-Shopper');
include 'header.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../library/css/bootstrap.min.css">
<style>
h2 {
    margin-top: 0px;
    padding-top: 0px;
    color: orange;
    text-align : center;
  }
  h3{
      text-align: center;
      color: orange;
  }
  
  </style>
</head>
<?php
echo "<h2>Order Has Been Placed Successfully !</h2>";
?>

<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
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
						</tr>
	</thead>
            <tbody>
              <?php 
              foreach($_SESSION['cart'] as $product){
                ?>
                <tr>
                <td class="cart_product">
                <img data-enlargeable style="cursor: zoom-in" src="images/Uploads/<?php echo $product['image']; ?>" width="80" height="80" alt="">
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
              <?php } ?>
            </tbody>
          </table>
          <hr>
          <span name="cTotal"></span></td>
        <div class="text-right">
        </div>
      </div>
    </div>
  </form>
<?php echo "<h3>Cash On delivery</h3>"; ?>
   <!-- <input type="checkbox"  name="sameadr">Cash On delivery
        </label> -->
<?php include 'footer.php'; ?>

<script>
	var iprice=document.getElementsByClassName('iprice');
	var iquantity=document.getElementsByClassName('iquantity');
	var itotal=document.getElementsByClassName('itotal');
	var cTotal=document.getElementById('cTotal');
	var ct=0; 
	
	// CART TOTAL
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
