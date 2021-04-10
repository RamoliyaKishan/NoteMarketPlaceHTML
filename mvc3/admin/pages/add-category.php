<?php ob_start(); ?>
<?php session_start(); ?>
<?php  include "includes/db.php"; ?>
<?php  include "includes/functions.php"; ?>

<?php

if(isset($_SESSION['UsersID'])) {
    
    $user_id = $_SESSION['UsersID'];
    
    $db_CategoryName = "";
    $db_Description= "";
    
    if(isset($_GET['c_id'])){
        
        $c_id = $_GET['c_id'];
        
        $query = "SELECT * FROM note_categories WHERE CategoryID = '{$c_id}'";
        $select_category_query = mysqli_query($connection, $query);
        
        $row = mysqli_fetch_array($select_category_query);
            $db_CategoryName = $row['CategoryName'];
            $db_Description = $row['Description'];
            $db_IsActive = $row['IsActive']; 
        
    }
        
    if(isset($_POST['submit'])) {
            
        $category_name = escape($_POST['category_name']);
        $description = escape($_POST['description']);
        
        if(isset($_GET['c_id'])){
            
            if($db_CategoryName != $category_name || $db_Description != $description || $db_IsActive != '1') {
                $query = "UPDATE note_categories SET CategoryName = '{$category_name}', Description = '{$description}', ModifiedDate =  now(), ModifiedBy = '{$user_id}', IsActive = '1' WHERE CategoryID = '{$c_id}'"; 

                $update_note_category = mysqli_query($connection, $query);
                if($update_note_category){
                    echo "<script type='text/javascript'>alert('Category Updateded Successfully.'); </script>";
                }else {
                    die("QUERY FAILD" . mysqli_error($connection));
                }
            }else {
                echo "<script type='text/javascript'>alert(There is no any changes in this Category.'); </script>";
            }
            
        }else {
            
            $query = "SELECT * FROM note_categories WHERE CategoryName = '{$category_name}'";
            $check_query = mysqli_query($connection, $query);
            $found = mysqli_num_rows($check_query);
            
            if($found <= 0){
                $query = "INSERT INTO note_categories (CategoryName, Description, CreatedDate, CreatedBy, IsActive) VALUES ('{$category_name}', '{$description}', now(), '{$user_id}', '1')";
                $add = mysqli_query($connection, $query);
                
                if(!$add) {
                    die("QUERY FAILD" . mysqli_error($connection));
                }else {
                    echo "<script type='text/javascript'>alert('Category added Successfully.');  </script>";
                }
            }else {
                echo "<script type='text/javascript'>alert('This Category Name is already exist.');  </script>";
            }
        }
        redirect("manage-category.php");
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
	<link rel="stylesheet" href="../css/add-category.css">

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
							<h2 class="heading">Add Category</h2>
						</div>
					</div>
					
					<div class="col-lg-6 col-md-8 col-sm-12">
						
						<div class="user-profile-left">

							<form class="myForm text-left" method="POST">

								<div class="form-group">
									<label class="form-label">Category Name *</label>
									<input class="myInput" placeholder="Enter your category Name" type="text" id="category_name" name="category_name" value="<?php echo $db_CategoryName; ?>" required>
								</div>
								<div class="form-group">
									<label class="form-label">Description *</label>
									<textarea class="myInput" id="description" name="description" placeholder="Enter your description" required><?php echo $db_Description; ?></textarea>
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