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

	<!-- Custom Css -->
	<link rel="stylesheet" href="../css/note-details.css">

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

			<h3 class="heading">Notes Details</h3>
			
			<?php
                $se_noteid = "";
                if(isset($_GET['NoteID'])) {
                    $se_noteid .= $_GET['NoteID'];
                    $query = "SELECT * FROM seller_notes WHERE NoteID = '{$se_noteid}'";
                                    
                    $select_notes_query = mysqli_query($connection, $query);

                    if (!$select_notes_query) {

                        die("QUERY FAILED" . mysqli_error($connection));

                    }
                    
                    while($row = mysqli_fetch_assoc($select_notes_query)) {
                          
                        $db_NoteID = $row['NoteID'];
                        $db_SellerID = $row['SellerID'];
                        $db_PublishedDate = $row['PublishedDate'];
                        $db_PublishedDate = date('d-m-Y, h:m:s',strtotime($db_PublishedDate));
                        $db_Title = $row['Title'];
                        $db_Category = $row['Category'];
                        $db_DisplayPicture = $row['DisplayPicture'];
                        $db_Note = $row['Note'];
                        $db_NumberOfPages = $row['NumberOfPages'];
                        $db_Description = $row['Description'];
                        $db_UniversityName = $row['UniversityName'];
                        $db_Country = $row['Country'];
                        $db_Course = $row['Course'];
                        $db_CourseCode = $row['CourseCode'];
                        $db_Professor = $row['Professor'];
                        $db_NotesPreview = $row['NotesPreview'];
                        $db_IsPaid = $row['IsPaid'];
                        $db_SellingPrice= $row['SellingPrice'];
                               
                        $query = "SELECT CategoryName FROM note_categories WHERE CategoryID = '{$db_Category}' ";
                        $cat_name = mysqli_query($connection, $query);
                            
                        $row = mysqli_fetch_array($cat_name);
                                        
                        $db_CategoryName = $row['CategoryName'];
                        
                        $query = "SELECT CountryName FROM countries WHERE CountryID = '{$db_Country}' ";
                        $coun_name = mysqli_query($connection, $query);
                                        
                        $row = mysqli_fetch_array($coun_name);
                                    
                        $db_CountryName = $row['CountryName'];
                    }
                    
                    $query = "SELECT * FROM  seller_notes_reported_issues WHERE NoteID = '{$se_noteid}'";    
                    $check_report = mysqli_query($connection, $query);
                    $total_report = mysqli_num_rows($check_report);
                    
                    $query = "SELECT * FROM  seller_notes_reviews WHERE NoteID = '{$se_noteid}'";
                    $check_reviews = mysqli_query($connection, $query);
                    $total_review = mysqli_num_rows($check_reviews);
                    
                    $stars = 0;
                    while($row = mysqli_fetch_array($check_reviews)){
                        $stars += $row['Ratings'];
                    }
                    if(!empty($total_review)){
                        $stars = round($stars/$total_review);
                    }
                }
            ?>

			<div class="row">

				<div class="col-lg-6 col-md-12 col-sm-12" id="left-side">

					<div id="left">
						<div id="book-front">
							<img src="../../front/uploaded files/<?php echo $db_DisplayPicture ?>" alt="">
						</div>
					</div>
					<div id="right">
						<h2 class="heading"><?php echo $db_Title ?></h2>
						<h4 class="heading"><?php echo $db_CategoryName ?></h4>
						<p class="pera"><?php echo $db_Description ?></p>

						<form method="POST">
						<input name="download-btn" onclick="return confirm('Are you sure to DOWNLOAD it?')"  id="download-btn" type="submit" class="btn" value="DOWNLOAD <?php echo ($db_IsPaid == "0") ? 'Free' : '$'. $db_SellingPrice ?>" />
						</form>
                    
                        <?php
                            
                            if(isset($_POST['download-btn'])){
                                
                                $query = "SELECT * FROM  users WHERE UsersID = '{$user_id}' AND RoleID != '1'";
                                $check_request = mysqli_query($connection, $query);    
                                $count = mysqli_num_rows($check_request);
                                
                                if($count > 0) {
                                    noteDownload($db_NoteID);
                                }else{
                                    echo "<script type='text/javascript'>alert('You cann't download this note.');</script>";
                                }
                                
                            }
                            
                        ?> 
						
					</div>
				</div>

				<div class="col-lg-6 col-md-12 col-sm-12" id="right-side">

					<div class="row">

						<div class="col-md-6 col-sm-6 col-6 left">
							<p>Institution:</p>
							<p>Country:</p>
							<p>Course Name:</p>
							<p>Course Code:</p>
							<p>Professor:</p>
							<p>Number Of Pages:</p>
							<p>Approved Date:</p>
							<p>Rating:</p>

						</div>

						<div class="col-md-6 col-sm-6 col-6 right text-right">

							<p class="text"><?php echo $db_UniversityName ?></p>
							<p class="text"><?php echo $db_CountryName ?></p>
							<p class="text"><?php echo $db_Course ?></p>
							<p class="text"><?php echo $db_CourseCode ?></p>
							<p class="text"><?php echo $db_Professor ?></p>
							<p class="text"><?php echo $db_NumberOfPages ?></p>
							<p class="text"><?php echo $db_PublishedDate ?></p>
							<p class="text">
								<!-- Stars -->
								
								<?php
                                
                                    for($i = 1; $i <= $stars; $i++) {
                                        echo '<img class="star" src="../images/Admin_images/star.png" alt="Star">';
                                    }
                                    for($i = 1; $i <= (5-$stars); $i++) {
                                        echo '<img class="star" src="../images/Admin_images/star-white.png" alt="Star">';
                                    }
                                
                                ?>
								
								<span class="text"><?php echo $total_review; ?> reviews</span>
							</p>
						</div>

						<div class="col-md-12">
							<span class="span"><?php echo $total_report; ?> users marked this note as inappropriate</span>
						</div>

					</div>
				</div>
			</div>
			<hr>


			<div class="row">
				<!-- Note Preview -->
				<div class="col-lg-5 col-md-6 col-sm-12 note-preview">

					<h3 class="heading">Notes Preview</h3>

					<div id="Iframe-Cicis-Menu-To-Go" class="set-margin-cicis-menu-to-go set-padding-cicis-menu-to-go set-border-cicis-menu-to-go set-box-shadow-cicis-menu-to-go center-block-horiz">
						<div class="responsive-wrapper responsive-wrapper-padding-bottom-90pct" style="-webkit-overflow-scrolling: touch; overflow: auto;">

							<iframe src="../../front/uploaded files/<?php echo $db_NotesPreview ?>#toolbar=0" frameBorder="0" scrolling="auto" height="530px%" width="100%">
								
							</iframe>
						</div>
					</div>

				</div>


				<div class="col-lg-7 col-md-6 col-sm-12">

					<h3 class="heading">Customer Review</h3>

					<div class="review-container">

						<!-- reviews -->
						<div class="reviews">
                            
                            <?php 
                                    
                                $query = "SELECT u.FirstName, up.ProfilePicture, snr.NoteReviewID, snr.Ratings, snr.Comments  FROM  
                                ((seller_notes_reviews AS snr INNER JOIN users AS u ON snr.ReviewedByID = u.UsersID)
                                LEFT JOIN user_profile AS up ON snr.ReviewedByID = up.UsersID)
                                WHERE NoteID = '{$se_noteid}' ORDER BY RAND() LIMIT 3";
                                $check_reviews = mysqli_query($connection, $query);
                                if(!$check_reviews){
                                    echo "error" . mysqli_error($connection);
                                }
                                while($row = mysqli_fetch_array($check_reviews)){
                                    $db_NoteReviewID = $row['NoteReviewID'];
                                    $db_ProfilePicture = $row['ProfilePicture'];
                                    $db_FirstName = $row['FirstName'];
                                    $db_Ratings = $row['Ratings'];
                                    $db_Comments = $row['Comments'];
                                   
                            ?>
							<table>
							    	
								<tr>
									<td>
                                        <img src="<?php echo ($db_ProfilePicture == "") ? "../../front/images/Front_images/default_profile.png" : "../../front/profile pictures/$db_ProfilePicture" ?>" alt="user image" class="reviewer img-responsive rounded-circle">
                                        
				                    </td>
									<td>
										<div class="main-information">
											<h5><?php echo $db_FirstName; ?></h5>
											<a onClick="return confirm('Are you sure you want to delete this?'); " href="?delete=<?php echo $db_NoteReviewID; ?>"><img class = "delete" src='../images/Admin_images/delete.png' alt='delete'></a>
											<div class="rating">
                                            
											    <?php
                                
                                                    for($i = 1; $i <= $db_Ratings; $i++) {
                                                        echo '<img class="star" src="../images/Admin_images/star.png" alt="Star">';
                                                    }
                                                    for($i = 1; $i <= (5-$db_Ratings); $i++) {
                                                        echo '<img class="star" src="../images/Admin_images/star-white.png" alt="Star">';
                                                    }
                                                ?>
												
											</div>
										</div>
										
									</td>
								</tr>
								    
								    
							</table>

							<p class="pera"><?php echo $db_Comments; ?></p>

							<hr class="hr">
							
							<?php
				            }
                            ?>
						</div>
						
						<?php  
                            if(isset($_GET['delete'])) {

                                $db_NoteReviewID = $_GET['delete'];
                                $query = "SELECT NoteID FROM seller_notes_reviews WHERE NoteReviewID = {$db_NoteReviewID}";
                                $select_query = mysqli_query($connection, $query);
                                $row = mysqli_fetch_array($select_query);
                                $se_noteid = $row['NoteID'];
                                
                                $query = "DELETE FROM seller_notes_reviews WHERE NoteReviewID = {$db_NoteReviewID}";
                                $delete_query = mysqli_query($connection, $query);
                                if (!$delete_query) {
                                    die("QUERY FAILED" . mysqli_error($connection));
                                }
                                redirect("note-details.php?NoteID=$se_noteid");
                                
                            }
                        ?>
						
					</div>

				</div>

			</div>
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
	
</body>

</html>