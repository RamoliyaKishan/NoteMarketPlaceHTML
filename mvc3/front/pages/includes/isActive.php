<?php include "db.php"; ?>
<?php include "functions.php"; ?>
<?php ob_start(); ?>
<?php 

session_start();

if(isset($_GET['token']) && isset($_SESSION['UsersID'])){
    $token = $_GET['token'];
    echo $user_id = $_SESSION['UsersID'];
    
    $query = "SELECT EmailID FROM users WHERE UsersID = '{$user_id}'";
    $select_user_query = mysqli_query($connection, $query);
    if(!$select_user_query){
        echo "query fail" . mysqli_error($connection);
    }
    $row  = mysqli_fetch_array($select_user_query);
    $db_email_id = $row['EmailID'];
    $db_token = bin2hex($db_email_id);
    
    if($token === $db_token) {
    
        $query = "UPDATE users  set isEmailVerified = '1', isActive = '1', CreatedBY = '{$user_id}', ModifiedDate = now(), ModifiedBY = '{$user_id}' where UsersID = '{$user_id}'";
        $update_active_query = mysqli_query($connection, $query);

        if($update_active_query) {
            redirect("../user-profile.php");
        }
        else{
            die("Query Faild");
        }
    }
    
}

?>
