<?php
if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
require 'config/config.php';
define('title', 'Payments | E-Shopper');
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
 $errorexpyear = '';
 $errorexpmonth = '';
 $errorcvv = '';

 if(isset($_POST['submit'])){

    $cardname = $_POST['cardname'];
    $cardnumber = $_POST['cardnumber'];
    $expyear = $_POST['expyear'];
    $expmonth = $_POST['expmonth'];
    $cvv = $_POST['cvv'];

    if(empty($cardname)){
       $errorcardname .= "Card Name Is Required";
    }
    if(empty($cardnumber)){
       $errorcardnumber .= "Card Number Is Required";
    }

    if(empty($expyear)){
       $errorexpyear .= "Year Expiry Is A Must";
    }
    if(empty($expmonth)){
       $errorexpmonth .= "Month Of Expiry Is A Must";
    }

    $sql = "INSERT INTO payment(cardname, cardnumber, expyear, expmonth, cvv) VALUES ('$cardname', '$cardnumber', '$expyear', '$expmonth',
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
Card Name: <input type="text"  name="cardname" placeholder="Name On Card" /><span style="color:red";><?php echo $errorcardname;?></span></i>

Card number: <input type="text" name="cardnumber" placeholder="1111-2222-8888" /><span style="color:red";><?php echo $errorcardnumber;?></span></i>

Expiry Year: <input type="text" name="expyear" placeholder="2020"><span style="color:red";><?php echo $errorexp_year;?></span>

Expiry Date<input type="text" name="expmonth" placeholder="2020"><span style="color:red";><?php echo $errorexp_month;?></span>

CVV <input type="text" name="cvv" placeholder="XXX9999"><span style="color:red";><?php echo $errorcvv;?></span>
</div>
<form method="POST" action="">
<a href="OrderDetail.php" input type="submit" name="submit" class="btn btn-warning btn-block">Place Order</a>
</div>
</form>
</div>
</div>
</section>
</body>
</html>
<?php include 'footer.php'; ?>
