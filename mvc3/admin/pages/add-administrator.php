<?php ob_start(); ?>
<?php session_start(); ?>
<?php  include "includes/db.php"; ?>
<?php  include "includes/functions.php"; ?>

<?php

if(isset($_SESSION['UsersID'])) {
    
    $user_id = $_SESSION['UsersID'];
    
    $db_FirstName = "";
    $db_LastName = "";
    $db_EmailID = "";
    $db_country_code = "";
    $db_phone_number = "";
    
    if(isset($_GET['u_id'])){
        
        $u_id = $_GET['u_id'];
        
        $query = "SELECT * FROM users WHERE UsersID = '{$u_id}'";
        $select_users_query = mysqli_query($connection, $query);
        
        $row = mysqli_fetch_array($select_users_query);
            $db_FirstName = $row['FirstName'];
            $db_LastName = $row['LastName'];
            $db_EmailID = $row['EmailID']; 
            $db_IsActive = $row['IsActive']; 
            
            
        $query = "SELECT * FROM  user_profile WHERE UsersID = '{$u_id}'";
        $check_request = mysqli_query($connection, $query);
            
        $row = mysqli_fetch_array($check_request);
            $db_country_code = $row['PhoneCountryCode'] ?? null ;
            $db_phone_number = $row['PhoneNumber'] ?? null ;
    }
        
    if(isset($_POST['submit_profile'])) {
            
        $first_name = escape($_POST['first_name']);
        $last_name = escape($_POST['last_name']);
        $email_id = escape($_POST['email_id']);
        $country_code = escape($_POST['country_code']);
        $phone_number = escape($_POST['phone_number']);
        
        if(isset($_GET['u_id'])){
            
            if($db_FirstName != $first_name || $db_LastName != $last_name || $db_EmailID != $email_id || $db_IsActive != '1') {
                $query = "UPDATE users SET FirstName = '{$first_name}', LastName = '{$last_name}', EmailID = '{$email_id}', ModifiedDate =  now(), ModifiedBy = '{$user_id}', IsActive='1' WHERE UsersID = '{$u_id}'"; 
                $update_user = mysqli_query($connection, $query);
            }
            elseif($db_country_code != $country_code || $db_phone_number != $phone_number) {
                $query = "UPDATE user_profile SET PhoneCountryCode = '{$country_code}', PhoneNumber = '{$phone_number}', ModifiedDate =  now(), ModifiedBy = '{$user_id}' WHERE UsersID = '{$u_id}'"; 

                $update_profile = mysqli_query($connection, $query);
                
            }else {
                echo "<script type='text/javascript'>alert(There is no any changes in this Profile.'); </script>";
            }
            echo "<script type='text/javascript'>alert('Your Profile Updateded Successfully.'); </script>";
        }else {
                
                $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                $password = substr(str_shuffle($chars),0,8);

                $to         = $email_id;
                $subject    = "New Temporary Password has been created for you";
                $message      = "\r\n" . "Hello" . "\r\n" . "\r\n";
                $message      .= "We have generated a new password for you" . "\r\n";
                $message    .= "Password: $password ";

                $from     = "notemarketplace00@gmail.com";

                $body =  "";

                $body .= "From: " . $from . "\r\n";
                $body .= "To: " . $to . "\r\n";
                $body .= "Message: " . $message . "\r\n";

                if(mail($to,$subject,$body))
                {   
                    $enc_password = md5($password);
                }else{
                    echo "ohhhhh nnnnnooooooo";
                }        
            
            $query = "SELECT * FROM users WHERE EmailID = '$email_id'";
            $check_users_query = mysqli_query($connection, $query);
            $user_found = mysqli_num_rows($check_users_query);
            
            if($user_found <= 0){
                $query = "INSERT INTO users (RoleID, FirstName, LastName, EmailID, Password, CreatedDate, CreatedBy, IsActive) VALUES ('2', '{$first_name}', '{$last_name}', '{$email_id}', '{$enc_password}', now(), '{$user_id}', '1')";
                $add_admin = mysqli_query($connection, $query);
                if(!$add_admin) {
                    die("QUERY FAILED" . mysqli_error($connection));
                }else {
                    $inserted_id = mysqli_insert_id($connection);
                }

                $query = "INSERT INTO user_profile (UsersID, PhoneCountryCode, PhoneNumber, CreatedDate, CreatedBy) VALUES ('{$inserted_id}', '{$country_code}', '{$phone_number}', now(), '{$user_id}')";
                $add_profile = mysqli_query($connection, $query);

                if(!$add_profile) {
                    die("QUERY FAILD" . mysqli_error($connection));
                }else {
                    echo "<script type='text/javascript'>alert('User Added Successfully.');  </script>";
                }
            }else {
                echo "<script type='text/javascript'>alert('This email id is already exist.');  </script>";
            }
        }
        redirect("manage-administrator.php");
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
	<link rel="shortcut icon" href="../images/Admin_images/favicon.ico">

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
	<link rel="stylesheet" href="../css/add-administrator.css">

</head>

<body>  	
    
	<!-- Header -->
	<?php
	    if(isset($_SESSION['UsersID'])) {  
            $user_id = $_SESSION['UsersID'];
            include "includes/login_nav.php"; 
        }else {
            redirect("../../front/pages/login.php");
        }
    ?>
    <!-- Header Ends -->
	
	<!-- Add Notes -->
	<section id="add-notes">

		<!-- form -->
		<div class="content-box-lg">

			<div class="container">

				<div class="row">

					<div class="col-md-12 col-sm-12">
						<div class="text-left">
							<h2 class="heading">Add Administrator</h2>
						</div>
					</div>
					
					<div class="col-lg-6 col-md-8 col-sm-12">
						
						<div class="user-profile-left">

							<form class="myForm text-left" method="POST">

								<div class="form-group">
									<label class="form-label">First Name *</label>
									<input class="myInput" placeholder="Enter your First Name" type="text" id="first_name" name="first_name" value="<?php echo "$db_FirstName"; ?>" required>
								</div>
								<div class="form-group">
									<label class="form-label">Last Name *</label>
									<input class="myInput" placeholder="Enter your Last Name" type="text" id="last_name" name="last_name" value="<?php echo "$db_LastName"; ?>" required>
								</div>
								<div class="form-group">
									<label class="form-label">Email *</label>
									<input class="myInput" placeholder="Enter your Email address" type="email" id="email_id" name="email_id" value="<?php echo "$db_EmailID"; ?>" required>
								</div>
								
								<div class="form-group">
									<label class="form-label">Phone Number</label>
									<div>
									
										<select class="myInput country-code" id="country_code" name="country_code" required>
                                            <option hidden>country code</option>
										    <?php
                                                $query = "SELECT * FROM countries ORDER BY CountryCode ASC";
                                                $select_countries = mysqli_query($connection,$query);
                                                
                                                while($row = mysqli_fetch_assoc($select_countries)) {
                                                    $CountryCode  = $row['CountryCode'];
                                                    $CountryName = $row['CountryName'];
                                                    
                                                    if($db_country_code == $CountryCode) {
                                                        echo "<option class='option' value=$CountryCode selected>+{$CountryCode}</option>";
                                                    }
                                                    else {
                                                        echo "<option class='option' value=$CountryCode>+{$CountryCode}</option>";
                                                    }
                                                }
                                            ?>
										    
											
										</select>

										<input class="myInput phone-no" maxlength="10" type="phone" id="phone_number" name="phone_number" placeholder="enter your phone number" pattern="[7-9]{1}[0-9]{9}" value="<?php echo "$db_phone_number"; ?>" required>
									</div>
								</div>
								
								<div class="last">
									<input type="submit" class="btn" onClick="return confirm('Are you sure to update this?')"  name="submit_profile" id="submit_profile" value="SUBMIT">
								</div>
							</form>
						</div>
						
					</div>
					
					
				</div>

			</div>

		</div>
	
	</section>
	
	<!--  footer  -->
    <?php include('includes/footer.php'); ?>

</body>

</html>