<?php ob_start(); ?>
<?php include "db.php"; ?>
<?php
    $query = "SELECT ProfilePicture FROM  user_profile WHERE UsersID = '{$user_id}'";
    $select_profile_picture_query = mysqli_query($connection, $query);
    
    if(mysqli_num_rows($select_profile_picture_query) > 0){
    $row = mysqli_fetch_array($select_profile_picture_query);
    $db_profile_picture = $row['ProfilePicture'];
    }else {
        $db_profile_picture = "";
    }
    
    $query = "SELECT RoleID FROM users WHERE UsersID = '{$user_id}'";
    $select_role_query = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($select_role_query);
    $db_RoleID = $row['RoleID'];

?>
<!-- Header -->
	<header>
		<div class="wrapper">
			<nav class="navbar navbar-expand-md">
				<div class="container">

					<!-- logo -->
                    <a class="navbar-brand" href="dashboard.php">
                        <img src="../images/Admin_images/logo.png" alt="logo">
                    </a>
                <!-- Mobile Menu Open Button -->
                <span id="mobile-nav-open-btn">&#9776;</span>
                
                 
                <!-- Main Menu-->
                <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                    <ul class="nav navbar-nav pull-right">
                        <li class="nav-item">
                            <a class="item" href="dashboard.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <div class="dropdown">
                                <a class="item" href="#" role="button" id="notesMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Notes
                                </a>
                                <div class="dropdown-menu" aria-labelledby="notesMenuLink">
                                    <a class="dropdown-item" href="notes-under-review.php">Notes Under Review</a>
                                    <a class="dropdown-item" href="published-notes.php">Published Notes</a>
                                    <a class="dropdown-item" href="downloads.php">Downloaded Notes</a>
                                    <a class="dropdown-item" href="rejected-notes.php">Rejected Notes</a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="item" href="members.php">Members</a>
                        </li>
                        <li class="nav-item">
                            <div class="dropdown">
                                <a class="item" href="#" role="button" id="reportsMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Reports
                                </a>

                                <div class="dropdown-menu" aria-labelledby="reportsMenuLink">
                                    <a class="dropdown-item" href="spam-reports.php">Spam Reports</a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <div class="dropdown">
                                <a class="item" href="#" role="button" id="settingMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Settings
                                </a>
                                <div class="dropdown-menu" aria-labelledby="settingMenuLink">
                                    <a class="dropdown-item" href="manage-system-config.php">Manage System Configuration</a>
                                    <a class="dropdown-item" href="manage-administrator.php" <?php echo ($db_RoleID == '3') ? "" : "hidden"; ?>>Manage Administrator</a>
                                    <a class="dropdown-item" href="manage-category.php">Manage Category</a>
                                    <a class="dropdown-item" href="manage-type.php">Manage Type</a>
                                    <a class="dropdown-item" href="manage-country.php">Manage Countries</a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="dropdown">
                                <a class="" href="#" role="button" id="userMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="<?php echo ($db_profile_picture == "") ? "../images/Admin_images/default_profile.png" : "../profile pictures/$db_profile_picture" ?>" alt="user image" class="user-img img-responsive rounded-circle">
                                </a>
                                
                                <div class="dropdown-menu" aria-labelledby="userMenuLink">
                                    <a class="dropdown-item" href="my-profile.php">update profile</a>
                                    <a class="dropdown-item" href="../../front/pages/change-password.php">change password</a>
                                    <a class="dropdown-item logout-btn" onclick="return confirm('Are you sure to Logout?')" href="includes/logout.php">logout</a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary" onclick="return confirm('Are you sure to Logout?')" href="includes/logout.php" type="button" role="button">Logout</a>
                        </li>
                    </ul>
                </div>
                
                
                <!-- Mobile Menu-->
                <div id="mobile-nav">
                   
                    <!--Mobile Menu Close Button -->
                    <span id="mobile-nav-close-btn">&times;</span>

                    <div id="mobile-nav-content">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="item" href="dashboard.php">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <div class="dropdown">
                                   <a class="" href="#" role="button" id="notesMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Notes
                                   </a>
                                   <div class="dropdown-menu" aria-labelledby="notesMenuLink">
                                      <a class="dropdown-item" href="notes-under-review.php">Notes Under Review</a>
                                       <a class="dropdown-item" href="published-notes.php">Published Notes</a>
                                      <a class="dropdown-item" href="downloads.php">Downloaded Notes</a>
                                       <a class="dropdown-item" href="rejected-notes.php">Rejected Notes</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                            <a class="item" href="members.php">Members</a>
                            </li>
                            <li class="nav-item">
                                <div class="dropdown">
                                    <a class="" href="#" role="button" id="reportsMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Reports
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="reportsMenuLink">
                                        <a class="dropdown-item" href="spam-reports.php">Spam Reports</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <div class="dropdown">
                                    <a class="" href="#" role="button" id="settingMenuLink" data-toggle="dropdown" aria-haspopup="true"   aria-expanded="false">
                                        Settings
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="settingMenuLink">
                                        <a class="dropdown-item" href="manage-system-config.php">Manage System Configuration</a>
                                        <a class="dropdown-item" href="manage-administrator.php" <?php echo ($db_RoleID == '3') ? "" : "hidden"; ?>>Manage Administrator</a>
                                        <a class="dropdown-item" href="manage-category.php">Manage Category</a>
                                        <a class="dropdown-item" href="manage-type.php">Manage Type</a>
                                        <a class="dropdown-item" href="manage-country.php">Manage Countries</a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dropdown">
                                    <a class="" href="#" role="button" id="userMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="<?php echo ($db_profile_picture == "") ? "../images/Admin_images/default_profile.png" : "../profile pictures/$db_profile_picture" ?>" alt="user image" class="user-img img-responsive rounded-circle">
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="userMenuLink">
                                        <a class="dropdown-item" href="update-profile.php">update profile</a>
                                        <a class="dropdown-item" href="../../front/pages/change-password.php">change password</a>
                                        <a class="dropdown-item logout-btn" onclick="return confirm('Are you sure to Logout?')" href="includes/logout.php">logout</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-primary" onclick="return confirm('Are you sure to Logout?')" href="includes/logout.php" type="button" role="button">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </nav>
    </div>
</header>