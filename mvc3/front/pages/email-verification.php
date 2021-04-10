<?php  include "includes/db.php"; ?>
<?php  include "includes/functions.php"; ?>
<?php ob_start(); ?>
<?php session_start(); ?>


<?php               
    
    $user_id = "";
    $fname = "";

    if(isset($_SESSION['UsersID'])) {
    
        $user_id .= $_SESSION['UsersID'];
        
        $query = "SELECT FirstName FROM users WHERE UsersID = '{$user_id}'";
        $select_userid = mysqli_query($connection, $query);
        
        $row  = mysqli_fetch_array($select_userid);
        $fname = $row['FirstName'];
    
        if(isset($_POST['submit'])) {
            redirect('https://www.google.com/gmail/');
        }
    
    }else {
        echo "No do it Again";
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

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="../css/bootstrap/bootstrap.min.css">

	<!-- Custom Css -->
	<link rel="stylesheet" href="../css/email-verification.css">

</head>

<body>

	<!-- Email Verification  -->
	<section id="email-verification">
		<div class="container">

			<div class="row">
				<div class="col-md-12 col-sm-12 justify-content-center">
						
					<div class="content">
						<div id="heading-img">
							<img src="../images/Front_images/logo.png" alt="heading image" />
						</div>
						<h2>Email Verification</h2>
						<p><span>Dear <?php echo $fname; ?> ,</span></p>
						<p>Thanks for Signing up!</p>
						<p>Simply click below for email verification.</p>
						
                        <form method="POST">
						    <input type="submit" name="submit" class="btn" value="verify email address">
                        </form>

					</div>

				</div>
			</div>

		</div>
	</section>
	<!-- Email Verification Ended -->

	<!-- Add jquery-->
	<script src="../js/jquery.min.js"></script>

	<!-- Bootstrap js -->
	<script src="../js/bootstrap/bootstrap.min.js"></script>

	<!-- Custom JS -->
	<script src="../js/script.js"></script>
	

</body>

</html>