<?php
if (session_status() !== PHP_SESSION_ACTIVE) {    session_start();   }
require 'config/config.php';
define('title', 'Cart | E-Shopper');
$status="";

// DELETE BUtton
 if (isset($_POST['addCart']) && $_POST['addCart']=="remove"){
if(!empty($_SESSION["addCart"])) {
    foreach($_SESSION["addCart"] as $key => $value) {
      if($_POST["prodId"] == $key){
      unset($_SESSION["addCart"][$key]);
      $status = "<div class='box' style='color:red;'>
      Product is removed from your cart!</div>";
      }
      if(empty($_SESSION["addCart"]))
      unset($_SESSION["addCart"]);
      } 
}
}
 // ADD to Cart
// if(isset($_SESSION['prodId'])){
//  $sql = mysqli_query($conn, "SELECT * FROM products where id='$_SESSION[prodId]'");
//  while($cartRows = mysqli_fetch_assoc($sql)){
//  if(isset($_SESSION['cart'])){
//  // if (isset($_POST['addCart']) && $_POST['addCart']){
//  //  foreach($_SESSION["addCart"] as $key => $value){
//     if($value['id'] === $_POST["id"]){
//         $value['quantity'] = $_POST["quantity"];
//         break; // Stop the loop after we've found the product
//     }
// }
//    }
// }
if(isset($_SESSION['prodId'])){echo 0;
    $sql = mysqli_query($conn, "SELECT * FROM products WHERE id='$_SESSION[prodId]'"); echo 1;
    $j=1;  
    while($cartRows = mysqli_fetch_array($sql))echo "01"; { echo 2; 
        echo "<pre>"; print_r($cartRows); exit;
        if(isset($_SESSION['cart'])){ echo 3;
            $items = array_column($_SESSION['cart'], 'short_description'); echo 4;
            $prod = $cartRows['short_description']; echo 4;
            if(in_array($prod, $items)){            }
            else{ echo 6;
                $count = count($_SESSION['cart']); echo 7;
                $_SESSION["cartItems"]= $count+1; echo 8;
                // echo "<pre>".$count."</pre>";
                // echo "<pre>"; print_r($_SESSION['cart']); echo "</pre>";
                $_SESSION['cart'][$count] = $cartRows; echo 9;
                echo "<script>alert('Item added to cart'); window.location.href='cart.php'</script>";
            }
        }else{ echo 10;
            // $_SESSION["cartItems"] = 1;
            $_SESSION['cart']['0'] = $cartRows; echo 11;
            echo "<script>alert('Item added to cart'); window.location.href='cart.php'</script>";
        }
        } echo 99;
    }
?>
<?php
    
include 'header.php';
?>

    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                  <li><a href="#">Home</a></li>
                  <li class="active">Shopping Cart</li>
                </ol>
            </div>
            <div class="table-responsive cart_info">
            <div class="cart">
<?php
if(!isset($_SESSION['cart'])){
    // echo "<pre>"; print_r($_SESSION['cart']); echo "</pre>";
    $total_price = 0;
?>
                <table class="table table-condensed">
                    <tbody>

                        <tr>
                            <td class="id">S.No</td>
                            <td class="image">Product</td>
                            <td class="description">Description</td>
                            <td class="mrp">Price</td>
                            <td class="quantity">Quantity</td>
                            <td class="total">Total</td>
                            <td class="delete">Action</td>
                            
                        </tr>
                        <?php 
 foreach($_SESSION['cart'] as $key=>$product){
?>
                    </thead> 
            <tr>
<td>
<img src='<?php echo $product["image"]; ?>' width="50" height="40" />
</td>
<td><?php echo $product["short_description"]; ?><br />
<form method='post' action=''>
<input type='hidden' name='prodId' value="<?php echo $product["prodId"]; ?>" />
<input type='hidden' name='action' value="remove" />
<button type='submit' class='remove'>Remove Item</button>
</form>
</td>
<td>
<form method='post' action=''>
<input type='hidden' name='prodId' value="<?php echo $product["prodId"]; ?>" />
<input type='hidden' name='addCart' value="change" />
<select name='quantity' class='quantity' onChange="this.form.submit()">
<option <?php if($product["quantity"]==1) echo "selected";?>
value="1">1</option>
<option <?php if($product["quantity"]==2) echo "selected";?>
value="2">2</option>
<option <?php if($product["quantity"]==3) echo "selected";?>
value="3">3</option>
<option <?php if($product["quantity"]==4) echo "selected";?>
value="4">4</option>
<option <?php if($product["quantity"]==5) echo "selected";?>
value="5">5</option>
</select>
</form>
</td>
<td><?php echo "$".$product["mrp"]; ?></td>
<td><?php echo "$".$product["mrp"]*$products["quantity"]; ?></td>
</tr>
<?php
$total_price += ($product["mrp"]* $products["quantity"]);
}
?>
<tr>
<td colspan="5" align="right">
<strong>TOTAL: <?php echo "$".$total_price; ?></strong>
</td>
</tr>
</tbody>
</table> 
  <?php
}else{ echo 5;
    echo "<pre>"; print_r($_SESSION('cart')); echo "</pre>";
 echo "<h2>Your cart is empty!</h2>";
 }
?>
</div>
 
<div style="clear:both;"></div>
 
<div class="message_box" style="margin:10px 0px;">
<?php echo $status; ?>
</div>

                        
    </section> </#cart_items-->

     <section id="do_action">
        <div class="container">
            <div class="heading">
                <h3>What would you like to do next?</h3>
                <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="chose_area">
                        <ul class="user_option">
                            <li>
                                <input type="checkbox">
                                <label>Use Coupon Code</label>
                            </li>
                            <li>
                                <input type="checkbox">
                                <label>Use Gift Voucher</label>
                            </li>
                            <li>
                                <input type="checkbox">
                                <label>Estimate Shipping & Taxes</label>
                            </li>
                        </ul>
                        <ul class="user_info">
                            <li class="single_field">
                                <label>Country:</label>
                                <select>
                                    <option>United States</option>
                                    <option>Bangladesh</option>
                                    <option>UK</option>
                                    <option>India</option>
                                    <option>Pakistan</option>
                                    <option>Ucrane</option>
                                    <option>Canada</option>
                                    <option>Dubai</option>
                                </select>
                                
                            </li>
                            <li class="single_field">
                                <label>Region / State:</label>
                                <select>
                                    <option>Select</option>
                                    <option>Dhaka</option>
                                    <option>London</option>
                                    <option>Dillih</option>
                                    <option>Lahore</option>
                                    <option>Alaska</option>
                                    <option>Canada</option>
                                    <option>Dubai</option>
                                </select>
                            
                            </li>
                            <li class="single_field zip-field">
                                <label>Zip Code:</label>
                                <input type="text">
                            </li>
                        </ul>
                        <a class="btn btn-default update" href="">Get Quotes</a>
                        <a class="btn btn-default check_out" href="">Continue</a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="total_area">
                        <ul>
                            <li>Cart Sub Total <span>$59</span></li>
                            <li>Eco Tax <span>$2</span></li>
                            <li>Shipping Cost <span>Free</span></li>
                            <li>Total <span>$61</span></li>
                        </ul>
                            <a class="btn btn-default update" href="">Update</a>
                            <a class="btn btn-default check_out" href="">Check Out</a>
                    </div>
                </div>
            </div>
        </div>
    </section> 

<?php include 'footer.php'; ?>
  