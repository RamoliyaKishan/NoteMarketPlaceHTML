<?php ob_start(); ?>
<?php session_start(); ?>
<?php  include "includes/db.php"; ?>
<?php  include "includes/functions.php"; ?>

<?php

if(isset($_SESSION['UsersID'])) {
    
    $user_id = $_SESSION['UsersID'];
        
    if(isset($_POST['submit'])) {
            
        $email_id = escape($_POST['email_id']);
        $email_id2 = escape($_POST['email_id2']);
        $phone_number = escape($_POST['phone_number']);
        $facebook = escape($_POST['facebook']);
        $twitter = escape($_POST['twitter']);
        $linkdin = escape($_POST['linkdin']);
        
        $profile_picture_filename        = $_FILES['profile_picture']['name'];
        $temp_profile_picture_filename   = $_FILES['profile_picture']['tmp_name'];
        
        $note_picture_filename        = $_FILES['note_picture']['name'];
        $temp_note_picture_filename   = $_FILES['note_picture']['tmp_name'];

        move_uploaded_file($temp_profile_picture_filename, "../profile pictures/" .$profile_picture_filename);
        move_uploaded_file($temp_note_picture_filename, "../profile pictures/" .$note_picture_filename);
        
        move_uploaded_file($temp_profile_picture_filename, "../../front/profile pictures/" .$profile_picture_filename);
        move_uploaded_file($temp_note_picture_filename, "../../front/uploaded files/" .$note_picture_filename);
            
            $query = "INSERT INTO system_configurations (KeyName, Value, CreatedDate, CreatedBy) VALUES ('FromSupportEmail', '{$email_id}', now(), '{$user_id}'),
            ('SupportPhoneNo', '{$phone_number}', now(), '{$user_id}'),
            ('ToSupportEmail', '{$email_id2}', now(), '{$user_id}'),
            ('FacebookUrl', '{$facebook}', now(), '{$user_id}'),
            ('TwitterUrl', '{$twitter}', now(), '{$user_id}'),
            ('LinkdinUrl', '{$linkdin}', now(), '{$user_id}'),
            ('DefaultProfilePicture', '{$profile_picture_filename}', now(), '{$user_id}'),
            ('DefaultNotePicture', '{$note_picture_filename}', now(), '{$user_id}')";

            $add_config = mysqli_query($connection, $query);

            if(!$add_config) {
                die("QUERY FAILED" . mysqli_error($connection));
            }else {
                echo "<script type='text/javascript'>alert('Your Configuration Added Successfully.');  </script>";
            }
       
        
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
	<link rel="stylesheet" href="../css/manage-system-config.css">

</head>

<body>

	<!-- Header -->
	<?php
	    if(isset($_SESSION['UsersID'])) {  
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
							<h2 class="heading">Manage System Configuration</h2>
						</div>
					</div>
					
					<div class="col-lg-6 col-md-8 col-sm-12">
						
						<div class="user-profile-left">

							<form class="myForm text-left" method="POST" enctype="multipart/form-data"    >

								<div class="form-group">
									<label class="form-label">Support Email Address *</label>
									<input class="myInput" placeholder="Enter your Email address" type="email" id="email_id" name="email_id" value="" required>
								</div>
								<div class="form-group">
									<label class="form-label">Support Phone Nummber *</label>
									<input class="myInput" placeholder="Enter your phone number" type="text" id="phone_number" name="phone_number" pattern="[6-9]{1}[0-9]{9}" value="" required>
								</div>
								<div class="form-group">
									<label class="form-label">Email Address(es) (for various events system will send notification to these users)*</label>
									<input class="myInput" placeholder="Enter your Email address" type="text" id="email_id2" name="email_id2" value="" required>
								</div>
								<div class="form-group">
									<label class="form-label">Facebook URL</label>
									<input class="myInput" placeholder="Enter facebook url" type="text" id="facebook" name="facebook" value="">
								</div>
								<div class="form-group">
									<label class="form-label">Twitter URL</label>
									<input class="myInput" placeholder="Enter twitter url" type="text" id="twitter" name="twitter" value="">
								</div>
								<div class="form-group">
									<label class="form-label">Linkdin URL</label>
									<input class="myInput" placeholder="Enter linkdin url" type="text" id="linkdin" name="linkdin" value="">
								</div>
								
								<div class="form-group ">
									<label class="form-label">Default Image for notes(If seller do not upload)</label>

									<div class="image-upload">
										<label class="myInput text-center" for="note_picture">
											<img src="../images/Admin_images/upload-file.png" class="img-responsive img-fluid" />
											<p>Upload a Picture</p>
										</label>
										<input id="note_picture" name="note_picture" type="file" accept="image/*"/>
										<div id="note_picture_filename"></div>
									</div>
								</div>
								<div class="form-group ">
									<label class="form-label">Default Profile for notes(If seller do not upload)</label>

									<div class="image-upload">
										<label class="myInput text-center" for="profile_picture">
											<img src="../images/Admin_images/upload-file.png" class="img-responsive img-fluid" />
											<p>Upload a Picture</p>
										</label>
										<input id="profile_picture" name="profile_picture" type="file" accept="image/*" />
										<div id="profile_picture_filename"></div>
									</div>
								</div>
								
								<div class="last">
									<input type="submit" class="btn" onClick="return confirm('Are you sure to update this?')" name="submit" value="SUBMIT">
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
    
    <script> 
        
        /* profile picture */
        $("#note_picture").change(function(){
          $("#note_picture_filename").text(this.files[0].name);

        });
        
        /* profile picture */
        $("#profile_picture").change(function(){
          $("#profile_picture_filename").text(this.files[0].name);

        });
    </script>
    
</body>

</html>