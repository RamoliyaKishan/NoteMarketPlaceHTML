<?php ob_start(); ?>
<?php session_start(); ?>
<?php  include "includes/db.php"; ?>
<?php  include "includes/functions.php"; ?>

<?php

if(isset($_SESSION['UsersID'])) {
    
    $user_id = $_SESSION['UsersID'];
    
    $db_TypeName = "";
    $db_Description= "";
    
    if(isset($_GET['t_id'])){
        
        $t_id = $_GET['t_id'];
        
        $query = "SELECT * FROM note_types WHERE TypeID = '{$t_id}'";
        $select_category_query = mysqli_query($connection, $query);
        
        $row = mysqli_fetch_array($select_category_query);
            $db_TypeName = $row['TypeName'];
            $db_Description = $row['Description'];    
            $db_IsActive = $row['IsActive'];    
    }
        
    if(isset($_POST['submit'])) {
            
        $type_name = escape($_POST['type_name']);
        $description = escape($_POST['description']);
        
        if(isset($_GET['t_id'])){
            
            if($db_TypeName != $type_name || $db_Description != $description || $db_IsActive != '1') {
                $query = "UPDATE note_types SET TypeName = '{$type_name}', Description = '{$description}', ModifiedDate =  now(), ModifiedBy = '{$user_id}', IsActive = '1' WHERE TypeID = '{$t_id}'"; 

                $update_note_type = mysqli_query($connection, $query);
                if(!$update_note_type){
                    die("QUERY FAILD" . mysqli_error($connection));
                }else {
                    echo "<script type='text/javascript'>alert('Type Updateded Successfully.'); </script>";
                }
            }else {
                echo "<script type='text/javascript'>alert(There is no any changes in this Type.'); </script>";
            }
            
        }else {
            
            $query = "SELECT * FROM note_types WHERE TypeName = '{$type_name}'";
            $check_query = mysqli_query($connection, $query);
            $found = mysqli_num_rows($check_query);
            
            if($found <= 0){
                $query = "INSERT INTO note_types (TypeName, Description, CreatedDate, CreatedBy, IsActive) VALUES ('{$type_name}', '{$description}', now(), '{$user_id}', '1')";
                $add = mysqli_query($connection, $query);
                
                if(!$add) {
                    die("QUERY FAILD" . mysqli_error($connection));
                }else {
                    echo "<script type='text/javascript'>alert('TYPE added Successfully.');  </script>";
                }
            }else {
                echo "<script type='text/javascript'>alert('This TYPE Name is already exist.');  </script>";
            }
        }
        redirect("manage-type.php");
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
	<link rel="stylesheet" href="../css/add-type.css">

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
							<h2 class="heading">Add type</h2>
						</div>
					</div>
					
					<div class="col-lg-6 col-md-8 col-sm-12">
						
						<div class="user-profile-left">

							<form class="myForm text-left" method="POST">

								<div class="form-group">
									<label class="form-label">Type *</label>
									<input class="myInput" placeholder="Enter your type" type="text" id="type_name" name="type_name" value="<?php echo $db_TypeName; ?>" required>
								</div>
								<div class="form-group">
									<label class="form-label">Description *</label>
									<textarea class="myInput" id="description" name="description" placeholder="Enter your description" value=""><?php echo $db_Description; ?></textarea>
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
	

</body>

</html>