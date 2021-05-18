<?php 
session_start();
$conn = mysqli_connect("localhost", "root", "", "ecom");
if(isset($_POST["addCart"])){
    if(isset($_SESSION["products"])){
$item_array_id = array_columnn($_SESSION["products"], "item_id");
if(!in_array($_GET["id"], $item_array_id))
{
	$count= count($_SESSION["products"]);
	$item_array = array(

		$item_array = array(
			$id = $_GET["id"],
			$short_description = $_POST["short_description"],
			$mrp = $_POST["mrp"],
			$image = $_POST["image"]
		}
$_SESSION["products"][$count] = $item_array
		}
		else{
			echo '<script>alert("item already added")</script>';
			echo '<script>window.location="index.php"</script>';
		}

}else{

}
    }
}else{
	$item_array = array(
	$id = $_GET["id"];
	$short_description = $_POST["short_description"];
	$mrp = $_POST["mrp"];
	$image = $_POST["image"];
	
	$_SESSION["products"][0] = $item_array;
	)



    
}
?>
<?php
require 'config/config.php';
define('title', 'Home | E-Shopper');
include 'header.php'; 
?>

<?php
$query = "SELECT * FROM products ORDER BY id ASC";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0){

    while($row = mysqli_fetch_array($result))
    {
        ?>
<?php } ?>
        <form method="POST" action="index.php?action=add&id=<?php
        echo $row["id"];?>"

        <img src="<?php echo $row["image"]; ?>" class="img-responsive" />
<h4 class="text-info"><?php echo $row["mrp"];  ?></h4>
<input type="text" name="quantity" class="form-control"
value="1" />
<input type="hidden" name="hidden_name" value="<?php echo $row["short_description"];?>" />
<input type="hidden" name="hidden_name" value="<?php echo $row["price"];?>" />
<input type="submit" name="addCart" style="margin-top: 5px" class="btn btn-success"
value="Add To Cart" />
        </form>
        
    }
}

?>
<table class="table table-bordered">
<tr>
<th>S.No</th>
<th>short_description</th>
<th>mrp</th>
<th>image</th>
<th>total</th>
<th>action</th>
</tr>
<?php
if(!empty($_SESSION["products"])){
	$total = 0;
foreach($_SESSION["shopping_cart"] as $keys = $value)
{
?>
<tr>
<td><?php echo $values["id"];?></td>
<td><?php echo $values["image"];?></td>
<td><?php echo $values["short_description"];?></td>
<td>$<?php echo $values["mrp"];?></td>
<td><?php echo number_format($values["quantity"] * $values["mrp"], 2); ?></td>
<td> <a href="index.php?action=delete&id=<?php echo $values["id"]; ?>
<span class="text-danger">REMOVE</span></a></td>
</tr>
<?php
$total = $total + ($values["quantity"] * $values["mrp"]);
}
?>
<tr>
<td colspan="3" align="right" >TOTAL</td>
<td align="right">$<?php echpo number_format($total,
2); ?></td>
<?php
}
?>
</table>
<?php

<i class="id" >S.No</i>
<i class="short_description">Description</i>
<i class="image">Images</i>
<i class="mrp">Price</i>

?>