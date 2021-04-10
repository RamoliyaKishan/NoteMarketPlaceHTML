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
	<link rel="stylesheet" href="../css/member-details.css">

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
	
	
	<section id="note-details">

		<div class="container">

			<h2 class="heading">Member Details</h2>
            
            <?php
                $u_id = "";
                
                if(isset($_GET['u_id'])) {
                    $u_id .= $_GET['u_id'];
                    
                    $query = "SELECT * FROM users WHERE UsersID = '{$u_id}'";
                    $select_users_query = mysqli_query($connection, $query);
                    if (!$select_users_query) {
                        die("QUERY FAILED" . mysqli_error($connection));
                    }
                    
                    while($row = mysqli_fetch_assoc($select_users_query)) {
                          
                        $db_UsersID = $row['UsersID'];
                        $db_FirstName = $row['FirstName'];
                        $db_LastName = $row['LastName'];
                        $db_EmailID = $row['EmailID'];
                        $db_CreatedDate = $row['CreatedDate'];
                        $db_CreatedDate = date('d-m-Y, h-m-s',strtotime($db_CreatedDate));
                        
                        $query = "SELECT * FROM user_profile WHERE UsersID = '{$u_id}'";
                        $select_userprofile_query = mysqli_query($connection, $query);
                        
                        $count = mysqli_num_rows($select_userprofile_query);
                        if($count > 0) {
                            
                            $row = mysqli_fetch_assoc($select_userprofile_query);
                            
                            $db_DOB = $row['DOB'];
                            $db_DOB = date('d-m-Y',strtotime($db_DOB));
                            $db_ProfilePicture = $row['ProfilePicture'];
                            $db_PhoneNumber = $row['PhoneNumber'];
                            $db_Collage = $row['Collage'];
                            $db_Address1 = $row['Address1'];
                            $db_Address2 = $row['Address2'];
                            $db_City = $row['City'];
                            $db_State = $row['State'];
                            $db_Country = $row['Country'];
                            $db_ZipCode = $row['ZipCode'];
                        
                        }else {
                            $db_DOB = " - ";
                            $db_ProfilePicture = "";
                            $db_PhoneNumber = " - ";
                            $db_Collage = " - ";
                            $db_Address1 = " - ";
                            $db_Address2 = " - ";
                            $db_City = " - ";
                            $db_State = " - ";
                            $db_Country = " - ";
                            $db_ZipCode = " - ";
                        }
                        
                    }
                    
                }
            ?>
            
			<div class="row">

				<div class="col-lg-2 col-md-3 col-sm-4" id="left-side">
					<div id="left">
					    
						<div id="user-front">
						    <img src="<?php echo ($db_ProfilePicture == "") ? "../images/Admin_images/default_profile.png" : "../../front/profile pictures/$db_ProfilePicture" ?>" alt="user image" class="profile-img">
						</div>
					</div>
				</div>
				
				<div class="col-lg-5 col-md-9 col-sm-12 details" id="left-side">

				    <table>
						<tr>
							<td class="col-md-6 col-sm-6">First Name:</td>
							<td class="col-md-6 col-sm-6"><?php echo $db_FirstName; ?></td>
						</tr>
							
						<tr>
							<td class="col-md-6 col-sm-6">Last Name:</td>
							<td class="col-md-6 col-sm-6"><?php echo $db_LastName; ?></td>
						</tr>
						<tr>	
							<td class="col-md-6 col-sm-6">Email:</td>
							<td class="col-md-6 col-sm-6"><?php echo $db_EmailID; ?></td>
						</tr>
						<tr>	
							<td class="col-md-6 col-sm-6">DOB:</td>
							<td class="col-md-6 col-sm-6"><?php echo $db_DOB; ?></td>
				        </tr>
						<tr>	
							<td class="col-md-6 col-sm-6">Phone Number:</td>
							<td class="col-md-6 col-sm-6"><?php echo $db_PhoneNumber; ?></td>
						</tr>
						<tr>
							<td class="col-md-6 col-sm-6">Collage/University:</td>
							<td class="col-md-6 col-sm-6"><?php echo $db_Collage; ?></td>
						</tr>
				    </table>
						
				</div>
				
				<div class="col-lg-5 col-md-12 col-sm-12 details" id="right-side">

				    <table>
						<tr>
							<td class="col-md-6 col-sm-6">Address 1:</td>
							<td class="col-md-6 col-sm-6"><?php echo $db_Address1; ?></td>
						</tr>
							
						<tr>
							<td class="col-md-6 col-sm-6">Address 2:</td>
							<td class="col-md-6 col-sm-6"><?php echo $db_Address2; ?></td>
						</tr>
						<tr>	
							<td class="col-md-6 col-sm-6">City:</td>
							<td class="col-md-6 col-sm-6"><?php echo $db_City; ?></td>
						</tr>
						<tr>	
							<td class="col-md-6 col-sm-6">State:</td>
							<td class="col-md-6 col-sm-6"><?php echo $db_State; ?></td>
							</tr>
						<tr>	
							<td class="col-md-6 col-sm-6">Country:</td>
							<td class="col-md-6 col-sm-6"><?php echo $db_Country; ?></td>
						</tr>
						<tr>
							<td class="col-md-6 col-sm-6">Zip Code:</td>
							<td class="col-md-6 col-sm-6"><?php echo $db_ZipCode; ?></td>
						</tr>
				    </table>
						
					</div>
					
			</div>
			
			<hr>
			
			<div class="row notes-heading">
				<h3 class="heading">Notes</h3>
			</div>
			
			<!-- data table -->
				<table id="notes-table" class="datatable table table-responsive-md display">
                    <thead>
                        <tr>
                        	<th>SR No.</th>
                            <th>NOte Title</th>
                            <th>Category</th>
                            <th>status</th>
                            <th>download notes</th>
                            <th>total earning</th>
                            <th>date addes</th>
                            <th>Published Date</th>                            
                            <th></th>
                        </tr>
                    </thead>
        
                    <tbody>
                        
                        <?php
                            
                            $i = 1;
                            $query = "SELECT * FROM seller_notes WHERE SellerID = '{$u_id}' AND IsActive = '1' ORDER BY CreatedDate DESC";
                            $select_notes_query = mysqli_query($connection, $query);
                            if (!$select_notes_query) {
                                die("QUERY FAILED" . mysqli_error($connection));
                            }
                            
                            $notes_count = mysqli_num_rows($select_notes_query);

                            while($row = mysqli_fetch_assoc($select_notes_query )) {
                                
                                $db_NoteID = $row['NoteID'];
                                $db_PublishedDate = $row['PublishedDate'];
                                $db_PublishedDate = date('d-m-Y, h:m:s',strtotime($db_PublishedDate));
                                $db_CreatedDate = $row['CreatedDate'];
                                $db_CreatedDate = date('d-m-Y, h:m:s',strtotime($db_CreatedDate));
                                $db_Status = $row['Status'];
                                $db_Title = $row['Title'];
                                $db_Category = $row['Category'];
                                $db_Note = $row['Note'];
                                $db_SellingPrice= $row['SellingPrice'];
                                
                                $query = "SELECT CategoryName FROM note_categories WHERE CategoryID = '{$db_Category}' ";
                                $cat_name = mysqli_query($connection, $query);
                                $row = mysqli_fetch_array($cat_name);
                                $db_CategoryName = $row['CategoryName'];
                                
                                
                                $query = "SELECT * FROM downloads WHERE SellerID = '{$u_id}' AND IsSellerHasAllowedDownload = '1'";
                                $notes_query = mysqli_query($connection, $query);
                                $earnings = 0;
                                while($row = mysqli_fetch_array($notes_query)){
                                    $earnings += $row['PurchasedPrice'];
                                }
                                
                                $query = "SELECT * FROM downloads WHERE DownloaderID = '{$u_id}' AND IsSellerHasAllowedDownload = '1'";
                                $download_notes_query = mysqli_query($connection, $query);
                                $db_num_of_downloads = mysqli_num_rows($download_notes_query);
                                
                                echo "<tr>";
                                echo "<td>{$i}</td>";  
                                echo "<td><a style='text-decoration:none; color:#6255a5' href='note-details.php?NoteID={$db_NoteID}'>{$db_Title}<a></td>";  
                                echo "<td>{$db_CategoryName}</td>"; 
                                echo "<td>{$db_Status}</td>"; 
                                echo "<td><a style='text-decoration:none; color:#6255a5' href='downloads.php?NoteID={$db_NoteID}'>{$db_num_of_downloads}<a></td>";
                                echo "<td>$ {$earnings}</td>";
                                echo "<td>{$db_CreatedDate}</td>";
                                echo "<td>{$db_PublishedDate}</td>";
                               
                                echo "<td>
                                    <span class='action-icons'>
                                        <div class='dropleft dropdown'>
                                            <a href='#' role='button'' id='downloads-notes-menu' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                <img src='../images/Admin_images/dots.png' alt='dots-icon' class='dots-icon'>
                                            </a>

                                            <div class='dropdown-menu' aria-labelledby='downloads-notes-menu'>
                                                
                                                <a class='dropdown-item' href='?d_id={$db_NoteID}'>download Notes</a
                                                
                                            </div>
                                        </div>

                                    </span>

                                </td>";
                                
                                echo "</tr>";
                                $i++;
                                
                            }
                            
                            if(isset($_GET['d_id'])){
                                noteDownload($_GET['d_id']);
                            }
                        ?>
                        
                    </tbody>
                </table>
			
			
			
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
	
	<script>
        $(function(){
            
            // In progress notes table
            search_member = $('#notes-table').DataTable({
                "bLengthChange": false, // this gives option for changing the number of records shown in the UI table
                "lengthMenu": [5], 
                "dom": "lrtp" 
            });
            
        });
        
    </script>

</body>

</html>