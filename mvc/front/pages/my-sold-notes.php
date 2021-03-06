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
	
	<!-- DataTable CSS -->
    <link rel="stylesheet" href="../css/DataTables/datatables.css">

	<!-- Custom Css -->
	<link rel="stylesheet" href="../css/my-sold-notes.css">

</head>

<body>

	<!-- Header -->
	<header>
		<div class="wrapper">
			<nav class="navbar navbar-expand-md">
				<div class="container">

					<!-- logo -->
						<a class="navbar-brand" href="#">
							<img src="../images/Front_images/logo.png" alt="logo">
						</a>

						<!-- Mobile Menu Open Button -->
						<span id="mobile-nav-open-btn">&#9776;</span>

					<!-- Main Menu-->
					<div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
						<ul class="nav navbar-nav pull-right">
							<li class="nav-item">
								<a class="item" href="search-notes.html">Search Notes</a>
							</li>
							<li class="nav-item">
								<a class="item" href="add-notes.html">Sell Your Notes</a>
							</li>
							<li class="nav-item">
								<a class="item" href="buyer-request.html">Buyer Request</a>
							</li>
							<li class="nav-item">
								<a class="item" href="faq.html">FAQ</a>
							</li>
							<li class="nav-item">
								<a class="item" href="contact-us.html">Contact Us</a>
							</li>
							<li>
								<div class="dropdown">
									<a class="" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<img src="../images/Front_images/user-img.png" alt="user image" class="user-img img-responsive rounded-circle">
									</a>
									
									<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    									<a class="dropdown-item" href="user-profile.html">my profile</a>
    									<a class="dropdown-item" href="my-downloads.html">my downloads</a>
    									<a class="dropdown-item" href="my-sold-notes.html">my sold notes</a>
    									<a class="dropdown-item" href="my-rejected-notes.html">my rejected notes</a>
										<a class="dropdown-item" href="change-password.html">change password</a>
										<a class="dropdown-item logout-btn" href="login.html">logout</a>
									</div>
								</div>
							</li>
							<li class="nav-item">
								<a class="btn btn-primary" href="login.html" type="button" role="button">Logout</a>
							</li>
						</ul>
					</div>
					
					<!-- Mobile Menu-->
					<div id="mobile-nav">

						<!--Mobile Menu Close Button -->
						<span id="mobile-nav-close-btn">&times;</span>

						<div id="mobile-nav-content">
							<ul class="nav">
							<li class="nav-item">
								<a class="item" href="search-notes.html">Search Notes</a>
							</li>
							<li class="nav-item">
								<a class="item" href="add-notes.html">Sell Your Notes</a>
							</li>
							<li class="nav-item">
								<a class="item" href="buyer-request.html">Buyer Request</a>
							</li>
							<li class="nav-item">
								<a class="item" href="faq.html">FAQ</a>
							</li>
							<li class="nav-item">
								<a class="item" href="contact-us.html">Contact Us</a>
							</li>
							<li>
								<div class="dropdown">
									<a class="" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<img src="../images/Front_images/user-img.png" alt="user image" class="user-img img-responsive rounded-circle">
									</a>
									
									<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    									<a class="dropdown-item" href="user-profile.html">my profile</a>
    									<a class="dropdown-item" href="my-downloads.html">my downloads</a>
    									<a class="dropdown-item" href="my-sold-notes.html">my sold notes</a>
    									<a class="dropdown-item" href="my-rejected-notes.html">my rejected notes</a>
										<a class="dropdown-item" href="change-password.html">change password</a>
										<a class="dropdown-item logout-btn" href="login.html">logout</a>
									</div>
								</div>
							</li>
							<li class="nav-item">
								<a class="btn btn-primary" href="#" type="button" role="button">Logout</a>
							</li>
							</ul>
						</div>
					</div>
					
				</div>
			</nav>
		</div>
	</header>
	<!-- Header Ends -->
	
	 <!-- My Sold Notes table -->
    <div class="notes-table">
		<div class="content-box-lg">
			<div class="container">
        		
        		<div class="row">
					<div class="col-md-6 col-sm-12">
						<h2 class="heading sold-notes-heading">My Sold Notes</h2>
					</div>
					<div class="col-md-6 col-sm-12 search-content">	
						<span toggle="#search" class="fa fa-search field-icon"></span>
						<input class="myInput" placeholder="Search" type="search" id="sold-notes-search" value="">
						<a class="btn" href="" role="button" id="sold-notes-search-btn">search</a>
					</div>
				</div>
				
				<!-- data table -->
				<table id="my-sold-notes-table" class="datatable table table-responsive-md display">
                    <thead>
                        <tr>
                        	<th>SR No.</th>
                            <th>NOte Title</th>
                            <th>Category</th>
                            <th>Buyer</th>
                            <th>Sell Type</th>
                            <th>price</th>
                            <th>Downloaded Date/Time</th>
                            <th></th>
                        </tr>
                    </thead>
        
                    <tbody>
                       
                        <tr>
                        	<td>1</td>
                            <td>Data Science</td>
                            <td>Science</td>
                            <td>testting123@gmail.com</td>
                            <td>Paid</td>
                            <td>250$</td>
                            <td>27 Nov 2020, 11:24:34</td>
                            <td>
                                <span class="action-icons">
									<img src="../images/Front_images/eye.png" alt="view Icon" class="view-icon">
                                   
                                   	<div class="dropleft dropdown">
										<a href="#" role="button" id="downloads-notes-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<img src="../images/Front_images/dots.png" alt="delete" class="dots-icon">
										</a>
									
										<div class="dropdown-menu" aria-labelledby="downloads-notes-menu" >
    										<a class="dropdown-item" href="#">download Notes</a>
										</div>
									</div>
                                </span>
                            </td>
                        </tr>
                        <tr>
                        	<td>2</td>
                            <td>Accounts</td>
                            <td>Commerce</td>
                            <td>testting123@gmail.com</td>
                            <td>Free</td>
                            <td>0$</td>
                            <td>27 Nov 2020, 11:24:34</td>
                            <td>
                                <span class="action-icons">
                                    <img src="../images/Front_images/eye.png" alt="view Icon" class="view-icon">
                                    <div class="dropdown dropleft">
										<a href="#" role="button" id="downloads-notes-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<img src="../images/Front_images/dots.png" alt="delete" class="dots-icon">
										</a>
									
										<div class="dropdown-menu" aria-labelledby="downloads-notes-menu" >
    										<a class="dropdown-item" href="#">download Notes</a>
										</div>
									</div>
                                </span>
                            </td>
                        </tr>
                        <tr>
                        	<td>3</td>
                            <td>Social Studies</td>
                            <td>Social</td>
                            <td>testting123@gmail.com</td>
                            <td>Free</td>
                            <td>0$</td>
                            <td>27 Nov 2020, 11:24:34</td>
                            <td>
                                <span class="action-icons">
                                    <img src="../images/Front_images/eye.png" alt="view Icon" class="view-icon">
                                    <div class="dropdown dropleft">
										<a href="#" role="button" id="downloads-notes-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<img src="../images/Front_images/dots.png" alt="delete" class="dots-icon">
										</a>
									
										<div class="dropdown-menu" aria-labelledby="downloads-notes-menu" >
    										<a class="dropdown-item" href="#">download Notes</a>
										</div>
									</div>
                                </span>
                            </td>
                        </tr>
                        <tr>
                        	<td>4</td>
                            <td>AI</td>
                            <td>IT</td>
                            <td>testting123@gmail.com</td>
                            <td>Paid</td>
                            <td>158$</td>
                            <td>27 Nov 2020, 11:24:34</td>
                            <td>
                                <span class="action-icons">
                                    <img src="../images/Front_images/eye.png" alt="view Icon" class="view-icon">
                                    <div class="dropdown dropleft">
										<a href="#" role="button" id="downloads-notes-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<img src="../images/Front_images/dots.png" alt="delete" class="dots-icon">
										</a>
									
										<div class="dropdown-menu" aria-labelledby="downloads-notes-menu" >
    										<a class="dropdown-item" href="#">download Notes</a>
										</div>
									</div>
                                </span>
                            </td>
                        </tr>
                        <tr>
                        	<td>5</td>
                            <td>Lorem ipsum</td>
                            <td>Lorem</td>
                            <td>testting123@gmail.com</td>
                            <td>Free</td>
                            <td>0$</td>
                            <td>27 Nov 2020, 11:24:34</td>
                            <td>
                                <span class="action-icons">
                                    <img src="../images/Front_images/eye.png" alt="view Icon" class="view-icon">
                                    <div class="dropdown dropleft">
										<a href="#" role="button" id="downloads-notes-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<img src="../images/Front_images/dots.png" alt="delete" class="dots-icon">
										</a>
									
										<div class="dropdown-menu" aria-labelledby="downloads-notes-menu" >
    										<a class="dropdown-item" href="#">download Notes</a>
										</div>
									</div>
                                </span>
                            </td>
                        </tr>
                        <tr>
                        	<td>6</td>
                            <td>Data Science</td>
                            <td>Science</td>
                            <td>testting123@gmail.com</td>
                            <td>Paid</td>
                            <td>555$</td>
                            <td>27 Nov 2020, 11:24:34</td>
                            <td>
                                <span class="action-icons">
									<img src="../images/Front_images/eye.png" alt="view Icon" class="view-icon">
                                   
                                   	<div class="dropleft dropdown">
										<a href="#" role="button" id="downloads-notes-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<img src="../images/Front_images/dots.png" alt="delete" class="dots-icon">
										</a>
									
										<div class="dropdown-menu" aria-labelledby="downloads-notes-menu" >
    										<a class="dropdown-item" href="#">download Notes</a>
										</div>
									</div>
                                </span>
                            </td>
                        </tr>
                        <tr>
                        	<td>7</td>
                            <td>Accounts</td>
                            <td>Commerce</td>
                            <td>testting123@gmail.com</td>
                            <td>Free</td>
                            <td>0$</td>
                            <td>27 Nov 2020, 11:24:34</td>
                            <td>
                                <span class="action-icons">
                                    <img src="../images/Front_images/eye.png" alt="view Icon" class="view-icon">
                                    <div class="dropdown dropleft">
										<a href="#" role="button" id="downloads-notes-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<img src="../images/Front_images/dots.png" alt="delete" class="dots-icon">
										</a>
									
										<div class="dropdown-menu" aria-labelledby="downloads-notes-menu" >
    										<a class="dropdown-item" href="#">download Notes</a>
										</div>
									</div>
                                </span>
                            </td>
                        </tr>
                        <tr>
                        	<td>8</td>
                            <td>Social Studies</td>
                            <td>Social</td>
                            <td>testting123@gmail.com</td>
                            <td>Free</td>
                            <td>0$</td>
                            <td>27 Nov 2020, 11:24:34</td>
                            <td>
                                <span class="action-icons">
                                    <img src="../images/Front_images/eye.png" alt="view Icon" class="view-icon">
                                    <div class="dropdown dropleft">
										<a href="#" role="button" id="downloads-notes-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<img src="../images/Front_images/dots.png" alt="delete" class="dots-icon">
										</a>
									
										<div class="dropdown-menu" aria-labelledby="downloads-notes-menu" >
    										<a class="dropdown-item" href="#">download Notes</a>
										</div>
									</div>
                                </span>
                            </td>
                        </tr>
                        <tr>
                        	<td>9</td>
                            <td>AI</td>
                            <td>IT</td>
                            <td>testting123@gmail.com</td>
                            <td>Paid</td>
                            <td>250$</td>
                            <td>27 Nov 2020, 11:24:34</td>
                            <td>
                                <span class="action-icons">
                                    <img src="../images/Front_images/eye.png" alt="view Icon" class="view-icon">
                                    <div class="dropdown dropleft">
										<a href="#" role="button" id="downloads-notes-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<img src="../images/Front_images/dots.png" alt="delete" class="dots-icon">
										</a>
									
										<div class="dropdown-menu" aria-labelledby="downloads-notes-menu" >
    										<a class="dropdown-item" href="#">download Notes</a>
										</div>
									</div>
                                </span>
                            </td>
                        </tr>
                        <tr>
                        	<td>10</td>
                            <td>Lorem ipsum</td>
                            <td>Lorem</td>
                            <td>testting123@gmail.com</td>
                            <td>Paid</td>
                            <td>115$</td>
                            <td>27 Nov 2020, 11:24:34</td>
                            <td>
                                <span class="action-icons">
                                    <img src="../images/Front_images/eye.png" alt="view Icon" class="view-icon">
                                    <div class="dropdown dropleft">
										<a href="#" role="button" id="downloads-notes-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<img src="../images/Front_images/dots.png" alt="delete" class="dots-icon">
										</a>
									
										<div class="dropdown-menu" aria-labelledby="downloads-notes-menu" >
    										<a class="dropdown-item" href="#">download Notes</a>
										</div>
									</div>
                                </span>
                            </td>
                        </tr>
                        <tr>
                        	<td>11</td>
                            <td>Social Studies</td>
                            <td>Social</td>
                            <td>testting123@gmail.com</td>
                            <td>Free</td>
                            <td>0$</td>
                            <td>27 Nov 2020, 11:24:34</td>
                            <td>
                                <span class="action-icons">
                                    <img src="../images/Front_images/eye.png" alt="view Icon" class="view-icon">
                                    <div class="dropdown dropleft">
										<a href="#" role="button" id="downloads-notes-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<img src="../images/Front_images/dots.png" alt="delete" class="dots-icon">
										</a>
									
										<div class="dropdown-menu" aria-labelledby="downloads-notes-menu" >
    										<a class="dropdown-item" href="#">download Notes</a>
										</div>
									</div>
                                </span>
                            </td>
                        </tr>
                        <tr>
                        	<td>12</td>
                            <td>AI</td>
                            <td>IT</td>
                            <td>testting123@gmail.com</td>
                            <td>Paid</td>
                            <td>250$</td>
                            <td>27 Nov 2020, 11:24:34</td>
                            <td>
                                <span class="action-icons">
                                    <img src="../images/Front_images/eye.png" alt="view Icon" class="view-icon">
                                    <div class="dropdown dropleft">
										<a href="#" role="button" id="downloads-notes-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<img src="../images/Front_images/dots.png" alt="delete" class="dots-icon">
										</a>
									
										<div class="dropdown-menu" aria-labelledby="downloads-notes-menu" >
    										<a class="dropdown-item" href="#">download Notes</a>
										</div>
									</div>
                                </span>
                            </td>
                        </tr>
                        <tr>
                        	<td>13</td>
                            <td>Lorem ipsum</td>
                            <td>Lorem</td>
                            <td>testting123@gmail.com</td>
                            <td>Paid</td>
                            <td>115$</td>
                            <td>27 Nov 2020, 11:24:34</td>
                            <td>
                                <span class="action-icons">
                                    <img src="../images/Front_images/eye.png" alt="view Icon" class="view-icon">
                                    <div class="dropdown dropleft">
										<a href="#" role="button" id="downloads-notes-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<img src="../images/Front_images/dots.png" alt="delete" class="dots-icon">
										</a>
									
										<div class="dropdown-menu" aria-labelledby="downloads-notes-menu" >
    										<a class="dropdown-item" href="#">download Notes</a>
										</div>
									</div>
                                </span>
                            </td>
                        </tr>
                        
                        
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