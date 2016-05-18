<!DOCTYPE html>
<html>
    <head>
        <title>Swift Sell</title>
        <link rel="stylesheet" href="stylesheet.css">
    </head>

    <body>
    <div class="casingnav">
        <div class="topbar">
            <div class="casingnav">
                <ul>
                    <a href="index.php"><img src="images/SwiftSell.png" style="height:58px; float: left"> </a>
                    <p class="locationlink" style="margin-left: 10px;"><a href="Home.php">Phoenix, Az <span class="glyphicon glyphicon-map-marker"> </span> </a></p>
                    <li><a href="#" style="color: #4a5c68;">Upload</a>
                    <li><a href="#" style="color: #4a5c68;">Sign Out</a></li>
                    <li><a href="#" style="color: #4a5c68;">Edit Profile</a></li>


                </ul>
            </div>
        </div>
    </div>


    <div class="categories">
        <center>
            <i><h1>Categories</h1></i>
            <p> <a href="Home.php">PHOENIX, AZ <span class="glyphicon glyphicon-map-marker"> </span> </a></p>
        </center>
        <a href="categories/auto.php">
            <div class="categoriefill">
                <input type="button" class="button" value="Auto" />
            </div>
        </a>

        <a href="categories/clothing.php">
            <div class="categoriefill">
                <input type="button" class="button" value="Clothing" />
            </div>
        </a>

        <a href="categories/technology.php">
            <div class="categoriefill">
                <input type="button" class="button" value="Technology" />
            </div>
        </a>

        <a href="categories/household.php">
            <div class="categoriefill">
                <input type="button" class="button" value="Household" />
            </div>
        </a>

        <a href="categories/games.php">
            <div class="categoriefill">
                <input type="button" class="button" value="Games" />
            </div>
        </a>

        <a href="categories/tools.php">
            <div class="categoriefill">
                <input type="button" class="button" value="Tools" />
            </div>
        </a>

        <a href="categories/sport.php">
            <div class="categoriefill">
                <input type="button" class="button" value="Sport" />
            </div>
        </a>
    </div>

    <div class="profile">
        <?php
        if (@$_SESSION['signIn'] == true) {
            $profileImage = $_SESSION['profileImage'];
            echo "<center>";
            echo '<img class="profileimg" src="images/' . $profileImage . '" >';
            echo "</center>";
            echo '<a href="profile.php">Profile</a>';
            echo '<a href="editProfile.php">Edit Profile</a>';
            echo '<a href="signOut.php">Sign Out</a>';
            echo '<a href="signUp.php">Sign Up</a>';
            echo '<a href="upload.php">Upload</a>';
        }
        else {
            echo "<center>";
            echo '<img class="profileimg" src="images/default-avatar.png" >';
            echo "</center>";
            echo '<a href="signIn.php">Sign In</a>';
            echo '<a href="signUp.php">Sign Up</a>';
        }
        ?>
    </div>

    <?php
        // Establish Connections and Sessions
        require_once('connect.php');
        session_start();

        if ($_SESSION['signIn']) {
            // Localize all of the SESSIONS
            $userid = $_SESSION['userid'];
            $username = $_SESSION['username'];
            $email = $_SESSION['email'];
            $address = $_SESSION['address'];
            $phoneNumber = $_SESSION['phoneNumber'];
            $cardNumber = $_SESSION['cardNumber'];
            $catagory = $_SESSION['catagory'];
            $profileImage = $_SESSION['profileImage'];
            $password = $_SESSION['password'];

            $imagePath = "profileImages/" . $profileImage;

            echo '<img' . " " . 'width="' . '200px"' . " " . 'src="'. $imagePath .'"/>';
            echo "<br>";
            echo "<h5>$username</h5>";
            echo "<br>";
            echo "<h5>$email</h5>";
            echo "<br>";
            echo "<h5>$address</h5>";
            echo "<br>";
            echo "<h5>$phoneNumber</h5>";
            echo "<br>";
            echo "<h5>$cardNumber</h5>";
            echo "<br>";
            echo "<h5>$catagory</h5>";
        }

        else {
            echo "Log in to see your profile";
        }
    ?>
    </body>
</html>
