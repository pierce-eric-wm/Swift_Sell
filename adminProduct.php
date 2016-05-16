<?php require_once ('authorize.php'); ?>
    <!DOCTYPE html>
    <html>
    <head>

        <title>Swift Sell Product- ADMIN</title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css" />
    </head>
    <body>
    <p id="userAdminHeader">Product ADMIN PAGE</p>
<?php
require_once ('connect.php');
require_once ('define.php');
// Retrieve the score data from MySQL
$query = "SELECT * FROM products";
$stmt =  $dbh->prepare($query);
$stmt->execute();
$result= $stmt->fetchAll();
//$imagePath = "profileImages/" . $row['profileImage'];
// Loop through the array of score data, formatting it as HTML
echo '<table id="adminTable">';
echo'<td class="adminUserTd">productid</td>';
echo'<td class="adminUserTd">user_userid</td>';
echo'<td class="adminUserTd">user_username</td>';
echo'<td class="adminUserTd">productName</td>';
echo'<td class="adminUserTd">productPrice';
echo '<td class="adminUserTd">productDescription</td>';
echo '<td class="adminUserTd">productCatagory</td>';
echo '<td class="adminUserTd">productLikes</td>';
echo '<td class="adminUserTd">productImage</td>';
echo '<td class="adminUserTd">Remove</td>';

foreach ($result as $row){
    // Display the score data
    echo '<tr></tr>';
    echo '<td class="adminUserTd"><span>' . $row['productid'] . '</span></td>';
    echo '<td class="adminUserTd">' . $row['users_userid'] . '</td>';
    echo '<td class="adminUserTd">' . $row['users_username'] . '</td>';
    echo '<td class="adminUserTd">'. $row ['productName'] . '</td>';
    echo '<td class="adminUserTd">'. $row ['productPrice'] . '</td>';
    echo '<td class="adminUserTd">'. $row ['productDescription'] . '</td>';
    echo '<td class="adminUserTd">'. $row ['productCatagory'] . '</td>';
    echo '<td class="adminUserTd">'. $row ['productLikes'] . '</td>';
    echo '<td class="adminUserTd">'. $row ['productImage'] . '</td>';
    echo '<td class="adminUserTd"><a href="removeProduct.php?productid=' . $row['productid'] . '">Remove</a></td>';
    echo '<tr></tr>';
}
echo '</table>';
echo '<p class="adminLinks"> Go to the <a href="adminUser.php">User</a> page</p>';
exit;
?>