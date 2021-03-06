<?php ?>


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

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css">

	<!-- Custom Css -->
	<link rel="stylesheet" href="../css/change-password.css">

</head>

<body>

	<!-- Change-password  -->
	<section id="change-password">
		<div class="container">
		<div class="main-content">
			<div class="row text-center">
				<div class="col-md-12 col-sm-12 col-12 text-center">
					<div id="heading-img" class="text-center">
						<img src="../images/Front_images/top-logo.png" class="text-center" alt="heading image" />
					</div>
				</div>
			</div>

			<div class="row">
				<div class="form">

					<form class="myForm text-left" action="#" method="POST">
						<h2 class="heading text-center">Change Password</h2>
						<p class="pera text-center" id="form-p">Enter your new password to change your password</p>

						<div class="form-group">
							<label class="form-label">Old Password</label>
							<input class="myInput" maxlength="21" type="password" id="old-password" placeholder="enter your Password" value="" required>
							<span toggle="#old-password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
						</div>
						
						<div class="form-group">
							<label class="form-label">New Password</label>
							<input class="myInput" maxlength="21" type="password" id="new-password" placeholder="enter your Password" value="" required>
							<span toggle="#new-password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
						</div>
						
						<div class="form-group">
							<label class="form-label">Confirm Password</label>
							<input class="myInput" maxlength="21" type="password" id="confirm-password" placeholder="enter your Password" value="" required>
							<span toggle="#confirm-password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
						</div>

	
						<input type="submit" class="btn" value="submit">

					</form>

				</div>
			</div>
			</div>
		</div>
	</section>
	<!-- Change-password Ended -->

	<!-- Add jquery-->
	<script src="../js/jquery.min.js"></script>

	<!-- Bootstrap js -->
	<script src="../js/bootstrap/bootstrap.min.js"></script>

	<!-- Custom JS -->
	<script src="../js/script.js"></script>
</body>

</html>