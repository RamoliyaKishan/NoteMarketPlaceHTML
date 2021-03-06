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
                if(isset($_SESSION['NoteID'])) {
                   $se_noteid = $_SESSION['NoteID'];
                                        
                    $query = "SELECT * FROM seller_notes WHERE NoteID = '{$se_noteid}'";
                                    
                    $select_notes_query = mysqli_query($connection, $query);

                    if (!$select_notes_query) {

                        die("QUERY FAILED" . mysqli_error($connection));

                    }
                    
                    while($row = mysqli_fetch_assoc($select_notes_query )) {
                                        
                                        $db_SellerID = $row['NoteID'];
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
                                        
                                        if($db_IsPaid == '1') {
                                            $db_IsPaid = 'Paid';
                                        }else {
                                            $db_IsPaid = 'free';
                                        }
                                        
                                        $query = "SELECT CategoryName FROM note_categories WHERE CategoryID = '{$db_Category}' ";
                                        $cat_name = mysqli_query($connection, $query);
                                        
                                        $row = mysqli_fetch_array($cat_name);
                                        
                                        $db_CategoryName = $row['CategoryName'];
                        
                                        $query = "SELECT CountryName FROM countries WHERE CountryID = '{$db_Country}' ";
                                        $coun_name = mysqli_query($connection, $query);
                                        
                                        $row = mysqli_fetch_array($coun_name);
                                        
                                        $db_CountryName = $row['CountryName'];
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
						<input name="download-btn" id="download-btn" type="submit" class="btn" value="DOWNLOAD <?php echo ($db_IsPaid == "Free") ? '' : '$'. $db_SellingPrice ?>">
						</form>
						
						<?php
                            if(isset($_POST['download-btn'])){
                                $_SESSION['NoteID'] = $se_noteid;
                                redirect("buyer-request.php");
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
								<img class="star" src="../images/Front_images/star.png" alt="Star">
								<img class="star" src="../images/Front_images/star.png" alt="Star">
								<img class="star" src="../images/Front_images/star.png" alt="Star">
								<img class="star" src="../images/Front_images/star.png" alt="Star">
								<img class="star" src="../images/Front_images/star-white.png" alt="Star">

								<span class="text">100 reviews</span>
							</p>

						</div>

						<div class="col-md-12">
							<span class="span">5 users marked this note as inappropriate</span>
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

							<iframe src="http://unec.edu.az/application/uploads/2014/12/pdf-sample.pdf#toolbar=0" frameBorder="0" scrolling="auto" height="530px%" width="100%">
								<p style="font-size: 110%;"><em><strong>ERROR: </strong> An &#105;frame should be displayed here but your browser version does not support &#105;frames.</em> Please update your browser to its most recent version and try again, or access the file <a href="../uploaded files/<?php echo $db_NotesPreview ?>">with this link.</a></p>
							</iframe>
						</div>
					</div>

				</div>


				<div class="col-lg-7 col-md-6 col-sm-12">

					<h3 class="heading">Customer Review</h3>

					<div class="review-container">

						<!-- review 01 -->
						<div class="reviews">

							<table>
								<tr>
									<td><img src="../images/Front_images/reviewer-1.png" class="reviewer"></td>
									<td>
										<div class="main-information">
											<h5>Richard Brown</h5>
											<div class="rating">
												<img class="star" src="../images/Front_images/star.png" alt="Star">
												<img class="star" src="../images/Front_images/star.png" alt="Star">
												<img class="star" src="../images/Front_images/star.png" alt="Star">
												<img class="star" src="../images/Front_images/star.png" alt="Star">
												<img class="star" src="../images/Front_images/star-white.png" alt="Star">
											</div>
										</div>
									</td>
								</tr>
							</table>

							<p class="pera">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure repellat asperiores nisi dignissimos pariatur dolor quis ut beatae.</p>

							<hr class="hr">

						</div>

						<!-- review 02 -->
						<div class="reviews">

							<table>
								<tr>
									<td><img src="../images/Front_images/reviewer-2.png" class="reviewer"></td>
									<td>
										<div class="main-information">
											<h5>Alis Ortiaz</h5>
											<div class="rating">
												<img class="star" src="../images/Front_images/star.png" alt="Star">
												<img class="star" src="../images/Front_images/star.png" alt="Star">
												<img class="star" src="../images/Front_images/star.png" alt="Star">
												<img class="star" src="../images/Front_images/star.png" alt="Star">
												<img class="star" src="../images/Front_images/star-white.png" alt="Star">
											</div>
										</div>
									</td>
								</tr>
							</table>

							<p class="pera">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure repellat asperiores nisi dignissimos pariatur dolor quis ut beatae.</p>

							<hr class="hr">

						</div>

						<!-- review 03 -->
						<div class="reviews">

							<table>
								<tr>
									<td><img src="../images/Front_images/reviewer-3.png" class="reviewer"></td>
									<td>
										<div class="main-information">
											<h5>Sara Martin</h5>
											<div class="rating">
												<img class="star" src="../images/Front_images/star.png" alt="Star">
												<img class="star" src="../images/Front_images/star.png" alt="Star">
												<img class="star" src="../images/Front_images/star.png" alt="Star">
												<img class="star" src="../images/Front_images/star.png" alt="Star">
												<img class="star" src="../images/Front_images/star-white.png" alt="Star">
											</div>
										</div>
									</td>
								</tr>
							</table>

							<p class="pera">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure repellat asperiores nisi dignissimos pariatur dolor quis ut beatae.</p>

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

	<!-- Custom JS -->
	<script src="../js/script.js"></script>

</body>

</html>