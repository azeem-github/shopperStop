<?php 
if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
require "config/config.php";
$title = "Home | E-Shopper";
include "header.php";

if(isset($_POST['addCart'])){
	$_SESSION['prodId'] = $_POST['prodId'];
	echo "<script>window.location.href='cart.php';</script>";
}
?>
<section id="advertisement">
        <div class="container">
            <img src="images/shop/advertisement.jpg" alt="" />
        </div>
    </section>
    <section id="slider"><!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                            <li data-target="#slider-carousel" data-slide-to="1"></li>
                            <li data-target="#slider-carousel" data-slide-to="2"></li>
                        </ol>
                        
                        <div class="carousel-inner">
                            <div class="item active">
                                <div class="col-sm-6">
                                    <h1><span>E</span>-SHOPPER</h1>
                                    <h2>Free E-Commerce Template</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                    <button type="button" class="btn btn-default get">Get it now</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="images/home/girl1.jpg" class="girl img-responsive" alt="" />
                                    <img src="images/home/pricing.png"  class="pricing" alt="" />
                                </div>
                            </div>
                            <div class="item">
                                <div class="col-sm-6">
                                    <h1><span>E</span>-SHOPPER</h1>
                                    <h2>100% Responsive Design</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                    <button type="button" class="btn btn-default get">Get it now</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="images/home/girl2.jpg" class="girl img-responsive" alt="" />
                                    <img src="images/home/pricing.png"  class="pricing" alt="" />
                                </div>
                            </div>
                            
                            <div class="item">
                                <div class="col-sm-6">
                                    <h1><span>E</span>-SHOPPER</h1>
                                    <h2>Free Ecommerce Template</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                    <button type="button" class="btn btn-default get">Get it now</button>
                                </div>
                                <div class="col-sm-6">
                                    <img src="images/home/girl3.jpg" class="girl img-responsive" alt="" />
                                    <img src="images/home/pricing.png" class="pricing" alt="" />
                                </div>
                            </div>
                            
                        </div>
                        
                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </section><!--/slider-->
	<section>
		<div class="container">
			<div class="row">
<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Category</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							<div class="panel panel-default">
							<?php
							if(isset($_GET['addCart'])){
								$id = $_GET['id'];
							}
							  $query = mysqli_query($conn, "SELECT * FROM categories");
							  
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
							<div class="well text-center">
								 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
								 <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
							</div>
						</div><!--/price-range-->
						
						<div class="shipping text-center"><!--shipping-->
							<img src="images/home/shipping.jpg" alt="" />
						</div><!--/shipping-->
					
					</div>
				</div>
			
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Featured Items</h2>
						
						<?php
						if(isset($_GET['id'])){
							$id = $_GET['id'];
						   $query2 = mysqli_query($conn, "SELECT * FROM products WHERE category=$id");
						   var_dump($query2);
						   											 
                         while($row = mysqli_fetch_array($query2)){
                            print_r($row);
						 ?>
						<div class="col-sm-4">			
							<div class="product-image-wrapper">
								<div class="single-products">
                               
									<div class="productinfo text-center">
										<form action="" method="post" enctype="multipart/form-data">
										<img src="images/shop/<?php echo $row['image']; ?>" alt="" />
										<h2>$ <?php echo $row['mrp']; ?></h2>
											<p><?php echo $row['short_description']; ?></p>
											<input type="hidden" name="prodId" value="<?php echo $row['prodId']; ?>">
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
                        <?php  } ?>
						<?php   } else {
							$query3= mysqli_query($conn, "SELECT * FROM products");
							while($row1 = mysqli_fetch_array($query3)){

							?>	
							<div class="col-sm-4">			
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<form action="" method="post" enctype="multipart/form-data">
										<img src="images/shop/<?php echo $row1['image']; ?>" alt="" />
										<h2>$ <?php echo $row1['mrp']; ?></h2>
											<p><?php echo $row1['short_description']; ?></p>
											<input type="hidden" name="prodId" value="<?php echo $row1
	                                 ['prodId']; ?>">
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
					
						<?php  } } ?> 
				</div>
				</div>
			</div>
		</div>
	</section>	
	<!--  <?php
//if(!empty($_SESSION["addCart"])) {
//$cart_count = count(array_keys($_SESSION["addCart"]));
?>
<div class="cart_div">
<a href="cart.php"><img src="cart-icon.png" /> Cart<span>
<?php// echo $cart_count; ?></span></a>
</div>
<?php
//}
?> -->
	<?php include "footer.php"; ?>