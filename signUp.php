<!DOCTYPE html>
<html>
    <head>
        <title>Swift Sell</title>
        <link rel="stylesheet" href="signup.css">
    </head>

    <body>

    <div class="topbar">
        <div class="casingnav">
            <ul>
                <img src="images/SwiftSell.png" style="height:58px;">
                <li><a href="#" style="color: #4a5c68;">About</a>
                <li><a href="#" style="color: #4a5c68;">example</a></li>
                <li class="navactive"><a href="Home.php" style="color: #4a5c68;">Home</a></li>
            </ul>
        </div>
    </div>

    <div class="categories">
        <center>
            <i><h1>Categories</h1></i>
        </center>
        <hr>
        <div class="categoriefill">
            <h3>Auto</h3>
        </div>
        <div class="categoriefill">
            <h3>Clothing</h3>
        </div>
        <div class="categoriefill">
            <h3>Technology</h3></div>
        <div class="categoriefill">
            <h3>Household</h3>
        </div>
        <div class="categoriefill">
            <h3>Games</h3>
        </div>
        <div class="categoriefill">
            <h3>Tools</h3>
        </div>
        <div class="categoriefill">
            <h3>Sport</h3>
        </div>
    </div>

    <div class="profile">
        <center>
            <img class="profileimg" src="images/default-avatar.png" >

        </center>
        <a href="profile.php">Profile</a>
        <a href="editProfile.php">Edit Profile</a>
        <a href="signIn.php">Sign In</a>
        <a href="signOut.php">Sign Out</a>
        <a href="signUp.php">Sign Up</a>
        <a href="upload.php">Upload</a>
    </div>

    <div class="categorybody">

        <div class="textbox">
            <h1>Sign Up</h1>
        </div>

        <center>
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
            <input type="file" name="image" id="image">
            <label for="image">Profile Image</label>
            <br><br>
            <input type="password" name="password">
            <label for="password">Password</label>
            <br><br>
            <input type="password" name="confirmPassword">
            <label for="confirmPassword">Confirm Password</label>
            <br><br>
            <button type="submit" name="signUp" value="1">Sign Up</button>
        </form>
            </div>
        </center>
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
                        $query = $dbh->prepare("INSERT INTO users VALUES (:userid, :username, :email, :address, :phoneNumber, :cardNumber, :catagory, :image, :password)");
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

    </body>
</html>
