<?php  
    session_start();
    include "config.php";
    ini_set('max_execution_time', 5); 
    //error_reporting( E_PARSE);
    $Email =$_SESSION['Email'];   
    $DeviceID= $_GET['DeviceID'];  
    $Datos= $_GET['Datos'];   
    $limites = json_decode($Datos);
    $t1= $limites->{'TempLimitMenor'};
    $t2= $limites->{'TempLimitMayor'};
    $t3= $limites->{'HRLimitMenor'};
    $t4= $limites->{'HRLimitMayor'};
    $t5= $limites->{'EnabledAlerts'};
    $querystr = "UPDATE devices SET TempLimitMenor = '" . $t1. "', TempLimitMayor = '" . $t2. "', HRLimitMenor = '" . $t3. "', HRLimitMayor = '" . $t4. "', EnabledAlerts = '" . $t5. "' WHERE DeviceID = '". $DeviceID."'";
    InsertDBMySQL($querystr);        
    $row="OK";
    echo json_encode($row, JSON_FORCE_OBJECT);   
?>
