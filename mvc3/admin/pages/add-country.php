<?php ob_start(); ?>
<?php session_start(); ?>
<?php  include "includes/db.php"; ?>
<?php  include "includes/functions.php"; ?>

<?php

if(isset($_SESSION['UsersID'])) {
    
    $user_id = $_SESSION['UsersID'];
    
    $db_CountryName = "";
    $db_CountryCode= "";
    
    if(isset($_GET['c_id'])){
        
        $c_id = $_GET['c_id'];
        
        $query = "SELECT * FROM countries WHERE CountryID = '{$c_id}'";
        $select_country_query = mysqli_query($connection, $query);
        
        $row = mysqli_fetch_array($select_country_query);
            $db_CountryName = $row['CountryName'];
            $db_CountryCode = $row['CountryCode'];
            $db_IsActive = $row['IsActive']; 
        
    }
        
    if(isset($_POST['submit'])) {
            
        $country_name = escape($_POST['country_name']);
        $country_code = escape($_POST['country_code']);
        
        if(isset($_GET['c_id'])){
            
            if($db_CountryName != $country_name || $db_CountryCode != $country_code || $db_IsActive != '1') {
                $query = "UPDATE countries SET CountryName = '{$country_name}', CountryCode = '{$country_code}', ModifiedDate =  now(), ModifiedBy = '{$user_id}', IsActive = '1' WHERE CountryID = '{$c_id}'"; 

                $update_note_country = mysqli_query($connection, $query);
                if($update_note_country){
                    echo "<script type='text/javascript'>alert('Country Updateded Successfully.'); </script>";
                }else {
                    die("QUERY FAILD" . mysqli_error($connection));
                }
            }else {
                echo "<script type='text/javascript'>alert(There is no any changes in this Country.'); </script>";
            }
            
        }else {
            
            $query = "SELECT CountryName FROM countries WHERE CountryName = '{$country_name}'";
            $check_query = mysqli_query($connection, $query);
            $found = mysqli_num_rows($check_query);
            
            if($found <= 0){
                $query = "INSERT INTO countries (CountryName, CountryCode, CreatedDate, CreatedBy, IsActive) VALUES ('{$country_name}', '{$country_code}', now(), '{$user_id}', '1')";
                $add = mysqli_query($connection, $query);
                
                if(!$add) {
                    die("QUERY FAILD" . mysqli_error($connection));
                }else {
                    echo "<script type='text/javascript'>alert('Country added Successfully.');  </script>";
                }
            }else {
                echo "<script type='text/javascript'>alert('This Country Name is already exist.');  </script>";
            }
        }
        redirect("manage-country.php");
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
	<link rel="stylesheet" href="../css/add-country.css">

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
	
	<!-- Add Category -->
	<section id="add-notes">

		<!-- form -->
		<div class="content-box-lg">

			<div class="container">

				<div class="row">

					<div class="col-md-12 col-sm-12">
						<div class="text-left">
							<h2 class="heading">Add Country</h2>
						</div>
					</div>
					
					<div class="col-lg-6 col-md-8 col-sm-12">
						
						<div class="user-profile-left">

							<form class="myForm text-left" method="POST">

								<div class="form-group">
									<label class="form-label">Country Name *</label>
									<input class="myInput" placeholder="Enter your Country Name" type="text" id="country_name" name="country_name" value="<?php echo "$db_CountryName"; ?>" required>
								</div>
								<div class="form-group">
									<label class="form-label">Country Code *</label>
									<input class="myInput" placeholder="Enter your Country code" type="text" id="country_code" name="country_code" value="<?php echo "$db_CountryCode"; ?>" required>
								</div>								
								
								<div class="last">
									<input type="submit" onClick="return confirm('Are you sure to update this?')" name="submit" class="btn" value="SUBMIT">
								</div>
							</form>
						</div>
						
					</div>
					
					
				</div>

			</div>

		</div>
	
	</section>
	
	<!-- Footer -->
	<footer>

		<div class="content-box-lg">
			<div class="container">
				<div class="row copyright">
					
					<div class="col-md-6 col-sm-12">
						<p class="pera">
							Version : 1.1.24
						</p>
					</div>

					<div class="col-md-6 col-sm-12 text-right">
						<p class="pera">
							Copyright &copy; Tatvasoft All Rights Reserved.
						</p>
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