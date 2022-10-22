<?php

//SET WEBHOOK https://api.telegram.org/bot5139733762:AAF-NbCsp-uXarMOp52cwibRcePVBdfoEuY/setWebhook?url=https://wisee.com.ar/THERMOCLOUD/telehook.php    
// LOG TELEGRAM
    include "config.php";
    ini_set('max_execution_time', 5); 
    //error_reporting( 0);
    $request = file_get_contents("php://input");

    $fecha = date('Y-m-d H:i:s');
    file_put_contents("TelegramLog.log", $fecha.' - '.$request, FILE_APPEND);
    $request = json_decode($request);
    
    $HayMensaje=false;
    $textoRecibido=strtoupper($request->message->text);
    $asociar = strtoupper(substr($textoRecibido,0,8));
    
    $channelid=$request->message->chat->id;
    $nombre=$request->message->from->first_name;

    if (substr($textoRecibido,0,8) == "ASOCIAR/"){
      $idAsociado= substr($textoRecibido,8);
       $querystr = "INSERT INTO telegram (DeviceID,channelid) VALUES  ('".$idAsociado."','". $channelid."') ON DUPLICATE KEY UPDATE `DeviceID` = '".$idAsociado."'";           
       sendTelegramMessage($channelid, "Wisee " . $idAsociado . " asociado OK!" );     
       InsertDBMySQL($querystr);
       $HayMensaje=true;
    }

    if (substr($textoRecibido,0,4) == "HOLA"){
        sendTelegramMessage($request->message->chat->id, " Hola " . $nombre. ", bienvenido al bot de Wisee");
        $HayMensaje=true;
    }    

    if (substr($textoRecibido,0,6) == "/START"){
      //  sendTelegramMessage($request->message->chat->id, " Hola " . $nombre. ", bienvenido al bot de Wisee");
        sendTelegramMessage($request->message->chat->id, " Hola " . $nombre. ", bienvenido al bot de Wisee.\nPara comenzar a recibir alertas de Telegram en tu celular tenés que asociar tus equipos.\n Listado de comandos:\nasociar/id_de_equipo: Para asociar un equipo\neliminar/id_de_equipo: Para dejar de recibir alertas.\nsensor/id_de_equipo: Para consultar equipo");
        $HayMensaje=true;
    }  

    if (substr($textoRecibido,0,9) == "ELIMINAR/"){
        $idAsociado= substr($textoRecibido,9);
        $querystr = "DELETE FROM telegram WHERE channelid = '". $channelid ."'";           
        sendTelegramMessage($channelid, "OK! Ya no recibirás más alertas del equipo " . $idAsociado);     
        InsertDBMySQL($querystr);
        $HayMensaje=true;
      }  

      if (substr($textoRecibido,0,7) == "SENSOR/"){
        $idAsociado= substr($textoRecibido,7);
        $querystr = "Select * from devices where DeviceID = '".$idAsociado."'";     
        $db =  ConnectMySQL();
        $sql = $db->prepare($querystr); 
        $sql->execute(); 
        $numeroFilas = $sql->rowCount();
        while( $row= $sql->fetch(PDO::FETCH_ASSOC)){
         $LastUpdate = MuestraFechaSTR($row["LastUpdateFecha"]) . " a las ". MuestraHoraSTR($row["LastUpdateHora"]); //Diferencia en minutos
         $Mensaje = "Datos del sensor " .$idAsociado. "\nNombre de dispositivo: " . $row["DeviceName"] . "\nDescripción: " . $row["Description"] . "\nUbicación: " . $row["Location"] . "\nLectura: " . $row["CurrentTemp"] . " / " . $row["CurrentHR"] . "\nÚltima actualización: " . $LastUpdate;
        }         
        sendTelegramMessage($channelid, $Mensaje);     
        InsertDBMySQL($querystr);
        $HayMensaje=true;
      }  

      if ($HayMensaje ==false){
        sendTelegramMessage($channelid, "Disculpa, pero no comprendo lo que quieres decirme.\nIntenta con los siguientes comandos: \n>>>\nasociar/id_de_equipo: Para asociar un equipo\neliminar/id_de_equipo: Para dejar de recibir alertas.\nsensor/id_de_equipo: Para consultar equipo ");   
      }

?>

