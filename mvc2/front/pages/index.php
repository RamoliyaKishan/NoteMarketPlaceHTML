<?php ob_start(); ?>
<?php session_start(); ?>
<?php include "includes/db.php"; ?>
<?php include "includes/functions.php"; ?>
<?php
if(isset($_SESSION['UsersID'])) {
    $user_id = $_SESSION['UsersID'];
    $query = "SELECT ProfilePicture FROM  user_profile WHERE UsersID = '{$user_id}'";
    $selecct_profile_picture_query = mysqli_query($connection, $query);
        
    if(!$selecct_profile_picture_query) {
        echo "Query Field" . mysqli_error($connection);
    }
    
    if(mysqli_num_rows($selecct_profile_picture_query) > 0){
    $row = mysqli_fetch_array($selecct_profile_picture_query);
    $db_profile_picture = $row['ProfilePicture'];
    }else {
        $db_profile_picture = "";
    }    
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

	<!-- Custom Css -->
	<link rel="stylesheet" href="../css/index.css">

</head>

<body>

	<!-- Header -->                    
                    
<?php 
        
    if(isset($_SESSION['UsersID'])) {
        
?>
<header>
    <div class="wrapper">
        <nav class="navbar navbar-expand-md fixed-top">
            <div class="container">


                <!-- logo -->
                <a class="navbar-brand justify-content-left" href="index.php">
                    <img src="../images/Front_images/top-logo.png" alt="logo">
                </a>

                <!-- Mobile Menu Open Button -->
                <span id="mobile-nav-open-btn">&#9776;</span>

                <div class="container">
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                        <ul class="nav navbar-nav pull-right">
                            <li class="nav-item">
                                <a class="item" href="search-notes.php">Search Notes</a>
                            </li>
                            <li class="nav-item">
                                <a class="item" href="dashboard.php">Sell Your Notes</a>
                            </li>
                            <li class="nav-item">
                                <a class="item" href="buyer-request.php">Buyer Request</a>
                            </li>
                            <li class="nav-item">
                                <a class="item" href="faq.php">FAQ</a>
                            </li>
                            <li class="nav-item">
                                <a class="item" href="contact-us.php">Contact Us</a>
                            </li>
                            <li>
                                <div class="dropdown">
                                    <a class="" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="<?php echo ($db_profile_picture == "") ? "../images/Front_images/default_profile.png" : "../profile pictures/$db_profile_picture" ?>" alt="user image" class="user-img img-responsive rounded-circle">
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="user-profile.php">my profile</a>
                                        <a class="dropdown-item" href="my-downloads.php">my downloads</a>
                                        <a class="dropdown-item" href="my-sold-notes.php">my sold notes</a>
                                        <a class="dropdown-item" href="my-rejected-notes.php">my rejected notes</a>
                                        <a class="dropdown-item" href="change-password.php">change password</a>
                                        <a class="dropdown-item logout-btn" href="includes/logout.php">logout</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-primary" href="includes/logout.php" type="button" role="button">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Mobile Menu-->
                <div id="mobile-nav">

                    <!--Mobile Menu Close Button -->
                    <span id="mobile-nav-close-btn">&times;</span>

                    <div id="mobile-nav-content">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="item" href="search-notes.php">Search Notes</a>
                            </li>
                            <li class="nav-item">
                                <a class="item" href="dashboard.php">Sell Your Notes</a>
                            </li>
                            <li class="nav-item">
                                <a class="item" href="buyer-request.php">Buyer Request</a>
                            </li>
                            <li class="nav-item">
                                <a class="item" href="faq.php">FAQ</a>
                            </li>
                            <li class="nav-item">
                                <a class="item" href="contact-us.php">Contact Us</a>
                            </li>
                            <li>
                                <div class="dropdown">
                                    <a class="" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="<?php echo ($db_profile_picture == "") ? "../images/Front_images/default_profile.png" : "../profile pictures/$db_profile_picture" ?>" alt="user image" class="user-img img-responsive rounded-circle">
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="user-profile.php">my profile</a>
                                        <a class="dropdown-item" href="my-downloads.php">my downloads</a>
                                        <a class="dropdown-item" href="my-sold-notes.php">my sold notes</a>
                                        <a class="dropdown-item" href="my-rejected-notes.php">my rejected notes</a>
                                        <a class="dropdown-item" href="change-password.php">change password</a>
                                        <a class="dropdown-item logout-btn" href="includes/logout.php">logout</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-primary" href="includes/logout.php" type="button" role="button">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>

<?php    
}else {
?>

<header>
    <div class="wrapper">
        <nav class="navbar navbar-expand-md fixed-top">
            <div class="container">


                <!-- logo -->
                <a class="navbar-brand justify-content-left" href="index.php">
                    <img style="margin-right: 100px" src="../images/Front_images/top-logo.png" alt="logo">
                </a>

                <!-- Mobile Menu Open Button -->
                <span id="mobile-nav-open-btn">&#9776;</span>
                <!-- Main Menu-->
                <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                    <ul class="nav navbar-nav pull-right">
                        <li class="nav-item">
                            <a class="item" href="search-notes.php">Search Notes</a>
                        </li>
                        <li class="nav-item">
                            <a class="item" href="login.php">Sell Your Notes</a>
                        </li>
                        <li class="nav-item">
                            <a class="item" href="faq.php">FAQ</a>
                        </li>
                        <li class="nav-item">
                            <a class="item" href="contact-us.php">Contact Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-primary" href="login.php" type="button" role="button">Login</a>
                        </li>
                    </ul>
                </div>

                <!-- Mobile Menu-->
                <div id="mobile-nav">

                    <!--Mobile Menu Close Button -->
                    <span id="mobile-nav-close-btn">&times;</span>

                    <div id="mobile-nav-content">
                        <ul class="nav">
                            <li>
                                <a href="search-notes.php">Search Notes</a>
                            </li>
                            <li>
                                <a href="login.php">Sell Your Notes</a>
                            </li>
                            <li>
                                <a href="faq.php">FAQ</a>
                            </li>
                            <li>
                                <a href="contact-us.php">Contact Us</a>
                            </li>
                            <li>
                                <a class="btn" href="login.php" type="button" role="button">Login</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>
      
<?php
        
    }
                        
?>
                    
					
				
	<!-- Header Ends -->


	<!-- Home -->
	<section id="home">
		<!-- Background video -->
		<img class="img-fluid img-responsive" src="../images/home/banner-with-overlay.jpg" alt="Home Image">

		<!-- Home Content-->
		<div id="home-content">

			<div id="home-content-inner">

				<div class="content-box-lg">
					<div class="container">
						<div class="row">
							<div class="col-md-8">

								<h1 class="heading" id="home-heading-1">Download Free/Paid Notes</h1><br>
								<h1 class="heading" id="home-heading-2">or Sale your Book</h1><br>

								<p class="pera">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt, necessitatibus ipsum dolor sit amet</p> <br>

								<a class="btn btn-general btn-home smooth-scroll" href="#about" title="Learn More" role="button">learn more</a>

							</div>
						</div>
					</div>
				</div>

			</div>

		</div>

	</section>
	<!-- Home Section Ended -->

	<!-- About -->
	<section id="about">

		<div class="content-box-lg">

			<div class="container">

				<div class="row">

					<!-- About left side -->
					<div class="col-md-5 col-sm-12 wow slideInLeft" data-wow-duration="1s">

						<div id="about-left">
							<div class="vertical-heading">
								<h2 class="heading">About</h2>
								<h2 class="heading">NotesMarketPlace</h2>
							</div>
						</div>

					</div>

					<!-- About right side -->
					<div class="col-md-7 col-sm-12 wow slideInRight" data-wow-duration="1s">

						<div id="about-right">
							<p class="pera">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quam dolor dignissimos doloremque expedita libero, tempora sequi dolore aspernatur enim nesciunt ducimus quibusdam voluptates voluptatum ut eum vitae ratione! Molestiae, ut voluptatum ut eum vitae ratione! Molestiae, ut?</p>

							<p class="pera">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda repellendus laboriosam esse sint ab velit doloribus dolores suscipit vitae officiis voluptate alias consequatur facilis, eveniet aliquam quasi soluta qui numquam.</p>
						</div>

					</div>

				</div>

			</div>

		</div>

	</section>
	<!-- About Ends -->

	<!-- work -->
	<section id="work">
		<div class="work">

			<div class="content-box-lg">

				<div class="container">

					<div class="row">

						<div class="col-md-12 col-sm-12 wow fadeInLeft">

							<div class="text-center">
								<h2 class="heading">How it Works</h2>
							</div>

						</div>

						<div class="col-md-6 col-sm-6 wow fadeInLeft">

							<div class="work-item text-center">
								<div class="img text-center">
									<img src="../images/Front_images/download.png" alt="download image" class="img-responsive">
								</div>
								<h3 class="heading">Download Free/Paid Notes</h3>
								<p class="pera">Get Material for your <br> Cource etc.</p>
								<a href="search-notes.php">
								    <input type="submit" class="btn btn-work" value="download">
								</a>
							</div>

						</div>
						<div class="col-md-6 col-sm-6 wow fadeInUp" data-wow-duration="2s">

							<div class="work-item text-center">
								<div class="img text-center">
									<img src="../images/Front_images/seller.png" alt="download image" class="img-responsive">
								</div>
								<h3 class="heading">Seller</h3>
								<p class="pera right">Upload and Download Cource<br>and Materials etc.</p>
								<a href="dashboard.php">
								    <input type="submit" class="btn btn-work" value="sell book">
                                </a>
							</div>

						</div>

					</div>

				</div>

			</div>

		</div>
	</section>
	<!-- work Ende-->

	<!-- Clients -->
	<section id="client">

		<div class="content-box-lg">

			<div class="container">

				<div class="row">

					<!-- Heading -->
					<div class="col-md-12 col-sm-12 wow fadeInLeft">

						<div class="text-center">
							<h2 class="heading">What our Customers are Saying</h2>
						</div>

					</div>

					<!-- Clients -->
					<div class="col-md-6 col-sm-6 col-xs-12 wow fadeIn" data-wow-duration="2s">

						<!-- testimonial 01 -->
						<div class="client-inner left">

							<div class="client-content">

								<div class="row">
									<div class="client-img">
										<img src="../images/Front_images/customer-1.png" alt="client" class="img-responsive img-circle">
									</div>

									<div class="client-name-des">
										<h3 class="heading">Walter Meller</h3>
										<p class="pera">Founder &amp; CEO, Matrix Group</p>
									</div>
								</div>

								<p class="pera"><i>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus impedit unde veniam, totam vitae hic earum dolores cum explicabo voluptate, repellendus cumque velit possimus."</i></p>

							</div>

						</div>

					</div>

					<div class="col-md-6 col-sm-6 col-xs-12 wow fadeIn" data-wow-duration="2s">

						<!-- testimonial 02 -->
						<div class="client-inner right">

							<div class="client-content">

								<div class="row">
									<div class="client-img">
										<img src="../images/Front_images/customer-2.png" alt="client" class="img-responsive img-circle">
									</div>

									<div class="client-name-des">
										<h3 class="heading">Jonnie Riley</h3>
										<p class="pera">Employee, Curios Snakcs Pvt. Ltd.</p>
									</div>
								</div>

								<p class="pera"><i>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus impedit unde veniam, totam vitae hic earum dolores cum explicabo voluptate, repellendus cumque velit possimus."</i></p>

							</div>

						</div>

					</div>

					<div class="col-md-6 col-sm-6 col-xs-12 wow fadeIn" data-wow-duration="2s">

						<!-- testimonial 03 -->
						<div class="client-inner left">

							<div class="client-content">

								<div class="row">

									<div class="client-img">
										<img src="../images/Front_images/customer-3.png" alt="client" class="img-responsive img-circle">
									</div>

									<div class="client-name-des">
										<h3 class="heading">Amilia Luna</h3>
										<p class="pera">Teacher, Sant Joseph High School</p>
									</div>
								</div>

								<p class="pera"><i>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus impedit unde veniam, totam vitae hic earum dolores cum explicabo voluptate, repellendus cumque velit possimus."</i></p>

							</div>

						</div>

					</div>

					<div class="col-md-6 col-sm-6 col-xs-12 wow fadeIn" data-wow-duration="2s">

						<!-- testimonial 04 -->
						<div class="client-inner right">

							<div class="client-content">

								<div class="row">
									<div class="client-img">
										<img src="../images/Front_images/customer-4.png" alt="client" class="img-responsive img-circle">
									</div>

									<div class="client-name-des">
										<h3 class="heading">Daniel Cardos</h3>
										<p class="pera">Software Engineer, Infin Company</p>
									</div>
								</div>

								<p class="pera"><i>"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus impedit unde veniam, totam vitae hic earum dolores cum explicabo voluptate, repellendus cumque velit possimus."</i></p>

							</div>

						</div>

					</div>


				</div>

			</div>

		</div>

	</section>
	<!-- client Ends -->

	<!-- Footer -->
	<footer>

		<div class="content-box-lg">
			<div class="container">
				<div class="row copyright">

					<div class="col-md-6 col-sm-12">
						<p class="pera">
							Copyright &copy; Tatvasoft All Rights Reserved.
						</p>
					</div>

					<div class="col-md-6 col-sm-12 justify-content-end">
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

	<!-- home Ends -->

	<!-- Add jquery-->
	<script src="../js/jquery.min.js"></script>

	<!-- jquery UI-->
	<script src="../js/jquery-ui/jquery-ui.js"></script>

	<!-- Bootstrap js -->
	<script src="../js/bootstrap/bootstrap.min.js"></script>

	<!-- Custom JS -->
	<script src="../js/home.js"></script>

</body>

</html>