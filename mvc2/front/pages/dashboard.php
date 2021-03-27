<?php ob_start(); ?>
<?php session_start(); ?>
<?php  include "includes/db.php"; ?>
<?php  include "includes/functions.php"; ?>
<?php 
if(isset($_SESSION['UsersID'])) {
    $user_id = $_SESSION['UsersID'];
    //Sold Notes
    $query = "SELECT DownloadID, PurchasedPrice FROM downloads where SellerID = $user_id ";
    $select_notes_query = mysqli_query($connection, $query);

    $count_SoldNotes  = mysqli_num_rows($select_notes_query);
    
    $sum = 0;
    while($row = mysqli_fetch_assoc($select_notes_query)){
        $sum += $row['PurchasedPrice'];
    }
    
    //Download Notes
     $query = "SELECT * FROM downloads WHERE DownloaderID = '{$user_id}' AND (IsSellerHasAllowedDownload = '1' OR IsPaid = '0')";
    $select_notes_query = mysqli_query($connection, $query);
    $count_DownloadNotes  = mysqli_num_rows($select_notes_query);
    
    //Rejected Notes
    $query = "SELECT * FROM seller_notes WHERE SellerID = '{$user_id}' AND Status = 'Rejected'";
    $select_notes_query = mysqli_query($connection, $query);
    $count_RejectedNotes  = mysqli_num_rows($select_notes_query);
    
    //Rejected Notes
    $query = "SELECT * FROM downloads WHERE SellerID = '{$user_id}' AND IsSellerHasAllowedDownload = '0'";
    $select_notes_query = mysqli_query($connection, $query);
    $count_BuyerRequest  = mysqli_num_rows($select_notes_query);
    
    
    
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

	<!-- Jquery UI -->
	<link rel="stylesheet" href="../css/jquery-ui/jquery-ui.css">
	<link rel="stylesheet" href="../css/jquery-ui/jquery-ui.structure.css">
	<link rel="stylesheet" href="../css/jquery-ui/jquery-ui.theme.css">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="../css/bootstrap/bootstrap.css">
	
	<!-- DataTable CSS -->
    <link rel="stylesheet" href="../css/DataTables/datatables.css">
	
	<!-- Custom Css -->
	<link rel="stylesheet" href="../css/dashboard.css">

</head>

<body>

	<!-- Header -->
	<?php
	    if(isset($_SESSION['UsersID'])) {    
            include "includes/login_nav.php"; 
        }else {
            include "includes/logoff_nav.php";
        }
    ?>
    <!-- Header Ends -->
    
	<!-- DashBoard -->
	<div id="dashboard">

		<div class="content-box-lg">

			<div class="container">
				
				<!-- DashBoard Heading-->
				<div class="row">
					<div class="col-md-12 col-md-12">
						<h2 class="heading">Dashboard</h2>
						<a class="btn" href="add-notes.php" role="button" id="add-note-btn">Add Note</a>
					</div>
				</div>
				<!-- DashBoard Heading end-->
				
				<!-- Notes States -->
				<div class="row" id="stats">
                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                        <div id="stats-left">
                            <div class="row">
                                <div class="col-md-4 col-sm-3 col-4 state-head text-center stats-text">
                                    <div>
                                        <img src="../images/Front_images/my-earning.png" alt="my earning image" id="my-earning-img" />
										<h3 class="heading">My Earning</h3>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-5 col-4 text-center stats-text">
                                   <a href="my-sold-notes.php" style="cursor:pointer; text-decoration:none; color: #212529">
                                    <div>
                                        <h4><?php echo "$count_SoldNotes"; ?></h4>
                                        <h6>Number of Notes Sold</h6>
                                    </div>
                                    </a>
                                </div>
                                <div class="col-md-4 col-sm-4 col-4 text-center stats-text">
                                    <div>
                                        <h4>$<?php echo "$sum"; ?></h4>
                                        <h6>Money Earned</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-4 col-sm-4 col-4 text-center">
                       <a href="my-downloads.php" style="cursor:pointer; text-decoration:none; color: #212529">
                        <div class="stat-item stats-text">
                            <div>
                                <h4><?php echo "$count_DownloadNotes"; ?></h4>
                                <h6>My Downloads</h6>
                            </div>
                        </div>  
                        </a>
                    </div>

                    <div class="col-lg-2 col-md-4 col-sm-4 col-4 text-center">
                       <a href="my-rejected-notes.php" style="cursor:pointer; text-decoration:none; color: #212529">
                        <div class="stat-item stats-text">
                            <div>
                                <h4><?php echo "$count_RejectedNotes"; ?></h4>
                                <h6>My Rejected Notes</h6>
                            </div>
                        </div>  
                        </a>
                    </div>

                    <div class="col-lg-2 col-md-4 col-sm-4 col-4 text-center">
                       <a href="buyer-request.php" style="cursor:pointer; text-decoration:none; color: #212529">
                        <div class="stat-item stats-text">
                            <div>
                                <h4><?php echo "$count_BuyerRequest"; ?></h4>
                                <h6>Buyer Requests</h6>
                            </div>
                        </div>  
                        </a>
                    </div>
                </div>
                <!-- Notes States End-->
                
			</div>

		</div>

	</div>
	<!-- DashBoard Ends -->	
	
	
	 <!-- In Progress table -->
    <div class="notes-table">
		<div class="content-box-lg">
			<div class="container">
        
        		<div class="row">
					<div class="col-md-6 col-sm-12 col-12">
						<h3 class="heading progress-heading">In Progress Notes</h3>
					</div>
					<div class="col-md-6 col-sm-12 search-content">	
						<span toggle="#search" class="fa fa-search field-icon"></span>
						<input class="myInput" placeholder="Search" type="search" id="progress-search" value="">
						<a class="btn" href="" role="button" id="progress-search-btn">search</a>
					</div>
				</div>
				
				<!-- data table -->
				<table id="in-progress-table" class="datatable table table-responsive-md display">
                    <thead>
                        <tr>
                           
                            <th>Added Date</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
        
                    <tbody>
                             
                            <?php
                                    
                                    $query = "SELECT * FROM seller_notes WHERE SellerID = '{$user_id}' and NOT(Status = 'Published' OR Status='Rejected')";
                                    
                                    $select_all_notes_query = mysqli_query($connection, $query);

                                    if (!$select_all_notes_query) {

                                        die("QUERY FAILED" . mysqli_error($connection));

                                    }

                                    $notes_count = mysqli_num_rows($select_all_notes_query);

                                    while($row = mysqli_fetch_assoc($select_all_notes_query )) {
                                        
                                        $db_NoteID = $row['NoteID'];
                                        $db_AddedDate = $row['CreatedDate'];
                                        $db_Title = $row['Title'];
                                        $db_Category = $row['Category'];
                                        $db_Status = $row['Status'];
                                        
                                        $query = "SELECT CategoryName FROM note_categories WHERE CategoryID = '{$db_Category}' ";
                                        $cat_name = mysqli_query($connection, $query);
                                        
                                        $row = mysqli_fetch_array($cat_name);
                                        
                                        $db_CategoryName = $row['CategoryName'];    
                                        
                                        
                                        
                                        echo "<tr>";
                                        echo "<td>{$db_AddedDate}</td>";  
                                        echo "<td>{$db_Title}</td>";  
                                        echo "<td>{$db_CategoryName}</td>";  
                                        echo "<td>{$db_Status}</td>";
                                        if($db_Status == 'Draft')
                                        {
                                            echo "<td>
                                                    <span class='action-icons'>
                                                        <a href='add-notes.php?edit={$db_NoteID}'><img src='../images/Front_images/edit.png' alt='edit' class='edit-icon'></a>
                                                        <a onClick=\"javascript: return confirm('Are you sure you want to delete this?');\" href='?delete={$db_NoteID}'><img src='../images/Front_images/delete.png' alt='delete'></a>
                                                    </span>
                                                </td>";
                                        }else {
                                            echo "<td>
                                                    <span class='action-icons'>
                                                        <a href='note-details.php?NoteID={$db_NoteID}'><img src='../images/Front_images/eye.png' alt='view' class='view-icon'></a>
                                                    </span>
                                                </td>";
                                        }
                                        echo "</tr>";

                                    }

                            
                            ?>                        
                        
                    </tbody>
                </table>
                
                <?php 
                    if(isset($_GET['delete'])) {
                        
                       
                        $note_id = $_GET['delete'];
                        $query = "DELETE FROM seller_notes WHERE NoteID = {$note_id}";
                        $delete_query = mysqli_query($connection, $query);
                        if (!$delete_query) {
                            die("QUERY FAILED" . mysqli_error($connection));
                        }
                        redirect("dashboard.php");
                }
                ?>
				
			</div>
		</div>
	</div>
	<!-- In Progress table  Ends-->
				
	<!-- published note table -->
		<div class="notes-table">
		<div class="content-box-lg">
			<div class="container">
        		
        		<div class="row">
					<div class="col-md-6 col-sm-12">
						<h3 class="heading published-heading">Published Notes</h3>
					</div>
					<div class="col-md-6 col-sm-12 search-content">	
						<span toggle="#search" class="fa fa-search field-icon"></span>
						<input class="myInput" placeholder="Search" type="search" id="published-search" value="">
						<a class="btn" href="" role="button" id="published-search-btn">search</a>
					</div>
				</div>
				
				<!-- data table -->
				<table id="published-table" class="datatable table table-responsive-md display">
                    <thead>
                        <tr>
                            <th>Added Date</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Sell type</th>
                            <th>price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
        
                    <tbody>
                        <?php
                            
                                    
                                    $query = "SELECT * FROM seller_notes WHERE SellerID = '{$user_id}' and Status = 'Published' ";
                                    
                                    $select_all_notes_query = mysqli_query($connection, $query);

                                    if (!$select_all_notes_query) {

                                        die("QUERY FAILED" . mysqli_error($connection));

                                    }

                                    $notes_count = mysqli_num_rows($select_all_notes_query);

                                    while($row = mysqli_fetch_assoc($select_all_notes_query )) {
                                        
                                        $db_NoteID = $row['NoteID'];
                                        $db_AddedDate = $row['CreatedDate'];
                                        $db_Title = $row['Title'];
                                        $db_Category = $row['Category'];
                                        $db_SellType = $row['IsPaid'];
                                        $db_Price= $row['SellingPrice'];
                                        
                                        if($db_SellType == '1') {
                                            $db_SellType = 'Paid';
                                        }else {
                                            $db_SellType = 'free';
                                        }
                                        
                                        $query = "SELECT CategoryName FROM note_categories WHERE CategoryID = '{$db_Category}' ";
                                        $cat_name = mysqli_query($connection, $query);
                                        
                                        $row = mysqli_fetch_array($cat_name);
                                        
                                        $db_CategoryName = $row['CategoryName'];    
                                        
                                        echo "<tr>";
                                        echo "<td>{$db_AddedDate}</td>";  
                                        echo "<td>{$db_Title}</td>";  
                                        echo "<td>{$db_CategoryName}</td>";  
                                        echo "<td>{$db_SellType}</td>";
                                        echo "<td>$ {$db_Price}</td>";
                                        
                                        echo "<td>
                                                <span class='action-icons'>
                                                    <a href='note-details.php?NoteID={$db_NoteID}'><img src='../images/Front_images/eye.png' alt='view' class='view-icon'></a>
                                                </span>
                                            </td>";
                                        
                                        echo "</tr>";

                                    }
                            ?>         
                        
                    </tbody>
                </table>
				
			</div>
		</div>
	</div>
	<!-- published note table Ends-->

	
	
	<!-- Footer -->
	<footer>

		<div class="content-box-lg">
			<div class="container">
				<div class="row copyright">

						<div class="col-md-6">
						<p class="pera">
							Copyright &copy; Tatvasoft All Rights Reserved.
						</p>
					</div>

					<div class="col-md-6 justify-content-end">
						<ul class="social-list ">
							<li><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
						</ul>
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

	<!-- Bootstrap js -->
	<script src="../js/bootstrap/bootstrap.min.js"></script>
	
	<!-- DataTable JS -->
    <script src="../js/DataTables/datatables.js"></script>

	<!-- Custom JS -->
	<script src="../js/script.js"></script>

</body>

</html>