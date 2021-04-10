<?php ob_start(); ?>
<?php session_start(); ?>
<?php  include "includes/db.php"; ?>
<?php  include "includes/functions.php"; ?>
<?php
if(isset($_SESSION['UsersID'])) {
    $user_id = $_SESSION['UsersID'];
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
                            <th>Note Title</th>
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
                        
                        $query = "SELECT * FROM downloads WHERE SellerID = '{$user_id}' AND IsSellerHasAllowedDownload = '0' ORDER BY CreatedDate DESC";
                                    
                        $select_notes_query = mysqli_query($connection, $query);

                        if (!$select_notes_query) {

                            die("QUERY FAILED" . mysqli_error($connection));

                        }
                        
                        $total_request = mysqli_num_rows($select_notes_query);
                            
                        while($row = mysqli_fetch_assoc($select_notes_query )) {
                                        
                            $db_DownloadID = $row['DownloadID'];
                            $db_NoteID = $row['NoteID'];
                            $db_SellerID = $row['SellerID'];
                            $db_DownloaderID = $row['DownloaderID'];
                            $db_Title = $row['NoteTitle'];
                            $db_Category = $row['NoteCategory'];
                            $db_IsPaid = $row['IsPaid'];
                            $db_Price= $row['PurchasedPrice'];
                            $db_CreatedDate = $row['CreatedDate'];
                            $db_CreatedDate = date('d-m-Y, h:m:s',strtotime($db_CreatedDate));
                            
                            if($db_IsPaid == '1') {
                                $db_IsPaid = 'Paid';
                            }else {
                                $db_IsPaid = 'free';
                            }

                            $query = "SELECT FirstName, EmailID FROM users WHERE UsersID = '{$db_DownloaderID}' ";
                            $buyer_detail = mysqli_query($connection, $query);
                            $row = mysqli_fetch_array($buyer_detail);

                            $buyer_name = $row['FirstName'];
                            $buyer_email = $row['EmailID'];
                            
                            $query = "SELECT FirstName, EmailID FROM users WHERE UsersID = '{$db_SellerID}' ";
                            $seller_detail = mysqli_query($connection, $query);
                            $row = mysqli_fetch_array($seller_detail);

                            $seller_name = $row['FirstName'];
                            $seller_email = $row['EmailID'];
                                
                            
                        echo "<tr>";
                        echo "<td>{$i}</td>";  
                        echo "<td>{$db_Title}</td>";  
                        echo "<td>{$db_Category}</td>";  
                        echo "<td>{$buyer_email}</td>";
                        echo "<td>9865327410</td>"; 
                        echo "<td>{$db_IsPaid}</td>";
                        echo "<td>$ {$db_Price}</td>";
                        echo "<td>{$db_CreatedDate}</td>";
                        echo "<td>
                                <span class='action-icons'>
                                    <a href='note-details.php?NoteID={$db_NoteID}'><img src='../images/Front_images/eye.png' alt='view' class='view-icon'></a>
                                    <div class='dropleft dropdown'>
										<a href='#' role='button'' id='downloads-notes-menu' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
											<img src='../images/Front_images/dots.png' alt='delete' class='dots-icon'>
										</a>
									
										<div class='dropdown-menu' aria-labelledby='downloads-notes-menu' >
    										<a class='dropdown-item' onClick=\"javascript: return confirm('Are you sure to allow Download Note $buyer_email');\" href='?d_id={$db_DownloadID}'>allow download</a>
										</div>
									</div>
                                    
                                </span>
                                
                            </td>";
                               
                        echo "</tr>";
                        
                        if(isset($_GET['d_id'])){
                            $d_id = $_GET['d_id'];
                            
                            $query = "UPDATE downloads SET IsSellerHasAllowedDownload = 1, ModifiedDate = now(), modifiedBy = '{$user_id}' where DownloadID = '{$d_id}'";
                            
                            $allow_download_query = mysqli_query($connection, $query);
                            
                            if($allow_download_query) {
                                
                                $to = $buyer_email;
                                $from = "notemarketplace00@gmail.com";

                                $subject    = $seller_name . " Allows you to download a note.";

                                $message      = "\r\n" . "Hello " . $buyer_name . ", " . "\r\n" . "\r\n";
                                $message      .= "We would like to inform you that, " .$seller_name . " Allows you to download a note. Please login and see My Download tabs to download " . $db_Title . " note." . "\r\n" . "\r\n";
                                $message      .= "Regards, " . "\r\n" . "Notes Marketplace";

                                $body =  "";
                                $body .= "Email From: " . $from . "\r\n";
                                $body .= "Email To: " . $to . "\r\n";
                                $body .= "Subject: " . $subject . "\r\n";
                                $body .= "Body: " . "\r\n" . $message;

                                if(mail($to,$subject,$body))
                                {
                                    echo "<script type='text/javascript'>alert('Thank you.'); history.go(-1);</script>";
                                }else{
                                    echo "<script type='text/javascript'>alert('Please Try Again.') history.go(-1);</script>";
                                }
                                
                            }
                            
                        }
                            
                        $i++; 
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