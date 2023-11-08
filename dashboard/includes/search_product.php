<?php
include("conn.php");
session_start();

$sql = "SELECT * FROM products WHERE userid = '$_SESSION[id]'";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)){
    $names = strtolower($row['product_name']);
    $existnames = array($names);
    if (isset($_POST['sugess'])){
        $name = strtolower($_POST['sugess']);
        if (!empty($name)){
            foreach($existnames as $existname){
                if (strpos($existname, $name) !== false){
                    $product_sql = "SELECT * FROM products WHERE userid='$_SESSION[id]' AND product_name LIKE '%$existname%'";
                    $product_result = mysqli_query($conn, $product_sql);
                    if(mysqli_num_rows($product_result) > 0){
                        $count = 0;
                    while($product_row = mysqli_fetch_assoc($product_result)){
                        $selling_price = number_format($product_row['selling_price']);
                        $count++;
                        echo "
                        <tr>
                            <td>$count</td>
                            <td><img src='../stores/assets/images/product_image/$product_row[product_image]' alt='$product_row[product_name]'></td>
                            <td>$product_row[product_name]</td>
                            <td>$product_row[category]</td>
                            <td>NGN $selling_price</td>
                            <td>
                            <div class='icons'>
                                <a href='#' class='small' title='copy single link'><i class='fa fa-link copy'><span style='display:none;'>localhost/venormall/stores/s/product-$product_row[product_code]-$_SESSION[id]</span></i></a>
                                <a href='editproduct-$product_row[id]' class='atc' title='edit $product_row[product_name]'><i class='fa fa-pencil'></i></a>
                                <a href='deleteproduct-$product_row[id]' class='atc' title='delete $product_row[product_name]'><i class='fa fa-trash'></i></a>
                            </div>
                            </td>
                        </tr>
                        ";
                    }
                }
                else{
                    echo "<p>no record found</p>";
                }
                }
            }
        }
    }
}
?>
