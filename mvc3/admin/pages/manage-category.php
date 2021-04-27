<?php ob_start(); ?>
<?php session_start(); ?>
<?php  include "includes/db.php"; ?>
<?php  include "includes/functions.php"; ?>

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
	<link rel="stylesheet" href="../css/manage-category.css">

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

	<!-- manage-category table -->
	<div class="notes-table">
		<div class="content-box-lg">
			<div class="container">

				<div class="row manage-category-heading">
					<div class="col-md-12 col-sm-12">
						<h2 class="heading">Manage Category</h2>
					</div>
				</div>

				<div class="row manage-category-heading">
					<div class="col-md-6 col-sm-6">
						<a class="top-btn btn" href="add-category.php" role="button" id="add-category-btn">add category</a>
					</div>
					<div class="col-md-6 col-sm-6 search-content">	
						<span toggle="#search" class="fa fa-search field-icon"></span>
						<input class="myInput" placeholder="Search" type="search" id="search" value="">
						<a class="search-btn btn" href="" role="button" id="search-btn">search</a>
					</div>
				</div>

				<!-- data table -->
				<table id="manage-category-table" class="datatable table table-responsive-md display">
					<thead>
						<tr>
							<th>SR No.</th>
							<th>category</th>
							<th>Description</th>
							<th>Date added</th>
							<th>Added By</th>
							<th>active</th>
							<th>action</th>
						</tr>
					</thead>

					<tbody>
                        
                        <?php
                            
                            $i = 1;
                            
                            $query = "SELECT * FROM note_categories ORDER BY CreatedDate DESC";
                        
                            $select_all_category_query = mysqli_query($connection, $query);
                            if (!$select_all_category_query) {
                                die("QUERY FAILED" . mysqli_error($connection));
                            }

                            $category_count = mysqli_num_rows($select_all_category_query);

                            while($row = mysqli_fetch_assoc($select_all_category_query )) {
                                
                                $db_CategoryID = $row['CategoryID'];
                                $db_CategoryName = $row['CategoryName'];
                                $db_Description = $row['Description'];
                                $db_IsActive = $row['IsActive'];
                                $db_CreatedBy = $row['CreatedBy'];
                                $db_CreatedDate = $row['CreatedDate'];
                                if(!empty($db_CreatedDate)){
                                    $db_CreatedDate = date('d-m-Y, h:m:s',strtotime($db_CreatedDate)) ?? null;
                                }
                                $query = "SELECT * FROM users WHERE UsersID = '{$db_CreatedBy}'";
                                $select_user_query = mysqli_query($connection, $query);
                                $count = mysqli_num_rows($select_user_query);
                                if($count > 0) {
                                    $row = mysqli_fetch_assoc($select_user_query);
                                    $db_AddedBy = $row['FirstName'];
                                    $db_AddedBy .= " " . $row['LastName'];
                                }else {
                                    $db_AddedBy = "";
                                }
                                $db_IsActive = ($db_IsActive == '1') ? 'Yes' : 'No';
                                
                                echo "<tr>";
                                echo "<td>{$i}</td>";
                                echo "<td>{$db_CategoryName}</td>";  
                                echo "<td>{$db_Description}</td>"; 
                                echo "<td>{$db_CreatedDate}</td>";
                                echo "<td>{$db_AddedBy}</td>";
                                echo "<td>{$db_IsActive}</td>";
                               
                                echo "<td>
                                    <span class='action-icons'>
                                            
                                        <a href='add-category.php?c_id={$db_CategoryID}'><img class='view-icon' src='../images/Admin_images/edit.png' alt='edit'></a>
                                        
                                        <a onClick=\"javascript: return confirm('Are you sure you want to delete this?');\" href='?delete={$db_CategoryID}'><img class='delete-icon' src='../images/Admin_images/delete.png' alt='delete'></a>    
                                        
                                    </span>

                                </td>";
                                
                                echo "</tr>";
                                $i++;
                                
                                if(isset($_GET['delete'])){

                                    $c_id = $_GET['delete'];

                                    $query = "SELECT CategoryID From note_categories WHERE CategoryID = {$c_id} AND IsActive = '1'";
                                    $update_query = mysqli_query($connection, $query);
                                    $count = mysqli_num_rows($update_query);

                                    if($count > 0){
                                        $query = "UPDATE note_categories SET ModifiedDate = now(), ModifiedBy = '{$user_id}', IsActive = '0' WHERE CategoryID = '{$c_id}'";
                                        $delete_query = mysqli_query($connection, $query);
                                        
                                        echo "<script type='text/javascript'>
                                                alert('you have made this CATEGORY Inactive');
                                                window.location.href='manage-category.php';
                                            </script>";
                                        

                                    }else {
                                        echo "<script type='text/javascript'>
                                                alert('This CATEGORY is already Inactive');
                                                window.location.href='manage-category.php';
                                            </script>";
                                    }

                                }
                                
                            }
                        ?>
                        
						
					</tbody>
				</table>

			</div>
		</div>
	</div>
	<!-- My Sold Notes table  Ends-->

	<!--  footer  -->
    <?php include('includes/footer.php'); ?>
    
    <script>
        $(function(){
            
            // In progress notes table
            search_filter_notes = $('#manage-category-table').DataTable({
                "bLengthChange": false, // this gives option for changing the number of records shown in the UI table
                "lengthMenu": [5], 
                "dom": "lrtp" 
            });
            // search
            $("#search").on('keyup',function(){
                search_filter_notes.search(this.value).draw();
            });
           
            
        });
        

    </script>

</body>

</html>