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
	<link rel="stylesheet" href="../css/my-downloads.css">

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
	
	 <!-- My Downloads table -->
    <div class="notes-table">
		<div class="content-box-lg">
			<div class="container">
        		
        		<div class="row">
					<div class="col-md-6 col-sm-12">
						<h2 class="heading downloads-heading">My Downloads</h2>
					</div>
					<div class="col-md-6 col-sm-12 search-content">	
						<span toggle="#downloads-search" class="fa fa-search field-icon"></span>
						<input class="myInput" placeholder="Search" type="search" id="downloads-search" value="">
						<a class="btn" href="" role="button" id="downloads-search-btn">search</a>
					</div>
				</div>
				
				<!-- data table -->
				<table id="my-downloads-table" class="datatable table table-responsive display">
                    <thead>
                        <tr>
                        	<th style="width: 100px;">SR No.</th>
                            <th style="width: 301px;">Note Title</th>
                            <th style="width: 130px;">Category</th>
                            <th style="width: 260px;">Buyer</th>
                            <th style="width: 130px;">Sell Type</th>
                            <th style="width: 130px;">price</th>
                            <th style="width: 250px !important;">Downloaded Date/Time</th>
                            <th style="width: 120px;"></th>
                        </tr>
                    </thead>
        
                    <tbody>
                      
                        <?php 
                        
                        $i = 1;
                        
                        $query = "SELECT * FROM downloads WHERE DownloaderID = '{$user_id}' AND (IsSellerHasAllowedDownload = '1' OR IsPaid = '0')";
                                    
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
                            $db_IsAttachmentDownloaded = $row['IsAttachmentDownloaded'];
                            $db_Title = $row['NoteTitle'];
                            $db_Category = $row['NoteCategory'];
                            $db_IsPaid = $row['IsPaid'];
                            $db_Price= $row['PurchasedPrice'];
                            $db_ModifiedDate = $row['ModifiedDate'];

                            if($db_IsPaid == '1') {
                                $db_IsPaid = 'Paid';
                            }else {
                                $db_IsPaid = 'free';
                            }

                            $query = "SELECT FirstName, EmailID FROM users WHERE UsersID = '{$db_DownloaderID}' ";
                            $buyer_detail = mysqli_query($connection, $query);

                            $row = mysqli_fetch_array($buyer_detail);
                            $buyer_email = $row['EmailID'];
                            $buyer_name = $row['FirstName'];
                            
                            $query = "SELECT FirstName FROM users WHERE UsersID = '{$db_SellerID}' ";
                            $seller_detail = mysqli_query($connection, $query);
                            $row = mysqli_fetch_array($seller_detail);
                            $seller_name = $row['FirstName'];
                                
                            
                        echo "<tr>";
                        echo "<td>{$i}</td>";  
                        echo "<td>{$db_Title}</td>";  
                        echo "<td>{$db_Category}</td>";  
                        echo "<td>{$buyer_email}</td>";
                        echo "<td>{$db_IsPaid}</td>";
                        echo "<td>$ {$db_Price}</td>";
                        echo "<td>{$db_ModifiedDate}</td>";
                        echo "<td>
                                <span class='action-icons'>
                                    <a href='note-details.php?NoteID={$db_NoteID}'><img src='../images/Front_images/eye.png' alt='view' class='view-icon'></a>
                                    
                                    <div class='dropleft dropdown'>
										<a href='#' role='button'' id='downloads-notes-menu' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
											<img src='../images/Front_images/dots.png' alt='dots-icon' class='dots-icon'>
										</a>
									
										<div class='dropdown-menu' aria-labelledby='downloads-notes-menu' >
                                            <a class='dropdown-item' href='?d_id={$db_DownloadID}'>download Notes</a>
    										<a class='dropdown-item rating' rating_noteid={$db_NoteID} data-toggle='modal' data-target='#ReviewModal'>add reviews/Feedback</a>
    										<a class='dropdown-item report' onClick=\"javascript: return confirm('Are you sure to report as inappropriate for $db_Title Note');\" report_noteid={$db_NoteID} data-toggle='modal' data-target='#ReportModal'>report as inappropriate</a>
										</div>
									</div>
                                    
                                </span>
                                
                            </td>";
                        ?>
                        <!-- Review Modal -->
                        <div class="modal fade" id="ReviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <a href="" role="button" id="close-btn" data-toggle="modal" data-target="#ReviewModal">
                                            <img src="../images/Front_images/close.png" alt="heading image" class="close-icon" title="close" />
                                        </a>
                                        <h2 class="'text-left">Add Review</h2>
                                    </div>
                                    <div class="modal-body">

                                        <form id="ReviewForm" method="POST">
                                        <div id="star-rating">
                                            <input type="hidden" Id="Review_model_noteid" name="Review_model_noteid">
                                            <input id="star-5" type="radio" name="rating" value="5" />
                                            <label for="star-5" title="5 stars">
                                                <i class="active fa fa-star" aria-hidden="true"></i>
                                            </label>
                                            <input id="star-4" type="radio" name="rating" value="4" />
                                            <label for="star-4" title="4 stars">
                                                <i class="active fa fa-star" aria-hidden="true"></i>
                                            </label>
                                            <input id="star-3" type="radio" name="rating" value="3" />
                                            <label for="star-3" title="3 stars">
                                                <i class="active fa fa-star" aria-hidden="true"></i>
                                            </label>
                                            <input id="star-2" type="radio" name="rating" value="2" />
                                            <label for="star-2" title="2 stars">
                                                <i class="active fa fa-star" aria-hidden="true"></i>
                                            </label>
                                            <input id="star-1" type="radio" name="rating" value="1" required />
                                            <label for="star-1" title="1 star">
                                                <i class="active fa fa-star" aria-hidden="true"></i>
                                            </label>
                                        </div>                        
                                        <span>Comments *</span>
                                        <textarea class="myInput" name="comment" id="comment" placeholder="Commments..." value="" required></textarea>
                                        <input type="submit" class="btn" name="give_review" id="give_review" value="submit">

                                    </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!--  Report Modal -->
                        <div class="modal fade" id="ReportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <a href="" role="button" id="close-btn" data-toggle="modal" data-target="#ReportModal">
                                            <img src="../images/Front_images/close.png" alt="heading image" class="close-icon" title="close" />
                                        </a>
                                        <h2 class="'text-left">Report Issue</h2>
                                    </div>
                                    <div class="modal-body">

                                        <form id="ReportForm" method="POST">
                                            
                                            <input type="hidden" Id="Report_model_noteid" name="Report_model_noteid">
                                            
                                            <span>Remarks *</span>
                                            <textarea class="myInput" name="remark" id="remark" placeholder="Remarks..." value="" required></textarea>
                                            
                                            <input type="submit" class="btn" name="add_report" id="add_report" value="submit">

                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <?php
                               
                        echo "</tr>";
                            
                            $i++; 
                            }
                        ?>
                        
                        
                      
                        <?php
                            
                            if(isset($_GET['d_id'])){
                                    
                                $query = "SELECT Note FROM seller_notes WHERE NoteID = '{$db_NoteID}' ";
                                $select_note_query = mysqli_query($connection, $query);    
                                $row = mysqli_fetch_array($select_note_query);
                                $db_Note = $row['Note'];
                                    
                                $fileName  = basename($db_Note);
                                $filePath  = "../uploaded files/". $fileName;
                                
                                if(!empty($fileName) && file_exists($filePath)){
                                                
                                    echo "<script type='text/javascript'>alert('Thank you for download');</script>";
                                            
                                    //define header
                                    header("Cache-Control: public");
                                    header("Content-Description: File Transfer");
                                    header("Content-Disposition: attachment; filename=$fileName");
                                    header("Content-Type: application/zip");
                                    header("Content-Transfer-Encoding: binary");

                                    //read file 
                                    readfile($filePath);
                                    exit;
                                    
                                    
                                    
                                }else{
                                    echo "<script type='text/javascript'>alert('This file does not exist');</script>";
                                }
                                
                            }
                            
                            if(isset($_POST['add_report'])){
                                
                                $remark = escape($_POST['remark']);
                                $noteId = escape($_POST['Report_model_noteid']);  
                                    
                                $query = "SELECT NoteID, ReportedBYID FROM  seller_notes_reported_issues WHERE NoteID = '{$noteId}' AND ReportedBYID = '{$user_id}'";
                                    
                                $check_request = mysqli_query($connection, $query); 
                                
                                if(!$check_request){
                                    echo mysqli_error($connection);
                                }
                                    
                                if(mysqli_num_rows($check_request) <= 0) {
                                        
                                    $query = "INSERT INTO seller_notes_reported_issues (NoteID, ReportedBYID, DownloadID, Remarks, CreatedDate, CreatedBy) VALUES('{$noteId}', '{$user_id}', '{$db_DownloadID}', '{$remark}',now(), '{$user_id}')";

                                    $insert_reported_issues_query = mysqli_query($connection, $query);    
                                    if($insert_reported_issues_query){
                                        
                                        $query = "SELECT Value FROM system_configuration WHERE Key = 'AdminEmail' ";
                                        $admin_detail = mysqli_query($connection, $query);
                                        $row = mysqli_fetch_array($admin_detail);
                                        $admin_email = $row['Value'];
                                        
                                        $to = $admin_email;
                                        $from = "notemarketplace00@gmail.com";

                                        $subject    = $buyer_name . " Reported an issue for" . $db_Title;

                                        $message      = "\r\n" . "Hello Admins, " . "\r\n" . "\r\n";
                                        $message      .= "We want to inform you that, ".$buyer_name." Reported an issue for ".$seller_name."’s Note with title ".$db_Title.". Please look at the notes and take required actions.". "\r\n" . "\r\n";
                                        $message      .= "Regards, " . "\r\n" . "Notes Marketplace";

                                        $body =  "";
                                        $body .= "Email From: " . $buyer_email . "\r\n";
                                        $body .= "Email To: " . $to . "\r\n";
                                        $body .= "Subject: " . $subject . "\r\n";
                                        $body .= "Body: " . "\r\n" . $message;

                                        if(mail($to,$subject,$body))
                                        {
                                            echo "<script type='text/javascript'>alert('Thank you.');</script>";
                                        }else{
                                            echo "<script type='text/javascript'>alert('Please Try Again.');</script>";
                                        }
                                    }else{
                                        echo "error" . mysqli_error($connection);
                                    }
                                    
                                }else{
                                    echo "<script type='text/javascript'>alert('You have already reported issue for this note');</script>";
                                }
                                
                            }
                            
                            if(isset($_POST['give_review'])){
                                    
                                echo $rating = escape($_POST['rating']);
                                echo $comment = escape($_POST['comment']);
                                echo $noteId = escape($_POST['Review_model_noteid']);                                
                                
                                $query = "SELECT NoteID, ReviewedByID FROM  seller_notes_reviews WHERE NoteID = '{$noteId}' AND ReviewedByID = '{$user_id}'";
                                    
                                $check_request = mysqli_query($connection, $query);    
                                    
                                if(mysqli_num_rows($check_request) <= 0) {
                                        
                                    $query = "INSERT INTO seller_notes_reviews (NoteID, ReviewedByID , DownloadID, Ratings, Comments, CreatedDate, CreatedBy) VALUES('{$noteId}', '{$user_id}', '{$db_DownloadID}', '{$rating}', '{$comment}',now(), '{$user_id}')";

                                    $insert_review_query = mysqli_query($connection, $query);    
                                    if($insert_review_query){ 
                                        echo "<script type='text/javascript'>alert('Thanks for giving your valuable review!!');</script>";
                                    }else{
                                        echo "error" . mysqli_error($connection);
                                    }
                                    
                                }else{
                                    echo "<script type='text/javascript'>alert('You have already given a review for this note');</script>";
                                }
                            }
                            
                        ?>
                       
                        
                        
                    </tbody>
                </table>
				
			</div>
		</div>
	</div>
	<!-- My Downloads table  Ends-->
	
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
	
	<script>
        
        $(".rating").click(function(){
            var note_id = $(this).attr("rating_noteid");
            // alert(note_id);
            $("#ReviewForm").trigger('reset');
            $('#Review_model_noteid').val(note_id);
            
        });
        
        $(".report").click(function(){
            var note_id = $(this).attr("report_noteid");
            // alert(note_id);
            $("#ReportForm").trigger('reset');
            $('#Report_model_noteid').val(note_id);
            
        });
        
    </script>

</body>

</html>