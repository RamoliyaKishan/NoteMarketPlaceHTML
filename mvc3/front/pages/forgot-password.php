<?php ob_start(); ?>
<?php session_start(); ?>
<?php  include "includes/db.php"; ?>
<?php  include "includes/functions.php"; ?>

<?php

    if(isset($_POST['submit'])){
        
		$email = escape($_POST['email']);

		$query = "SELECT * FROM users WHERE EmailID = '{$email}' and IsActive = '1' ";
		$forgot_password_query = mysqli_query($connection, $query);
        
		if (!$forgot_password_query) {

            die("QUERY FAILED" . mysqli_error($connection));

		}
        
        $user_count = mysqli_num_rows($forgot_password_query);
		
        if($user_count > 0){
            
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $regenerated_password = substr(str_shuffle($chars),0,8);
            
            $to         = $email;
            $subject    = "New Temporary Password has been created for you";
            $message      = "\r\n" . "Hello" . "\r\n" . "\r\n";
            $message      .= "We have generated a new password for you" . "\r\n";
            $message    .= "Password: $regenerated_password ";

            $from     = "notemarketplace00@gmail.com";

            $body =  "";

            $body .= "From: " . $from . "\r\n";
            $body .= "To: " . $to . "\r\n";
            $body .= "Message: " . $message . "\r\n";

            if(mail($to,$subject,$body))
            {   
                $password = md5($regenerated_password);
                $query = "UPDATE users SET Password = '$password' where EmailID = '$email' ";
                $update_password = mysqli_query($connection, $query);
                redirect('login.php');
            }else{
                echo "<script type='text/javascript'>alert('Sorry, Email Faild !!');</script>";
            }        
            
        }else {
            $email_message = "The Email is not is not exist.";
        }
        
}else {
    $email_message = "";
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
	<link rel="stylesheet" href="../css/forgot-password.css">

</head>

<body>

	<!-- Forgot Password   -->
	<section id="forgot-password">
		<div class="container">
			<div class="main-content">
			<div class="row text-center">
				<div class="col-md-12 col-sm-12 col-12 text-center">
					<div id="heading-img" class="text-center">
						<a href="index.php">
						    <img src="../images/Front_images/top-logo.png" class="text-center" alt="heading image" />
                        </a>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="form">

					<form class="myForm text-left" method="POST">
						<h2 class="heading text-center">Forgot Password?</h2>
						<p class="pera text-center" id="form-p">Enter your email to reset your password</p>

						<div class="form-group">
                            <?php
                                if($email_message) {
                                    $input_css = "margin-bottom: 30px; border-color: #ff5e5e";
                                    $message_css = "color: #FF3636; margin-top: -20px; margin-bottom: 10px";

                                }else {
                                    $input_css = "margin-bottom: 30px; border-color: #D2C8D2;";
                                }

                            ?>
							<label class="form-label">Email</label>
							<input style = "<?php echo $input_css; ?>" class="myInput" placeholder="enter your email address" type="email" id="email" name="email" value="" required>
							<p style = "<?php echo $message_css; ?>" ><?php echo $email_message; ?></p>
						</div>
						
						<input type="submit" class="btn" name="submit" value="submit">


					</form>

				</div>
			</div>
			</div>
		</div>
	</section>
	<!-- Forgot Password Ended -->

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

</body>

</html>