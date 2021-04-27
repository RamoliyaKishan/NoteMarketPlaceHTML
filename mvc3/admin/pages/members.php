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
	
	<!-- DataTable CSS -->
    <link rel="stylesheet" href="../css/DataTables/datatables.css">

	<!-- Custom Css -->
	<link rel="stylesheet" href="../css/members.css">

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
    	
	 <!-- manage-category table -->
    <div class="notes-table">
		<div class="content-box-lg">
			<div class="container">
        
        		<div class="row members-heading box">
					<div class="col-md-6 col-sm-6">
						<h2 class="heading">Members</h2>
					</div>
					<div class="col-md-6 col-sm-6 search-content">
						<span toggle="#search" class="fa fa-search field-icon"></span>
						<input class="myInput" placeholder="Search" type="search" id="search" value="">
						<a class="btn" href="" role="button" id="search-btn">search</a>
					</div>
				</div>
				
				<!-- data table -->
				<table id="members-table" class="datatable table table-responsive display">
                    <thead>
                        <tr>
                        	<th>SR No.</th>
                            <th>first name</th>
                            <th>last name</th>
                            <th>email</th>
                            <th>joining_added</th>
                            <th>Update review notes</th>
                            <th>published notes</th>
                            <th>downloaded notes</th>
                            <th>total expenses</th>
                            <th>total earnings</th>
                            <th></th>
                        </tr>
                    </thead>
        
                    <tbody>
                        
                        <?php
                            
                            $i = 1;
                            
                            $query = "SELECT * FROM users WHERE RoleID = '1' ORDER BY CreatedDate DESC";
                        
                            $select_all_users_query = mysqli_query($connection, $query);
                            if (!$select_all_users_query) {
                                die("QUERY FAILED" . mysqli_error($connection));
                            }

                            $notes_count = mysqli_num_rows($select_all_users_query);

                            while($row = mysqli_fetch_assoc($select_all_users_query )) {
                                
                                $db_UsersID = $row['UsersID'];
                                $db_FirstName = $row['FirstName'];
                                $db_LastName = $row['LastName'];
                                $db_EmailID = $row['EmailID'];
                                $db_CreatedDate = $row['CreatedDate'];
                                $db_CreatedDate = date('d-m-Y, h:m:s',strtotime($db_CreatedDate));
                                
                                
                                $query = "SELECT * FROM seller_notes WHERE SellerID = '{$db_UsersID}' AND (Status = 'Submited for Review' OR Status = 'In Review')";
                                $notes_query = mysqli_query($connection, $query);
                                $under_review = mysqli_num_rows($notes_query);
                                
                                $query = "SELECT * FROM seller_notes WHERE SellerID = '{$db_UsersID}' AND Status = 'Published'";
                                $notes_query = mysqli_query($connection, $query);
                                $pubished = mysqli_num_rows($notes_query);
                                
                                $query = "SELECT * FROM downloads WHERE DownloaderID = '{$db_UsersID}' AND IsSellerHasAllowedDownload = '1'";
                                $notes_query = mysqli_query($connection, $query);
                                $downloaded = mysqli_num_rows($notes_query);
                                $expenses = 0;
                                while($row = mysqli_fetch_array($notes_query)){
                                    $expenses += $row['PurchasedPrice'];
                                }
                                
                                $query = "SELECT * FROM downloads WHERE SellerID = '{$db_UsersID}' AND IsSellerHasAllowedDownload = '1'";
                                $notes_query = mysqli_query($connection, $query);
                                $earnings = 0;
                                while($row = mysqli_fetch_array($notes_query)){
                                    $earnings += $row['PurchasedPrice'];
                                }
                                
                                echo "<tr>";
                                echo "<td>{$i}</td>";  
                                echo "<td>{$db_FirstName}</td>";  
                                echo "<td>{$db_LastName}</td>"; 
                                echo "<td>{$db_EmailID}</td>";
                                echo "<td>{$db_CreatedDate}</td>";
                                echo "<td><a style='text-decoration:none; color:#6255a5' href='notes-under-review.php?u_ID={$db_UsersID}'>{$under_review}<a></td>";
                                echo "<td><a style='text-decoration:none; color:#6255a5' href='published-notes.php?u_ID={$db_UsersID}'>{$pubished}<a></td>";
                                echo "<td><a style='text-decoration:none; color:#6255a5' href='downloads.php?u_ID={$db_UsersID}'>{$downloaded}<a></td>";
                                
                                echo "<td><a style='text-decoration:none; color:#6255a5' href='downloads.php?u_ID={$db_UsersID}'>$ {$expenses}<a></td>";
                                echo "<td>{$earnings}</td>";
                               
                                echo "<td>
                                    <span class='action-icons'>
                                        <div class='dropleft dropdown'>
                                            <a href='#' role='button'' id='downloads-notes-menu' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                <img src='../images/Admin_images/dots.png' alt='dots-icon' class='dots-icon'>
                                            </a>

                                            <div class='dropdown-menu' aria-labelledby='downloads-notes-menu'>
                                                
                                                <a class='dropdown-item' href='member-details.php?u_id={$db_UsersID}'>View More Details</a>
                                                
                                                <a class='dropdown-item' onClick=\"javascript: return confirm('Are you sure you want to make this member $db_FirstName inactive?');\" href='?d_id={$db_UsersID}'>Deactive</a>
                                                
                                            </div>
                                        </div>

                                    </span>

                                </td>";
                                
                                echo "</tr>";
                                $i++;
                                
                                if(isset($_GET['d_id'])){

                                    $UsersID = $_GET['d_id'];

                                    $query = "SELECT UsersID From users WHERE UsersID = {$UsersID}";
                                    $update_user_query = mysqli_query($connection, $query);
                                    $count = mysqli_num_rows($update_user_query);

                                    if($count > 0){
                                        $query = "UPDATE users SET ModifiedDate = now(), ModifiedBy = '{$user_id}', IsActive='0' WHERE UsersID = '{$UsersID}'";
                                        $update_status_query = mysqli_query($connection, $query);
                                        
                                        echo "<script type='text/javascript'>
                                                window.location.href='members.php';
                                            </script>";
                                        

                                    }else {
                                        echo "<script type='text/javascript'>
                                                alert('This user is already Inactive');
                                                window.location.href='members.php';
                                            </script>";
                                    }

                                }
                            
                                
                            }
                        ?>                         
                     
                    </tbody>
                </table>
				
			</div>
		</div>
	</div>
	<!-- My Sold Notes table  Ends-->
	
	<!--  footer  -->
    <?php include('includes/footer.php'); ?>

    <script>
        $(function(){
            
            // In progress notes table
            search_member = $('#members-table').DataTable({
                "bLengthChange": false, // this gives option for changing the number of records shown in the UI table
                "lengthMenu": [5], 
                "dom": "lrtp" 
            });
            // search
            $("#search").on('keyup',function(){
                search_member.search(this.value).draw();
            });            
            
        });
        
    </script>
    
</body>

</html>