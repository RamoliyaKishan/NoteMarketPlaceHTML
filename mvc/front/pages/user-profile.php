<?php ob_start(); ?>
<?php session_start(); ?>
<?php  include "includes/db.php"; ?>
<?php  include "includes/functions.php"; ?>
    
<?php 

if(isset($_SESSION['emailid'])) {
    
    $emailid = $_SESSION['emailid'];
    
    $query = "SELECT UsersID FROM users WHERE EmailID = '$emailid' ";
    $select_userid_query = mysqli_query($connection, $query);
    
    $row = mysqli_fetch_array($select_userid_query);
    
    $db_UserID = $row['UsersID'];
    $_SESSION['UsersID'] = $db_UserID;
    
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
	<link rel="shortcut icon" href="../images/Front_images/fav-icon.png">

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

				<div class="row">

					<!-- Basic Profile -->
					<div class="col-md-12 col-sm-12 wow fadeInLeft">

						<div class="text-left">
							<h2 class="heading">Basic Profile Details</h2>
						</div>

					</div>
    
					<!-- Basic Profile Form -->
					<div class="col-md-6 col-sm-12 wow fadeInLeft">

						<div class="user-profile-left">

							<form class="myForm text-left" action="#" method="POST">

								<div class="form-group">
									<label class="form-label">First Name *</label>
									<input class="myInput" placeholder="Enter your First Name" type="text" id="first-name" value="" required>
								</div>

								<div class="form-group">
									<label class="form-label">Email *</label>
									<input class="myInput" placeholder="Enter your Email address" type="email" id="login-email" value="" required>
								</div>

								<div class="form-group">
									<label class="form-label">Gender</label>
									<div class="select-gender">
										<select class="myInput" id="gender" placeholder="select your gender" required>
											<option selected disabled>Select Your Gender</option>
											<option class="option" value="1">Male</option>
											<option class="option" value="2">Female</option>
										</select>
									</div>
								</div>

								<div class="form-group ">
									<label class="form-label">Profile Picture</label>

									<div class="image-upload">
										<label class="myInput text-center" for="file-input">
											<img src="../images/Front_images/upload-file.png" class="img-responsive img-fluid" />
											<p>Upload a Picture</p>
										</label>
										<input id="file-input" type="file" />
									</div>

								</div>

							</form>
						</div>
					</div>


					<div class="col-md-6 col-sm-12 wow fadeInUp" data-wow-duration="2s">

						<div class="user-profile-right">
							<form class="myForm text-left" action="#" method="POST">

								<div class="form-group">
									<label class="form-label">Last Name *</label>
									<input class="myInput" placeholder="Enter your Last Name" type="text" id="last-name" value="" required>
								</div>

								<div class="form-group">
									<label class="form-label">Date Of Birth</label>
									<input class="myInput" placeholder="Enter your birth date" type="text" id="birth-date" value="" required>
									<img src="../images/Front_images/calendar.png" class="field-icon img-responsive img-fluid" alt="calander image">
								</div>

								<div class="form-group">
									<label class="form-label">Phone Number</label>
									<div>


										<select class="myInput country-code" id="country-code" required>
											<option selected disabled>--Select your country code -- </option>
											<option class="option" value="1" selected>+91</option>
											<option class="option" value="2">+92</option>
											<option class="option" value="2">+1</option>
											<option class="option" value="2">+44</option>
											<option class="option" value="2">+324</option>
											<option class="option" value="2">+261</option>
										</select>

										<input class="myInput phone-no" maxlength="21" type="phone" id="phone-number" placeholder="enter your phone number" value="" required>
									</div>
								</div>

							</form>
						</div>
					</div>
					
				</div>

			</div>

		</div>

		<div class="content-box-lg">

			<div class="container">

				<div class="row">

					<!-- Address -->
					<div class="col-md-12 col-sm-12 wow fadeInLeft">

						<div class="text-left">
							<h2 class="heading">Address Details</h2>
						</div>

					</div>

					<!-- Address Form -->
					<div class="col-md-6 col-sm-12 wow fadeInLeft">

						<div class="user-profile-left">

							<form class="myForm text-left" action="#" method="POST">

								<div class="form-group">
									<label class="form-label">Address Line 1 *</label>
									<input class="myInput" placeholder="Enter your address" type="text" id="address1" value="" required>
								</div>

								<div class="form-group">
									<label class="form-label">City *</label>
									<input class="myInput" placeholder="Enter your city" type="text" id="city" value="" required>
								</div>

								<div class="form-group">
									<div class="last">
										<label class="form-label">ZipCode *</label>
										<input class="myInput" placeholder="Enter your zipcode" type="text" id="zipcode" value="" required>
									</div>
								</div>

							</form>
						</div>
					</div>


					<div class="col-md-6 col-sm-12 wow fadeInUp" data-wow-duration="2s">

						<div class="user-profile-right">
							<form class="myForm text-left" action="#" method="POST">

								<div class="form-group">
									<label class="form-label">Address Line 2</label>
									<input class="myInput" placeholder="Enter your address" type="text" id="address" value="" required>
								</div>

								<div class="form-group">
									<label class="form-label">State *</label>
									<input class="myInput" placeholder="Enter your state" type="text" id="state" value="" required>
								</div>

								<div class="form-group">
									<div class="last">
										<label class="form-label">Country *</label>
										<input class="myInput" placeholder="Select your country" type="text" id="country" value="" required>
										<img src="images/User-Profile/down-arrow.png" class="arrow-down">
									</div>
								</div>
							</form>
						</div>
					</div>

				</div>

			</div>

		</div>

		<div class="content-box-lg">

			<div class="container">

				<div class="row">

					<!-- University and Collage Information -->
					<div class="col-md-12 col-sm-12 wow fadeInLeft">

						<div class="text-left">
							<h2 class="heading">University and Collage Information </h2>
						</div>

					</div>

					<!-- Address Form -->
					<div class="col-md-6 col-sm-12 wow fadeInLeft">

						<div class="user-profile-left">

							<form class="myForm text-left" action="#" method="POST">

								<div class="form-group">
									<label class="form-label">University</label>
									<input class="myInput" placeholder="Enter your university" type="text" id="university" value="" required>
								</div>

								

							</form>
						</div>
					</div>


					<div class="col-md-6 col-sm-12 wow fadeInUp" data-wow-duration="2s">

						<div class="user-profile-right">
							<form class="myForm text-left" action="#" method="POST">

								<div class="form-group">
									<div class="last">
										<label class="form-label">Collage</label>
										<input class="myInput" placeholder="Enter your collage" type="text" id="colage" value="" required>
									</div>
								</div>

							</form>
						</div>
					</div>
					
					<!--  Buttons  -->
					<div class="col-md-12 col-sm-12">
						<div class="myForm">
							<div class="buttons">
								<div class="last">
									<input type="submit" class="btn" value="SUBMIT">
								</div>
							</div>
						</div>
					</div>

				</div>

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

	<!-- Custom JS -->
	<script src="../js/script.js"></script>

</body>

</html>