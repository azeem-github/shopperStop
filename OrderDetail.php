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
    margin-top: 10px;
    padding-top: 0px;
    color: orange;
    text-align : center;
  }
  h3{
      text-align: center;
      color: orange;
  }
  h4{
      text-align: center;
      color: orange;
  }
  </style>
</head>
 <div class="col-md-8 col-md-offset-1 well">
        <div class="text-right">
                  <hr>
                  <?php
      if(isset($_SESSION['cart'])){
        ?>
          <!-- <h4><span class="glyphicon glyphicon-shopping-cart"></span><sup id="itemCount"><?php //= //$cartPrices['itemCount']; ?></sup></h4> -->
          <table class="table">
          <h2> Your Order Is Placed Successfully !</h2><br>
              
          <thead>
				<tr>
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
                <img data-enlargeable style="cursor: zoom-in" src="images/Uploads/<?php echo $product['image']; ?>" width="40" height="40" alt="">
                </td>
                <td class="cart_description">
                
                <?php echo $product['short_description'];?></p>
                </td>
                <td class="cart_price">
                <p>$<?php echo $product['mrp'];?></p>
                </td>
            <td class="cart_quantity">
            <p> <?php echo $product['qty'];?></p>
            
            <td class="cart_total itotal">
            <p> <?php echo $product['mrp']*$product['qty'];?></p>
        </td>
            </tbody>
          </table>
          <?php } ?>
          <hr>
          <td>Cart Total :<span id="cTotal"></span></td>
        <div class="text-right">
        </div>
    <?php
    }else {
      echo "<h2>Payment Was too lonely</h2>";
      echo "<h4>Please add items to place order</h4>";

    } ?>
   

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
