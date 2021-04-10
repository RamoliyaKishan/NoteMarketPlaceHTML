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
	<link rel="stylesheet" href="../css/notes-under-review.css">

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

				<div class="row notes-under-review-heading">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<h2 class="heading">Notes Under Review</h2>
					</div>
				</div>

				<div class="row notes-under-review-heading">
					<div class="col-md-6 col-sm-6">
						<span>Seller</span><br>
						<select class="myInput common filter" id="seller-filter" name="seller">
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
					<div class="col-md-6 col-sm-6 search-content">
						<span toggle="#search" class="fa fa-search field-icon"></span>
						<input class="myInput" placeholder="Search" type="search" id="search" value="">
						<a class="btn" href="" role="button" id="notes-under-review-search-btn">search</a>
					</div>
				</div>

				<!-- data table -->
				<table id="notes-under-review-table" class="datatable table table-responsive display">
                    <thead>
                        <tr>
                        	<th>SR No.</th>
                            <th>NOte Title</th>
                            <th>Category</th>
                            <th>Seller</th>
                            <th></th>
                            <th>Date Added</th>
                            <th>Status</th>
                            <th class="dt-center">action</th>
                            <th></th>
                        </tr>
                    </thead>
        
                    <tbody>
                        
                        <?php
                            
                            $i=1;
                            
                            $query = "SELECT * FROM seller_notes WHERE (Status = 'Submited for Review' OR Status = 'In Review')";
                            
                            if(isset($_GET['u_ID'])){
                                $query .= " AND SellerID = {$_GET['u_ID']}";
                            }
                            $query .= " ORDER BY CreatedDate ASC";
                            $select_all_notes_query = mysqli_query($connection, $query);

                            while($row = mysqli_fetch_assoc($select_all_notes_query )) {
                                
                                $db_NoteID = $row['NoteID'];
                                $db_SellerID = $row['SellerID'];
                                $db_CreatedDate = $row['CreatedDate'];
                                $db_CreatedDate = date('d-m-Y, h:m:s',strtotime($db_CreatedDate));
                                $db_Note = $row['Note'];
                                $db_Title = $row['Title'];
                                $db_Category = $row['Category'];
                                $db_Status= $row['Status'];
                                
                                $query = "SELECT CategoryName FROM note_categories WHERE CategoryID = '{$db_Category}' ";
                                $cat_name = mysqli_query($connection, $query);
                                $row = mysqli_fetch_array($cat_name);
                                $db_CategoryName = $row['CategoryName'];
                                
                                $query = "SELECT FirstName, LastName FROM users WHERE UsersID = '{$db_SellerID}' ";
                                $seller_name = mysqli_query($connection, $query);
                                $row = mysqli_fetch_array($seller_name);
                                $db_SellerName = $row['FirstName'];
                                $db_SellerName .= " ". $row['LastName'];

                                echo "<tr>";
                                echo "<td>{$i}</td>";  
                                echo "<td><a style='text-decoration:none; color:#6255a5' href='note-details.php?NoteID={$db_NoteID}'>{$db_Title}<a></td>";
                                echo "<td>{$db_CategoryName}</td>";
                                echo "<td>{$db_SellerName} </td>";
                                echo "<td><a href = 'member-details.php?u_id=$db_SellerID'><img src='../images/Admin_images/eye.png' class='eye' alt='See Seller'></a></td>";
                                echo "<td>{$db_CreatedDate}</td>";
                                echo "<td>{$db_Status}</td>";
                                echo "<td>
                                        <a class='btn tab-btn' onClick=\"javascript: return confirm('Are you sure to Approve $db_Title Note ??');\" href='?a_id=$db_NoteID' role='button' id='aprove-btn'>Approve</a>
                                        
                                        <a class='btn tab-btn reject-btn' rejected_noteid='{$db_NoteID}' rejected_notename='{$db_Title}' rejected_notecategory='{$db_CategoryName}' role='button' id='reject-btn'>Reject</a>
                                        
                                        <a class='btn tab-btn' onClick=\"javascript: return confirm('Are you sure to add $db_Title Note for InReview ??');\" href='?ir_id=$db_NoteID' role='button' id='inReview-btn'>inReview</a>
                                    </td>";
                                
                                echo "<td>
                                    <span class='action-icons'>
                                        <div class='dropleft dropdown'>
                                            <a href='#' role='button'' id='downloads-notes-menu' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                <img src='../images/Admin_images/dots.png' alt='dots-icon' class='dots-icon'>
                                            </a>

                                            <div class='dropdown-menu' aria-labelledby='downloads-notes-menu'>
                                            
                                                <a class='dropdown-item rating' href='note-details.php?NoteID={$db_NoteID}'>View More Details</a>
                                                
                                                <a class='dropdown-item' href='?d_id={$db_NoteID}'>download Notes</a>
                                                
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
                                            <input type="submit" class="btn modal_btn" name="reject" id="reject" value="reject">

                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                            
                        <?php  
                         
                            echo "</tr>";
                            $i++;
                        }
                       
                          
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
                                            window.location.href='notes-under-review.php';
                                        </script>";

                                }else {

                                    $query = "UPDATE seller_notes SET Status='Published', ActionedBy = '{$user_id}', PublishedDate = now(), ModifiedDate = now(), ModifiedBy = '$user_id', IsActive = '1' WHERE NoteID = '$NoteID'";
                                    $update_status_query = mysqli_query($connection, $query);

                                    echo "<script type='text/javascript'>
                                            alert('Thank you for Published $db_Title Note.');
                                            window.location.href='notes-under-review.php';
                                        </script>";
                                }

                            }
                            
                            if(isset($_GET['ir_id'])){

                                $NoteID = $_GET['ir_id'];

                                $query = "SELECT Status From seller_notes WHERE Status='In Review' AND NoteID = '$NoteID'";
                                $update_status_query = mysqli_query($connection, $query);
                                $count = mysqli_num_rows($update_status_query);

                                if($count > 0){
                                    echo "<script type='text/javascript'>
                                            alert('This $db_Title Note is already In Review process');
                                            window.location.href='notes-under-review.php';
                                        </script>";

                                }else {

                                    $query = "UPDATE seller_notes SET Status='In Review', ActionedBy = '{$user_id}', ModifiedDate = now(), ModifiedBy = '$user_id' WHERE NoteID = '$NoteID'";
                                    $update_status_query = mysqli_query($connection, $query);

                                    echo "<script type='text/javascript'>
                                            alert('Thank you for add $db_Title Note under IN Review.');
                                            window.location.href='notes-under-review.php';
                                        </script>";
                                }

                            }
                                
                            if(isset($_POST['reject'])){
                                $remark = escape($_POST['remark']);
                                $noteId = escape($_POST['Reject_model_noteid']);  

                                $query = "SELECT * FROM  seller_notes WHERE NoteID = '{$noteId}' AND Status = 'Rejected'";

                                $check_request = mysqli_query($connection, $query); 

                                if(!$check_request){
                                    echo mysqli_error($connection);
                                }

                                if(mysqli_num_rows($check_request) <= 0) {

                                    $query = "UPDATE seller_notes SET Status = 'Rejected', ActionedBy = '{$user_id}', AdminRemarks = '{$remark}', ModifiedDate = now(), ModifiedBy = '{$user_id}', IsActive = '0' WHERE NoteID = '{$noteId}'";

                                    $reject_query = mysqli_query($connection, $query);    
                                    if(!$reject_query){
                                        echo "error" . mysqli_error($connection);
                                    }else {
                                        redirect($_SERVER['PHP_SELF']);
                                    }

                                }else{
                                    echo "<script type='text/javascript'>alert('This note is already Rejected!!');</script>";
                                }
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

	<!-- Manage Administrator Ends -->

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
            search_filter_notes = $('#notes-under-review-table').DataTable({
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
            $('.common').on('change', function(){
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
                
                var r = confirm('Are you sure you want to reject seller request?');
                if(r == true){
                    $('#RejectModal').modal().show();
                }
            });
        });
        

    </script>


</body></html>