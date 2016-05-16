
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Swift Sell - Remove a Product</title>
</head>
<body>
<h2>Swift Sell- Remove a Product</h2>
​
<?php
require_once('connect.php');

if (isset($_GET['productid'])) {
    $productid = $_GET['productid'];
    $query = "SELECT productid, users_userid, users_username, productName, productPrice, productDescription, productCatagory, productLikes, productImage FROM products WHERE productid = :productid LIMIT 1";
    $stmt = $dbh->prepare($query);
    $stmt->execute(array(
        'productid' => $productid
    ));
    $results = $stmt->fetchAll();
    // Declaring variables based on the userID
    foreach ($results as $row) {
        $users_userid = $row[1];
        $users_username = $row[2];
        $productName = $row[3];
        $productPrice = $row[4];
        $productDescription = $row[5];
        $productCatagory = $row[6];
        $productLikes = $row[7];
        $productImage = $row[8];
    }

    // Echo a confirmation of deletion
    echo '<p>Are you sure you want to delete the following Product?</p>';
    echo '<p><strong>UserId </strong>' . $users_userid . '<br /><strong>Username:</strong>' . $users_username .
        '<br /><strong>Product Name: </strong>' . $productName . '</p><br /><p><strong>Product Price:</strong>'. $productPrice .'</p><br /><p><strong>Product Description </strong> '. $productDescription . '</p><br /><p><strong>Product Category </strong> '. $productCatagory . '</p><br /><p><strong>Product Likes: </strong>'. $productLikes . '</p><br /><p><strong>Product Image </strong>'. $productImage . '</p>';
    echo '<form method="post">';
    echo '<input type="radio" name="confirm" value="Yes" /> Yes ';
    echo '<input type="radio" name="confirm" value="No" checked="checked" /> No <br />';
    echo '<input type="submit" value="submit" name="submit" />';
    echo '<input type="hidden" name="productId" value="' . $productid . '" />';
    echo '<input type="hidden" name="users_userid" value="' . $users_userid . '" />';
    echo '<input type="hidden" name="users_username" value="' . $users_username . '" />';
    echo '<input type="hidden" name="productName" value="' . $productName . '" />';
    echo '<input type="hidden" name="productPrice" value="' . $productPrice . '" />';
    echo '<input type="hidden" name="productDescription" value="' . $productDescription . '" />';
    echo '<input type="hidden" name="productDescription" value="' . $productCatagory . '" />';
    echo '<input type="hidden" name="productLikes" value="' . $productLikes . '" />';
    echo '<input type="hidden" name="productImage" value="' . $productImage . '" />';
    echo '</form>';

    if (isset($_POST['submit'])) {
        if ($_POST['confirm'] == 'Yes') {
            // Delete the screen shot image file from the server
            @unlink('images/' . $productImage);
            // Delete the score data from the database
            $query = "DELETE FROM products WHERE productid = " . $productid . " LIMIT 1";
            $stmt = $dbh->prepare($query);
            $stmt->execute();
            // Confirm success with the user
            echo '<p>The product with that was selected for removal was successfully removed.';
        }
        else {
            echo '<p class="error">Product removal was canceled.</p>';
        }
    }
}
else{
    echo 'The specified product does not exist.';
}


echo '<p><a href="adminProduct.php">&lt;&lt; Back to  user admin page</a></p>';
exit();
?>
​
</body>
</html>