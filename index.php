<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Swift Sell</title>
</head>
<body>
<tr>
    <div id="navbar">
       <p><a href="index.php" style="text-decoration:none">Home</a></p>
    </div>
</tr>
<?php
require_once ('connect.php');
require_once ('session.php');
// Get 10 of the newest products if the user is not signed in
$query = "SELECT * FROM products ORDER BY id DESC  LIMIT 10 ";
$stmt =  $dbh->prepare($query);
$stmt->execute();
$id = $stmt->fetchAll();
// Echo 10 of the newest products
foreach ($id as $row) {
    echo '<table>';
    // Display the Product data
    $filepath = GW_UPLOADPATH . $row['productImage'];
    echo '<tr>';
    echo '<strong>Name:</strong> ' . $row['productName'] . '<br />';
    echo '<strong>Cost:</strong> ' . $row['productPrice'] . '<br />';
    echo '<strong>Description:</strong>' .$row['productLikes'] .'<br />';
    echo '<strong>Likes:</strong>' .$row['productDescription'] .'<br />';
    echo '<strong>Seller:</strong>' .$row['username'] .'<br />';
    echo '<strong>Catagorie:</strong>'.$row['productCategorie']. '<br />'
    if (is_file($filepath) && filesize($filepath) > 0) {
        echo '<td><img src="' . $filepath . '"alt="Find Image"  class="image"/></td>';
        echo '</table>';
    }
}
// If the user is signed in then the index will display 10 products to only
// Show items from the categories that the user who is signed in/ logged in likes
if (isset($_SESSION['username'])) {
    echo ' <a href="profile.php">View Profile</a><br />';
    echo ' <a href="logout.php">Log Out (' . $_SESSION['username'] . ')</a>';
    //Show 10 products tied to the categories that the user picked
    $query = "SELECT * FROM products ORDER BY id DESC  LIMIT 10 ";
    $stmt =  $dbh->prepare($query);
    $stmt->execute();
    $data = $stmt->fetchAll();

}

?>
    </body>
</html>
