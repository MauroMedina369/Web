<?php  
session_start();
    include "config.php";
    ini_set('max_execution_time', 5); 
    //error_reporting( E_PARSE);
    $Email =$_SESSION['Email'];   
    $querystr = "Select * from usuarios where Email = '".$Email."'"; 
    #$querystr = "Select * from Dispositivos"; 
    //logmsg($querystr);   
    $row=SelectMultiDB($querystr);
    echo json_encode($row, JSON_FORCE_OBJECT);   
?>