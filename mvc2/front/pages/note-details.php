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
            include "includes/logoff_nav.php";
        }
    ?>
    <!-- Header Ends -->
	
	
	<section id="note-details">

		<div class="container">

			<h3 class="heading">Notes Details</h3>
			
			<?php 
                if(isset($_SESSION['NoteID']) || isset($_GET['NoteID'])) {
                    $se_noteid = $_GET['NoteID'];
                    
                    $query = "SELECT * FROM seller_notes WHERE NoteID = '{$se_noteid}'";
                                    
                    $select_notes_query = mysqli_query($connection, $query);

                    if (!$select_notes_query) {

                        die("QUERY FAILED" . mysqli_error($connection));

                    }
                    
                    while($row = mysqli_fetch_assoc($select_notes_query )) {
                                        
                        $db_NoteID = $row['NoteID'];
                        $db_SellerID = $row['SellerID'];
                        $db_PublishedDate = $row['PublishedDate'];
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
                    $query = "SELECT FirstName, EmailID FROM users WHERE UsersID = '{$user_id}' ";
                    $buyer_detail = mysqli_query($connection, $query);
                    $row = mysqli_fetch_array($buyer_detail);

                    $buyer_name = $row['FirstName'];
                    $buyer_email = $row['EmailID'];

                    $query = "SELECT FirstName, EmailID FROM users WHERE UsersID = '{$db_SellerID}' ";
                    $seller_detail = mysqli_query($connection, $query);
                    $row = mysqli_fetch_array($seller_detail);

                    $seller_name = $row['FirstName'];
                    $seller_email = $row['EmailID'];
                    
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
							<img src="../uploaded files/<?php echo $db_DisplayPicture ?>" alt="">
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
                                if(isset($_SESSION['UsersID'])) {
                                    
                                    $downloader_id = $_SESSION['UsersID'];
                                    
                                    $query = "SELECT * FROM  downloads WHERE NoteID = '{$se_noteid}' AND DownloaderID = '{$downloader_id}'";
                                    
                                    $check_request = mysqli_query($connection, $query);    
                                    
                                    if(mysqli_num_rows($check_request) <= 0) {
                                        if($downloader_id != $db_SellerID){
                                        
                                        $query = "INSERT INTO downloads (NoteID, SellerID, DownloaderID, IsPaid , PurchasedPrice, NoteTitle, NoteCategory, CreatedDate, CreatedBy) ";
             
                                        $query .= "VALUES ({$db_NoteID}, {$db_SellerID}, '{$downloader_id}', '{$db_IsPaid}', '{$db_SellingPrice}', '{$db_Title}', '{$db_CategoryName}', now(), '{$user_id}')"; 

                                        $download_note_query = mysqli_query($connection, $query); 

                                        if($download_note_query){
                                            
                                            $to = $seller_email;
                                            $from = "notemarketplace00@gmail.com";

                                            $subject    = $buyer_name . " Allows you to download a note.";

                                            $message      = "\r\n" . "Hello " . $seller_name . ", " . "\r\n" . "\r\n";
                                            $message      .= "We would like to inform you that, " .$buyer_name . " Allows you to download a note. Please login and see My Download tabs to download " . $db_Title . " note." . "\r\n" . "\r\n";
                                            $message      .= "Regards, " . "\r\n" . "Notes Marketplace";

                                            $body =  "";
                                            $body .= "Email From: " . $from . "\r\n";
                                            $body .= "Email To: " . $to . "\r\n";
                                            $body .= "Subject: " . $subject . "\r\n";
                                            $body .= "Body: " . "\r\n" . $message;

                                            if(mail($to,$subject,$body))
                                            {
                                                echo "<script type='text/javascript'>alert('Thank you.');</script>";
                                            }else{
                                                echo "<script type='text/javascript'>alert('Please Try Again.');</script>";
                                            }
                                        }
                                        }
                                        
                                    }
                                    
                                    $query = "SELECT IsSellerHasAllowedDownload FROM  downloads WHERE NoteID = '{$se_noteid}' AND DownloaderID = '{$downloader_id}'";
                                    $check_download = mysqli_query($connection, $query); 
                                    
                                    $db_IsSellerHasAllowedDownload = "";
                                    if($row = mysqli_fetch_array($check_download)){
                                        $db_IsSellerHasAllowedDownload  .= $row['IsSellerHasAllowedDownload'];
                                        if($db_IsSellerHasAllowedDownload == "1" || $db_IsPaid == "0"){
                                            redirect("my-downloads.php");
                                        }else {
                                            echo "<script type='text/javascript'>alert('You have requested for download this note. Please wait for seller conformation');</script>";
                                        }
                                    }else{
                                        echo "<script type='text/javascript'>alert('You are seller of this note. You can download from my sold');</script>";
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
                                        }
                                    }
                                    
                                }else {
                                    redirect("login.php");
                                }
                            }
                            
                        ?> 
						
					</div>
				</div>

				<div class="col-lg-6 col-md-12 col-sm-12" id="right-side">

					<div class="row">

						<div class="col-md-6 col-sm-6 left">
							<p>Institution:</p>
							<p>Country:</p>
							<p>Course Name:</p>
							<p>Course Code:</p>
							<p>Professor:</p>
							<p>Number Of Pages:</p>
							<p>Approved Date:</p>
							<p>Rating:</p>

						</div>

						<div class="col-md-6 col-sm-6 right text-right">

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
                                        echo '<img class="star" src="../images/Front_images/star.png" alt="Star">';
                                    }
                                    for($i = 1; $i <= (5-$stars); $i++) {
                                        echo '<img class="star" src="../images/Front_images/star-white.png" alt="Star">';
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

							<iframe src="../uploaded files/<?php echo $db_NotesPreview ?>#toolbar=0" frameBorder="0" scrolling="auto" height="530px%" width="100%">
								
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
                                    
                                $query = "SELECT u.FirstName, up.ProfilePicture, snr.Ratings, snr.Comments  FROM  
                                ((seller_notes_reviews AS snr INNER JOIN users AS u ON snr.ReviewedByID = u.UsersID)
                                LEFT JOIN user_profile AS up ON snr.ReviewedByID = up.UsersID)
                                WHERE NoteID = '{$se_noteid}' ORDER BY RAND() LIMIT 3";
                                $check_reviews = mysqli_query($connection, $query);
                                if(!$check_reviews){
                                    echo "error" . mysqli_error($connection);
                                }
                                while($row = mysqli_fetch_array($check_reviews)){
                                    $db_ProfilePicture = $row['ProfilePicture'];
                                    $db_FirstName = $row['FirstName'];
                                    $db_Ratings = $row['Ratings'];
                                    $db_Comments = $row['Comments'];
                                   
                            ?>
							<table>
							    	
								<tr>
									<td>
                                        <img src="<?php echo ($db_ProfilePicture == "") ? "../images/Front_images/default_profile.png" : "../profile pictures/$db_ProfilePicture" ?>" alt="user image" class="reviewer img-responsive rounded-circle">
                                        
                                        
				                    </td>
									<td>
										<div class="main-information">
											<h5><?php echo $db_FirstName; ?></h5>
											<div class="rating">
											    <?php
                                
                                                    for($i = 1; $i <= $db_Ratings; $i++) {
                                                        echo '<img class="star" src="../images/Front_images/star.png" alt="Star">';
                                                    }
                                                    for($i = 1; $i <= (5-$db_Ratings); $i++) {
                                                        echo '<img class="star" src="../images/Front_images/star-white.png" alt="Star">';
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