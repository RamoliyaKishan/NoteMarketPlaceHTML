<?php ob_start(); ?>
<?php 

session_start();
    
session_destroy();
    
header("Location: ../../../front/pages/login.php");

?>