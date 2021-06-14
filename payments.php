<?php 
session_start(); 
require 'config/config.php';
include 'header.php';

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
<?php

$errorcardname = '';
$errorcardnumber = '';
$errorexp_year = '';
$errorexp_month ='';
$errorcvv ='';

if(isset($_POST['submit'])){

   $cardname = $_POST['cardname'];
   $cardnumber = $_POST['cardnumber'];
   $exp_year = $_POST['exp_year'];
   $exp_month = $_POST['exp_month'];
   $cvv = $_POST['cvv'];

if(empty($cardname)){
   $errorcardname .= "Card Number Is Required";
}
if(empty($cardnumber)){
   $errorcardnumber .= "Card Number Is Required";
}

if(empty($exp_year)){
   $errorexp_year .= "Year Of Expiry is Required";
}
if(empty($exp_month)){
   $errorexp_month .= "Month Of Expiry Is Required";
}
if(empty($cvv)){
   $errorcvvv .= "Last 4-Digit Number Is Required";
}

 $sql = "INSERT INTO payment (cardname, cardnumber, exp_year, exp_month, cvv) VALUES ('$cardname', '$cardnumber','$exp_year','$exp_month',
'$cvv')";
$result = mysqli_query($conn, $sql);
if($result === TRUE){
   header("Location: OrderDetail.php");
    
   echo "<script>alert('Successfull!');</script>";
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

<h1 style="text-align: center;">Mode Of Payment</h1>
<div class="formContainer">
<form>
<div>
<h3>Payment:</h3>
<br>
<label for="cname">Name on Card</label>
<input type="text"  name="cardname" placeholder="Name On Card" /><span style="color:red";><?php echo $errorcardname;?></span></i>
<label for="ccnum">Credit card number</label>
<input type="text" name="cardnumber" placeholder="1111-2222-8888" /><span style="color:red";><?php echo $errorcardnumber;?></span></i>
<label for="ccnum">Year Of Expiry</label>
<input type="text" name="exp_year" placeholder="2020"><span style="color:red";><?php echo $errorexp_year;?></span>
<label for="ccnum">Month Of Expiry</label>
<input type="text" name="exp_year" placeholder="2020"><span style="color:red";><?php echo $errorexp_year;?></span>
<label for="ccnum">CVV</label>
<input type="text" name="cvv" placeholder="XXX9999"><span style="color:red";><?php echo $errorcvv;?></span>
</div>

<form method="POST" action="">
<input type="submit" name="submit" value="Place Order" class="btn btn-warning btn-block">
</div>
</div>
</form>
</div>
</div>
</section>
</body>
</html>

<?php include 'footer.php'; ?>