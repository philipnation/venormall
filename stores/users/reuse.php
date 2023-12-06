<title>reuse bag</title>
<?php
include("../includes/script.php");
session_start();
$bagid = $_GET['id'];
$sql = "SELECT * FROM bags WHERE id='$bagid'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result)>=1){
    $bag = mysqli_fetch_assoc($result);
    $products = explode(",",$bag['product']);
    $productimages = explode(",",$bag['product_image']);
    $unitprices = explode(",",$bag['unitprice']);
    $producttotalprices = explode(",",$bag['product_total_price']);
    $total_price = $bag['total_price'];
    for($i = 0; $i<count($products); $i++){
        $product = trim($products[$i]);
        $productimage = trim($productimages[$i]);
        $unitprice = trim($unitprices[$i]);
        $producttotalprice = trim($producttotalprices[$i]);
        $sql2 = "SELECT * FROM products WHERE food_stuffs = '$product'";
        $result2 = mysqli_query($conn, $sql2);
        $productdetails = mysqli_fetch_assoc($result2);
        $productid = $productdetails['id'];
        $sql3 = "SELECT * FROM product_measure WHERE product_id='$productid'";
        $result3 = mysqli_query($conn, $sql3);
        $measures = mysqli_fetch_assoc($result3);
        $price = $measures['price'];
        $quntity = $producttotalprice/$unitprice;
        $mainprice = $price*$quntity;
        if(isset($_SESSION["shopping_cart"]))
        {
            $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
            if(!in_array($productid, $item_array_id))
            {
                $count = count($_SESSION["shopping_cart"]);
                $item_array = array(
                    'item_id'			=>	$productid,
                    'item_name'			=>	$product,
                    'item_price'		=>	$mainprice,
                    'item_quantity'		=>	$quntity,
                    'unit_price'        =>  $price,
                    'product_image'     =>  $productimage
                );
                $_SESSION["shopping_cart"][$count] = $item_array;
                $status = "<script>alert('added to cart')</script>";
                
            }
            else
            {
                $status = "<script>alert('product already in the cart')</script>";
            }
        }
        else
        {
            $item_array = array(
                    'item_id'			=>	$productid,
                    'item_name'			=>	$product,
                    'item_price'		=>	$mainprice,
                    'item_quantity'		=>	$quntity,
                    'unit_price'        =>  $price,
                    'product_image'     =>  $productimage
            );
            $_SESSION["shopping_cart"][0] = $item_array;
            echo "product added";
        }
        }

}
//echo $status;
echo "<script>location.href='../cart'</script>";
?>