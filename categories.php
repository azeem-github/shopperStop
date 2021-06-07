<?php
if(session_status()!== PHP_SESSION_ACTIVE){
	session_start();  }

require 'config/config.php';	
define('title', 'Categories| E-Shopper');
include 'header.php'; 

//Add Item To Cart
if(isset($_POST['addCart'])){
	$_SESSION['prodId'] = $_POST['id'];
	echo "<script>window.location.href='cart.php';</script>";

}

if(isset($_POST['prodId']) && $_POST['prodId']!=""){
	$prodId = $_POST['prodId'];
	$result = mysqli_query(
		$conn, "SELECT * FROM products WHERE id='$prodId'"
	);
	$row = mysqli_fetch_assoc($result);
	$image = $row['image'];
	$short_description = $row['short_description'];
	$mrp = $row['mrp'];


	$caartArray = array(
		$prodId=>array(
			'image'=>$image,
			'short_description'=>$short_description,
			'mrp'=>$mrp,
			'quantity'=>1)
		);
	
}
?>

<form action="" method="POST">
	<section id="advertisement">
		<div class="container">
			<img src="images/shop/advertisement.jpg" alt="" />
		</div>
	</section>
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							<div class="panel panel-default">
                            <?php 
                            $query = mysqli_query($conn, "SELECT * FROM categories");
							//  echo "<pre>"; print_r($query); echo "</pre>"; exit;
                            while($rows = mysqli_fetch_array($query)){
							//   echo "<pre>"; print_r($rows); echo "</pre>"; 
								$count = mysqli_query($conn, "SELECT id FROM products WHERE products.category = $rows[id]");
								$prodCount = mysqli_num_rows($count);
								?>
								<div class="panel-heading">
									
									<h4 class="panel-title"><a href="categories.php?id=<?php echo $rows['id']; ?>">
										<img src="images/IMAGES/<?php echo $rows['image']; ?>" height="20" width="20" alt="" />
										<?php echo $rows['category']; ?>
										<span class="pull-right">(<?php echo $prodCount; ?>)</span>
										</a>
										</h4>
								</div>
                                <?php } ?>
							</div>
					
						</div><!--/category-productsr-->
					
						
						<div class="price-range"><!--price-range-->
							<h2>Price Range</h2>
							<div class="well">
								 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
								 <b>$ 0</b> <b class="pull-right">$ 600</b>
							</div>
						</div><!--/price-range-->
						
						<div class="shipping text-center"><!--shipping-->
							<img src="images/home/shipping.jpg" alt="" />
						</div><!--/shipping-->
						
					</div>
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>
                        <?php
						if(isset($_GET['id'])){
							$id = $_GET['id'];
						   $query2 = mysqli_query($conn, "SELECT * FROM products WHERE category=$id");
						//    var_dump($query2);
						   											 
                         while($row = mysqli_fetch_array($query2)){
                            // print_r($row);
						 ?>
						<div class="col-sm-4">			
							<div class="product-image-wrapper">
								<div class="single-products">
                               
									<div class="productinfo text-center">
									<form action="" method="post" enctype="multipart/form-data">
										<img data-enlargeable style="cursor: zoom-in" src="images/shop/<?php echo $row['image']; ?>" alt="" />
										<h2>$ <?php echo $row['mrp']; ?></h2>
											<p><?php echo $row['short_description']; ?></p>
											<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
										<button type="submit" name="addCart" class="btn btn-warning" style="width:100%;"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
									</form>
									</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
										<li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
									</ul>
								</div>
							</div>
						</div>
                        <?php } ?>
						<?php  } else {
							$query3 = mysqli_query($conn, "SELECT * FROM products");
							while($row1 = mysqli_fetch_array($query3)){

							?>	
							<div class="col-sm-4">			
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<img src="images/shop/<?php echo $row1['image']; ?>" alt="" />
										<h2>$ <?php echo $row1['mrp']; ?></h2>
											<p><?php echo $row1['short_description']; ?></p>
										<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
									</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
										<li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
									</ul>
								</div>
							</div>
						</div>
					
						<?php } } ?>
				</div>
						<ul class="pagination">
							<li class="active"><a href="">1</a></li>
							<li><a href="">2</a></li>
							<li><a href="">3</a></li>
							<li><a href="">&raquo;</a></li>
						</ul>
					</div><!--features_items-->
			</div>
		</div>
	</section>
</form>
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
	var ctotal=document.getElementsById('cTotal');
	var ct=0; //cart total

	function subTotal(){
		ct=0;
		for(i = 0; i < iprice.length; i++) {
			itotal[i].innerText = (iprice[i].value)*
			(iquantity[i].value);
			ct = ct +(iprice[i].value)*(iquantity[i].
			value);
		}
		cTotal.innerText = ct;
	}
	subTotal();
	</script>