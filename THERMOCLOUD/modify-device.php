<?php  
session_start();
    include "config.php";
    ini_set('max_execution_time', 5); 
    //error_reporting( E_PARSE);
    $Email =$_SESSION['Email'];   
    $DeviceID= $_GET['DeviceID'];  
    $DeviceName= $_GET['DeviceName'];  
    $Description= $_GET['Description'];      
    $Location= $_GET['Location'];     
    $TempLimitMayor=  $_GET['TempLimitMayor'];     
    $TempLimitMenor=  $_GET['TempLimitMenor'];     
    $HRLimitMayor=  $_GET['HRLimitMayor'];     
    $HRLimitMenor=  $_GET['HRLimitMenor'];     
    $PPMLimitMax = $_GET['PPMLimitMax'];
    $EnabledAlerts= $_GET['EnabledAlerts'];
    $querystr = "UPDATE ajustes SET Configuration=1, Description = '" . $Description. "' , DeviceName = '". $DeviceName ."' , Location = '". $Location ."' , PPMLimitMax = '" . $PPMLimitMax. "' , TempLimitMenor = '" . $TempLimitMenor. "', TempLimitMayor = '" . $TempLimitMayor. "', HRLimitMenor = '" . $HRLimitMenor. "', HRLimitMayor = '" . $HRLimitMayor. "', EnabledAlerts = '" . $EnabledAlerts. "' WHERE DeviceID = '". $DeviceID."' and Email = '".$Email ."'";

    InsertDBMySQL($querystr);      
    
    $row="OK";
    echo json_encode($row, JSON_FORCE_OBJECT);   
?>
