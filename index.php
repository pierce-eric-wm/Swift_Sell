<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Swift Sell</title>
</head>
<body>
<tr>
    <div id="navbar">
       <a href="index.php">Home</a>
    </div>
</tr>
<?php
require_once ('connect.php');
// Get all products
$query = "SELECT * FROM products ORDER BY id DESC  LIMIT 10 ";
$stmt =  $dbh->prepare($query);
$stmt->execute();
$id = $stmt->fetchAll();

foreach ($id as $row) {
    echo '<table>';
    // Display the score data
    $filepath = GW_UPLOADPATH . $row['productImage'];
    echo '<tr>';
    echo '<strong>Name:</strong> ' . $row['productName'] . '<br />';
    echo '<strong>Cost:</strong> ' . $row['productPrice'] . '<br />';
    echo '<strong>Description:</strong></tr>' .$row['productLikes'] .'<br />';
    echo '<strong>Likes:</strong></tr>' .$row['productDescription'] .'<br />';
    echo '<strong>Seller:</strong></tr>' .$row['users_username'] .'<br />';
    if (is_file($filepath) && filesize($filepath) > 0) {
        echo '<td><img src="' . $filepath . '"alt="Find Image"  class="image"/></td></tr>';
        echo '</table>';
    }
}
?>
</body>
</html>