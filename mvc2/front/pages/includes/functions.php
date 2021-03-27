<?php    

function redirect($location){


    header("Location:" . $location);
    exit;

}

function isLoggedIn(){

    if(isset($_SESSION['UserID'])){
        return true;
    }
   return false;

}

function checkIfUserIsLoggedInAndRedirect($redirectLocation=null){

    if(isLoggedIn()){

        redirect($redirectLocation);

    }

}

function escape($string) {

    global $connection;

    return mysqli_real_escape_string($connection, trim($string));


}

function is_member($email) {

    global $connection; 

    $query = "SELECT RoleID FROM users WHERE EmailID = '$email'";
    $result = mysqli_query($connection, $query);

    $row = mysqli_fetch_array($result);


    if($row['RoleID'] == '1'){

        return true;

    }else {


        return false;
    }
}

function is_admin($email) {

    global $connection; 

    $query = "SELECT RoleID FROM users WHERE EmailID = '$email'";
    $result = mysqli_query($connection, $query);

    $row = mysqli_fetch_array($result);


    if($row['RoleID'] == '2'){

        return true;

    }else {


        return false;
    }
}

function is_super_admin($email) {

    global $connection; 

    $query = "SELECT RoleID FROM users WHERE EmailID = '$email'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($result);


    if($row['RoleID'] == '3'){

        return true;

    }else {


        return false;
    }
}
    
function email_exists($email){

    global $connection;

    $query = "SELECT EmailID FROM users WHERE EmailID = '$email'";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("QUERY FAILED" . mysqli_error($connection));
    }  
    
    if(mysqli_num_rows($result) > 0) {

        return true;

    } else {

        return false;

    }

}




?>