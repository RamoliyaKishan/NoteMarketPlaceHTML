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
	<link rel="stylesheet" href="../css/add-review.css">

</head>


<body>

	<!-- Add Review Popup  -->
	<section id="add-review">
	
		<!-- Button trigger modal -->
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#popup">
			Click Me
		</button>
		

		<!-- Modal -->
		<div class="modal fade" id="popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<a href="" role="button" id="close-btn" data-toggle="modal" data-target="#popup">
							<img src="../images/Front_images/close.png" alt="heading image" class="field-icon" />
						</a>
						<h2 class="'text-left">Add Review</h2>
					</div>
					<div class="modal-body">

						<div id="stars">
							<!-- Stars -->
								<img class="star" src="../images/Front_images/star.png" alt="Star">
								<img class="star" src="../images/Front_images/star.png" alt="Star">
								<img class="star" src="../images/Front_images/star.png" alt="Star">
								<img class="star" src="../images/Front_images/star.png" alt="Star">
								<img class="star" src="../images/Front_images/star-white.png" alt="Star">
						</div>
						<span>Comments *</span>
						<textarea class="myInput" id="Comment" placeholder="Commments..." value=""></textarea>
						<a class="btn" href="" role="button" id="add-review-submit">submit</a>

					</div>

				</div>
			</div>
		</div>
	</section>
	<!-- Add Review PopUp End -->

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