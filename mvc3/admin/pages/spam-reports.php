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
	<link rel="stylesheet" href="../css/spam-reports.css">

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
        
        		<div class="row spam-reports-heading">
					<div class="col-md-6 col-sm-6">
						<h2 class="heading">Spam Reports</h2>
					</div>
					<div class="col-md-6 col-sm-6 search-content">
						<span toggle="#search" class="fa fa-search field-icon"></span>
						<input class="myInput" placeholder="Search" type="search" id="search" value="">
						<a class="btn" href="" role="button" id="search-btn">search</a>
					</div>
				</div>
				
				<!-- data table -->
				<table id="spam-reports-table" class="datatable table table-responsive-md display">
                    <thead>
                        <tr>
                        	<th>SR No.</th>
                            <th>Reported By</th>
                            <th>Note Title</th>
                            <th>category</th>
                            <th>Date added</th>
                            <th>remark</th>
                            <th>action</th>
                            <th></th>
                        </tr>
                    </thead>
        
                    <tbody>
                        
                        <?php
                            
                            $i = 1;
                            
                            $query = "SELECT * FROM seller_notes_reported_issues ORDER BY CreatedDate DESC";
                        
                            $select_all_issues_query = mysqli_query($connection, $query);
                            if (!$select_all_issues_query) {
                                die("QUERY FAILED" . mysqli_error($connection));
                            }
                            
                            while($row = mysqli_fetch_assoc($select_all_issues_query)) {
                                
                                
                                $db_ReportedIssuesID  = $row['ReportedIssuesID'];
                                $db_NoteID = $row['NoteID'];
                                $db_ReportedBYID = $row['ReportedBYID'];
                                $db_Remarks = $row['Remarks'];
                                $db_CreatedDate = $row['CreatedDate'];
                                $db_CreatedDate = date('d-m-Y, h:m',strtotime($db_CreatedDate));
                                
                                
                                $query = "SELECT FirstName, LastName FROM users WHERE UsersID = '{$db_ReportedBYID}'";
                                $users_query = mysqli_query($connection, $query);
                                $row = mysqli_fetch_array($users_query);
                                $db_ReportedBY = $row['FirstName'];
                                $db_ReportedBY .= " " . $row['LastName'];
                                
                                
                                $query = "SELECT * FROM seller_notes WHERE NoteID = '{$db_NoteID}'";
                                $notes_query = mysqli_query($connection, $query);
                                $row = mysqli_fetch_array($notes_query);
                                $db_Title  = $row['Title'];
                                $db_Category = $row['Category'];
                                $db_Note = $row['Note'];
                                
                                $query = "SELECT CategoryName FROM note_categories WHERE CategoryID = '{$db_Category}' ";
                                $cat_name = mysqli_query($connection, $query);
                                $row = mysqli_fetch_array($cat_name);
                                $db_CategoryName = $row['CategoryName'];
                                
                                
                                echo "<tr>";
                                echo "<td>{$i}</td>";  
                                echo "<td>{$db_ReportedBY}</td>";  
                                 echo "<td><a style='text-decoration:none; color:#6255a5' href='note-details.php?NoteID={$db_NoteID}'>{$db_Title}<a></td>";  
                                echo "<td>{$db_CategoryName}</td>"; 
                                echo "<td>{$db_CreatedDate}</td>";
                                echo "<td>{$db_Remarks}</td>";
                                
                                 echo "<td>
                                    <span class='action-icons'>
                                        
                                        <a onClick=\"javascript: return confirm('Are you sure you want to delete this?');\" href='?delete={$db_ReportedIssuesID}'><img class='delete-icon' src='../images/Admin_images/delete.png' alt='delete'></a>    
                                        
                                    </span>

                                </td>";
                                
                                echo "<td>
                                    <span class='action-icons'>
                                        <div class='dropleft dropdown'>
                                            <a href='#' role='button'' id='downloads-notes-menu' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                <img src='../images/Admin_images/dots.png' alt='dots-icon' class='dots-icon'>
                                            </a>

                                            <div class='dropdown-menu' aria-labelledby='downloads-notes-menu'>
                                                
                                                <a class='dropdown-item' href='?d_id={$db_NoteID}'>download Notes</a>
                                                
                                                <a class='dropdown-item rating' href='note-details.php?NoteID={$db_NoteID}'>View More Details</a>
                                                
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
                                
                                if(isset($_GET['delete'])) {
                                    
                                    $report_id = $_GET['delete'];
                                    $query = "DELETE FROM seller_notes_reported_issues WHERE ReportedIssuesID = {$report_id}";
                                    $delete_query = mysqli_query($connection, $query);
                                    if (!$delete_query) {
                                        die("QUERY FAILED" . mysqli_error($connection));
                                    }
                                    redirect("spam-reports.php");
                                }
                                
                                if(isset($_GET['d_id'])){
                                    noteDownload($_GET['d_id']);
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
            search_member = $('#spam-reports-table').DataTable({
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