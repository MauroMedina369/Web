<?php  
    session_start();
    include "config.php";
    //ini_set('max_execution_time', 5); 

    error_reporting(E_PARSE);
    $Email =$_SESSION['Email'];   
   // logmsg($Email);
    $querystr = "Select * from ajustes where Email = '".$Email."' order by State desc, DeviceName asc"; 
    //$querystr = "Select * from ajustes where Email = '".$Email."' "; 
    #$querystr = "Select * from Dispositivos"; 
  //  logmsg($querystr);   

    $db =  ConnectMySQL();
    $sql = $db->prepare($querystr); 
    $sql->execute(); 
    $numeroFilas = $sql->rowCount();
   while( $row= $sql->fetch(PDO::FETCH_ASSOC)){
    $diferencia = DiffTime($row["LastUpdateFecha"], $row["LastUpdateHora"]); //Diferencia en minutos
    // logmsg("LastUpdateFecha: "  . $row["LastUpdateFecha"]);
    // logmsg("Diferencia: "  . $diferencia);
    $row["State"]="0";
    $row["ColorTemp"]="success";
    $row["ColorHR"]="success";  
    if (($diferencia <= 5) && ($row["LastUpdateFecha"] !="")) {$row["State"]="1";};
  
    if ($row["CurrentTemp"]> $row["TempLimitMayor"]) $row["ColorTemp"]="danger";
    if ($row["CurrentTemp"]< $row["TempLimitMenor"]) $row["ColorTemp"]="primary";
    if ($row["CurrentHR"]> $row["HRLimitMayor"]) $row["ColorHR"]="danger";
    if ($row["CurrentHR"]< $row["HRLimitMenor"]) $row["ColorHR"]="primary";
    //logmsg($row["TempLimitMayor"]);
    $querystr2 = "Select DeviceID,Temp,HR,Fecha,Hora from datos where DeviceID = '".$row["DeviceID"]."' order by Fecha desc, Hora desc limit 10"; 
    $DatosGrafico= SelectMultiDB($querystr2);
   // echo json_encode($DatosGrafico);   
    $data[]=$row;   
   }      
   $db= null;
   $sql = null; // obligado para cerrar la conexión                               while($row= $sql->fetch(PDO::FETCH_ASSOC)){   

    //echo json_encode($age);
   echo json_encode($data,JSON_FORCE_OBJECT);   
//echo $data[0]["Temp"];
?>