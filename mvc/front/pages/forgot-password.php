<?php ob_start(); ?>
<?php session_start(); ?>
<?php  include "includes/db.php"; ?>
<?php  include "includes/functions.php"; ?>

<?php

    if(isset($_POST['submit'])){
        
		$email = trim($_POST['email']);

		$query = "SELECT * FROM users WHERE EmailID = '{$email}' and IsActive = '1' ";
		$forgot_password_query = mysqli_query($connection, $query);
        
		if (!$forgot_password_query) {

            die("QUERY FAILED" . mysqli_error($connection));

		}
        
        $user_count = mysqli_num_rows($forgot_password_query);
		
        
        if($user_count > 0){
            
            function rand_string( $length ) {
            
                $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                return substr(str_shuffle($chars),0,$length);

            }

            $regenerated_password = rand_string(8);
            
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
                        echo "ohhhhh nnnnnooooooo";
                    }        
            
            
        }else {
            echo  $email_message = "The Email is not is not exist.";
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
	<link rel="stylesheet" href="../css/login.css">

</head>

<body>

	<!-- Forgot Password   -->
	<section id="forgot-password">
		<div class="container">
			<div class="main-content">
			<div class="row text-center">
				<div class="col-md-12 col-sm-12 col-12 text-center">
					<div id="heading-img" class="text-center">
						<img src="../images/Front_images/logo.png" class="text-center" alt="heading image" />
					</div>
				</div>
			</div>

			<div class="row">
				<div class="form">

					<form class="myForm text-left" method="POST">
						<h2 class="heading text-center">Forgot Password?</h2>
						<p class="pera text-center" id="form-p">Enter your email to reset your password</p>

						<div class="form-group">
							<label class="form-label">Email</label>
							<input class="myInput" placeholder="enter your email address" type="email" id="email" name="email" value="" required>
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