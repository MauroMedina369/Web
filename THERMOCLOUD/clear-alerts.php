<?php  
    session_start();
    include "config.php";
    // ini_set('max_execution_time', 5); 
    //error_reporting( E_PARSE);
    $Email =$_SESSION['Email']; 
    //$DeviceID =$_GET['DeviceID'];   
    $querystr="Update alarms SET Viewed =1 Where Email = '".$Email."'";
    //logmsg($querystr);
    UpdateDB($querystr);
    echo json_encode("OK", JSON_FORCE_OBJECT); ;
?>


