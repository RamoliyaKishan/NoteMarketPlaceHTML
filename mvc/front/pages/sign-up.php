<?php include "includes/db.php"; ?>
<?php ob_start(); ?>
<?php session_start(); ?>
<?php include "includes/functions.php"; ?>

<?php 

    if(isset($_POST['signup'])){
        
		$firstname = trim($_POST['firstname']);
		$lastname = trim($_POST['lastname']);
		$email = trim($_POST['email']);
		$password = trim($_POST['password']);
		$confirm_password = trim($_POST['confirm_password']);
        
		$firstname = mysqli_real_escape_string($connection, $firstname);
		$lastname = mysqli_real_escape_string($connection, $lastname);
		$email = mysqli_real_escape_string($connection, $email);
		$password = mysqli_real_escape_string($connection, $password);
		$confirm_password = mysqli_real_escape_string($connection, $confirm_password);
        
        
        $password = md5($password);
        $confirm_password = md5($confirm_password);
        
        $token = bin2hex(random_bytes(30));
        
        if(email_exists($email)) {
            $email_message = "This user Email ID is already exist";
            $password_message = "";
            $welcome_message = "";
        }
        else {
            if($password === $confirm_password){
                
                $query = "INSERT INTO users (FirstName, LastName, EmailID, Password, Token) VALUES ('{$firstname}', '{$lastname}', '{$email}', '{$password}', '$token') ";
                $register_user_query = mysqli_query($connection, $query);
                
                if($register_user_query){
                    
                    $welcome_message = "<i style='font-size: 23px' class='fa fa-check-circle fa-md'></i> Your account has been successfully created.";
                    $email_message = "";
                    $password_message = "";
                    
                    $to         = $email;
                    $subject    = "Note Marketplace - Email Verification";
                    $message      = "Hello" . $firstname . "\r\n";
                    $message      .= "Thank you for signing up with us. Please click on below link to verify your email address and to do login." . "\r\n";
                    $message    .= "http://localhost/noteMarketPlace/front/pages/includes/isActive.php?token=$token";

                    $from     = "notemarketplace00@gmail.com";

                    $body =  "";

                    $body .= "From: " . $from . "\r\n";
                    $body .= "To: " . $to . "\r\n";
                    $body .= "Message: " . $message . "\r\n";

                    if(mail($to,$subject,$body))
                    {
                        redirect('email-verification.php');
                    }else{
                        echo "ohhhhh nnnnnooooooo";
                    }
                }else {
                    echo "Query Faild";
                }
                    
                    $_SESSION['fname'] = $firstname;
                    $_SESSION['email'] = $email;
                    redirect('email-verification.php');
                    
                    
                }
                
            else {
               $password_message = "Both password are not same";
                $email_message = "";
                $welcome_message = "";
            }    
        }
        
        
}else {
        $email_message = "";
        $password_message = "";
        $welcome_message = "";
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
	<link rel="stylesheet" href="../css/sign-up.css">

</head>

<body>

	<!-- Sign Up page  -->
	<section id="sign-up">
		<div class="main-content">
		<div class="container">
			<div class="row text-center">
				<div class="col-md-12 col-sm-12 col-12 text-center">
					<div id="heading-img" class="text-center">
						<img src="../images/Front_images/top-logo.png" class="text-center" alt="heading image" />
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12 col-sm-12 col-12 form">

					<form class="myForm text-left" method="POST">
						<h2 class="heading text-center">Create an Account</h2>
						<p class="pera text-center" id="form-p">Enter your detais to signup</p>
						
						<?php
                        
                                if ($email_message){
                                    $email_message_css = "color: #FF3636; margin-top: -20px; margin-bottom: 20px";
                                    $email_input_css = "margin-bottom: 30px; border-color: #ff5e5e";
                                }elseif ($password_message) {
                                    $password_message_css = "color: #FF3636; margin-top: -20px; margin-bottom: 20px"; 
                                    $password_input_css = "margin-bottom: 30px; border-color: #ff5e5e";
                                }else {
                                    $welcome_message_css = "color: #0bba0e; margin-top: -20px; margin-bottom: 10px";
                                }
                                    
                            ?>
						<p style = "<?php echo $welcome_message_css; ?>" class="text-center" ><?php echo $welcome_message; ?></p>
						
						<div class="form-group">
							<label class="form-label">First Name *</label>
							<input class="myInput" placeholder="Enter your First Name" name="firstname" type="text" id="firstname" value="" required>
						</div>
						
						<div class="form-group">
							<label class="form-label">Last Name *</label>
							<input class="myInput" placeholder="Enter your Last Name" type="text" name="lastname" id="lastname" value="" required>
						</div>

						<div class="form-group">
							<label class="form-label">Email *</label>
							<input style = "<?php echo $email_input_css; ?>" class="myInput" placeholder="Enter your Email eddress" type="email" name="email" id="login-email" value="" required>
							
							<p style = "<?php echo $email_message_css; ?>" ><?php echo $email_message; ?></p>
							
						</div>

						<div class="form-group">
							<label class="form-label">Password</label>
							<input style = "<?php echo $password_input_css; ?>" class="myInput" maxlength="21" type="password" id="password" name="password"
							placeholder="enter your Password" value="" required>
							<span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
							
							<p style = "<?php echo $password_message_css; ?>" ><?php echo $password_message; ?></p>
							
						</div>
						
						<div class="form-group">
							<label class="form-label">Password</label>
							<input class="myInput" maxlength="21" type="password" name="confirm_password" id="confirm_password" placeholder="Re-enter your Password" value="" required>
							<span toggle="#confirm_password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
						</div>

						<input type="submit" name="signup" class="btn" value="sign up">

						<p class="text-center">Already have an account? <a href="login.php">Login</a></p>

					</form>

				</div>
			</div>
			</div>
		</div>
	</section>
	<!-- Sign Up Ended -->

	<!-- Add jquery-->
	<script src="../js/jquery.min.js"></script>

	<!-- Bootstrap js -->
	<script src="../js/bootstrap/bootstrap.min.js"></script>

	<!-- Custom JS -->
	<script src="../js/script.js"></script>

</body>

</html>