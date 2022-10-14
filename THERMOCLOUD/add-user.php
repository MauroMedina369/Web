<?php  
header('Access-Control-Allow-Origin: *');
include "config.php";
ini_set('max_execution_time', 5); 
error_reporting( E_PARSE);
    $Name = $_GET['Name'];
    $LastName = $_GET['LastName'];
    $Email = $_GET['Email'];
    $Password= $_GET['password'];
    $Fecha= _GetDate();
    $Hora =_GetTime();
    $DateCreation = $Fecha . "-". $Hora;
    $ValoresString = "'".$Name . "','" .  $LastName. "','" . $Email. "','"  .$Password."','" . $Fecha. "','"  . $Hora. "','"  . $DateCreation. "'"  ;
    $ValoresString2 = "`Name` = '".$Name."'";    
    $querystr = "INSERT  INTO  usuarios (Name, LastName , Email, Password,Fecha,Hora, DateCreation) VALUES (".$ValoresString.") ON DUPLICATE KEY UPDATE ".$ValoresString2;
  //  logmsg($querystr);
if (CheckUser($Email)) {
    $jsondata= "EXIST";
} else {
    InsertDBMySQL($querystr);
    $jsondata ="OK";
}
echo json_encode($jsondata, JSON_FORCE_OBJECT); 
//echo $jsondata;  
// logmsg($querystr);                         
//        $cuerpo = "¡Hola <strong>" .$datos->{'Nombre'}. " </strong>! Bienvenido a Meelux. Esperamos que disfrutes de nuestro producto tanto como nosotros desarrollarlo, y te sea muy útil a la hora de ahorrar en tu consumo eléctrico. <br><label> Usaremos éste correo para enviarte las alertas y notificaciones. </label><br>Si necesitás ayuda o tenés alguna duda, ingresá a <strong> meelux.com.ar/ayuda </strong> o escribinos a <a href='mailto:soporte@meelux.com.ar'> soporte@meelux.com.ar</a>.<br> Que tengas un excelente día.<br><br> Equipo Meelux";      
//EnviaMail( $datos->{'Email'},"Bienvenido a Meelux", $cuerpo);
  



// function CheckValidDevice($id) {
//     $querystr =  "SELECT * FROM mauromba_mysql.Dispositivos WHERE Dispositivo = '" . $id ."'";            
//     $db =  connect();
//     $sql = $db->prepare($querystr);      
//     $sql->execute();     
//     while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
        
//         $db=null;
//         $sql=null;
//         return "OK";
//     }
//     $db=null;
//     $sql=null;
//     return "ERROR";
// }


  ?>