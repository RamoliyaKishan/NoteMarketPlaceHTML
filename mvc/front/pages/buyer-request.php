<?php ob_start(); ?>
<?php session_start(); ?>
<?php  include "includes/db.php"; ?>
<?php  include "includes/functions.php"; ?>
<?php
if(isset($_SESSION['UsersID'])) {
    $buyer_id = $_SESSION['UsersID'];
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
	<link rel="shortcut icon" href="../images/Front_images/fav-icon.png">

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
	<link rel="stylesheet" href="../css/buyer-request.css">

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
	
	 <!-- buyer-request table -->
    <div class="notes-table">
		<div class="content-box-lg">
			<div class="container">
        
        		<div class="row">
					<div class="col-md-6 col-sm-12">
						<h2 class="heading buyer-request-heading">Buyer Requests</h2>
					</div>
					<div class="col-md-6 col-sm-12 search-content">	
						<span toggle="#search" class="fa fa-search field-icon"></span>
						<input class="myInput" placeholder="Search" type="search" id="buyer-request-search" value="">
						<a class="btn" href="" role="button" id="buyer-request-search-btn">search</a>
					</div>
				</div>
				    
    				
				<!-- data table -->
				<table id="buyer-request-table" class="datatable table-responsive display">
                    <thead>
                        <tr>
                        	<th>SR No.</th>
                            <th>NOte Title</th>
                            <th>Category</th>
                            <th>Buyer</th>
                            <th>Phone no.</th>
                            <th>Sell Type</th>
                            <th>price</th>
                            <th>Downloaded Date/Time</th>
                            <th></th>
                        </tr>
                    </thead>
        
                    <tbody>
                       
                    <?php 
                        $i = 1;
                        $i++;
                    if(isset($_SESSION['NoteID'])) {
                        
                        $note_id = $_SESSION['NoteID'];
                            
                        $query = "SELECT * FROM seller_notes WHERE NoteID = '{$note_id}'";
                                    
                        $select_notes_query = mysqli_query($connection, $query);

                        if (!$select_notes_query) {

                            die("QUERY FAILED" . mysqli_error($connection));

                        }
                    
                        while($row = mysqli_fetch_assoc($select_notes_query )) {
                                        
                                        $db_Title = $row['Title'];
                                        $db_Category = $row['Category'];
                                        $db_IsPaid = $row['IsPaid'];
                                        $db_SellingPrice= $row['SellingPrice'];
                                        $db_PublishedDate = $row['PublishedDate'];
                                        
                                        if($db_IsPaid == '1') {
                                            $db_IsPaid = 'Paid';
                                        }else {
                                            $db_IsPaid = 'free';
                                        }
                                        
                                        $query = "SELECT CategoryName FROM note_categories WHERE CategoryID = '{$db_Category}' ";
                                        $cat_name = mysqli_query($connection, $query);
                                        
                                        $row = mysqli_fetch_array($cat_name);
                                        
                                        $db_CategoryName = $row['CategoryName'];
                        
                                        $query = "SELECT * FROM Users WHERE UsersID = '{$buyer_id}' ";
                                        $buyer_detail = mysqli_query($connection, $query);
                                        
                                        $row = mysqli_fetch_array($buyer_detail);
                                        
                                        $buyer_email = $row['EmailID'];
                                        
                                        
                                        
                                    }
                        
                        echo "<tr>";
                        echo "<td>{$i}</td>";  
                        echo "<td>{$db_Title}</td>";  
                        echo "<td>{$db_CategoryName}</td>";  
                        echo "<td>{$buyer_email}</td>";
                        echo "<td>9865327410</td>"; 
                        echo "<td>{$db_IsPaid}</td>";
                        echo "<td>$ {$db_SellingPrice}</td>";
                        echo "<td>" . date('m-d-y h:i:sa') . "</td>";
                        echo "<td>
                                <span class='action-icons'>
                                    <a><img src='../images/Front_images/eye.png' alt='view' class='view-icon'></a>
                                    <div class='dropleft dropdown'>
										<a href='#' role='button'' id='downloads-notes-menu' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
											<img src='../images/Front_images/dots.png' alt='delete class='dots-icon'>
										</a>
									
										<div class='dropdown-menu' aria-labelledby='downloads-notes-menu' >
    										<a class='dropdown-item' href='#'>allow download</a>
										</div>
									</div>
                                    
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
	<!-- My Sold Notes table  Ends-->
	
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