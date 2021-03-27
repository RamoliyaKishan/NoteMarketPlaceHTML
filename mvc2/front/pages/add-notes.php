<?php ob_start(); ?>
<?php session_start(); ?>
<?php  include "includes/db.php"; ?>
<?php  include "includes/functions.php"; ?>
<?php

if(isset($_SESSION['UsersID'])) {
    
    $user_id = $_SESSION['UsersID'];
    $query = "SELECT FirstName, EmailID FROM users WHERE UsersID = '{$user_id}' ";
    $seller_detail = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($seller_detail);
    $seller_name = $row['FirstName'];
    $seller_email = $row['EmailID'];

    
    if(isset($_POST['save'])){
        
		$title = escape($_POST['title']);
		$type_id = escape($_POST['type']);
		$category_id = escape($_POST['category']);
		$pages = escape($_POST['pages']);
		$description = escape($_POST['description']);
		$country_id = escape($_POST['country']);
		$institute_name = escape($_POST['institute_name']);
		$course = escape($_POST['course']);
		$professor = escape($_POST['professor']);
		$course_code = escape($_POST['course_code']);
		$sell_for = escape($_POST['sell_for']);
		$price = escape($_POST['price']);
        
        $display_picture_filename        = escape($_FILES['display_picture']['name']);
        $temp_display_picture_filename   = escape($_FILES['display_picture']['tmp_name']);
            
        $note_filename        = escape($_FILES['note']['name']);
        $temp_note_filename   = escape($_FILES['note']['tmp_name']);
            
        $note_preview_filename        = escape($_FILES['note_preview']['name']);
        $temp_note_preview_filename   = escape($_FILES['note_preview']['tmp_name']);
        
        move_uploaded_file($temp_display_picture_filename, "../uploaded files/" . $display_picture_filename);
        move_uploaded_file($temp_note_filename, "../uploaded files/". $note_filename );
        move_uploaded_file($temp_note_preview_filename, "../uploaded files/" . $note_preview_filename);
        
        $query = "SELECT * FROM seller_notes WHERE SellerID = '{$user_id}' AND Title= '{$title}' AND Note = '{$note_filename}'";
        $select_notes_query = mysqli_query($connection, $query);
        if(!$select_notes_query) {
            die("QUERY FAILED" . mysqli_error($connection));
        }
        
        if(mysqli_num_rows($select_notes_query) > 0) {
            echo "<script type='text/javascript'>alert('You have already add this note. Try another for selle');</script>";
            $publish_button = "none";
        
            $title = "";
            $type_id = "";
            $category_id = "";
            $pages = "";
            $description = "";
            $country_id = "";
            $institute_name = "";
            $course = "";
            $professor = "";
            $course_code = "";
            $sell_for = "";
            $price = "";

            $display_picture_filename = "";
            $note_filename = "";
            $note_preview_filename = "";
        
        } else {
        
            $query = "INSERT INTO seller_notes (SellerID, Status , Title, Category , DisplayPicture, Note, NoteType , NumberofPages, Description, UniversityName, Country, Course, CourseCode, Professor, IsPaid, SellingPrice, NotesPreview, CreatedDate, CreatedBy) ";
            
            $query .= "VALUES ({$user_id}, 'Draft', '{$title}',  '{$category_id}', '{$display_picture_filename}', '{$note_filename}', '{$type_id}', '{$pages}', '{$description}', '{$institute_name}', '{$country_id}', '{$course}', '{$course_code}', '{$professor}', '{$sell_for}', '{$price}', '{$note_preview_filename}', now(), '{$user_id}')"; 

            $add_note_query = mysqli_query($connection, $query); 

            if(!$add_note_query){
                echo "query failed" . mysqli_error($connection);
            }else {
                $NoteID = mysqli_insert_id($connection);
            }
            $publish_button = "";
        }
        
    }else {
        
        if(isset($_GET['clone']) || isset($_GET['edit'])) {
            
            $NoteID = "";
            $query = "";
            if(isset($_GET['edit'])){
                $NoteID .= $_GET['edit'];
                $query .= "SELECT * FROM seller_notes WHERE NoteID = '{$NoteID}'";
                  
            }
            if(isset($_GET['clone'])) {
                $NoteID .= $_GET['clone'];
                $query .= "SELECT * FROM seller_notes WHERE NoteID = '{$NoteID}'";
            }
            
            $select_notes_query = mysqli_query($connection, $query);
            if(!$select_notes_query) {
                die("QUERY FAILED" . mysqli_error($connection));
            }
            
            while($row = mysqli_fetch_array($select_notes_query)) {
                
                if(isset($_GET['clone'])){
                    $note_id = "";
                }
                $note_id = $row['NoteID'];
                $title = $row['Title'];
                $type_id = $row['NoteType'];
                $category_id = $row['Category'];
                $pages = $row['NumberOfPages'];
                $description = $row['Description'];
                $country_id = $row['Country'];
                $institute_name = $row['UniversityName'];
                $course = $row['Course'];
                $professor = $row['Professor'];
                $course_code = $row['CourseCode'];
                $sell_for = $row['IsPaid'];
                $price = $row['SellingPrice'];

                $display_picture_filename = $row['DisplayPicture'];
                $note_filename = $row['Note'];
                $note_preview_filename = $row['NotesPreview'];            
            }
            if(isset($_POST['save'])){ 
                $query = "UPDATE seller_notes SET NoteID = '{$note_id}',
                SellerID={$user_id}, 
                Status = 'Draft', 
                ActionedBy='', 
                AdminRemarks = '',
                Title '{$title}',
                Category = '{$category_id}',
                DisplayPicture = '{$display_picture_filename}',
                Note = '{$note_filename}',
                NoteType = '{$type_id}',
                NumberofPages = '{$pages}',
                Description = '{$description}',
                UniversityName = '{$institute_name}',
                Country = '{$country_id}', 
                Course = '{$course}',
                CourseCode = '{$course_code}', 
                Professor = '{$professor}', 
                IsPaid = '{$sell_for}',
                SellingPrice = '{$price}',
                NotesPreview = '{$note_preview_filename}', 
                CreatedDate  =  now(), 
                CreatedBy = '{$user_id}' 
                WHERE NoteID = '{$NoteID}'";
                $update_post_query = mysqli_query($connection, $query);
                redirect("my-downloads.php");
            }
            if(isset($_POST['publish'])) {
                $query = "UPDATE seller_notes SET Status='Submitted', IsActive = '1',  ModifiedDate = now(), 
                ModifiedBy = '{$user_id}'   WHERE NoteID = '$NoteID'";
                $update_status_query = mysqli_query($connection, $query);

                // mail to admin for check published notes
                if($update_status_query){
                    
                    $query = "SELECT Value FROM system_configuration WHERE Key = 'AdminEmail' ";
                    $admin_detail = mysqli_query($connection, $query);
                    $row = mysqli_fetch_array($admin_detail);
                    $admin_email = $row['Value'];
                    
                    $to = $admin_email;
                    $from = "notemarketplace00@gmail.com";

                    $subject    = $seller_name . " sent his note for review";

                    $message      = "\r\n" . "Hello Admins, " . "\r\n" . "\r\n";
                    $message      .= "We want to inform you that, ".$seller_name." sent his note ".$title.". for review. Please look at the notes and take required actions.". "\r\n" . "\r\n";
                    $message      .= "Regards, " . "\r\n" . "Notes Marketplace";

                    $body =  "";
                    $body .= "Email From: " . $seller_email . "\r\n";
                    $body .= "Email To: " . $to . "\r\n";
                    $body .= "Subject: " . $subject . "\r\n";
                    $body .= "Body: " . "\r\n" . $message;

                    if(mail($to,$subject,$body))
                    {
                        echo "<script type='text/javascript'>alert('Thank you.');</script>";
                    }else{
                        echo "<script type='text/javascript'>alert('Please Try Again.');</script>";
                    }
                    
                    redirect("dashboard.php");
                }else{
                    echo "error" . mysqli_error($connection);
                }
            }
        }

        else {
        $publish_button = "none";
        
        $title = "";
        $type_id = "";
		$category_id = "";
		$pages = "";
		$description = "";
		$country_id = "";
		$institute_name = "";
		$course = "";
		$professor = "";
		$course_code = "";
		$sell_for = "";
		$price = "";
        
        $display_picture_filename = "";
        $note_filename = "";
        $note_preview_filename = "";
        }
    }
    
    if(isset($_POST['publish'])) {
        $query = "UPDATE seller_notes SET Status='Submitted', IsActive = '1' WHERE NoteID = '$NoteID'";
        $update_status_query = mysqli_query($connection, $query);
        
            // mail to admin for check published notes
        $query = "SELECT Value FROM system_configuration WHERE Key = 'AdminEmail' ";
        $admin_detail = mysqli_query($connection, $query);
        $row = mysqli_fetch_array($admin_detail);
        $admin_email = $row['Value'];
        
        $to = $admin_email;
        $from = "notemarketplace00@gmail.com";

        $subject    = $seller_name . " sent his note for review";

        $message      = "\r\n" . "Hello Admins, " . "\r\n" . "\r\n";
        $message      .= "We want to inform you that, ".$seller_name." sent his note ".$title.". for review. Please look at the notes and take required actions.". "\r\n" . "\r\n";
        $message      .= "Regards, " . "\r\n" . "Notes Marketplace";

        $body =  "";
        $body .= "Email From: " . $seller_email . "\r\n";
        $body .= "Email To: " . $to . "\r\n";
        $body .= "Subject: " . $subject . "\r\n";
        $body .= "Body: " . "\r\n" . $message;

        if(mail($to,$subject,$body))
        {
            echo "<script type='text/javascript'>alert('Thank you.');</script>";
        }else{
            echo "<script type='text/javascript'>alert('Please Try Again.');</script>";
        }
        
        redirect("dashboard.php");
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
	<link rel="stylesheet" href="../css/add-notes.css">

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

						<div class="col-md-12 col-sm-12 wow fadeIn">

							<div id="top-heading" class="text-center">

								<h3>Add Notes</h3>
								
							</div>

						</div>

					</div>

				</div>

			</div>

		</section>
	<!-- Top Content Ends -->
	
	<!-- Add Notes -->
	<section id="add-notes">

		
		<div class="content-box-lg">

			<div class="container">
                
                <form class="myForm text-left" autocomplete=" <?php echo $auto_complete; ?>" method="POST" enctype="multipart/form-data">
				
                <!-- form 1 -->
                <div class="row">
                    
					<div class="col-md-12 col-sm-12">
						<div class="text-left">
							<h2 class="heading">Basic Note Details</h2>
						</div>
					</div>
					
					<div class="col-md-6 col-sm-12">
						
						<div class="user-profile-left">

								<div class="form-group">
									<label class="form-label">Title *</label>
									<input class="myInput" placeholder="Enter your note title" type="text" id="title" name="title" value="<?php echo "$title"; ?>" required>
								</div>
								
								<div class="form-group ">
									<label class="form-label">Display Picture</label>

									<div class="image-upload">
										<label class="myInput text-center" for="display_picture">
											<img src="../images/Front_images/upload-file.png" class="img-responsive img-fluid" />
											<p>Upload a Picture</p>
										</label>
										<input id="display_picture" name="display_picture" value="<?php echo "$display_picture_filename"; ?>" type="file" accept="image/*" />
										<div id="display_picture_filename"><?php echo "$display_picture_filename"; ?></div>
									</div>
								</div>
								
								<div class="form-group">
									<label class="form-label">Type</label>
									<div class="select-type">
										<select class="myInput" id="type" name="type" required>
											<option selected disabled>Select your note type</option>
											<?php

                                                $query = "SELECT * FROM note_types";
                                                $select_type = mysqli_query($connection,$query);
                                                
                                                while($row = mysqli_fetch_assoc($select_type )) {
                                                    $TypeID  = $row['TypeID'];
                                                    $TypeName = $row['TypeName'];
                                                    
                                                    if($type_id == $TypeID) {
                                                        echo "<option class='option' selected value='$TypeID'>{$TypeName}</option>";
                                                    }
                                                    else {
                                                    echo "<option class='option' value='$TypeID'>{$TypeName}</option>";
                                                    }
                                                    
                                                
                                                    
                                                }

                                            ?>
											
										</select>
									</div>
									
								</div>
						</div>
						
					</div>
					
					<!-- Right Side -->
					<div class="col-md-6 col-sm-12">
						
						<div class="user-profile-right">

								<div class="form-group">
									<label class="form-label">Category *</label>
									<div class="select-type">
										<select class="myInput" id="category" name="category" required>
                                        
                                            <option selected disabled>Select your note type</option>
										    <?php

                                                $query = "SELECT * FROM note_categories";
                                                $select_categories = mysqli_query($connection,$query);
                                            
                                                
                                                
                                                while($row = mysqli_fetch_array($select_categories )) {
                                                    $CategoryID  = $row['CategoryID'];
                                                    $CategoryName = $row['CategoryName'];

                                                    if($category_id == $CategoryID) {
                                                         echo "<option class='option' value=$CategoryID selected>{$CategoryName}</option>";
                                                    }
                                                    else {
                                                    echo "<option class='option' value=$CategoryID>{$CategoryName}</option>";
                                                    }
                                                    
                                                }

                                            ?>
										</select>
									</div>
									
								</div>
								
								<div class="form-group">
									<label class="form-label">Upload Notes *</label>

									<div class="image-upload">
										<label class="myInput text-center" for="note">
											<img src="../images/Front_images/upload-note.png" class="img-responsive img-fluid" />
											<p>Upload your Notes </p>
										</label>
										<input id="note" name="note" type="file" value="<?php echo "$note_filename"; ?>" accept=".pdf,.docx, .txt" />
										<div id="note_filename"><?php echo "$note_filename"; ?></div>
									</div>

								</div>

								<div class="form-group">
									<label class="form-label">Number of pages</label>
									<input class="myInput" placeholder="Enter number of note pages" type="text" id="pages" name="pages" value="<?php echo "$pages"; ?>" required>
								</div>								
							
						</div>
						
					</div>
					
					<div class="col-md-12 col-sm-12">
							<div class="form-group">
								<label class="form-label">Description *</label>
								<textarea class="myInput" id="description" name="description" placeholder="Enter your description"><?php echo "$description"; ?></textarea>
							</div>
					</div>
					
				</div>

		
		        <!-- form 2 -->

				<div class="row">

					<div class="col-md-12 col-sm-12">
						<div class="text-left">
							<h2 class="heading" style="margin-top: 60px">Institution Information</h2>
						</div>
					</div>
					
					<div class="col-md-6 col-sm-12">
						
						<div class="user-profile-left">
                            
								<div class="form-group">
									<label class="form-label">Country</label>
									<select class="myInput" id="country" name="country" required>
											<option selected disabled>Select your country </option>
											<?php

                                                $query = "SELECT * FROM countries";
                                                $select_countries = mysqli_query($connection,$query);
                                            
                                                
                                                
                                                while($row = mysqli_fetch_assoc($select_countries)) {
                                                    $CountryID  = $row['CountryID'];
                                                    $CountryName = $row['CountryName'];
                                                    
                                                    if($country_id == $CountryID) {
                                                        echo "<option class='option' value=$CountryID selected>{$CountryName}</option>";
                                                    }
                                                    else {
                                                    echo "<option class='option' value=$CountryID>{$CountryName}</option>";
                                                    }

                                                }

                                            ?>
											
										</select>
									
								</div>
								
						</div>
						
					</div>
					
					<!-- Right Side -->
					<div class="col-md-6 col-sm-12">
						
						<div class="user-profile-right">
                            
								<div class="form-group">
									<label class="form-label">Institution Name</label>
									<input class="myInput" placeholder="Enter your institution name" type="text" id="institute_name" name="institute_name" value="<?php echo "$institute_name"; ?>">
									
								</div>
								
						</div>
						
					</div>
					
				</div>
		
		        
		        <!-- form 3 -->

				<div class="row">

					<div class="col-md-12 col-sm-12">
						<div class="text-left">
							<h2 class="heading" style="margin-top: 30px">Course Detais</h2>
						</div>
					</div>
					
					<div class="col-md-6 col-sm-12">
						
						<div class="user-profile-left">
                            
								<div class="form-group">
									<label class="form-label">Course Name</label>
									<input class="myInput" placeholder="Enter your Course Name" type="text" id="course" name="course" value="<?php echo "$course"; ?>">
								</div>
								
								<div class="form-group">
									<label class="form-label">Professor / Lecturer</label>
									<input class="myInput" placeholder="Enter your Professor Name" type="text" id="professor" name="professor" value="<?php echo "$professor"; ?>">
								</div>
								
						</div>
						
					</div>
					
					<!-- Right Side -->
					<div class="col-md-6 col-sm-12">
						
						<div class="user-profile-right">


								<div class="form-group">
									<label class="form-label">Course Code</label>
									<input class="myInput" placeholder="Enter your course code" type="text" id="course-code" name="course_code" value="<?php echo "$course_code"; ?>">
									
								</div>
								
						</div>
						
					</div>
					
				</div>
		
		        
		        <!-- form 4 -->
		        
				<div class="row">

					<div class="col-md-12 col-sm-12">
						<div class="text-left">
							<h2 class="heading" style="margin-top: 60px">Selling Information</h2>
						</div>
					</div>
					
					<div class="col-md-6 col-sm-12">
						
						<div class="user-profile-left">

								
								<div class="form-group">
									<label class="form-label">Sell for *</label><br>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="sell_for" id="free" value="0" required <?php echo ($sell_for == 0 ) ? 'checked' : ""; ?> />
										<label class="form-label" for="free">Free</label>
									</div>
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio" name="sell_for" id="paid" value="1" <?php echo ($sell_for == 1 ) ? 'checked' : ""; ?> >
										<label class="form-label" for="paid">Paid</label>
									</div>
								</div>

								<div class="form-group">
									<label class="form-label">Sell Price*</label>
									<input class="myInput" placeholder="Enter your price" type="text" id="price" name="price" value="<?php echo "$price"; ?>">
								</div>
								
								
						</div>
						
					</div>
					
					<!-- Right Side -->
					<div class="col-md-6 col-sm-12">
						
						<div class="user-profile-left">


								<div class="form-group ">
									<label class="form-label">Note Preview</label>

									<div class="image-upload">
										<label class="myInput text-center last" for="note_preview">
											<img src="../images/Front_images/upload-file.png" class="img-responsive img-fluid" />
											<p>Upload a File</p>
										</label>
										<input id="note_preview" name="note_preview" value="<?php echo "$note_preview_filename"; ?>" type="file" accept="application/pdf" />
										<div id="note_preview_filename"><?php echo "$note_preview_filename"; ?></div>
									</div>
								</div>
								
						</div>
						
					</div>
					
					<!--  Buttons  -->
					<div class="col-md-12 col-sm-12">
							<div class="buttons">
									<div class="last">
										<input type="submit" class="btn" name="save" id="save" value="SAVE">
										
										<input type="submit" style="display: <?php echo $publish_button; ?> ;" class="btn" name="publish" id="publish" value="PUBLISH">
									</div>
							</div>
					</div>
					
				</div>
            
            </form>
			</div>

		</div>
		

	</section>
	<!--  Ends -->
	
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