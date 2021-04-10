<?php    

function noteDownload ($db_NoteID) {
    
    global $connection;
    
    $query = "SELECT Note FROM seller_notes WHERE NoteID = '{$db_NoteID}' ";
    $select_note_query = mysqli_query($connection, $query);    
    $row = mysqli_fetch_array($select_note_query);
    $db_Note = $row['Note'];

    $fileName  = basename($db_Note);
    $filePath  = "../../front/uploaded files/". $fileName;

    if(!empty($fileName) && file_exists($filePath)){
        
        //define header
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$fileName");
        header("Content-Type: application/zip");
        header("Content-Transfer-Encoding: binary");

        //read file 
        readfile($filePath);
        exit;



    }else{
        echo "<script type='text/javascript'>alert(\"This file does not exist\"); history.go(-1);</script>";
        
    }

    
}

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

function calculateFileSize($size)
{
    $size = filesize('../../front/uploaded files/' . $size);
   $sizes = ['B', 'KB', 'MB', 'GB'];
   $count=0;
   if ($size < 1024) {
    return $size . " " . $sizes[$count];
    } else{
     while ($size>1024){
        $size=round($size/1024,2);
        $count++;
    }
     return $size . " " . $sizes[$count];
   }
}

function escape($string) {

    global $connection;

    return mysqli_real_escape_string($connection, trim($string));


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