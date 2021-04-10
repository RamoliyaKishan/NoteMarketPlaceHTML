<?php ob_start(); ?>
<?php session_start(); ?>
<?php  include "includes/db.php"; ?>
<?php  include "includes/functions.php"; ?>

<?php

if(isset($_SESSION['UsersID'])) {
    
    $user_id = $_SESSION['UsersID'];
    
    $query = "SELECT * FROM users WHERE UsersID = '{$user_id}'";
    $select_users_query = mysqli_query($connection, $query);
    if(!$select_users_query) {
        die("QUERY FAILED" . mysqli_error($connection));
    }
    
    $row = mysqli_fetch_array($select_users_query);
        $db_FirstName = $row['FirstName'];
        $db_LastName = $row['LastName'];
        $db_EmailID = $row['EmailID'];
    
    
    $query = "SELECT * FROM  user_profile WHERE UsersID = '{$user_id}'";
    $check_request = mysqli_query($connection, $query);
    $count = mysqli_num_rows($check_request);
    
    if($count > 0) {
        
        while($row = mysqli_fetch_array($check_request)) {
            
            $second_emailid = $row['SecondEmailID'];
            $country_code = $row['PhoneCountryCode'];
            $phone_number = $row['PhoneNumber'];
            
            $profile_picture_filename = $row['ProfilePicture'];
            
        }
    }
    else {
        $second_emailid = "";
        $country_code = "";
        $phone_number = "";
        
        $profile_picture_filename = "";
    }
    
    
    
    if(isset($_POST['submit_profile'])) {
            
        $first_name = escape($_POST['first_name']);
        $last_name = escape($_POST['last_name']);
        $second_emailid = escape($_POST['second_emailid']);
        $country_code = escape($_POST['country_code']);
        $phone_number = escape($_POST['phone_number']);
        
        $profile_picture_filename        = $_FILES['profile_picture']['name'];
        $temp_profile_picture_filename   = $_FILES['profile_picture']['tmp_name'];

        move_uploaded_file($temp_profile_picture_filename, "../profile pictures/" .$profile_picture_filename);

        if($count > 0){
            
            
            if($db_FirstName != $first_name || $db_LastName != $last_name) {
                $query = "UPDATE users SET FirstName = '{$first_name}', LastName = '{$last_name}' , ModifiedDate =  now(), ModifiedBy = '{$user_id}' WHERE UsersID = '{$user_id}'"; 
                $update_user = mysqli_query($connection, $query);
            }
            
            $query = "UPDATE user_profile SET SecondEmailID = '{$second_emailid}', PhoneCountryCode = '{$country_code}', PhoneNumber = '{$phone_number}', ProfilePicture = '{$profile_picture_filename}', ModifiedDate =  now(), ModifiedBy = '{$user_id}' WHERE UsersID = '{$user_id}'"; 
            
            $update_profile = mysqli_query($connection, $query);

            if(!$update_profile) {
                die("QUERY FAILED" . mysqli_error($connection));
            }
        }else {
            
            $query = "INSERT INTO user_profile (UsersID, SecondEmailID, PhoneCountryCode, PhoneNumber, ProfilePicture, CreatedDate, CreatedBy) VALUES ('{$user_id}', '{$second_emailid}', '{$country_code}', '{$phone_number}', '{$profile_picture_filename}', now(), '{$user_id}')";

            $add_profile = mysqli_query($connection, $query);

            if(!$add_profile) {
                die("QUERY FAILED" . mysqli_error($connection));
            }else {
                echo "<script type='text/javascript'>alert('Your Profile Updateded Successfully.');  </script>";
            }
        }
       
        redirect("my-profile.php");
        
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

	<!-- meta tags -->
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Title -->
	<title>Market Notes</title>

	<!-- Favicon -->
	<link rel="shortcut icon" href="../images/Admin_images/favicon.ico">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">

	<!-- FontAwesome -->
	<link rel="stylesheet" href="../css/font-awesome/css/font-awesome.min.css">

	<!-- Jquery UI -->
	<link rel="stylesheet" href="../css/jquery-ui/jquery-ui.css">
	<link rel="stylesheet" href="../css/jquery-ui/jquery-ui.structure.css">
	<link rel="stylesheet" href="../css/jquery-ui/jquery-ui.theme.css">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="../css/bootstrap/bootstrap.css">
	
	<!-- DataTable CSS -->
    <link rel="stylesheet" href="../css/DataTables/datatables.css">

	<!-- Custom Css -->
	<link rel="stylesheet" href="../css/my-profile.css">

</head>

<body>

	<!-- Header -->
	<?php
	    if(isset($_SESSION['UsersID'])) {  
            include "includes/login_nav.php"; 
        }else {
            redirect("../../front/pages/login.php");
        }
    ?>
    <!-- Header Ends -->
	
	<!-- Add Notes -->
	<section id="add-notes">

		<!-- form -->
		<div class="content-box-lg">

			<div class="container">

				<div class="row">

					<div class="col-md-12 col-sm-12">
						<div class="text-left">
							<h2 class="heading">My Profile</h2>
						</div>
					</div>
					
					<div class="col-lg-6 col-md-8 col-sm-12">
						
						<div class="user-profile-left">

							<form class="myForm text-left" method="POST" enctype="multipart/form-data">

								<div class="form-group">
									<label class="form-label">First Name *</label>
									<input class="myInput" placeholder="Enter your First Name" type="text" id="first_name" name="first_name" value="<?php echo "$db_FirstName"; ?>" required>
								</div>
								<div class="form-group">
									<label class="form-label">Last Name *</label>
									<input class="myInput" placeholder="Enter your Last Name" type="text" id="last_name" name="last_name" value="<?php echo "$db_LastName"; ?>" required>
								</div>
								<div class="form-group">
									<label class="form-label">Email *</label>
									<input class="myInput" style="background-color:#e8e8e8" placeholder="Enter your Email address" type="email" id="email_id" name="email_id" value="<?php echo "$db_EmailID"; ?>" required readonly>
								</div>
								<div class="form-group">
									<label class="form-label">Secondray Email </label>
									<input class="myInput" placeholder="Enter your Email address" type="email" id="second_emailid" value="<?php echo "$second_emailid"; ?>">
								</div>
								
								<div class="form-group">
									<label class="form-label">Phone Number</label>
									<div>
									
										<select class="myInput country-code" id="country_code" name="country_code">
                                            <option hidden>country code</option>
										    <?php
                                                $query = "SELECT * FROM countries ORDER BY CountryCode ASC";
                                                $select_countries = mysqli_query($connection,$query);
                                                
                                                while($row = mysqli_fetch_assoc($select_countries)) {
                                                    $CountryCode  = $row['CountryCode'];
                                                    $CountryName = $row['CountryName'];
                                                    
                                                    if($country_code == $CountryCode) {
                                                        echo "<option class='option' value=$CountryCode selected>+{$CountryCode}</option>";
                                                    }
                                                    else {
                                                        echo "<option class='option' value=$CountryCode>+{$CountryCode}</option>";
                                                    }
                                                }
                                            ?>
										    
											
										</select>

										<input class="myInput phone-no" maxlength="10" type="phone" id="phone_number" name="phone_number" placeholder="enter your phone number" pattern="[7-9]{1}[0-9]{9}" value="<?php echo "$phone_number"; ?>">
									</div>
								</div>
								
								<div class="form-group ">
									<label class="form-label">Display Picture</label>

									<div class="image-upload">
										<label class="myInput text-center" for="profile_picture">
											<img src="../images/Admin_images/upload-file.png" class="img-responsive img-fluid" />
											<p>Upload a Picture</p>
										</label>
										<input id="profile_picture" name="profile_picture" type="file" accept="image/*" value="<?php echo "$profile_picture_filename"; ?>" />
										<div id="profile_picture_filename"><?php echo "$profile_picture_filename"; ?></div>
									</div>
								</div>
								
								<div class="last">
									<input type="submit" class="btn" name="submit_profile" id="submit_profile" value="SUBMIT">
								</div>
							</form>
						</div>
						
					</div>
					
					
				</div>

			</div>

		</div>
	
	</section>
	
	<!-- Footer -->
	<footer>

		<div class="content-box-lg">
			<div class="container">
				<div class="row copyright">
					
					<div class="col-md-6 col-sm-12">
						<p class="pera">
							Version : 1.1.24
						</p>
					</div>

					<div class="col-md-6 col-sm-12 text-right">
						<p class="pera">
							Copyright &copy; Tatvasoft All Rights Reserved.
						</p>
					</div>


				</div>
			</div>
		</div>

	</footer>
	<!-- Footer Ends -->

	<!-- User Profile Ends -->

	<!-- Add jquery-->
	<script src="../js/jquery.min.js"></script>
	
	<!-- jquery UI-->
	<script src="../js/jquery-ui/jquery-ui.js"></script>
	
	<!-- Bundle/Proper js -->
	<script src="../js/bootstrap/bootstrap.bundle.min.js"></script>

	<!-- Bootstrap js -->
	<script src="../js/bootstrap/bootstrap.min.js"></script>
	
	<!-- DataTable JS -->
    <script src="../js/DataTables/datatables.js"></script>

	<!-- Custom JS -->
	<script src="../js/script.js"></script>
	
	<script> 
        
        /* profile picture */
        $("#profile_picture").change(function(){
          $("#profile_picture_filename").text(this.files[0].name);

        });
    </script>


</body>

</html>