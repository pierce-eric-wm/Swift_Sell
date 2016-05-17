<?php
    // Start the sessions and connect to the database
    session_start();
    require_once('connect.php');

    // Checks to see if user if allready signed in and if so then it takes them to profile password_get_info
    if (@$_SESSION['signIn'] == true) {
        header('location: profile.php');
    }

    // Once the form has been submited...
    if (@$_POST['signIn']) {
        // Define the POST variables
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Makes sure the user fills out all of the forms
        if (!empty($email) && !empty($password)) {
            // If they have entered in all the form fields then we check to see if they are a user
            $query = $dbh->prepare("SELECT * FROM users WHERE email = :email AND password = SHA(:password)");
            $query->execute(
                array(
                    'email' => $email,
                    'password' => $password
                )
            );
            $userInfo = $query->fetch();

            // If a user with that info exits then we store info in SESSIONS and take them to profile
            if ($userInfo) {
                // Store user info in SESSIONS
                $_SESSION['userid'] = $userInfo['0'];
                $_SESSION['username'] = $userInfo['1'];
                $_SESSION['email'] = $userInfo['2'];
                $_SESSION['address'] = $userInfo['3'];
                $_SESSION['phoneNumber'] = $userInfo['4'];
                $_SESSION['cardNumber'] = $userInfo['5'];
                $_SESSION['catagory'] = $userInfo['6'];
                $_SESSION['profileImage'] = $userInfo['7'];
                $_SESSION['password'] = $userInfo['8'];
                $_SESSION['signIn'] = true;

                // Take the user to the profile page
                header('location: profile.php');
            }
            else {
                echo "<p>Sorry we do not have an account that matches that username and password</p>";
            }
        }
        else {
            echo "<p>You did not enter in a username and password</p>";
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <!-- tell internet to use the latest rendering engine -->
        <meta http-eqiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width = device-width, initial- scle = 1">
        <title>Sign In</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="signin.css">
        <link async href="http://fonts.googleapis.com/css?family=Advent%20Pro" data-generated="http://enjoycss.com" rel="stylesheet" type="text/css"/>
    </head>

    <body>

<div class="casingnav">
            <div class="topbar">
                <div class="casingnav">
                    <ul class="navbar">
                        <a href="index.php"><img src="images/SwiftSell.png" style="height:58px; float: left"> </a>
                        <p class="locationlink" style="margin-left: 10px;"><a href="Home.php">Phoenix, Az <span class="glyphicon glyphicon-map-marker"> </span> </a></p>
                        <li class="tabs"><a href="#" style="color: #4a5c68;">About Us</a>
                        <li class="tabs"><a href="#" style="color: #4a5c68;">Locations</a></li>

                    </ul>
                    </div>
                </div>
            </div>

        <div id="login-overlay" class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <img src="images/SwiftSell.png" style="height:38px;">
          </div>
          <div class="modal-body">
              <div class="row">
                  <div class="col-xs-7">
                      <div class="well">
                          <form id="loginForm" method="post" name="signIn">
                              <div class="form-group">
                                  <label for="email" class="control-label">Email</label>
                                  <input class="button" type="email" id="email" name="email"/>
                              </div>
                              <div class="form-group">
                                  <label for="password" class="control-label">Password</label>
                                  <input class="button" type="password" id="password" name="password" />
                              </div>
                              <button type="submit" name="signIn" value="1" class="btn btn-success btn-block" style="background: rgba(40,40,40,0.4); width:120px; border-color:white;">Login</button>
                          </form>
                      </div>
                  </div>
                  <div class="col-xs-5">
                      <p class="lead">Register now for <span class="text-success">FREE</span></p>
                      <ul class="list-unstyled" style="line-height: 2">
                          <li><span class="glyphicon glyphicon-shopping-cart"></span> Sell your products</li>
                          <li><span class="glyphicon glyphicon-edit"></span> Easy to use site</li>
                          <li><span class="glyphicon glyphicon-heart"></span> Like other products</li>
                          <li><span class="glyphicon glyphicon-usd"></span> Fast checkout</li>
                      </ul>
                      <p><a href="signup.php" class="btn btn-info btn-block" style="background-color:#528B9C; width:120px;">Register now!</a></p>
                  </div>
              </div>
          </div>
      </div>
</div>
    </body>
</html>
