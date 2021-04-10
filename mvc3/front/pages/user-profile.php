<?php ob_start(); ?>
<?php session_start(); ?>
<?php include "includes/db.php"; ?>
<?php include "includes/functions.php"; ?>
    
<?php

if(isset($_SESSION['UsersID'])) {
    
    $user_id = $_SESSION['UsersID'];
    
    $query = "SELECT * FROM users WHERE UsersID = '{$user_id}'";
    $select_users_query = mysqli_query($connection, $query);
    if(!$select_users_query) {
        die("QUERY FAILED" . mysqli_error($connection));
    }
    
    while($row = mysqli_fetch_array($select_users_query)) {
        $db_FirstName = $row['FirstName'];
        $db_LastName = $row['LastName'];
        $db_EmailID = $row['EmailID'];
    }
    
    $query = "SELECT * FROM  user_profile WHERE UsersID = '{$user_id}'";
    $check_request = mysqli_query($connection, $query);
    $count = mysqli_num_rows($check_request);
    
    if($count > 0) {
        
        while($row = mysqli_fetch_array($check_request)) {
                
            $birth_date = $row['DOB'];
            $birth_date  = date('d-m-Y',strtotime($birth_date));
            $gender = $row['Gender'];
            $country_code = $row['PhoneCountryCode'];
            $phone_number = $row['PhoneNumber'];
            $address1 = $row['Address1'];
            $address2 = $row['Address2'];
            $city = $row['City'];
            $state = $row['State'];
            $zipcode = $row['ZipCode'];
            $country_id = $row['Country'];
            $university = $row['University'];
            $collage = $row['Collage'];
            
            $profile_picture_filename = $row['ProfilePicture'];
            
        }
    }
    else {
        $birth_date = "";
        $birth_date  = "";
        $gender = "";
        $country_code = "";
        $phone_number = "";
        $address1 = "";
        $address2 = "";
        $city = "";
        $state = "";
        $zipcode = "";
        $country_id = "";
        $university = "";
        $collage = "";
        
        $profile_picture_filename = "";
    }
    
    
    
    if(isset($_POST['submit_profile'])) {
        
        $first_name = escape($_POST['first_name']);
        $last_name = escape($_POST['last_name']);
        
        $birth_date = escape($_POST['birth_date']);
        $birth_date=date('Y-m-d',strtotime($birth_date));
        $gender = escape($_POST['gender']);
        $country_code = escape($_POST['country_code']);
        $phone_number = escape($_POST['phone_number']);
        $address1 = escape($_POST['address1']);
        $address2 = escape($_POST['address2']);
        $city = escape($_POST['city']);
        $state = escape($_POST['state']);
        $zipcode = escape($_POST['zipcode']);
        $country_id = escape($_POST['country']);
        $university = escape($_POST['university']);
        $collage = escape($_POST['collage']);

        $profile_picture_filename        = $_FILES['profile_picture']['name'];
        $temp_profile_picture_filename   = $_FILES['profile_picture']['tmp_name'];

        move_uploaded_file($temp_profile_picture_filename, "../profile pictures/".$profile_picture_filename);

        if($count > 0){
            
            if($db_FirstName != $first_name || $db_LastName != $last_name) {
                $query = "UPDATE users SET FirstName = '{$first_name}', LastName = '{$last_name}' , ModifiedDate =  now(), ModifiedBy = '{$user_id}' WHERE UsersID = '{$user_id}'"; 
                $update_user = mysqli_query($connection, $query);
            }
            
            $query = "UPDATE user_profile SET UsersID = '{$user_id}', DOB = '{$birth_date}', Gender = '{$gender}', PhoneCountryCode = '{$country_code}', PhoneNumber = '{$phone_number}', ProfilePicture = '{$profile_picture_filename}', Address1 = '{$address1}', Address2 = '{$address2}', City = '{$city}', State = '{$state}', ZipCode = '{$zipcode}', Country = '{$country_id}', University = '{$university}', Collage = '{$collage}', ModifiedDate =  now(), ModifiedBy = '{$user_id}' WHERE UsersID = '{$user_id}'"; 

            $update_profile = mysqli_query($connection, $query);

            if(!$update_profile) {
                die("QUERY FAILED" . mysqli_error($connection));
            }
        }else {

            $query = "INSERT INTO user_profile (UsersID, DOB, Gender, PhoneCountryCode, PhoneNumber, ProfilePicture, Address1, Address2, City, State, ZipCode, Country, University, Collage, CreatedDate, CreatedBy) VALUES ('{$user_id}', '{$birth_date}', '{$gender}', '{$country_code}', '{$phone_number}', '{$profile_picture_filename}', '{$address1}', '{$address2}', '{$city}', '{$state}', '{$zipcode}', '{$country_id}', '{$university}', '{$collage}', now(), '{$user_id}')";

            $add_profile = mysqli_query($connection, $query);
            
        }
        
        echo "<script type='text/javascript'>alert('Your Profile Updateded Successfully.');  history.go(-1);</script>";
        
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
	<link rel="shortcut icon" href="../images/Front_images/favicon.ico">

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
	<link rel="stylesheet" href="../css/user-profile.css">
</head>

<body>

	<!-- Header -->
	<?php
	    if(isset($_SESSION['UsersID'])) {
            $user_id = $_SESSION['UsersID'];
            include "includes/login_nav.php"; 
        }else {
            include "includes/logoff_nav.php";
        }
    ?>	<!-- Header Ends -->
	
	<!-- Top Content -->
		<section id="top-content">

			<div class="content-box-lg">

				<div class="container">

					<div class="row">

						<div class="col-md-12 wow fadeIn">

							<div id="top-heading" class="text-center">

								<h3>User Profile</h3>
								
							</div>

						</div>

					</div>

				</div>

			</div>

		</section>
	<!-- Top Content Ends -->
	
	<!-- Forms -->
	<section id="forms">

		<div class="content-box-lg">

			<div class="container">
                
                <form class="myForm text-left" method="POST" enctype="multipart/form-data">

                <!-- Basic Profile -->
				<div class="row">

					<div class="col-md-12 col-sm-12">
						<div class="text-left">
							<h2 class="heading">Basic Profile Details</h2>
						</div>
					</div>
    
					<!-- Basic Profile Form -->
					<div class="col-md-6 col-sm-12">
						<div class="user-profile-left">

								<div class="form-group">
									<label class="form-label">First Name *</label>
									<input class="myInput" placeholder="Enter your First Name" type="text" id="first_name" name="first_name" value="<?php echo "$db_FirstName"; ?>" required>
								</div>

								<div class="form-group">
									<label class="form-label">Email *</label>
									<input class="myInput" style="background-color:#e8e8e8" placeholder="Enter your Email address" type="email" id="email_id" value="<?php echo "$db_EmailID"; ?>" required readonly>
								</div>

								<div class="form-group">
									<label class="form-label">Gender</label>
									<div class="select-gender">
										<select class="myInput" id="gender" name="gender" placeholder="select your gender">
											<option selected disabled>Select Your Gender</option>
											<option class="option" id="gender" value="male" <?php if($gender=="male") echo 'selected="selected"'; ?> >Male</option>
											<option class="option" id="gender" value="female" <?php if($gender=="female") echo 'selected="selected"'; ?> >Female</option>
										</select>
									</div>
								</div>

								<div class="form-group ">
									<label class="form-label">Profile Picture</label>

									<div class="image-upload">
										<label class="myInput text-center" for="profile_picture">
											<img src="../images/Front_images/upload-file.png" class="img-responsive img-fluid" />
											<p>Upload a Picture</p>
										</label>
										<input id="profile_picture" name="profile_picture" type="file" accept="image/*" value="<?php echo "$profile_picture_filename"; ?>" />
										<div id="profile_picture_filename"><?php echo "$profile_picture_filename"; ?></div>
									</div>

								</div>
						</div>
					</div>


					<div class="col-md-6 col-sm-12">
						<div class="user-profile-right">
								<div class="form-group">
									<label class="form-label">Last Name *</label>
									<input class="myInput" placeholder="Enter your Last Name" type="text" id="last_name" name="last_name" value="<?php echo "$db_LastName"; ?>" required>
								</div>

								<div class="form-group">
									<label class="form-label">Date Of Birth</label>
									
								    <input class="myInput" placeholder="Enter your birth date" type="text" id="birth_date" name="birth_date" value="<?php echo $birth_date; ?>">
									<img src="../images/Front_images/calendar.png" id="open_datepicker" class="field-icon img-responsive img-fluid" alt="calander image">
									
								</div>

								<div class="form-group">
									<label class="form-label">Phone Number</label>
									<div>
										<select class="myInput country-code" name="country_code" id="country_code">
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

										<input class="myInput phone-no" maxlength="10" type="phone" id="phone_number" name="phone_number" placeholder="enter your phone number" pattern="[7-9]{1}[0-9]{9}" value="<?php echo $phone_number; ?>" required>
									</div>
								</div>
						</div>
					</div>
					
				</div>
				
				<!-- Address -->
				<div class="row">

					<div class="col-md-12 col-sm-12">
						<div class="text-left" style="margin-top: 60px">
							<h2 class="heading">Address Details</h2>
						</div>
					</div>
    
					<!-- Address Form -->
					<div class="col-md-6 col-sm-12">
						<div class="user-profile-left">
								<div class="form-group">
									<label class="form-label">Address Line 1 *</label>
									<input class="myInput" placeholder="Enter your address" type="text" id="address1" name="address1" value="<?php echo $address1; ?>" required>
								</div>

								<div class="form-group">
									<label class="form-label">City *</label>
									<input class="myInput" placeholder="Enter your city" type="text" id="city" name="city" value="<?php echo $city; ?>" required>
								</div>

								<div class="form-group">
									<div class="last">
										<label class="form-label">ZipCode *</label>
										<input class="myInput" placeholder="Enter your zipcode" type="text" id="zipcode" name="zipcode" value="<?php echo $zipcode; ?>" required>
									</div>
								</div>
							
						</div>
					</div>

					<div class="col-md-6 col-sm-12">

						<div class="user-profile-right">

								<div class="form-group">
									<label class="form-label">Address Line 2</label>
									<input class="myInput" placeholder="Enter your address" type="text" id="address2" name="address2" value="<?php echo $address2; ?>">
								</div>

								<div class="form-group">
									<label class="form-label">State *</label>
									<input class="myInput" placeholder="Enter your state" type="text" id="state" name="state" value="<?php echo $state; ?>" required>
								</div>

								<div class="form-group">
									<div class="last">
									<label class="form-label">Country *</label>
									<select class="myInput" id="country" name="country" required>
											<option selected disabled>Select your country </option>
											<?php
                                                $query = "SELECT * FROM countries";
                                                $select_countries = mysqli_query($connection,$query);
                                                
                                                while($row = mysqli_fetch_assoc($select_countries)) {
                                                    $CountryID  = $row['CountryID'];
                                                    $CountryName = $row['CountryName'];
                                                    
                                                    if($country_id == $CountryID) {
                                                        echo "<option class='option' value=$CountryID selected>{$CountryName}</option>";
                                                    }
                                                    else {
                                                        echo "<option class='option' value=$CountryID>{$CountryName}</option>";
                                                    }
                                                }
                                            ?>
											
										</select>
									</div>
								</div>
						</div>
					</div>
					
				</div>
				
				<!-- University and Collage Information -->
				<div class="row">

					<div class="col-md-12 col-sm-12">
						<div class="text-left" style="margin-top: 60px">
							<h2 class="heading">University and Collage Information </h2>
						</div>
					</div>
    
					<!-- University and Collage Information Form -->
					<div class="col-md-6 col-sm-12">
						<div class="user-profile-left">
				            <div class="form-group">
				    			<label class="form-label">University</label>
				        		<input class="myInput" placeholder="Enter your university" type="text" id="university" name="university" value="<?php echo $university; ?>">
				            </div>
						</div>
					</div>

					<div class="col-md-6 col-sm-12">

						<div class="user-profile-right">
				            <div class="form-group">
								<div class="last">
				            		<label class="form-label">Collage</label>
				        			<input class="myInput" placeholder="Enter your collage" type="text" id="colage" name="collage" value="<?php echo $collage; ?>">
				    			</div>
							</div>
							
						</div>
					</div>
					
					<!--  Buttons  -->
					<div class="col-md-12 col-sm-12">
						<div class="myForm">
							<div class="buttons">
								<div class="last">
									<input type="submit" class="btn" name="submit_profile" id="submit_profile" value="SUBMIT">
								</div>
							</div>
						</div>
					</div>
					
				</div>
				
                </form>
			</div>

		</div>

	</section>
	<!-- Forms Ende-->


	<!-- Footer -->
	<footer>

		<div class="content-box-lg">
			<div class="container">
				<div class="row copyright">

						<div class="col-md-6">
						<p class="pera">
							Copyright &copy; Tatvasoft All Rights Reserved.
						</p>
					</div>

					<div class="col-md-6 justify-content-end">
						<ul class="social-list ">
							<li><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
						</ul>
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

	<!-- Bootstrap js -->
	<script src="../js/bootstrap/bootstrap.min.js"></script>
	
	<!-- DataTable JS -->
    <script src="../js/DataTables/datatables.js"></script>

	<!-- Custom JS -->
	<script src="../js/script.js"></script>

</body>

</html>