<?php 
session_start();
require 'config/config.php';
include 'header.php';

?>
<!DOCTYPE html>
<html>
<head> </head>
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

<h1 style="text-align: center;">Mode Of Payment</h1>

<div class="Fields">
<div>
<div class="formContainer">
<form>
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
</div>
</div>
<form method="POST" action="orderplaced.php">
<input type="submit" value="Place Order" class="btn btn-warning btn-block">
</div>
</div>
</form>
</div>
</section>
</body>
</html>

<?php include 'footer.php'; ?>