<?php ob_start(); ?>
<?php session_start(); ?>
<?php  include "includes/db.php"; ?>
<?php  include "includes/functions.php"; ?>

<?php 
if(isset($_SESSION['UsersID'])) {
    $user_id = $_SESSION['UsersID'];
}else {
    redirect("../../front/pages/login.php");
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
	<link rel="stylesheet" href="../css/dashboard.css">

</head>

<body>
	
	<!-- Header -->
	<?php
	    if(isset($_SESSION['UsersID'])) {
            include "includes/login_nav.php"; 
        }
    ?>
    <!-- Header Ends -->
	
	<!-- DashBoard -->
	<div id="dashboard">

		<div class="content-box-lg">

			<div class="container">
				
				<!-- DashBoard Heading-->
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<h2 class="heading dashboard-heading">Dashboard</h2>
					</div>
				</div>
				<!-- DashBoard Heading end-->
				
				<!-- Notes States -->
				<div class="row" id="stats">
                    
                    <div class="col-md-4 col-sm-4 col-12 text-center">
                        <div class="stat-item stats-text">
                            <div>
                                <?php
                                    $query = "SELECT * FROM seller_notes WHERE (Status = 'Submited for Review' OR Status = 'In Review')";
                                
                                    $select_all_notes_query = mysqli_query($connection, $query);
                                    $notes_count = mysqli_num_rows($select_all_notes_query);
                                ?>
                                <h4><a style='text-decoration:none; color:#6255a5' href="notes-under-review.php"><?php echo $notes_count; ?></a></h4>
                                <h6>Number of Notes in Review for Publish</h6>
                            </div>
                        </div>  
                    </div>

                    <div class="col-md-4 col-sm-4 col-12 text-center">
                        <div class="stat-item stats-text">
                            <div>
                                <?php
                                    $query = "SELECT *  FROM downloads AS d INNER JOIN seller_notes AS sn ON d.NoteID = sn.NoteID WHERE IsSellerHasAllowedDownload = '1' AND AttachmentDownloadedDate >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)";
                                
                                    $select_all_notes_query = mysqli_query($connection, $query);
                                    $notes_count = mysqli_num_rows($select_all_notes_query);
                                ?>
                                <h4><a style='text-decoration:none; color:#6255a5' href="downloads.php"><?php echo $notes_count; ?></a></h4>
                                <h6>Number of New Notes Downloades <br>(Last 7 days)</h6>
                            </div>
                        </div>  
                    </div>

                    <div class="col-md-4 col-sm-4 col-12 text-center">
                        <div class="stat-item stats-text">
                            <div>
                                <?php
                                    $query = "SELECT * FROM users WHERE RoleID = '1' AND IsActive = '1' AND CreatedDate >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)";
                                
                                    $select_all_notes_query = mysqli_query($connection, $query);
                                    $notes_count = mysqli_num_rows($select_all_notes_query);
                                ?>
                                <h4><a style='text-decoration:none; color:#6255a5' href="members.php"><?php echo $notes_count; ?></a></h4>
                                <h6>Number of New Registrations <br>(Last 7 days)</h6>
                            </div>
                        </div>  
                    </div>
                </div>
                <!-- Notes States End-->
                
			</div>

		</div>

	</div>
	<!-- DashBoard Ends -->	
	
	 <!-- My Sold Notes table -->
    <div class="notes-table">
		<div class="content-box-lg">
			<div class="container">
        
        		<div class="row dashboard-published-notes-heading">
					<div class="col-lg-4 col-md-4 col-sm-12 search-filter">
						<h3 class="heading">Published Notes</h3>
					</div>
					<div class="col-lg-8 col-md-8 col-sm-12 search-content">
                        <span toggle="#search" class="fa fa-search field-icon"></span>
                        <input class="myInput" placeholder="Search" type="search" id="search" value="">
                        <a class="btn" href="" role="button" id="search-btn">search</a>
                            
						
							<select class="myInput" id="dashboard-published-notes-month">
								<option hidden>Select-Month</option>
								<?php 
                                    $month = date('F');
                                    $month_no = date('m');
                                    $year = date('Y');
                                ?>
								<?php 
                                    for ($i=1; $i<=6 ; $i++) {
                                        $year = ($month_no-1 > 0)?$year:$year-1;
                                        $month_no = (($month_no-1) > 0)?$month_no-1:($month_no-1+12);                                 
                                        $dateObj   = DateTime::createFromFormat('!m', $month_no);
                                        $month = $dateObj->format('F'); 
                                ?>
                                        <option value="<?php echo ($month_no <10 )?'0'.$month_no:$month_no;?>-<?php echo $year;?>"><?php echo $month;?></option>
                                <?php   
                                        
                                    }
                                ?>
<!--
								<option value="01">January</option>
-->
							</select>
					</div>
				</div>
				
				<!-- data table -->
				<table id="dashboard-published-notes-table" class="datatable table-responsive display">
                    <thead>
                        <tr>
                        	<th>SR No.</th>
                            <th>NOte Title</th>
                            <th>Category</th>
                            <th>Attachment size</th>
                            <th>Sell Type</th>
                            <th>price</th>
                            <th>Publisher</th>
                            <th>Published Date</th>
                            <th>Number of downloads</th>
                            <th></th>
                            
                        </tr>
                    </thead>
        
                    <tbody>
                      
                        <?php
                            
                            $i = 1;
                            
                            $query = "SELECT * FROM seller_notes WHERE Status = 'Published' AND ModifiedDate >= CURDATE() - INTERVAL 6 MONTH ORDER BY PublishedDate DESC";
                        
//                            AND MONTH(ModifiedDate) = MONTH(CURRENT_DATE())

                            $select_all_notes_query = mysqli_query($connection, $query);
                            if (!$select_all_notes_query) {
                                die("QUERY FAILED" . mysqli_error($connection));
                            }

                            $notes_count = mysqli_num_rows($select_all_notes_query);

                            while($row = mysqli_fetch_assoc($select_all_notes_query )) {
                                
                                $db_NoteID = $row['NoteID'];
                                $db_SellerID = $row['SellerID'];
                                $db_PublishedDate = $row['PublishedDate'];
                                $db_PublishedDate = date('d-m-Y, h:m:s',strtotime($db_PublishedDate));
                                $db_Title = $row['Title'];
                                $db_Category = $row['Category'];
                                $db_Note = $row['Note'];
                                $db_IsPaid = $row['IsPaid'];
                                $db_SellingPrice= $row['SellingPrice'];
                                
                                if($db_IsPaid == '1') {
                                    $db_IsPaid = 'Paid';
                                }else {
                                    $db_IsPaid = 'free';
                                }
                                
                                
                                $db_Note= calculateFileSize($db_Note);
                                
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
                                
                                $query = "SELECT * FROM downloads WHERE NoteID = '{$db_NoteID}' AND IsAttachmentDownloaded = '1'";
                                $select_notes_query = mysqli_query($connection, $query);
                                $db_num_of_downloads = mysqli_num_rows($select_notes_query);
                                
                                
                                echo "<tr>";
                                echo "<td>{$i}</td>";  
                                echo "<td><a style='text-decoration:none; color:#6255a5' href='note-details.php?NoteID={$db_NoteID}'>{$db_Title}<a></td>";  
                                echo "<td>{$db_CategoryName}</td>"; 
                                echo "<td>{$db_Note}</td>"; 
                                echo "<td>{$db_IsPaid}</td>";
                                echo "<td>$ {$db_SellingPrice}</td>";
                                echo "<td>{$db_SellerName}</td>";
                                echo "<td>{$db_PublishedDate}</td>";
                                echo "<td><a style='text-decoration:none; color:#6255a5' href='downloads.php?NoteID={$db_NoteID}'>{$db_num_of_downloads}<a></td>";
                                echo "<td>
                                    <span class='action-icons'>
                                        <div class='dropleft dropdown'>
                                            <a href='#' role='button'' id='downloads-notes-menu' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                <img src='../images/Admin_images/dots.png' alt='dots-icon' class='dots-icon'>
                                            </a>

                                            <div class='dropdown-menu' aria-labelledby='downloads-notes-menu'>
                                                <a class='dropdown-item' href='?d_id={$db_NoteID}'>download Notes</a>
                                                
                                                <a class='dropdown-item rating' href='note-details.php?NoteID={$db_NoteID}'>View More Details</a>
                                                
                                                <a class='dropdown-item reject-btn' rejected_noteid='{$db_NoteID}' rejected_notename='{$db_Title}' rejected_notecategory='{$db_CategoryName}'>Unpublish</a>
                                            </div>
                                        </div>

                                    </span>

                                </td>";
                            
                            ?>
                                
                                <!--  Reject Modal -->
                                <div class="modal fade" id="RejectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <a href="" role="button" id="close-btn" data-toggle="modal" data-target="#RejectModal">
                                                    <img src="../images/Admin_images/close.png" alt="heading image" class="close-icon" title="close" />
                                                </a>
                                                <h2 class="text-left" id="modal_bookname"></h2>
                                            </div>
                                            <div class="modal-body">

                                                <form id="RejectForm" method="POST">

                                                    <input type="hidden" Id="Reject_model_noteid" name="Reject_model_noteid">

                                                    <span>Remarks *</span>
                                                    <textarea class="myInput" name="remark" id="remark" placeholder="Remarks..." value="" required></textarea>

                                                    <input type="submit" class="btn modal_btn" data-dismiss="modal" aria-label="Close" name="cancel" id="cancle" value="cancel">
                                                    <input type="submit" class="btn modal_btn" name="reject" id="reject" value="Unpublish">

                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            <?php
                                
                                if(isset($_POST['reject'])){
                                    $remark = escape($_POST['remark']);
                                    $noteId = escape($_POST['Reject_model_noteid']);  

                                    $query = "SELECT * FROM  seller_notes WHERE NoteID = '{$noteId}' AND Status = 'Removed'";

                                    $check_request = mysqli_query($connection, $query); 

                                    if(!$check_request){
                                        echo mysqli_error($connection);
                                    }

                                    if(mysqli_num_rows($check_request) <= 0) {

                                        $query = "UPDATE seller_notes SET Status = 'Removed', ActionedBy = '{$user_id}', AdminRemarks = '{$remark}', ModifiedDate = now(), ModifiedBy = '{$user_id}', IsActive = '0' WHERE NoteID = '{$noteId}'";

                                        $reject_query = mysqli_query($connection, $query);    
                                        if(!$reject_query){
                                            echo "error" . mysqli_error($connection);
                                        }else {
                                            $to = $seller_email;
                                            $from = "notemarketplace00@gmail.com";

                                            $subject    ="Sorry! We need to remove your notes from our portal.";

                                            $message      = "\r\n" . "Hello " . $db_SellerName . ", " . "\r\n" . "\r\n";
                                            $message      .= "We want to inform you that, your note " .$db_Title . " has been removed from the portal.  " . "\r\n" . " Please find our remarks as below -." . "\r\n". $remark . "\r\n" . "\r\n";
                                            $message      .= "Regards, " . "\r\n" . "Notes Marketplace";

                                            $body =  "";
                                            $body .= "Email From: " . $from . "\r\n";
                                            $body .= "Email To: " . $to . "\r\n";
                                            $body .= "Subject: " . $subject . "\r\n";
                                            $body .= "Body: " . "\r\n" . $message;

                                            if(mail($to,$subject,$body))
                                            {
                                                echo "<script type='text/javascript'>return alert('Thank you.');</script>";
                                                redirect($_SERVER['PHP_SELF']);
                                            }else{
                                                echo "<script type='text/javascript'>alert('Please Try Again.');</script>";
                                            }
                                            
                                        }

                                    }else{
                                        echo "<script type='text/javascript'>alert('This note is already Rejected!!');</script>";
                                    }
                                }

                                
                                echo "</tr>";
                                $i++;
                            }
                            
                        ?>
                        <?php
                            
                            if(isset($_GET['d_id'])){
                                
                                noteDownload($_GET['d_id']);
                                
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
    
    <script>
        $(function(){
            
            // In progress notes table
            search_filter_notes = $('#dashboard-published-notes-table').DataTable({
                "bLengthChange": false, // this gives option for changing the number of records shown in the UI table
                "lengthMenu": [5], 
                "dom": "lrtp" 
            });
            // search
            $("#search").on('keyup',function(){
                search_filter_notes.search(this.value).draw();
            });

            // Filter by Month 
            searchSeller();
            function searchSeller() {
                $("#dashboard-published-notes-month").on('change',function(){
//                regExSearch = search_filter_notes.column(7).getMonth();
                search_filter_notes.column(7).search(this.value).draw();
            });
            }
            $('.filter').on('change', function(){
                searchSeller();
            });
            $('.filter').on('select', function(){
                searchSeller();
            });
	       
            
            
            // Handel reject button
            $(".reject-btn").click(function(){
                
                var note_id = $(this).attr("rejected_noteid");
                var note_name = $(this).attr("rejected_notename");
                var note_category = $(this).attr("rejected_notecategory");
                $("#RejectForm").trigger('reset');
                document.getElementById('modal_bookname').innerHTML = note_name + "-" + note_category;
                $('#Reject_model_noteid').val(note_id);
                
                var r = confirm('Are you sure you want to Unpublish this note?');
                if(r == true){
                    $('#RejectModal').modal().show();
                }
                
            });
            
        });
        

    </script>

</body>

</html>