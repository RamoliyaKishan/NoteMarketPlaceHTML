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
            $user_id = $_SESSION['UsersID'];
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

                                <div class="col-md-2 col-sm-4" style="padding: 0 10px 0 0">
                                    <div class="form-group">
                                        <select class="myInput common" id="type" name="type">
                                            <option selected disabled>Select type</option>
                                            <?php

                                                $query = "SELECT * FROM note_types ORDER BY TypeName ASC";
                                                $select_type = mysqli_query($connection,$query);

                                                while($row = mysqli_fetch_assoc($select_type)) {
                                                    $TypeID  = $row['TypeID'];
                                                    $TypeName = $row['TypeName'];

                                                    echo "<option class='option' value='$TypeID'>{$TypeName}</option>";
                                                }

                                            ?>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2 col-sm-4" style="padding: 0 10px">
                                    <div class="form-group">
                                        <div class="select-type">
                                            <select class="myInput common" id="category" name="category">
                                                <option selected disabled>Select category</option>
                                                <?php

                                                    $query = "SELECT * FROM note_categories ORDER BY CategoryName ASC";
                                                    $select_categories = mysqli_query($connection,$query);

                                                    while($row = mysqli_fetch_array($select_categories)) {
                                                        $CategoryID  = $row['CategoryID'];
                                                        $CategoryName = $row['CategoryName'];

                                                        echo "<option class='option' value=$CategoryID>{$CategoryName}</option>";
                                                    }

                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2 col-sm-4" style="padding: 0 10px">
                                    <div class="form-group">
                                        <select class="myInput common" id="university" name="university">
                                            <option selected disabled>Select university</option>
                                            <?php
                                                $query = "SELECT DISTINCT(UniversityName) FROM seller_notes ORDER BY UniversityName ASC";
                                                $select_university = mysqli_query($connection,$query);

                                                while($row = mysqli_fetch_array($select_university)) {
                                                    $UniversityName = $row['UniversityName'];

                                                    echo "<option class='option' value=$UniversityName>{$UniversityName}</option>";
                                                }
                                            ?>
                                        </select>
                                        </div>
                                </div>

                                <div class="col-md-2 col-sm-4" style="padding: 0 10px">
                                    <div class="form-group">
                                        <select class="myInput common" id="course" name="course">
                                            <option selected disabled>Select course</option>
                                            <?php
                                                $query = "SELECT DISTINCT(Course) FROM seller_notes ORDER BY Course ASC";
                                                $select_course = mysqli_query($connection,$query);

                                                while($row = mysqli_fetch_array($select_course)) {
                                                    $Course = $row['Course'];

                                                    echo "<option class='option' value=$Course>{$Course}</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2 col-sm-4" style="padding: 0 10px">
                                    <div class="form-group">
                                        <select class="myInput common" id="country" name="country">
                                            <option selected disabled>Select country </option>
                                            <?php
                                                $query = "SELECT * FROM countries ORDER BY CountryName ASC";
                                                $select_countries = mysqli_query($connection,$query);

                                                while($row = mysqli_fetch_assoc($select_countries)) {
                                                    $CountryID  = $row['CountryID'];
                                                    $CountryName = $row['CountryName'];

                                                    echo "<option class='option' value=$CountryID>{$CountryName}</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2 col-sm-4" style="padding: 0 0 0 10px">
                                    <div class="form-group">
                                        <select class="myInput common" id="rating" name="rating">
                                            <option selected disabled>Select rating</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
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

			<div class="container" id="notes_list">
				
				
            </div>
				<!-- Pagination -->
				<div class="container">
				<div class="row text-center">

					<div class="col-md-12 col-sm-12" id="pagination">
						
                        
					</div>
				
				</div>	

			</div>

		</div>
		
		

	</section>
	<!--  Ends -->

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

	<!-- User Profile Ends -->

	<!-- Add jquery-->
	<script src="../js/jquery.min.js"></script>

	<!-- jquery UI-->
	<script src="../js/jquery-ui/jquery-ui.js"></script>
	
	<!-- Pagination jquery UI-->
	<script src="../js/simplePagination.js"></script>

	<!-- Bootstrap js -->
	<script src="../js/bootstrap/bootstrap.min.js"></script>
	
	<!-- DataTable JS -->
    <script src="../js/DataTables/datatables.js"></script>

	<!-- Custom JS -->
	<script src="../js/script.js"></script>
	<script>
        $(function() {
    
            filter_data();

            function filter_data() {   
                var action = 'filter';
                var search = $('#search').val();
                var type = $('#type').val();
                var category = $('#category').val();
                var university = $('#university').val();
                var course = $('#course').val();
                var country = $('#country').val();
                var rating = $('#rating').val();

                $.ajax({
                    url: "includes/search_filter.php",
                    method: "POST",
                    data: {action: action, search : search, type : type, category: category, university: university, course: course, country:country, rating: rating}, 
                    success: function(data){
                        $('#notes_list').html(data);
                    }
                });
            }

            $('.common').on('change', function(){
                filter_data();
            });

            $('#search').on('keyup', function() {
                filter_data();
            });
        });
        
        
        
    </script>
    
    
</body>

</html>