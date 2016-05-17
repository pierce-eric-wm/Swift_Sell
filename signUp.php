<!DOCTYPE html>
<html>
    <head>
         <meta charset="UTF-8">
        <!-- tell internet to use the latest rendering engine -->
        <meta http-eqiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width = device-width, initial- scle = 1">
        <title>Sign Up</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link rel="stylesheet" href="signup.css">
        <link async href="http://fonts.googleapis.com/css?family=Antic" data-generated="http://enjoycss.com" rel="stylesheet" type="text/css"/>
                <link async href="http://fonts.googleapis.com/css?family=Advent%20Pro" data-generated="http://enjoycss.com" rel="stylesheet" type="text/css"/>
    </head>
<body>
    <!--
        <form method="post" name="signUp" enctype="multipart/form-data">
            <input type="text" name="username">
            <label for="username">Username</label>
            <br><br>
            <input type="email" name="email">
            <label for="email">Email</label>
            <br><br>
            <input type="text" name="address">
            <label for="address">Address</label>
            <br><br>
            <input type="number" name="phoneNumber">
            <label for="phoneNumber">Phone Number</label>
            <br><br>
            <input type="number" name="cardNumber">
            <label for="cardNumber">Card Number</label>
            <br><br>
            <select name="catagory">
                <option value="Auto">Auto</option>
                <option value="Clothing">Clothing</option>
                <option value="Technology">Technology</option>
                <option value="Household">Household</option>
                <option value="Games">Games</option>
                <option value="Tools">Tools</option>
                <option value="Sport">Sport</option>
            </select>
            <label for="catagory">Category</label>
            <br><br>
            <label for="image">Profile Image</label>
            <input type="file" name="image" id="image">
            
            <br><br>
            <label for="password">Password</label>
            <input type="password" name="password">
            
            <br><br>
            <label for="confirmPassword">Confirm Password</label>
            <input type="password" name="confirmPassword">
            
            <br><br>
            <button type="submit" name="signUp" value="1">Sign Up</button>
        
            </div>
-->
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
              <h3 style="float:right;">Sign Up</h3>
              <img src="images/SwiftSell.png" style="height:38px;">
          </div>
          <div class="modal-body">
              <div class="row">
                
                <div class="col-lg-12">
                      <div class="well">
                          <form method="post" name="signUp" enctype="multipart/form-data">
                              <div class="form-group">
                                  <label for="username">Username </label>
                                  <input class="button" type="text" name="username" placeholder="Your Username ..." />
                                
                              </div>
                              <div class="form-group">
                                  <label for="email">Email</label>
                                  <input class="button" type="email" name="email" placeholder="Your Email ..." />                                  
                              </div>
                              <div class="form-group">
                                  <label for="address">Address</label>
                                
                                  <input class="button" type="text" name="address" placeholder="Your Address ..." />    
                              </div>
                              <div class="form-group">
                                  <label for="phoneNumber">Phone Number</label>
                                  <input class="button" type="number" name="phoneNumber" placeholder="Your Number ..." />    
                              </div>
                              <div class="form-group">
                                  <label for="cardNumber">Card Number</label>
                                  <input class="button" type="number" name="cardNumber" placeholder="Your Card Number ..." />   
                              </div>
                              <div class="form-group">
                                <label for="catagory">Category</label>
                                  <select name="catagory" class="inputbtn">
                <option value="Auto">Auto</option>
                <option value="Clothing">Clothing</option>
                <option value="Technology">Technology</option>
                <option value="Household">Household</option>
                <option value="Games">Games</option>
                <option value="Tools">Tools</option>
                <option value="Sport">Sport</option>
            </select>
                              </div>
                              <div class="form-group">
                                  <label for="image" style="float:left; margin-right:2px;">Profile Image</label>
            <input type="file" name="image" id="image">
                              </div>
                            <div class="form-group">
                              <label for="password">Password</label>
                                <input class="button" type="password" name="password" placeholder="Your Password ..." />   

                            </div>
                            <div class="form-group">
                              <label for="confirmPassword">Confirm Password</label>
                            <input class="button" type="password" name="confirmPassword" placeholder="Your Password ..." />   




        
                            </div>
                            <button type="submit" name="signUp" value="1" class="signupbutton" style="width:100px;">Sign Up</button>
            
                              <p style="float:right; margin-top:18px;">Already a member?<a href="signIn.php"> Sign In!</a></p>
                          </form>
                      </div>
                  </div>

              </div>
          </div>
      </div>
</div>


               <?php
    // Start the sessions and connect to the database
    require_once ('session.php');
    require_once('connect.php');

    // Once the form has been submited...
    if (@$_POST['signUp']) {
        // Define the POST variables
        $username = $_POST['username'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $phoneNumber = $_POST['phoneNumber'];
        $cardNumber = $_POST['cardNumber'];
        $catagory = $_POST['catagory'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];

        // Define the Image File stuff
        $imageName = $_FILES['image'] ['name'];
        $imageSize = $_FILES['image'] ['size'];

        // Makes sure user fills out all of the forms
        if (!empty($username) && !empty($email) && !empty($address) && !empty($phoneNumber) && !empty($cardNumber) && !empty($catagory) && !empty($imageName) && !empty($password) && !empty($confirmPassword)) {
            // Make sure the user has the same passwords
            if ($password == $confirmPassword) {
                // Make sure the profile image is not bigger than 10Mb
                if ($imageSize < 10485760) {
                    // Define the path for the image to go
                    $imagePath = "profileImages/$imageName";

                    if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                        // If everything is good then we can insert the user data into the databse
                        $query = $dbh->prepare("INSERT INTO users VALUES (:userid, :username, :email, :address, :phoneNumber, SHA(:cardNumber), :catagory, :image, SHA(:password))");
                        $query->execute(
                            array(
                                'userid' => 0,
                                'username' => $username,
                                'email' => $email,
                                'address' => $address,
                                'phoneNumber' => $phoneNumber,
                                'cardNumber' => $cardNumber,
                                'catagory' => $catagory,
                                'image' => $imageName,
                                'password' => $password,
                            )
                        );

                        $query = $dbh->prepare("SELECT * FROM users WHERE email = :email");
                        $query->execute(
                            array(
                                'email' => $email
                            )
                        );
                        $userInfo = $query->fetch();

                        // We then stored user data in PHP Session
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
                        echo "<p>Your profile image did not upload</p>";
                    }
                }
                else {
                    echo "<p>Profile image must be under 10Mb</p>";
                }
            }
            else {
                echo "<p>Make sure your passwords match</p>";
            }
        }
        else {
            echo "<p>You need to fill out all of the form fields</p>";
        }
    }
    ?>
            </div>
        </div>
    </body>


</html>
