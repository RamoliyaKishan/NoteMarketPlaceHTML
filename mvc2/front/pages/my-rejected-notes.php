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
	<link rel="stylesheet" href="../css/my-rejected-notes.css">

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
	
	 <!-- My rejected Notes table -->
    <div class="notes-table">
		<div class="content-box-lg">
			<div class="container">
        		
        		<div class="row">
					<div class="col-md-6 col-sm-12">
						<h2 class="heading rejected-notes-heading">My Rejected Notes</h2>
					</div>
					<div class="col-md-6 col-sm-12 search-content">	
						<span toggle="#search" class="fa fa-search field-icon"></span>
						<input class="myInput" placeholder="Search" type="search" id="rejected-notes-search" value="">
						<a class="btn" href="" role="button" id="rejected-notes-search-btn">search</a>
					</div>
				</div>
				
				<!-- data table -->
				<table id="my-rejected-notes-table" class="datatable table table-responsive-md display">
                    <thead>
                        <tr>
                        	<th>SR No.</th>
                            <th>NOte Title</th>
                            <th>Category</th>
                            <th>Remark</th>
                            <th>clone</th>
                            <th></th>
                        </tr>
                    </thead>
        
                    <tbody>
                      
                        <?php 
                        
                            $i = 1;

                            $query = "SELECT * FROM seller_notes WHERE SellerID = '{$user_id}' AND Status = 'Rejected'";

                            $select_notes_query = mysqli_query($connection, $query);

                            if (!$select_notes_query) {
                                die("QUERY FAILED" . mysqli_error($connection));
                            }
                            while($row = mysqli_fetch_assoc($select_notes_query )) {
                                        
                                $db_NoteID = $row['NoteID'];
                                $db_Title = $row['Title'];
                                $db_Category = $row['Category'];
                                $db_Remark= $row['AdminRemarks'];
                                
                                $query = "SELECT CategoryName FROM note_categories WHERE CategoryID = '{$db_Category}' ";
                                $cat_name = mysqli_query($connection, $query);

                                $row = mysqli_fetch_array($cat_name);

                                $db_CategoryName = $row['CategoryName'];
                                
                                
                            
                            echo "<tr>";
                            echo "<td>{$i}</td>";  
                            echo "<td><a style='text-decoration:none; color:#6255a5' href='note-details.php?NoteID={$db_NoteID}'>{$db_Title}<a></td>";  
                            echo "<td>{$db_CategoryName}</td>";  
                            echo "<td>{$db_Remark}</td>";  
                            echo "<td><a style='text-decoration:none; color:#6255a5' onClick=\"javascript: return confirm('Do you want to add $db_Title Note agin with changes??');\" href='add-notes.php?clone={$db_NoteID}'>Clone<a></td>"; 
                            echo "<td>
                                <span class='action-icons'>
                                    
                                    <div class='dropleft dropdown'>
										<a href='#' role='button'' id='downloads-notes-menu' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
											<img src='../images/Front_images/dots.png' alt='dots-icon' class='dots-icon'>
										</a>
									
										<div class='dropdown-menu' aria-labelledby='downloads-notes-menu' >
    										<a class='dropdown-item' href='?d_id={$db_NoteID}'>Download Notes</a>
										</div>
									</div>
                                    
                                </span>
                                
                                </td>";
                               
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
                        ?>
                       
                    </tbody>
                </table>
				
			</div>
		</div>
	</div>
	<!-- My rejected Notes table  Ends-->
	
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