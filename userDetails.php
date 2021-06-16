<?php
if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
require 'config/config.php';
define('title', 'User-Details | E-Shopper');
include 'header.php';



?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../library/css/bootstrap.min.css">
<style>
.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

  h2, h3 {
    margin-top: 0px;
    padding-top: 0px;
  }
  td {
    border-top: none !important;
  }
  hr {
  border: 1px solid lightgrey;
}
</style>
</head>
<body>

 <?php

$errorname = '';
$erroremail = '';
$errormobile = '';
$erroraddress = '';
$errorcity = '';
$errorstate = '';
$errorzip_code = '';
$errorcountry = '';

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $zip_code = $_POST['zip_code'];
    $country = $_POST['country'];

    if(empty($name)){
        $errorname .= "First Name Is Required";
    }
    if(empty($email)){
        $erroremail .= "Email is Required";
    }
    if(empty($mobile)){
      $errormobile .= "Number Is Required";
  }
        if(empty($address)){
            $erroraddress .= "Address Is Required";
        }
        if(empty($city)){
          $errorcity .= "City Is Required";
      }
      if(empty($state)){
        $errorstate .= "State Is Required";
    }
      if(empty($zip_code)){
        $errorzip_code .= "Zip Code Is Required";
    }
    if(empty($country)){
      $errorcountry .= "Country Is Required";
  }    
  if ($email != ''){
    $sql = "SELECT * FROM user_details WHERE(email = '$email')";
    $search = mysqli_query($conn, $sql);
    $rows = mysqli_num_rows($search);
    if($rows > 0){
      $erroremail .= "Email Already Exists";
    } else {

  
        $sql = "INSERT INTO user_details (name, email, mobile, address, city, state, zip_code, country)VALUES('$name', '$email', '$mobile',
         '$address', '$city','$state', '$zip_code', '$country')";
        $result = mysqli_query($conn, $sql);
        if($result === TRUE){
        
           echo "<script>alert('Successfull!');</script>";
           header("Location: payments.php");
        }   
    }
  }
}
?> 

    <div class="row">
      <div class="col-md-7 well">
        <h3>Billing Address</h3>
        <form action="" method="POST">
        <div class="form-group">
          <div class="input-group">
            <div class="input-group-addon addon-diff-color">
                <span class="glyphicon glyphicon-user"></span>
            </div>
            <input class="form-control" type="text" name="name" placeholder="Full Name"><span style="color:red";><?php echo $errorname;?></span></i>
          </div>
        </div>

        <div class="form-group">
          <div class="input-group">
            <div class="input-group-addon addon-diff-color">
                <span class="glyphicon glyphicon-envelope"></span>
            </div>
            <input class="form-control" type="email" name="email" placeholder="example@gmail.com"><span style="color:red";><?php echo $erroremail;?></span></i>
          </div>
        </div>

        <div class="form-group">
          <div class="input-group">
            <div class="input-group-addon addon-diff-color">
                <span class="glyphicon glyphicon-earphone"></span>
            </div>
            <input class="form-control" type="tel"  name="mobile" placeholder="+91 0000 00000 0"> <span style="color:red";><?php echo $errormobile;?></span></i>
          </div>
        </div>

        <div class="form-group">
          <div class="input-group">
            <div class="input-group-addon addon-diff-color">
                <span class="glyphicon glyphicon-home"></span>
            </div>
            <input class="form-control" type="text" name="address" placeholder="11, Abc road"><span style="color:red";><?php echo $erroraddress;?></span></i>
          </div>
        </div>

        <div class="form-group">
          <div class="input-group">
            <div class="input-group-addon addon-diff-color">
                <span class="glyphicon glyphicon-home"></span>
            </div>
            <input class="form-control" type="text" name="city" placeholder="Hydearabad"><span style="color:red";><?php echo $errorcity;?></span></i>
          </div>
        </div>

        <div class="row">
          <div class="col-md-5">
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-addon addon-diff-color">
                    <span class="glyphicon glyphicon-home"></span>
                </div>
                <input class="form-control" type="text" name="state" placeholder="Telangana"><span style="color:red";><?php echo $errorstate;?></span></i>
              </div>
            </div>
          </div>
          <div class="col-md-5 col-md-offset-2">
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-addon addon-diff-color">
                    <span class="glyphicon glyphicon-map-marker"></span>
                </div>
                <input class="form-control" type="text" name="zip_code" placeholder="400-000-3"><span style="color:red";><?php echo $errorzip_code;?></span></i>
              </div>
            </div>
          </div> 
        </div>
        <div class="form-group">
          <div class="input-group">
            <div class="input-group-addon addon-diff-color">
                <span class="glyphicon glyphicon-home"></span>
            </div>
            <input class="form-control" type="text" name="country" placeholder="India"><span style="color:red";><?php echo $errorcountry;?></span></i>
          </div>
        </div>
        
        <input type="hidden" name="id" value="<?php echo $row1['id']; ?>">
        <input type="hidden" name="prodId" value="<?php echo $row1['id']; ?>">
										<button type="submit" name="submit" class="btn btn-warning" style="width:100%;">
										<i class="fa fa-shopping-card"></i>Proceed To Mode Of Payment</button>
      </div>
      <div class="col-md-4 col-md-offset-1 well">

      <?php
      if(isset($_SESSION['cart'])){
        ?>
        <div class="text-right">
                  <h3>Your Order</h3>
                  <hr>

          <!-- <h4><span class="glyphicon glyphicon-shopping-cart"></span><sup id="itemCount"><?php //= //$cartPrices['itemCount']; ?></sup></h4> -->
          <table class="table">
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
            </td>
            <td class="cart_total itotal">
            <p> <?php echo $product['mrp']*$product['qty'];?></p>
              <?php } ?>
            </tbody>
          </table>
          <hr>
          <td>Cart Total :<span id="cTotal"></span></td>
        <div class="text-right">
        </div>
      </div>
    </div>
  </form>
  <?php 
  	}else{ 
      echo "<p align=center style=color:orange>Its Pretty Lonely in here Add Items Please ! :( </p> <br> ";
} ?>
</div>

</body>
</html>
</div>

<?php include 'footer.php';?>

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
    
	
	//Handling ESC
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