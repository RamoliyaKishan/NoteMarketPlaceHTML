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
	<link rel="stylesheet" href="../css/rejected-notes.css">

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

				<div class="row rejected-notes-heading">
					<div class="col-md-12 col-sm-12">
						<h2 class="heading">Rejected Notes</h2>
					</div>
				</div>

				<div class="row rejected-notes-heading">
					<div class="col-md-6 col-sm-6">
						<span>Seller</span><br>
						<select class="myInput filter" id="seller-filter" name="seller">
                            <option selected disabled>Select seller</option>
                            <?php
                                $query = "SELECT DISTINCT u.FirstName, u.LastName FROM users AS u INNER JOIN seller_notes AS sn ON u.UsersID = sn.SellerID ORDER BY FirstName ASC";
                                $seller_name = mysqli_query($connection, $query);
                                
                                while($row = mysqli_fetch_array($seller_name)) {
                                    $db_SellerName = $row['FirstName'];
                                    $db_SellerName .= " ". $row['LastName'];
                                    
                                    echo "<option class='option' value=$db_SellerName>{$db_SellerName}</option>";
                                }
                            ?>
                        </select>
					</div>
					<div class="col-md-6 col-sm-6 search-conten search-content">
						<span toggle="#search" class="fa fa-search field-icon"></span>
						<input class="myInput" placeholder="Search" type="search" id="search" value="">
						<a class="btn" href="" role="button" id="search-btn">search</a>
					</div>
				</div>

				<!-- data table -->
				<table id="rejected-notes-table" class="datatable table table-responsive display">
                    <thead>
                        <tr>
                        	<th>SR No.</th>
                            <th>NOte Title</th>
                            <th>Category</th>
                            <th>Seller</th>
                            <th></th>
                            <th>Date Edited</th>
                            <th>rejected by</th>
                            <th>remark</th>
                            <th></th>
                        </tr>
                    </thead>
        
                    <tbody>
                        
                        <?php
                            
                            $i = 1;
                            
                            $query = "SELECT * FROM seller_notes WHERE Status = 'Rejected' OR Status = 'Removed' ORDER BY ModifiedDate DESC";
                            $select_all_notes_query = mysqli_query($connection, $query);
                            if (!$select_all_notes_query) {
                                die("QUERY FAILED" . mysqli_error($connection));
                            }

                            $notes_count = mysqli_num_rows($select_all_notes_query);

                            while($row = mysqli_fetch_assoc($select_all_notes_query )) {
                                
                                $db_NoteID = $row['NoteID'];
                                $db_SellerID = $row['SellerID'];
                                $db_ActionedBy = $row['ActionedBy'];
                                $db_AdminRemarks = $row['AdminRemarks'];
                                $db_PublishedDate = $row['PublishedDate'];
                                $db_PublishedDate = date('d-m-Y, h:m:s',strtotime($db_PublishedDate));
                                $db_Title = $row['Title'];
                                $db_Category = $row['Category'];
                                $db_Note = $row['Note'];
                                
                                    
                                $query = "SELECT CategoryName FROM note_categories WHERE CategoryID = '{$db_Category}' ";
                                $cat_name = mysqli_query($connection, $query);
                                $row = mysqli_fetch_array($cat_name);
                                $db_CategoryName = $row['CategoryName'];
                                
                                $query = "SELECT FirstName, LastName, EmailID FROM users WHERE UsersID = '{$db_SellerID}' ";
                                $seller_name = mysqli_query($connection, $query);
                                $row = mysqli_fetch_array($seller_name);
                                $db_SellerName = $row['FirstName'];
                                $db_SellerName .= " ". $row['LastName'];
                                $seller_email = " ". $row['EmailID'];
                                
                                $query = "SELECT FirstName, LastName FROM users WHERE UsersID = '{$db_ActionedBy}' ";
                                $admin_name = mysqli_query($connection, $query);
                                $row = mysqli_fetch_array($admin_name);
                                $db_ActionedByName = $row['FirstName'];
                                $db_ActionedByName .= " ". $row['LastName'];
                                
                                
                                echo "<tr>";
                                echo "<td>{$i}</td>";  
                                echo "<td><a style='text-decoration:none; color:#6255a5' href='note-details.php?NoteID={$db_NoteID}'>{$db_Title}<a></td>";  
                                echo "<td>{$db_CategoryName}</td>"; 
                                echo "<td>{$db_SellerName}</td>";
                                echo "<td><a href = 'member-details.php?u_id=$db_SellerID'><img src='../images/Admin_images/eye.png' class='eye' alt='See Seller'></a></td>";
                                echo "<td>{$db_PublishedDate}</td>";
                                echo "<td>{$db_ActionedByName}</td>";
                                echo "<td>{$db_AdminRemarks}</td>";
                                echo "<td>
                                    <span class='action-icons'>
                                        <div class='dropleft dropdown'>
                                            <a href='#' role='button'' id='downloads-notes-menu' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                <img src='../images/Admin_images/dots.png' alt='dots-icon' class='dots-icon'>
                                            </a>

                                            <div class='dropdown-menu' aria-labelledby='downloads-notes-menu'>
                                            
                                                <a class='dropdown-item' onClick=\"javascript: return confirm('Are you sure to Approve $db_Title Note ??');\" href='?a_id=$db_NoteID'>Approve</a>
                                                
                                                <a class='dropdown-item' href='?d_id={$db_NoteID}'>download Notes</a>
                                                
                                                <a class='dropdown-item' href='note-details.php?NoteID={$db_NoteID}'>View More Details</a>
                                                
                                            </div>
                                        </div>

                                    </span>

                                </td>";
                                
                                echo "</tr>";
                                $i++;
                                
                                if(isset($_GET['d_id'])){
                                noteDownload($_GET['d_id']);
                            }
                            
                            if(isset($_GET['a_id'])){

                                $NoteID = $_GET['a_id'];

                                $query = "SELECT Status From seller_notes WHERE Status='Published' AND NoteID = '$NoteID'";
                                $update_status_query = mysqli_query($connection, $query);
                                $count = mysqli_num_rows($update_status_query);

                                if($count > 0){
                                    echo "<script type='text/javascript'>
                                            alert('This $db_Title Note is already Published');
                                            window.location.href='rejected-notes.php';
                                        </script>";

                                }else {

                                    $query = "UPDATE seller_notes SET Status='Published', ActionedBy = '{$user_id}', PublishedDate = now(), ModifiedDate = now(), ModifiedBy = '$user_id', IsActive = '1' WHERE NoteID = '$NoteID'";
                                    $update_status_query = mysqli_query($connection, $query);

                                    echo "<script type='text/javascript'>
                                            alert('Thank you for Published $db_Title Note.');
                                            window.location.href='rejected-notes.php';
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
            search_filter_notes = $('#rejected-notes-table').DataTable({
                "bLengthChange": false, // this gives option for changing the number of records shown in the UI table
                "lengthMenu": [5], 
                "dom": "lrtp" 
            });
            // search
            $("#search").on('keyup',function(){
                search_filter_notes.search(this.value).draw();
            });

            // Filter by seller 
            searchSeller();
            function searchSeller() {
                $("#seller-filter").on('change',function(){
                    search_filter_notes.columns(3).search(this.value).draw();
                });
            }
            $('.filter').on('change', function(){
                searchSeller();
            });
            
            
        });
        

    </script>


</body>
</html>