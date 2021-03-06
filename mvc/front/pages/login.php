<?php ob_start(); ?>
<?php session_start(); ?>
<?php  include "includes/db.php"; ?>
<?php  include "includes/functions.php"; ?>



<?php

    if(isset($_POST['login'])){
        
		$email = trim($_POST['email']);
		$password = trim($_POST['password']);
        
        $password = md5($password);
        
		$email = mysqli_real_escape_string($connection, $email);
		$password = mysqli_real_escape_string($connection, $password);

		$query = "SELECT * FROM users WHERE EmailID = '{$email}' and IsActive = '1' ";
		$select_user_query = mysqli_query($connection, $query);
        
		if (!$select_user_query) {

            die("QUERY FAILED" . mysqli_error($connection));

		}
        
        $user_count = mysqli_num_rows($select_user_query);

		while ($row = mysqli_fetch_array($select_user_query)) {

		$db_UsersID = $row['UsersID'];
		$db_RoleID = $row['RoleID'];
		$db_FirstName = $row['FirstName'];
		$db_LastName = $row['LastName'];
		$db_EmailID = $row['EmailID'];
		$db_IsEmailVerified	 = $row['IsEmailVerified'];
		$db_Password = $row['Password'];
        
		}
        
        if($user_count > 0){
             
            
            if($password == $db_Password) {
                $_SESSION['UsersID'] = $db_UsersID;            
                        
                    if(is_member($email)) {
                        redirect("index.php" );
                    }
                    else {
                        redirect("../../admin/pages/dashboard.html" );
                    }
            }
            else {
                $pass_message = "The Password that you have enter is incorrect";            
                $email_message = "";
            }
        }else {
                $email_message = "The Email id that you have enter is incorrect OR InActive";
                $pass_message = "";
        }
        
}else {
    $email_message = "";
    $pass_message = "";
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

	<!-- Login page  -->
	<section id="login">
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

					<form class="myForm text-left" autocomplete="on" method="POST">
						<h2 class="heading text-center">Login</h2>
						<p class="pera text-center" id="form-p">Enter your email address and password to login</p>

						<div class="form-group">
						    
						    <?php
                                if($email_message) {
                                    $input_css = "margin-bottom: 30px; border-color: #ff5e5e";
                                    $message_css = "color: #FF3636; margin-top: -20px; margin-bottom: 20px";
                                    
                                }else {
                                    $input_css = "margin-bottom: 30px; border-color: #D2C8D2;";
                                }
                            
                            ?>
							<label for="user_email" class="form-label">Email</label>
							<input style = "<?php echo $input_css; ?>" class="myInput" placeholder="Enter your Email eddress" type="email" id="email" name="email" value="" required>
							<p style = "<?php echo $message_css; ?>" ><?php echo $email_message; ?></p>
							
						</div>

						<div class="form-group">
                            
							<label for="user_password" class="form-label">Password</label>
							<?php
                                if($pass_message) {
                                    $input_css = "margin-bottom: 30px; border-color: #ff5e5e";
                                    $message_css = "color: #FF3636; margin-top: -20px; margin-bottom: 20px";
                                    
                                }else {
                                    $input_css = "margin-bottom: 30px; border-color: #D2C8D2;";
                                }
                            
                            ?>
							<a class="forgot-password" href="forgot-password.php">Forgot Password?</a><br>
							<input style = "<?php echo $input_css; ?>" class="myInput" type="password" id="password" name="password" placeholder="enter your Password" value="" required>
							<span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                           <p style = "<?php echo $message_css; ?>" ><?php echo $pass_message; ?></p>
                            
						</div>

						<div class="form-group text-left">

							<input class="myInput check" id="check" name="check" type="checkbox" value="Remember Me">
							<label for="check" class="form-label rememberme">Remember Me</label>

						</div>

						<input name="login" type="submit" class="btn" value="LOGIN">

						<p class="text-center">Don't have an account? <a href="sign-up.php">Sign Up</a></p>

					</form>

				</div>
			</div>
			</div>
		</div>
	</section>
	<!-- Login page Ended -->

	
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