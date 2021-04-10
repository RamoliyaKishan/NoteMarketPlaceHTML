<?php ob_start(); ?>
<?php session_start(); ?>
<?php  include "includes/db.php"; ?>
<?php  include "includes/functions.php"; ?>
    
<?php 
$db_FirstName = "";
$db_EmailID = "";

if(isset($_SESSION['UsersID'])) {
    
    $user_id = $_SESSION['UsersID'];
    
    $query = "SELECT FirstName, EmailID FROM users WHERE UsersID = '{$user_id}'";
    $select_user_data = mysqli_query($connection, $query);
    
    if (!$select_user_data) {
        die("QUERY FAILED" . mysqli_error($connection));
    }
    
    while ($row = mysqli_fetch_array($select_user_data)) {

		$db_FirstName .= $row['FirstName'];
		$db_EmailID .= $row['EmailID'];        
    }
    
    
}


if(isset($_POST['submit'])) {

$db_firstname    = $_POST['firstname'];
$db_subject    = $_POST['subject'];
$db_message      = $_POST['comment'];
$db_email      = $_POST['email'];

    $to = "defaultnotemarketplace00@gmail.com";
    $from = "notemarketplace00@gmail.com";
    
    $subject    = $db_firstname . " - " . $db_subject;
    
    $message      = "\r\n" . "Hello, " . "\r\n" . $db_message . "\r\n" . "\r\n";
    $message      .= "Regards, " . "\r\n" . $db_firstname . "\r\n";
    
    $body =  "";
    $body .= "Email From: " . $db_email . "\r\n";
    $body .= "Email To: " . $to . "\r\n";
    $body .= "Subject: " . $subject . "\r\n";
    $body .= "Body: " . "\r\n" . $message;
    
if(mail($to,$subject,$body))
{
    echo "<script type='text/javascript'>alert('We will contact back to you. Thank you.');</script>";
}else{
    echo "<script type='text/javascript'>alert('Please Try Again.');</script>";
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
	<link rel="stylesheet" href="../css/contact-us.css">

</head>

<body>

	<!-- Header -->
    <?php
	    if(isset($_SESSION['UsersID'])) {    
            include "includes/login_nav.php"; 
        }else {
            include "includes/logoff_nav.php";
        }
    ?>

	<!-- Header Ends -->
	
<!-- Top Content -->
		<section id="top-content">

			<div class="content-box-lg">

				<div class="container">

					<div class="row">

						<div class="col-md-12 wow fadeIn">

							<div id="top-heading" class="text-center">

								<h3>Contact Us</h3>
								
							</div>

						</div>

					</div>

				</div>

			</div>

		</section>
	<!-- Top Content Ends -->
	
	<!-- Contact Us -->
	<section id="add-notes">
		
		<!-- Contact form -->
		<div class="content-box-lg">

			<div class="container">

				<div class="row">

					<div class="col-md-12 col-sm-12">
						<div class="header">
							<h2 class="heading">Get In Touch</h2>
							<p class="pera">Let us know how to get back to you</p>
						</div>
					</div>
				
				</div>		
				
				<form class="myForm text-left" method="POST">
				
				<div class="row">
					
					<div class="col-md-6 col-sm-12">
						
						<div class="user-profile-left">
								
								<div class="form-group">
									<label class="form-label">First Name *</label>
									<input class="myInput" placeholder="Enter your First Name" name="firstname" type="text" id="firstname" value="<?php echo "$db_FirstName"; ?>" required>
								</div>

								<div class="form-group">
									<label class="form-label">Email *</label>
									<input class="myInput" placeholder="Enter your Email address" name="email" type="email" id="login-email" value="<?php echo "$db_EmailID"; ?>" required>
								</div>

								<div class="form-group last">
									<label class="form-label">Subject *</label>
									<input class="myInput" placeholder="Enter your subject" type="text" id="subject" name="subject" value="" required>
								</div>
								
								
						</div>
						
					</div>
					
					<!-- Right Side -->
					<div class="col-md-6 col-sm-12">
						
						<div class="user-profile-right">
                            
				            <div class="form-group">
				        		<label class="form-label">Comment / Question *</label>
				    			<textarea class="myInput" placeholder="comments..." type="text" id="comment" name="comment" value="" required></textarea>
				            </div>
								
						</div>
						
					</div>
					
					<!--  Buttons  -->
					<div class="col-md-12 col-sm-12">
						<div class="buttons form-group last">
				    		<input type="submit" name="submit" class="btn" id="save" value="SUBMIT">
				        </div>
					</div>
					
				</div>
                
                </form>
                
			</div>

		</div>
		

	</section>
	<!--  Ends -->
	
	<!-- Footer -->
	<footer>

		<div class="content-box-lg">
			<div class="container">
				<div class="row copyright">

					<div class="col-md-6 col-sm-12">
						<p class="pera">
							Copyright &copy; Tatvasoft All Rights Reserved.
						</p>
					</div>

					<div class="col-md-6 col-sm-12 justify-content-end">
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