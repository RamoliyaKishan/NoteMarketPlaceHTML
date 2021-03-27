<?php ob_start(); ?>
<?php include "db.php"; ?>
<?php
    $query = "SELECT ProfilePicture FROM  user_profile WHERE UsersID = '{$user_id}'";
    $selecct_profile_picture_query = mysqli_query($connection, $query);
        
    if(!$selecct_profile_picture_query) {
        echo "Query Field" . mysqli_error($connection);
    }
    
    if(mysqli_num_rows($selecct_profile_picture_query) > 0){
    $row = mysqli_fetch_array($selecct_profile_picture_query);
    $db_profile_picture = $row['ProfilePicture'];
    }else {
        $db_profile_picture = "";
    }    
?>
  <header>
   
    <div class="wrapper">
        <nav class="navbar navbar-expand-md">
            <div class="container">

                <!-- logo -->
                <a class="navbar-brand justify-content-left" href="index.php">
                    <img src="../images/Front_images/logo.png" alt="logo">
                </a>

                <!-- Mobile Menu Open Button -->
                <span id="mobile-nav-open-btn">&#9776;</span>

                <div class="container">
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                        <ul class="nav navbar-nav pull-right">
                            <li class="nav-item">
                                <a class="item" href="search-notes.php">Search Notes</a>
                            </li>
                            <li class="nav-item">
                                <a class="item" href="dashboard.php">Sell Your Notes</a>
                            </li>
                            <li class="nav-item">
                                <a class="item" href="buyer-request.php">Buyer Request</a>
                            </li>
                            <li class="nav-item">
                                <a class="item" href="faq.php">FAQ</a>
                            </li>
                            <li class="nav-item">
                                <a class="item" href="contact-us.php">Contact Us</a>
                            </li>
                            <li>
                                <div class="dropdown">
                                    <a class="" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="<?php echo ($db_profile_picture == "") ? "../images/Front_images/default_profile.png" : "../profile pictures/$db_profile_picture" ?>" alt="user image" class="user-img img-responsive rounded-circle">
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="user-profile.php">my profile</a>
                                        <a class="dropdown-item" href="my-downloads.php">my downloads</a>
                                        <a class="dropdown-item" href="my-sold-notes.php">my sold notes</a>
                                        <a class="dropdown-item" href="my-rejected-notes.php">my rejected notes</a>
                                        <a class="dropdown-item" href="change-password.php">change password</a>
                                        <a class="dropdown-item logout-btn" onclick="return confirm('Are you sure to Logout?')" href="includes/logout.php">logout</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-primary" href="includes/logout.php" type="button" role="button" onclick="return confirm('Are you sure to Logout?')">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Mobile Menu-->
                <div id="mobile-nav">

                    <!--Mobile Menu Close Button -->
                    <span id="mobile-nav-close-btn">&times;</span>

                    <div id="mobile-nav-content">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="item" href="search-notes.php">Search Notes</a>
                            </li>
                            <li class="nav-item">
                                <a class="item" href="dashboard.php">Sell Your Notes</a>
                            </li>
                            <li class="nav-item">
                                <a class="item" href="buyer-request.php">Buyer Request</a>
                            </li>
                            <li class="nav-item">
                                <a class="item" href="faq.php">FAQ</a>
                            </li>
                            <li class="nav-item">
                                <a class="item" href="contact-us.php">Contact Us</a>
                            </li>
                            <li>
                                <div class="dropdown">
                                    <a class="" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="<?php echo ($db_profile_picture == "") ? "../images/Front_images/default_profile.png" : "../profile pictures/$db_profile_picture" ?>" alt="user image" class="user-img img-responsive rounded-circle">
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="user-profile.php">my profile</a>
                                        <a class="dropdown-item" href="my-downloads.php">my downloads</a>
                                        <a class="dropdown-item" href="my-sold-notes.php">my sold notes</a>
                                        <a class="dropdown-item" href="my-rejected-notes.php">my rejected notes</a>
                                        <a class="dropdown-item" href="change-password.php">change password</a>
                                        <a class="dropdown-item logout-btn" onclick="return confirm('Are you sure to Logout?')" href="includes/logout.php">logout</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-primary" href="includes/logout.php" type="button" role="button" onclick="return confirm('Are you sure to Logout?')">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>