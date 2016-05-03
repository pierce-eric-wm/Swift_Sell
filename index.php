<?php
    session_start();
    require_once('connect.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Swift Sell</title>
        <link rel="stylesheet" href="stylesheet.css">
    </head>

    <body>
        <a href="index.php">Swift Sell</a>

        <?php
            // Get 10 of the newest products
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
                echo '<strong>Seller:</strong>' .$row['users_username'] .'<br />';
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
    // if you picked something you see that something

    // if (???) {
    // php stuff echo
    // }
}


?>
    </body>
</html>
