<?php  
    //header('Access-Control-Allow-Origin: *');
    session_start();
    include "config.php";
    ini_set('max_execution_time', 5); 
    error_reporting( 0);
    $Email =$_SESSION['Email'];   
    $DeviceID= $_GET['DeviceID'];  
    $DeviceName= $_GET['DeviceName'];  
    $Description= $_GET['Description']; 
    $Location= $_GET['Location'];  

    $querystr = "Select * from valid_devices where DeviceID = '".$DeviceID."'"; //obtiene el MODELO
    $row=SelectDB($querystr);
    $Model= $row['Model'];      

    $querystr = "Select * from devices where DeviceID = '".$DeviceID."'"; 
    $row=SelectDB($querystr);
    if (strlen($row["DeviceID"]) >1){
        $row= "EXIST";
    } else {
        $querystr = "Select * from datos where DeviceID = '".$DeviceID."' limit 1"; 
        $row=SelectDB($querystr);
        if (strlen($row["DeviceID"]) >1){
            $querystr = "INSERT INTO devices (`DeviceID`,`TempLimitMenor`,`TempLimitMayor`,`HRLimitMenor`,`HRLimitMayor`,`Description`,`Location`,`EnabledAlerts`, `Email`,`DeviceName`,`Model`) VALUES  ('".$DeviceID."','24','30','50','70','".$Description."','".$Location."','1','".$Email."','". $DeviceName ."','". $Model . "') ON DUPLICATE KEY UPDATE `DeviceID` = '".$DeviceID."'";
            //InsertDBMySQL($querystr);        
            $row= "OK";
        }else {
            $row="INVALID";
        }

    }

    echo json_encode($row, JSON_FORCE_OBJECT);   
?>

