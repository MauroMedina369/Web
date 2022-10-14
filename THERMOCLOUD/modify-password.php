<?php
    session_start();
?>

<?php  
    header('Access-Control-Allow-Origin: *');
    include "config.php";
    ini_set('max_execution_time', 5); 
    //error_reporting( E_PARSE);
    $Email =$_SESSION['Email'];   
    $t1= $_GET['Password'];   

    $querystr = "UPDATE usuarios SET Password = '" . $t1. "' WHERE Email = '".$Email ."'";
    InsertDBMySQL($querystr);        
    $row="OK";
    echo json_encode($row, JSON_FORCE_OBJECT);   
?>
