<?php include "db.php"; ?>
<?php include "functions.php"; ?>
<?php ob_start(); ?>
<?php 

session_start();

if(isset($_GET['token'])){
    $token = $_GET['token'];
    $query = "UPDATE users  set isActive = '1' where Token = '$token' ";
    $update_active_query = mysqli_query($connection, $query);
    
    if($update_active_query) {
        redirect("../user-profile.php");
    }
    else{
        die("Query Faild");
    }
    
}

?>
