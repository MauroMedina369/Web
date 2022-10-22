<?php  
    session_start();
    header('Access-Control-Allow-Origin: *');
    include "config.php";
    ini_set('max_execution_time', 5); 



    //error_reporting( E_PARSE);
    $Email =$_SESSION['Email'];   
    $DeviceID= $_GET['DeviceID'];
    $DateMin= $_GET['DateMin'];
    $DateMax= $_GET['DateMax'];
    //logmsg($Email);
    if ($Email == "") return;    
    $querystr = "Select * from devices where DeviceID = '".$DeviceID."'"; 

    $db =  ConnectMySQL();
    $sql = $db->prepare($querystr); 
    $sql->execute(); 
    //logmsg($sql->rowCount());
   //$data[]=array();
   while($row= $sql->fetch(PDO::FETCH_ASSOC)){
    $LimiteMinimoTemp=$row["TempLimitMenor"];      
    $LimiteMaximoTemp=$row["TempLimitMayor"];        
    $LimiteMinimoHR=$row["HRLimitMenor"];      
    $LimiteMaximoHR=$row["HRLimitMayor"];           
    //logmsg($LimiteMaximoTemp);
   }   


    $querystr = "Select * from datos where DeviceID = '".$DeviceID."' and Fecha >= '". $DateMin . "' and Fecha <= '". $DateMax . "' order by Fecha asc, Hora asc"; 
    #$querystr = "Select * from Dispositivos"; 
    //logmsg($querystr);   

    $db =  ConnectMySQL();
    $sql = $db->prepare($querystr); 
    $sql->execute(); 
   // logmsg($sql->rowCount());
   //$data[]=array();
   $PicoTemp=0;
   $PicoHR=0;
   $PromedioTemp=0;
   $PromedioHR=0;
   $CantidadRegistros=0;
   while($row= $sql->fetch(PDO::FETCH_ASSOC)){
    $CantidadRegistros++;
    $PromTemp=$PromTemp+$row["Temp"];
    $PromHR=$PromHR+$row["HR"];

    if ($row["Temp"] > $PicoTemp){
        $data["PicoTemp"]=$row["Temp"];
        $PicoTemp=$row["Temp"];
        $data["FechaPicoTemp"]=MuestraFechaSTR($row["Fecha"]) . " a las  " . MuestraHoraSTR($row["Hora"]);
    }
    if ($row["HR"] > $PicoHR){
        $data["PicoHR"]=$row["HR"];
        $PicoHR=$row["HR"];
        $data["FechaPicoHR"]=MuestraFechaSTR($row["Fecha"]) ." a las " . MuestraHoraSTR($row["Hora"]);
    }    
    $PromedioTemp=$PromTemp / $CantidadRegistros;
    $PromedioHR=$PromHR / $CantidadRegistros;
    $data["PromedioTemp"]=$PromedioTemp;
    $data["PromedioHR"]=$PromedioHR;
    $data["Temp"][]=$row["Temp"];      
    $data["HR"][]=$row["HR"];      
    $data["Soil"][]=$row["Soil"];  
    $data["Fecha"][]= substr(MuestraFechaSTR($row["Fecha"]),0,5) . " " .MuestraHoraSTR($row["Hora"]);      
    $data["Hora"][]=MuestraHoraSTR($row["Hora"]);  
    $data["LimiteMinimoTemp"][]=$LimiteMinimoTemp;
    $data["LimiteMaximoTemp"][]=$LimiteMaximoTemp;    
    $data["LimiteMinimoHR"][]=$LimiteMinimoHR;
    $data["LimiteMaximoHR"][]=$LimiteMaximoHR;        
   }   



  
   $db= null;
   $sql = null; // obligado para cerrar la conexión                               while($row= $sql->fetch(PDO::FETCH_ASSOC)){   

    //$row=SelectMultiDB($querystr);

   echo json_encode($data);  
?>