<?php 
if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
define('title', 'Forms | E-Shopper');
include 'config/config.php';
include 'header.php'; 
?>

<?php

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
<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<form action="index.php" method="POST">
							<input type="email" name="email" placeholder="Email Address" /><span style="color:red"><?php echo $erroremail; ?></span>
							<input type="password" name="password" placeholder="Password" /><span style="color:red"><?php echo $errorpassword; ?></span>
							<span>
								<input type="checkbox" class="checkbox"> 
								Keep me signed in
							</span>
							<button type="submit" name="login"class="btn btn-default">Login</button>
						</form>
					</div>
				</div>

<?php

$errorname = '';
$erroremail = '';
$errorpassword = '';

if(isset($_POST['submit'])){
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];

if(empty($name)){
	$errorname .= "Name Is Required";
}
if(empty($email)){
	$erroremail .= "Email Is Required";
}

if(empty($password)){
	$errorpassword .= "Password is Required";
}

$conn = mysqli_connect('localhost', 'root', '', 'tshopper');

if($email != ''){
	$sql = "SELECT * FROM users WHERE email = '$email'";
	$search = mysqli_query($conn, $sql);
	$rows = mysqli_num_rows($search);

	if($rows > 0 ){
		$erroremail .= "Email Already Exists";

	}
	else{
		$sql = "INSERT INTO users (name, email, password)VALUES('$name', '$email', '$password')";
		$result = mysqli_query($conn, $sql);
		if($result === TRUE){
			echo "Successfully";
			echo "Login Now";
		}
	}

}
}

?>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form action="#" method="POST">
							<input type="text" name="name" placeholder="Name"/><span style ="color:red"><?php echo $errorname; ?></span>
							<input type="email" name="email" placeholder="Email Address"/><span style ="color:red"><?php echo $erroremail; ?></span>
							<input type="password" name="password" placeholder="Password"/><span style ="color:red"><?php echo $errorpassword; ?></span>
							<button type="submit" name="submit" class="btn btn-default">Signup</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->

<?php include 'footer.php'; ?>