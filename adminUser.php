<?php require_once ('authorize.php'); ?>
    <!DOCTYPE html>
    <html>
    <head>

        <title>Swift Sell User- ADMIN</title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css" />
    </head>
    <body> 
<?php
require_once ('connect.php');
require_once ('define.php');
// Retrieve the score data from MySQL
$query = "SELECT * FROM users";
$stmt =  $dbh->prepare($query);
$stmt->execute();
$result= $stmt->fetchAll();
//$imagePath = "profileImages/" . $row['profileImage'];
// Loop through the array of score data, formatting it as HTML
echo'<div class="categorybodyadmin">';
echo '<p id="userAdminHeader">USER ADMIN PAGE</p>';
echo '<table id="adminTable">';
echo'<td class="adminUserTd">userid</td>';
echo'<td class="adminUserTd">username</td>';
echo'<td class="adminUserTd">email</td>';
echo'<td class="adminUserTd">address</td>';
echo'<td class="adminUserTd">phoneNumber';
echo '<td class="adminUserTd">cardNumber</td>';
echo '<td class="adminUserTd">catagory</td>';
echo '<td class="adminUserTd">profileImage</td>';
echo '<td class="adminUserTd">password</td>';
echo '<td class="adminUserTd">remove</td>';
echo '<td class="adminUserTd">edit</td>';
echo'</div>';
foreach ($result as $row){
    // Display the score data
    echo '<tr></tr>';
    echo '<td class="adminUserTd"><span>' . $row['userid'] . '</span></td>';
    echo '<td class="adminUserTd">' . $row['username'] . '</td>';
    echo '<td class="adminUserTd">' . $row['email'] . '</td>';
    echo '<td class="adminUserTd">'. $row ['address'] . '</td>';
    echo '<td class="adminUserTd">'. $row ['phoneNumber'] . '</td>';
    echo '<td class="adminUserTd">'. $row ['cardNumber'] . '</td>';
    echo '<td class="adminUserTd">'. $row ['catagory'] . '</td>';
    echo '<td class="adminUserTd">'. $row ['profileImage'] . '</td>';
    echo '<td class="adminUserTd">'. $row ['password'] . '</td>';
    echo '<td class="adminUserTd"><a href="removeUser.php?userid=' . $row['userid'] . '">Remove</a></td>';
    echo '<td class="adminUserTd"><a href="editUser.php?userid=' . $row['userid'] . '">Edit</a></td>';
    echo '<tr></tr>';
}
echo '</table>';
echo '<p class="adminLinks"><a href="signUp.php">Create a User</a> (directs to sign up page)</p>';
echo '<p class="adminLinks">Go to the <a href="adminProduct.php">Product</a> page </p>';
echo '<p class="adminLinks"> Go to <a href="index.php.php">Home</a> page</p>';
exit;
?>