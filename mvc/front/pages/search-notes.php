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
    
    <!-- DataTable CSS -->
    <link rel="stylesheet" href="../css/DataTables/datatables.css">
    
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="../css/bootstrap/bootstrap.css">

	<!-- Custom Css -->
	<link rel="stylesheet" href="../css/search-notes.css">

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
		
	<!-- Top Content -->
		<section id="top-content">

			<div class="content-box-lg">

				<div class="container">

					<div class="row">

						<div class="col-md-12 col-sm-12">

							<div id="top-heading" class="text-center">

								<h3>Search Notes</h3>
								
							</div>

						</div>

					</div>

				</div>

			</div>

		</section>
	<!-- Top Content Ends -->
			
	<!-- Title -->
	<div class="container">
		<div class="content-box-lg text-left">
			<h3 class="heading">Search and Filter notes</h3>
		</div>
	</div>
				
	<!-- Forms -->
	<section id="forms">

		<div class="content-box-lg">

			<div class="container">
                
                <!-- Basic Profile Form -->
                <form class="myForm text-left" method="POST">
				<div class="row">
					
					<div class="col-md-12 col-sm-12 first">
								<div class="form-group">
									
									<input class="myInput" placeholder="Search notes here..." type="search" id="search" value="">
									<span toggle="#search" class="fa fa-search field-icon toggle-password text-left"></span>
									
								</div>
							
					</div>


					<div class="col-md-12 col-sm-12 second">
								
								<div class="row">
								
									<div class="col-md-2 col-sm-4 box">
										<div class="form-group">
											<input class="myInput" placeholder="select type" type="text" id="select-type" value="" >
											<img src="../images/Front_images/arrow-down.png" class="arrow-down">
										</div>
									</div>
								
									<div class="col-md-2 col-sm-4 box">
										<div class="form-group">
										<input class="myInput" placeholder="select category" type="text" id="select-category" value="" >
										<img src="../images/Front_images/arrow-down.png" class="arrow-down">
									</div>
									</div>
								
									<div class="col-md-2 col-sm-4 box">
										<div class="form-group">
										<input class="myInput" placeholder="select university" type="text" id="select-university" value="" >
										<img src="../images/Front_images/arrow-down.png" class="arrow-down">
										</div>
									</div>
								
								<div class="col-md-2 col-sm-4 box">
								<div class="form-group">
									<input class="myInput" placeholder="select course" type="text" id="select-course" value="" >
									<img src="../images/Front_images/arrow-down.png" class="arrow-down">
								</div>
								</div>
								
								<div class="col-md-2 col-sm-4 box">
								<div class="form-group">
									<input class="myInput" placeholder="select country" type="text" id="select-country" value="" >
									<img src="../images/Front_images/arrow-down.png" class="arrow-down">
								</div>
								</div>
								
								<div class="col-md-2 col-sm-4 box">
								<div class="form-group">
									<input class="myInput" placeholder="select rating" type="text" id="select-rating" value="" >
									<img src="../images/Front_images/arrow-down.png" class="arrow-down">
								</div>
								</div>
								
								
								</div>

					</div>

				</div>
                </form>

			</div>

		</div>

	</section>
	<!-- Forms Ende-->


	<!-- Notes -->
	<section id="search-notes">

		<div class="content-box-lg">

			<div class="container">

				<div class="row">

					<div class="col-md-12 col-sm-12">
						<h3 class="heading">total 18 notes</h3>
					</div>
				
				</div>	
					
				
				<!-- Search Notes List -->
				<div class="row">
				    <table id="all-notes-table" class="datatable table table-responsive-md display">
	
					<!-- note-01 -->
					<div class="col-lg-4 col-md-4 col-sm-6">
					<div class="notes-container">
						<img src="../images/Front_images/search1.png" alt="Search notes Image" class="img-responsive">
						
						<div class="note">
							<!-- notes heading -->
							<h3 class="heading">computer operating system - final exam book with paper solution</h3>
								
								<!-- Notes Details -->
								<ul class="note-details">
							    	
									<div class="row">
										<div class="col-md-2 col-sm-2">
											<li><img src="../images/Front_images/university.png"></li>
										</div>
										<div class="col-md-10 col-sm-10 span">
											<span>University Of California, US</span>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-2  col-sm-2">
											<li><img src="../images/Front_images/pages.png"></li>
										</div>
										<div class="col-md-10 col-sm-10 span">
											<span>204 Pages</span>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-2 col-sm-2">
											<li><img src="../images/Front_images/date.png"></li>
										</div>
										<div class="col-md-10 col-sm-10 span">
											<span>Thu, Nov 26 2020</span>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-2 col-sm-2">
											<li><img src="../images/Front_images/flag.png"></li>
										</div>
										<div class="col-md-10 col-sm-10 span">
											<span style="color: #df3434">5 Users marked this note as inappropriate </span>
										</div>
									</div>
									
								</ul>
							
							<!-- Stars -->	
							<img class="star" src="../images/Front_images/star.png" alt="Star">
							<img class="star" src="../images/Front_images/star.png" alt="Star">
							<img class="star" src="../images/Front_images/star.png" alt="Star">
							<img class="star" src="../images/Front_images/star.png" alt="Star">
							<img class="star" src="../images/Front_images/star.png" alt="Star">
							
							<span class="span">100 reviews</span>
							
						</div>
					</div>
					</div>
					
					<!-- note-02 -->
					<div class="col-lg-4 col-md-4 col-sm-6">
					<div class="notes-container">
						<img src="../images/Front_images/search2.png" alt="Search notes Image" class="img-responsive">
						
						<div class="note">
							<!-- notes heading -->
							<h3 class="heading">computer science</h3>
								
								<!-- Notes Details -->
								<ul class="note-details">
							    	
									<div class="row">
										<div class="col-md-2 col-sm-2">
											<li><img src="../images/Front_images/university.png"></li>
										</div>
										<div class="col-md-10 col-sm-10 span">
											<span>University Of California, US</span>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-2  col-sm-2">
											<li><img src="../images/Front_images/pages.png"></li>
										</div>
										<div class="col-md-10 col-sm-10 span">
											<span>204 Pages</span>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-2 col-sm-2">
											<li><img src="../images/Front_images/date.png"></li>
										</div>
										<div class="col-md-10 col-sm-10 span">
											<span>Thu, Nov 26 2020</span>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-2 col-sm-2">
											<li><img src="../images/Front_images/flag.png"></li>
										</div>
										<div class="col-md-10 col-sm-10 span">
											<span style="color: #df3434">5 Users marked this note as inappropriate </span>
										</div>
									</div>
									
								</ul>
								
							<!-- Stars -->	
							<img class="star" src="../images/Front_images/star.png" alt="Star">
							<img class="star" src="../images/Front_images/star.png" alt="Star">
							<img class="star" src="../images/Front_images/star.png" alt="Star">
							<img class="star" src="../images/Front_images/star.png" alt="Star">
							<img class="star" src="../images/Front_images/star-white.png" alt="Star">
							
							<span class="span">100 reviews</span>
							
							
						</div>
					</div>
					</div>
					
					<!-- note-03 -->
					<div class="col-lg-4 col-md-4 col-sm-6">
					<div class="notes-container">
						<img src="../images/Front_images/search3.png" alt="Search notes Image" class="img-responsive">
						
						<div class="note">
							<!-- notes heading -->
							<h3 class="heading">basic computer engineering tech india publication series</h3>
								
								<!-- Notes Details -->
								<ul class="note-details">
							    	
									<div class="row">
										<div class="col-md-2 col-sm-2">
											<li><img src="../images/Front_images/university.png"></li>
										</div>
										<div class="col-md-10 col-sm-10 span">
											<span>University Of California, US</span>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-2  col-sm-2">
											<li><img src="../images/Front_images/pages.png"></li>
										</div>
										<div class="col-md-10 col-sm-10 span">
											<span>204 Pages</span>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-2 col-sm-2">
											<li><img src="../images/Front_images/date.png"></li>
										</div>
										<div class="col-md-10 col-sm-10 span">
											<span>Thu, Nov 26 2020</span>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-2 col-sm-2">
											<li><img src="../images/Front_images/flag.png"></li>
										</div>
										<div class="col-md-10 col-sm-10 span">
											<span style="color: #df3434">5 Users marked this note as inappropriate </span>
										</div>
									</div>
									
								</ul>
								
							<!-- Stars -->	
							<img class="star" src="../images/Front_images/star.png" alt="Star">
							<img class="star" src="../images/Front_images/star.png" alt="Star">
							<img class="star" src="../images/Front_images/star.png" alt="Star">
							<img class="star" src="../images/Front_images/star-white.png" alt="Star">
							<img class="star" src="../images/Front_images/star-white.png" alt="Star">
							
							<span class="span">100 reviews</span>
							
								
						</div>
					</div>
					</div>
					
					<!-- note-04 -->
					<div class="col-md-4 col-sm-6">
					<div class="notes-container">
						<img src="../images/Front_images/search4.png" alt="Search notes Image" class="img-responsive">
						
						<div class="note">
							<!-- notes heading -->
							<h3 class="heading">computer science illuminated -seventh edition</h3>
								
								<!-- Notes Details -->
								<ul class="note-details">
							    	
									<div class="row">
										<div class="col-md-2 col-sm-2">
											<li><img src="../images/Front_images/university.png"></li>
										</div>
										<div class="col-md-10 col-sm-10 span">
											<span>University Of California, US</span>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-2  col-sm-2">
											<li><img src="../images/Front_images/pages.png"></li>
										</div>
										<div class="col-md-10 col-sm-10 span">
											<span>204 Pages</span>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-2 col-sm-2">
											<li><img src="../images/Front_images/date.png"></li>
										</div>
										<div class="col-md-10 col-sm-10 span">
											<span>Thu, Nov 26 2020</span>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-2 col-sm-2">
											<li><img src="../images/Front_images/flag.png"></li>
										</div>
										<div class="col-md-10 col-sm-10 span">
											<span style="color: #df3434">5 Users marked this note as inappropriate </span>
										</div>
									</div>
									
								</ul>
							
							<!-- Stars -->	
							<img class="star" src="../images/Front_images/star.png" alt="Star">
							<img class="star" src="../images/Front_images/star.png" alt="Star">
							<img class="star" src="../images/Front_images/star.png" alt="Star">
							<img class="star" src="../images/Front_images/star.png" alt="Star">
							<img class="star" src="../images/Front_images/star.png" alt="Star">
							
							<span class="span">100 reviews</span>
							
						</div>
					</div>
					</div>
					
					<!-- note-05 -->
					<div class="col-md-4 col-sm-6">
					<div class="notes-container">
						<img src="../images/Front_images/search5.png" alt="Search notes Image" class="img-responsive">
						
						<div class="note">
							<!-- notes heading -->
							<h3 class="heading">principles of computer hardware-oxford</h3>
								
								<!-- Notes Details -->
								<ul class="note-details">
							    	
									<div class="row">
										<div class="col-md-2 col-sm-2">
											<li><img src="../images/Front_images/university.png"></li>
										</div>
										<div class="col-md-10 col-sm-10 span">
											<span>University Of California, US</span>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-2  col-sm-2">
											<li><img src="../images/Front_images/pages.png"></li>
										</div>
										<div class="col-md-10 col-sm-10 span">
											<span>204 Pages</span>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-2 col-sm-2">
											<li><img src="../images/Front_images/date.png"></li>
										</div>
										<div class="col-md-10 col-sm-10 span">
											<span>Thu, Nov 26 2020</span>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-2 col-sm-2">
											<li><img src="../images/Front_images/flag.png"></li>
										</div>
										<div class="col-md-10 col-sm-10 span">
											<span style="color: #df3434">5 Users marked this note as inappropriate </span>
										</div>
									</div>
									
								</ul>
								
							<!-- Stars -->	
							<img class="star" src="../images/Front_images/star.png" alt="Star">
							<img class="star" src="../images/Front_images/star.png" alt="Star">
							<img class="star" src="../images/Front_images/star.png" alt="Star">
							<img class="star" src="../images/Front_images/star.png" alt="Star">
							<img class="star" src="../images/Front_images/star-white.png" alt="Star">
							
							<span class="span">100 reviews</span>
							
							
						</div>
					</div>
					</div>
					
					<!-- note-06 -->
					<div class="col-md-4 col-sm-6">
					<div class="notes-container">
						<img src="../images/Front_images/search6.png" alt="Search notes Image" class="img-responsive">
						
						<div class="note">
							<!-- notes heading -->
							<h3 class="heading">the computer book</h3>
								
								<!-- Notes Details -->
								<ul class="note-details">
							    	
									<div class="row">
										<div class="col-md-2 col-sm-2">
											<li><img src="../images/Front_images/university.png"></li>
										</div>
										<div class="col-md-10 col-sm-10 span">
											<span>University Of California, US</span>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-2  col-sm-2">
											<li><img src="../images/Front_images/pages.png"></li>
										</div>
										<div class="col-md-10 col-sm-10 span">
											<span>204 Pages</span>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-2 col-sm-2">
											<li><img src="../images/Front_images/date.png"></li>
										</div>
										<div class="col-md-10 col-sm-10 span">
											<span>Thu, Nov 26 2020</span>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-2 col-sm-2">
											<li><img src="../images/Front_images/flag.png"></li>
										</div>
										<div class="col-md-10 col-sm-10 span">
											<span style="color: #df3434">5 Users marked this note as inappropriate </span>
										</div>
									</div>
									
								</ul>
								
							<!-- Stars -->	
							<img class="star" src="../images/Front_images/star.png" alt="Star">
							<img class="star" src="../images/Front_images/star.png" alt="Star">
							<img class="star" src="../images/Front_images/star.png" alt="Star">
							<img class="star" src="../images/Front_images/star-white.png" alt="Star">
							<img class="star" src="../images/Front_images/star-white.png" alt="Star">
							
							<span class="span">100 reviews</span>
							
								
						</div>
					</div>
					</div>
					
					<!-- note-07 -->
					<div class="col-md-4 col-sm-6">
					<div class="notes-container">
						<img src="../images/Front_images/search1.png" alt="Search notes Image" class="img-responsive">
						
						<div class="note">
							<!-- notes heading -->
							<h3 class="heading">computer operating system - final exam book with paper solution</h3>
								
								<!-- Notes Details -->
								<ul class="note-details">
							    	
									<div class="row">
										<div class="col-md-2 col-sm-2">
											<li><img src="../images/Front_images/university.png"></li>
										</div>
										<div class="col-md-10 col-sm-10 span">
											<span>University Of California, US</span>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-2  col-sm-2">
											<li><img src="../images/Front_images/pages.png"></li>
										</div>
										<div class="col-md-10 col-sm-10 span">
											<span>204 Pages</span>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-2 col-sm-2">
											<li><img src="../images/Front_images/date.png"></li>
										</div>
										<div class="col-md-10 col-sm-10 span">
											<span>Thu, Nov 26 2020</span>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-2 col-sm-2">
											<li><img src="../images/Front_images/flag.png"></li>
										</div>
										<div class="col-md-10 col-sm-10 span">
											<span style="color: #df3434">5 Users marked this note as inappropriate </span>
										</div>
									</div>
									
								</ul>
							
							<!-- Stars -->	
							<img class="star" src="../images/Front_images/star.png" alt="Star">
							<img class="star" src="../images/Front_images/star.png" alt="Star">
							<img class="star" src="../images/Front_images/star.png" alt="Star">
							<img class="star" src="../images/Front_images/star.png" alt="Star">
							<img class="star" src="../images/Front_images/star.png" alt="Star">
							
							<span class="span">100 reviews</span>
							
						</div>
					</div>
					</div>
					
					<!-- note-08 -->
					<div class="col-md-4 col-sm-6">
					<div class="notes-container">
						<img src="../images/Front_images/search2.png" alt="Search notes Image" class="img-responsive">
						
						<div class="note">
							<!-- notes heading -->
							<h3 class="heading">computer science</h3>
								
								<!-- Notes Details -->
								<ul class="note-details">
							    	
									<div class="row">
										<div class="col-md-2 col-sm-2">
											<li><img src="../images/Front_images/university.png"></li>
										</div>
										<div class="col-md-10 col-sm-10 span">
											<span>University Of California, US</span>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-2  col-sm-2">
											<li><img src="../images/Front_images/pages.png"></li>
										</div>
										<div class="col-md-10 col-sm-10 span">
											<span>204 Pages</span>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-2 col-sm-2">
											<li><img src="../images/Front_images/date.png"></li>
										</div>
										<div class="col-md-10 col-sm-10 span">
											<span>Thu, Nov 26 2020</span>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-2 col-sm-2">
											<li><img src="../images/Front_images/flag.png"></li>
										</div>
										<div class="col-md-10 col-sm-10 span">
											<span style="color: #df3434">5 Users marked this note as inappropriate </span>
										</div>
									</div>
									
								</ul>
								
							<!-- Stars -->	
							<img class="star" src="../images/Front_images/star.png" alt="Star">
							<img class="star" src="../images/Front_images/star.png" alt="Star">
							<img class="star" src="../images/Front_images/star.png" alt="Star">
							<img class="star" src="../images/Front_images/star.png" alt="Star">
							<img class="star" src="../images/Front_images/star-white.png" alt="Star">
							
							<span class="span">100 reviews</span>
							
							
						</div>
					</div>
					</div>
					
					<!-- note-09 -->
					<div class="col-md-4 col-sm-6">
					<div class="notes-container">
						<img src="../images/Front_images/search3.png" alt="Search notes Image" class="img-responsive">
						
						<div class="note">
							<!-- notes heading -->
							<h3 class="heading">basic computer engineering tech india publication series</h3>
								
								<!-- Notes Details -->
								<ul class="note-details">
							    	
									<div class="row">
										<div class="col-md-2 col-sm-2">
											<li><img src="../images/Front_images/university.png"></li>
										</div>
										<div class="col-md-10 col-sm-10 span">
											<span>University Of California, US</span>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-2  col-sm-2">
											<li><img src="../images/Front_images/pages.png"></li>
										</div>
										<div class="col-md-10 col-sm-10 span">
											<span>204 Pages</span>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-2 col-sm-2">
											<li><img src="../images/Front_images/date.png"></li>
										</div>
										<div class="col-md-10 col-sm-10 span">
											<span>Thu, Nov 26 2020</span>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-2 col-sm-2">
											<li><img src="../images/Front_images/flag.png"></li>
										</div>
										<div class="col-md-10 col-sm-10 span">
											<span style="color: #df3434">5 Users marked this note as inappropriate </span>
										</div>
									</div>
									
								</ul>
								
							<!-- Stars -->	
							<img class="star" src="../images/Front_images/star.png" alt="Star">
							<img class="star" src="../images/Front_images/star.png" alt="Star">
							<img class="star" src="../images/Front_images/star.png" alt="Star">
							<img class="star" src="../images/Front_images/star-white.png" alt="Star">
							<img class="star" src="../images/Front_images/star-white.png" alt="Star">
							
							<span class="span">100 reviews</span>
							
								
						</div>
					</div>
					</div>
					
					<!-- note-10 -->
					<div class="col-md-4 col-sm-6">
					<div class="notes-container">
						<img src="../images/Front_images/search4.png" alt="Search notes Image" class="img-responsive">
						
						<div class="note">
							<!-- notes heading -->
							<h3 class="heading">computer science illuminated -seventh edition</h3>
								
								<!-- Notes Details -->
								<ul class="note-details">
							    	
									<div class="row">
										<div class="col-md-2 col-sm-2">
											<li><img src="../images/Front_images/university.png"></li>
										</div>
										<div class="col-md-10 col-sm-10 span">
											<span>University Of California, US</span>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-2  col-sm-2">
											<li><img src="../images/Front_images/pages.png"></li>
										</div>
										<div class="col-md-10 col-sm-10 span">
											<span>204 Pages</span>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-2 col-sm-2">
											<li><img src="../images/Front_images/date.png"></li>
										</div>
										<div class="col-md-10 col-sm-10 span">
											<span>Thu, Nov 26 2020</span>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-2 col-sm-2">
											<li><img src="../images/Front_images/flag.png"></li>
										</div>
										<div class="col-md-10 col-sm-10 span">
											<span style="color: #df3434">5 Users marked this note as inappropriate </span>
										</div>
									</div>
									
								</ul>
							
							<!-- Stars -->	
							<img class="star" src="../images/Front_images/star.png" alt="Star">
							<img class="star" src="../images/Front_images/star.png" alt="Star">
							<img class="star" src="../images/Front_images/star.png" alt="Star">
							<img class="star" src="../images/Front_images/star.png" alt="Star">
							<img class="star" src="../images/Front_images/star.png" alt="Star">
							
							<span class="span">100 reviews</span>
							
						</div>
					</div>
					</div>
					
					<!-- note-11 -->
					<div class="col-md-4 col-sm-6">
					<div class="notes-container">
						<img src="../images/Front_images/search5.png" alt="Search notes Image" class="img-responsive">
						
						<div class="note">
							<!-- notes heading -->
							<h3 class="heading">principles of computer hardware-oxford</h3>
								
								<!-- Notes Details -->
								<ul class="note-details">
							    	
									<div class="row">
										<div class="col-md-2 col-sm-2">
											<li><img src="../images/Front_images/university.png"></li>
										</div>
										<div class="col-md-10 col-sm-10 span">
											<span>University Of California, US</span>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-2  col-sm-2">
											<li><img src="../images/Front_images/pages.png"></li>
										</div>
										<div class="col-md-10 col-sm-10 span">
											<span>204 Pages</span>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-2 col-sm-2">
											<li><img src="../images/Front_images/date.png"></li>
										</div>
										<div class="col-md-10 col-sm-10 span">
											<span>Thu, Nov 26 2020</span>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-2 col-sm-2">
											<li><img src="../images/Front_images/flag.png"></li>
										</div>
										<div class="col-md-10 col-sm-10 span">
											<span style="color: #df3434">5 Users marked this note as inappropriate </span>
										</div>
									</div>
									
								</ul>
								
							<!-- Stars -->	
							<img class="star" src="../images/Front_images/star.png" alt="Star">
							<img class="star" src="../images/Front_images/star.png" alt="Star">
							<img class="star" src="../images/Front_images/star.png" alt="Star">
							<img class="star" src="../images/Front_images/star.png" alt="Star">
							<img class="star" src="../images/Front_images/star-white.png" alt="Star">
							
							<span class="span">100 reviews</span>
							
							
						</div>
					</div>
					</div>
					
					<!-- note-12 -->
					<div class="col-md-4 col-sm-6">
					<div class="notes-container">
						<img src="../images/Front_images/search6.png" alt="Search notes Image" class="img-responsive">
						
						<div class="note">
							<!-- notes heading -->
							<h3 class="heading">the computer book</h3>
								
								<!-- Notes Details -->
								<ul class="note-details">
							    	
									<div class="row">
										<div class="col-md-2 col-sm-2">
											<li><img src="../images/Front_images/university.png"></li>
										</div>
										<div class="col-md-10 col-sm-10 span">
											<span>University Of California, US</span>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-2  col-sm-2">
											<li><img src="../images/Front_images/pages.png"></li>
										</div>
										<div class="col-md-10 col-sm-10 span">
											<span>204 Pages</span>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-2 col-sm-2">
											<li><img src="../images/Front_images/date.png"></li>
										</div>
										<div class="col-md-10 col-sm-10 span">
											<span>Thu, Nov 26 2020</span>
										</div>
									</div>
									
									<div class="row">
										<div class="col-md-2 col-sm-2">
											<li><img src="../images/Front_images/flag.png"></li>
										</div>
										<div class="col-md-10 col-sm-10 span">
											<span style="color: #df3434">5 Users marked this note as inappropriate </span>
										</div>
									</div>
									
								</ul>
								
							<!-- Stars -->	
							<img class="star" src="../images/Front_images/star.png" alt="Star">
							<img class="star" src="../images/Front_images/star.png" alt="Star">
							<img class="star" src="../images/Front_images/star.png" alt="Star">
							<img class="star" src="../images/Front_images/star-white.png" alt="Star">
							<img class="star" src="../images/Front_images/star-white.png" alt="Star">
							
							<span class="span">100 reviews</span>
							
								
						</div>
					</div>
					</div>
                    </table>	
				</div>
				
				
				<!-- Pagination -->
				<div class="row text-center">

					<div class="col-md-12 col-sm-12" id="pagination">
						
						<img src="../images/Front_images/left-arrow.png" alt="left-arrow" id="left-arrow">
							<a href="#"><span>1</span></a>
							<a href="#"><span>2</span></a>
							<a href="#"><span>3</span></a>
							<a href="#"><span>4</span></a>
							<a href="#"><span>5</span></a>
							
						<img src="../images/Front_images/right-arrow.png" alt="right-arrow" id="right-arrow">
							
					</div>
				
				</div>	

			</div>

		</div>

	</section>
	<!--  Ends -->

	<!-- Footer -->
	<footer>

		<div class="content-box-lg">
			<div class="container-fluid">
				<div class="row copyright">

					<hr>
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

	<!-- Bootstrap js -->
	<script src="../js/bootstrap/bootstrap.min.js"></script>
	
	<!-- DataTable JS -->
    <script src="../js/DataTables/datatables.js"></script>

	<!-- Custom JS -->
	<script src="../js/script.js"></script>

</body>

</html>