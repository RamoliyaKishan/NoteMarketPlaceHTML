<?php ob_start(); ?>
<?php session_start(); ?>
<?php  include "includes/db.php"; ?>
<?php  include "includes/functions.php"; ?>
<?php
if(isset($_SESSION['UsersID'])) {
    
    $user_id = $_SESSION['UsersID'];
    $old_pass_message = "";
    $new_pass_message = "";
    
    if(isset($_POST['submit_password'])){
        
        $old_password = escape($_POST['old_password']);
        $new_password = escape($_POST['new_password']);
        $confirm_password = escape($_POST['confirm_password']);
        
        $old_password = md5($old_password);

        $query = "SELECT Password FROM users where UsersID = '{$user_id}' ";
        $select_pass_query = mysqli_query($connection, $query);

        $row = mysqli_fetch_assoc($select_pass_query);
        $db_Password = $row['Password'];
        
        
        if($old_password == $db_Password){
            
            if($new_password == $confirm_password){
                
                $new_password  = md5($new_password);
                $query = "UPDATE users SET Password = '{$new_password}', ModifiedDate = now(), ModifiedBY = '{$user_id}' where UsersID = '{$user_id}'";
                $update_pass_query = mysqli_query($connection, $query);
                
                if($update_pass_query){
                    redirect("index.php");
                }else {
                    echo "query fail" . mysqli_error($connection);
                }
            }else {
                $new_pass_message .= "Both Passwords are not same";
            }
        }else {
            $old_pass_message .= "Old Password that you have enter is incorrect";
        }
    }
    
    
}else {
    redirect("login.php");
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
						<a href="index.php">
						    <img src="../images/Front_images/top-logo.png" class="text-center" alt="heading image" />
                        </a>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="form">

					<form class="myForm text-left" method="POST">
						<h2 class="heading text-center">Change Password</h2>
						<p class="pera text-center" id="form-p">Enter your new password to change your password</p>
                        
                        <?php
                        
                            if (!empty($old_pass_message)){
                                $old_pass_message_css = "color: #FF3636; margin-top: -20px; margin-bottom: 10px";
                                $old_pass_input_css = "margin-bottom: 30px; border-color: #ff5e5e";
                            }elseif (!empty($new_pass_message)) {
                                $new_pass_message_css = "color: #FF3636; margin-top: -20px; margin-bottom: 10px"; 
                                $new_pass_input_css = "margin-bottom: 30px; border-color: #ff5e5e";
                            }else {
                                $welcome_message_css = "color: #0bba0e; margin-top: -20px; margin-bottom: 10px";
                            }

                        ?>
                        
						<div class="form-group">
							<label class="form-label">Old Password</label>
							<input style = "<?php echo $old_pass_input_css; ?>" class="myInput" maxlength="21" type="password" name="old_password" id="old_password" placeholder="enter your Password" value="" required>
							<span toggle="#old_password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
							<p style = "<?php echo $old_pass_message_css; ?>" ><?php echo $old_pass_message; ?></p>
						</div>
						
						<div class="form-group">
							<label class="form-label">New Password</label>
							<input style = "<?php echo $new_pass_input_css; ?>" class="myInput" maxlength="21" type="password" name="new_password" id="new_password" placeholder="enter your Password" value="" required>
							<span toggle="#new_password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
							<p style = "<?php echo $new_pass_message_css; ?>" ><?php echo $new_pass_message; ?></p>
						</div>
						
						<div class="form-group">
							<label class="form-label">Confirm Password</label>
							<input class="myInput" maxlength="21" type="password" name="confirm_password" id="confirm_password" placeholder="enter your Password" value="" required>
							<span toggle="#confirm_password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
						</div>

	
						<input type="submit" name="submit_password" class="btn" value="submit">

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