<?php
    // Start the sessions and connect to the database
    session_start();
    require_once('connect.php');

    if (@$_POST['signUp']) {

    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Swift Sell</title>
        <link rel="stylesheet" href="stylesheet.css">
    </head>

    <body>
        <h3>Sign Up</h3>

        <form method="post" name="signUp">
            <input type="text" name="username">
            <input type="email" name="email">
            <input type="text" name="address">
            <input type="number" name="phoneNumber">
            <input type="number" name="cardNumber">
            <select name="catagory">
                <option value="Auto">Auto</option>
                <option value="Clothing">Clothing</option>
                <option value="Technology">Technology</option>
                <option value="Household">Household</option>
                <option value="Games">Games</option>
                <option value="Tools">Tools</option>
                <option value="Sport">Sport</option>
            </select>
            <input type="password" name="password">
            <input type="password" name="confirmPassword">
        </form>
    </body>
</html>
