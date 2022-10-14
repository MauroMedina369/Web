<?php  
session_start();
#header('Access-Control-Allow-Origin: *');
include "config.php";
//{{timeout_db}} 
//include database configuration file
$id = $_GET['DeviceID'];  
$inicio=$_GET['inicio'];
$fin= $_GET['fin'];
$querystr = "Select * from datos where DeviceID = '".$id."' and Fecha >= '". $inicio . "' and Fecha <= '". $fin . "' order by Fecha asc, Hora asc"; 
//logmsg($querystr);
$db =  ConnectMySQL();
$sql = $db->prepare($querystr); 
$sql->execute(); 
$delimiter = ",";
$filename = "wisee_ID_".$id."-".$inicio."-".$fin.".csv";

//create a file pointer
$f = fopen('php://memory', 'w');

//set column headers
$fields = array('Fecha', 'Hora', 'Temp', 'HR');
fputcsv($f, $fields, $delimiter);
while($row= $sql->fetch(PDO::FETCH_ASSOC)){                                     
        //$status = ($row['status'] == '1')?'Active':'Inactive';
        $lineData = array(MuestraFechaSTR($row['Fecha']),MuestraHoraSTR($row['Hora']), $row['Temp'], $row['HR']);
        fputcsv($f, $lineData, $delimiter);
    }    
    //move back to beginning of file
    fseek($f, 0);    
    //set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');    
    //output all remaining data on a file pointer
    fpassthru($f);
exit;

?>