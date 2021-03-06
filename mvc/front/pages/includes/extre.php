<!-- new login code-->


<?php  include "includes/db.php"; ?>
<?php  include "includes/functions.php"; ?>
<?php ob_start(); ?>
<?php session_start(); ?>



<?php
    
checkIfUserIsLoggedInAndRedirect('/');

if(isset($_POST['login'])){
        
    if(isset($_POST['email']) && isset($_POST['password'])){
        
		login_user($_POST['email'], $_POST['password']);
        
	}
//    else {
//        redirect('login.php');
//    }    
    
}else {
    $email_message = "";
    $pass_message = "";
}


?>


<!-- new login code end -->

<?php

function login_user($email, $password){

    global $connection;
    
        $email = trim($_POST['email']);
		$password = trim($_POST['password']);
        
        $password = md5($password);
        
		$email = mysqli_real_escape_string($connection, $email);
		$password = mysqli_real_escape_string($connection, $password);

		$query = "SELECT * FROM users WHERE EmailID = '{$email}' ";
		$select_user_query = mysqli_query($connection, $query);
        
		if (!$select_user_query) {

            die("QUERY FAILED" . mysqli_error($connection));

		}

		while ($row = mysqli_fetch_array($select_user_query)) {

		$db_UsersID = $row['UsersID'];
		$db_RoleID = $row['RoleID'];
		$db_FirstName = $row['FirstName'];
		$db_LastName = $row['LastName'];
		$db_EmailID = $row['EmailID'];
		$db_IsEmailVerified	 = $row['IsEmailVerified'];
		$db_Password = $row['Password'];
        
		}
        
            if($email !== $db_EmailID){
                $email_message = "The Email id that you have enter is incorrect";
                $pass_message = "";
                
            }elseif($password !== $db_Password) {
                $pass_message = "The Password that you have enter is incorrect";
                $email_message = "";
            }
            else {
                if($email == $db_EmailID  && $password == $db_Password){
            
                    $_SESSION['UsersID'] = $db_UsersID;            
            
                    header("Location: index.php" );
                
                }else {
                    return false;
                }
                $pass_message = "";
                $email_message = "";
            }
        


    
    
    
    
    
    
    
    
    
    

//     $username = trim($username);
//     $password = trim($password);
//
//     $username = mysqli_real_escape_string($connection, $username);
//     $password = mysqli_real_escape_string($connection, $password);
//
//
//     $query = "SELECT * FROM users WHERE username = '{$username}' ";
//     $select_user_query = mysqli_query($connection, $query);
//     if (!$select_user_query) {
//
//         die("QUERY FAILED" . mysqli_error($connection));
//
//     }
//
//
//     while ($row = mysqli_fetch_array($select_user_query)) {
//
//         $db_user_id = $row['user_id'];
//         $db_username = $row['username'];
//         $db_user_password = $row['user_password'];
//         $db_user_firstname = $row['user_firstname'];
//         $db_user_lastname = $row['user_lastname'];
//         $db_user_role = $row['user_role'];
//
//
//         if (password_verify($password,$db_user_password)) {
//
//             $_SESSION['username'] = $db_username;
//             $_SESSION['firstname'] = $db_user_firstname;
//             $_SESSION['lastname'] = $db_user_lastname;
//             $_SESSION['user_role'] = $db_user_role;
//
//
//
//             redirect("/cms/admin");
//
//
//         } else {
//
//
//             return false;
//
//
//
//         }
//
//
//
//     }
//
//     return true;

 }
?>

<!-- new login function code -->




<!-- new login function code end -->

<!--SIgn Up page-->


