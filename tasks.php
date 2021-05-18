workied with login.php (user Registration and Login),
added all the left pane (Categories, Brands and Price Range) in a separate file and included in every file,
added buttons to create/delete Categories and Brands,
Created user account page

when click on particular category then only that product is displayed. Today trying to do the same with the brand. when we chick on a particular brand all the products of that brand should be displayed.

jaweed bhai !
select count(*) from products where brand_id = brandid

rajeev's code
SELECT * FROM products ORDER BY category ASC

Azeem's codes'

1.  foreach( $product_categories as $cat )  { 
   echo $cat->name.' ('.$cat->count.')'; 
}

2. <?php woocommerce_page_title(); 

//$cat->count

global $wp_query;
// get the query object
$cat_obj = $wp_query->get_queried_object();


if($cat_obj)    {
    $category_name = $cat_obj->name;
    $category_desc = $cat_obj->description;
    $category_ID  = $cat_obj->term_id;
}


$term = get_term( $category_ID, 'product_cat' ); 
echo '('. $term->count . ')';


?>      

3. 
$term = get_term( CAT_ID, 'product_cat' );   //Replace your category ID here
echo 'Product Category: '
    . $term->name
    . ' - Count: '
    . $term->count;

*Youtube Code For Count*

$sql = "SELECT count (id) AS total FROM products
WHERE category = 'id'";
$result = mysqli_query($conn, $sql);
$values = mysqli_fetch_assoc($result);
$num_rows = $values['total'];
echo $num_rows;
?>
 
 *GOOGLE <CODE>

 
$args = array(
    'number'     => $number,
    'orderby'    => $orderby,
    'order'      => $order,
    'hide_empty' => $hide_empty,
    'include'    => $ids
);

$product_categories = get_terms( 'product_cat', $args );

foreach( $product_categories as $cat )  { 
   echo $cat->name.' ('.$cat->count.')'; 
}


==================================================

NEW CODE FOR CART.PHP

CONFUSED WHERE DID I PUT THIS CODE
<?php
$result = mysqli_query($con,"SELECT * FROM products");
while($row = mysqli_fetch_assoc($result)){
    echo "<div class='product_wrapper'>
    <form method='post' action=''>
    <input type='hidden' name='id' value=".$row['id']." />
    <div class='image'><img src='".$row['image']."' /></div>
    <div class='short_description'>".$row['short_description']."</div>
    <div class='mrp'>$".$row['mrp']."</div>
    <button type='submit' class='buy'>Buy Now</button>
    </form>
    </div>";
        }
mysqli_close($con);
?>
 
<div style="clear:both;"></div>
 
<div class="message_box" style="margin:10px 0px;">
<?php echo $status; ?>
</div>