<?php include "includes/db.php"; ?>
<?php ob_start(); ?>

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
        
        if(email_exists($email)) {
            $email_message = "This user Email ID is already exist";
            $password_message = "";
            $welcome_message = "";
        }
        else {
            if($password === $confirm_password){
                
                $query = "INSERT INTO users (FirstName, LastName, EmailID, Password) VALUES ('{$firstname}', '{$lastname}', '{$email}', '{$password}') ";
                $register_user_query = mysqli_query($connection, $query);
        
                if (!$register_user_query) {
                    die("QUERY FAILED" . mysqli_error($connection));
                }
                
                $welcome_message = "<i style='font-size: 23px' class='fa fa-check-circle fa-md'></i> Your account has been successfully created.";
                $email_message = "";
                $password_message = "";
                
            }else {
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


<!--Sign Up page end-->

<!--Sign Up page end-->

<?php  include "includes/db.php"; ?>
<?php  include "includes/functions.php"; ?>
<?php ob_start(); ?>
<?php session_start(); ?>



<?php

    if(isset($_POST['login'])){
        
		$email = trim($_POST['email']);
		$password = trim($_POST['password']);
        
        $password = md5($password);
        
		$email = mysqli_real_escape_string($connection, $email);
		$password = mysqli_real_escape_string($connection, $password);

		$query = "SELECT * FROM users WHERE EmailID = '{$email}' ";
		$select_user_query = mysqli_query($connection, $query);
        
		if (!$select_user_query) {

            die("QUERY FAILED" . mysqli_error($connection));

		}

		while ($row = mysqli_fetch_array($select_user_query)) {

		$db_UsersID = $row['UsersID'];
		$db_RoleID = $row['RoleID'];
		$db_FirstName = $row['FirstName'];
		$db_LastName = $row['LastName'];
		$db_EmailID = $row['EmailID'];
		$db_IsEmailVerified	 = $row['IsEmailVerified'];
		$db_Password = $row['Password'];
        
		}
        
            if($email !== $db_EmailID){
                $email_message = "The Email id that you have enter is incorrect";
                $pass_message = "";
                
            }elseif($password !== $db_Password) {
                $pass_message = "The Password that you have enter is incorrect";
                $email_message = "";
            }
            else {
                if($email == $db_EmailID  && $password == $db_Password){
            
                    $_SESSION['UsersID'] = $db_UsersID;            
                        
                    if(is_member($email)) {
                        redirect("index.php" );
                    }
                    else {
                        redirect("../../admin/pages/dashboard.html" );
                    }
                    
                
                }else {
                    return false;
                }
                $pass_message = "";
                $email_message = "";
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
							<a class="forgot-password" href="forgot_password.php">Forgot Password?</a><br>
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

<!--login page end-->


<!--User-profile new created form-->
<!-- Forms -->
	<section id="forms">

		<div class="content-box-lg">

			<div class="container">
            
            
            <form class="myForm text-left" action="#" method="POST">
                
                <!-- Basic Profile -->
				<div class="row">
					
					<div class="col-md-12 col-sm-12 wow fadeInLeft">

						<div class="text-left">
							<h2 class="heading">Basic Profile Details</h2>
						</div>

					</div>
               
                </div>
                
                <!-- Basic Profile Form -->
                <div class="row">
					
					<div class="col-md-6 col-sm-12 wow fadeInLeft">

						<div class="user-profile-left">


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
               
                <!-- Address -->
                <div class="row">
					
					<div class="col-md-12 col-sm-12 wow fadeInLeft">

						<div class="text-left">
							<h2 class="heading">Address Details</h2>
						</div>

					</div>
                
                </div>
                
                <!-- Address Form -->
                <div class="row">
					
					<div class="col-md-6 col-sm-12 wow fadeInLeft">

						<div class="user-profile-left">

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

            
                <!-- University and Collage Information -->
				<div class="row">
                    
					<div class="col-md-12 col-sm-12 wow fadeInLeft">

						<div class="text-left">
							<h2 class="heading">University and Collage Information </h2>
						</div>

					</div>
					
				</div>

				<!-- Unniversity Form -->
				<div class="row">
					
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
					
					</div>
					
					<!--  Buttons  -->
				<div class="row">	
					<div class="col-md-12 col-sm-12">
							<div class="buttons">
								<div class="last">
									<input type="submit" class="btn" value="SUBMIT">
								</div>
							</div>
					</div>
				</div>
				</form>

				</div>

        </div>

	</section>
	<!-- Forms Ende-->

<!--User-profile new created form End-->