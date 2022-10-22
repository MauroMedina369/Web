<?php  
date_default_timezone_set('America/Buenos_Aires');
ini_set('max_execution_time', 10); 

function ConnectMySQL()
{    
  $db = [
    //   'host' => 'localhost',
    //   'username' => 'c2091346_wiseedb',
    //   'password' => 'GOrowuvu21',
    //   'db' => 'c2091346_wiseedb' 


    'host' => 'localhost',
    'username' => 'wisee_sa',
    'password' => 'Poderoso22',
    'db' => 'wiseedb'     
  ];
    try {
        $conn = new PDO("mysql:host={$db['host']};dbname={$db['db']}", $db['username'], $db['password']);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $exception) {
         logmsg($exception->getMessage());
    }
}


///////////////////////////////////////////////////////////////
function UpdateDB($querySQL){
    //  logmsg("UPADTEDB: ");  logmsg($querySQL); 
      try {
          $db =  ConnectMySQL();
          $sql = $db->prepare($querySQL);    
          $sql->execute();    
          $cuenta = $sql->rowCount();     
      }
      catch(exception $e){
        $db=null;   
        $sql = null;
        return -1;
      } 
      $db=null;
      $sql = null; // obligado para cerrar la conexión
    //  logmsg("UPDATE afectadas: ". $cuenta);
      return $cuenta;
  }

/////////////////////////////
function InsertDBMySQL($_querySQL){
    //logmsg("INSERTDB: ");  logmsg($_querySQL); 
    try {
        $db =  ConnectMySQL();
        $sql = $db->query($_querySQL); 
        $sql->execute();       
        $cuenta =$sql->rowCount();                                   
    } catch(Error $e){  
        $db=null;   
        $sql = null;
        return -1;
    }  
    
    $db=null;   
    $sql = null;
     //logmsg("Cuenta Insert:".$cuenta);
    return $cuenta;
}


/////////////////////////////
function SelectDB ($querySQL){
    //logmsg("Entra SelectDB: ".$querySQL);
    $db =  ConnectMySQL();
    $sql = $db->prepare($querySQL); 
    $sql->execute(); 
   // logmsg($sql->rowCount());
    $row= $sql->fetch(PDO::FETCH_ASSOC);     
    $db= null;
    $sql = null; // obligado para cerrar la conexión                               while($row= $sql->fetch(PDO::FETCH_ASSOC)){   
   return $row;
}

/////////////////////////////
function SelectMultiDB ($querySQL){
    //    logmsg("Entra SelectDB: ".$querySQL);
        $db =  ConnectMySQL();
        $sql = $db->prepare($querySQL); 
        $sql->execute(); 
       // logmsg($sql->rowCount());
       //$data[]=array();
       while($row= $sql->fetch(PDO::FETCH_ASSOC)){
        $data[]=$row;            
       }   
        $db= null;
        $sql = null; // obligado para cerrar la conexión                               while($row= $sql->fetch(PDO::FETCH_ASSOC)){   
       return $data;
    }

/////////////////////////////
function GetGraphicCard($_DeviceID){
    $querystr2 = "Select * from datos where DeviceID = '".$_DeviceID ."' order by Fecha desc, Hora desc limit 24"; 
    //logmsg($querystr2);
    $DatosGrafico= SelectMultiDB($querystr2);   
    $DatosTotales= count($DatosGrafico);
    $templist="";
    $humlist="";
    $soillist="";
    $fechalist="";
    $fecha="";
    $a=0;
    for ($x=$DatosTotales-1;$x>0; $x--) {
    //for ($x=0;$x<$DatosTotales-1; $x++) {
        
        $templist=$templist . $DatosGrafico[$a]["Temp"] . ",";
        $humlist=$humlist . $DatosGrafico[$a]["HR"] .",";
        $soillist=$soillist . $DatosGrafico[$a]["Soil"] .",";
        $fechalist=$fechalist . "'" . MuestraHoraSTR($DatosGrafico[$a]["Hora"]) ."',";
        $a++;
    }
    $templist=$templist .intval($DatosGrafico[$DatosTotales-1]["Temp"]);
    $humlist=$humlist . intval($DatosGrafico[$DatosTotales-1]["HR"]) ;
    $soillist=$soillist . intval($DatosGrafico[$DatosTotales-1]["Soil"]) ;
    $fechalist=$fechalist ."'" . MuestraHoraSTR($DatosGrafico[$DatosTotales-1]["Hora"]) ."'"  ;
    return $templist. "/" . $humlist . "/" . $soillist . "/". $fechalist;
}


////////////////////////////////////////////////////
function sendTelegramMessage($chat_id, $msg)
{
// global $URL;
// $json = ['chat_id'       => $chat_id,
//          'text'          => $text,
//          'parse_mode'    => 'HTML'];
// return http_post($URL.'/sendMessage', $json);
$token = "5139733762:AAF-NbCsp-uXarMOp52cwibRcePVBdfoEuY";
$urlMsg = "https://api.telegram.org/bot".$token ."/sendMessage";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $urlMsg);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "chat_id={$chat_id}&parse_mode=HTML&text=$msg");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);    
$server_output = curl_exec($ch);
curl_close($ch);    
}


/////////////////////////////
function CheckUser($id){
    $querystr= "Select * from usuarios where Email='".$id."'";
    $row=SelectDB($querystr);
    // logmsg("Email ID:".$id);
    // logmsg("Email row: ". $row['Email']);
    if ($id === $row["Email"]) {
        // logmsg ("Existe Mail. Retorna True CheckUser.");
        return true;
    }
    // logmsg("No existe Email. Retorna False CheckUser.");
    return false;
}

/////////////////////////////
function _GetTime(){
    return date("H") . date("i");
}

/////////////////////////////
function _GetDate(){
    return  date("Y").date("m"). date("d");   
}

/////////////////////////////
function logmsg($variable){
    echo '<pre>';
    print_r("LOG: ".$variable);
    echo '</pre>';
}

/////////////////////////////////////////
function DiffTime ($_fecha, $_hora) { //devuelve la cantidad de minutos desde una fecha hasta el presente
    if ($_fecha == "" )return 0;
    $a= str_pad($_hora,4,"0",STR_PAD_LEFT); //rellena con ceros si es necesario
    $leido = DateTime::createFromFormat('Ymd Hi', $_fecha ." ".$a);
    $ahora = new DateTime();
    $intervalo = $ahora->diff($leido);
        $días=  $intervalo->format('%a');
        $horas=  $intervalo->format('%H');
        $minutos=  $intervalo->format('%I');
        $minutostotales = $días *1440 + $horas*60 + $minutos;
        return $minutostotales;
}


//////////////////////////////////////////////////////////////////////////////////
function MuestraHoraSTR($_in) {
    if (strlen($_in) == 1) $_in="000".$_in;
    if (strlen($_in) == 2) $_in="00".$_in;
    if (strlen($_in) == 3) $_in="0".$_in;
    $hora = substr($_in,0, 2);
    $min = substr($_in,2, 2);   
    return $hora . ":" . $min;
}

//////////////////////////////////////////////////////////////////////////////////
function MuestraFechaSTR($_in) {
    $año = substr($_in,0, 4);
    $mes = substr($_in,4, 2);
    $dia = substr($_in,6, 2);
    return $dia . "/" . $mes . "/" . $año;
}

/////////////////////////////////////////////////////////////////////////////
function getDay($in){
    $dia = substr($in,6,2);
    $fechats = strtotime($in); //pasamos a timestamp
    //el parametro w en la funcion date indica que queremos el dia de la semana
    //lo devuelve en numero 0 domingo, 1 lunes,....
    switch (date('w', $fechats)){
        case 0: return "Dom ".$dia  ; break;
        case 1: return "Lun ".$dia; break;
        case 2: return "Mar ".$dia; break;
        case 3: return "Mie ".$dia; break;
        case 4: return "Jue ".$dia; break;
        case 5: return "Vie ".$dia; break;
        case 6: return "Sab ".$dia; break;    
    }
}


/////////////////////////////////////////////////////////////////////////////

function SendMail($Title,$Email,$Message){
    //instanciamos un objeto de la clase phpmailer al que llamamos 
    //por ejemplo mail
    $mail = new phpmailer();
  
  
    //Definimos las propiedades y llamamos a los métodos 
    //correspondientes del objeto mail
  
    //Con PluginDir le indicamos a la clase phpmailer donde se 
    //encuentra la clase smtp que como he comentado al principio de 
    //este ejemplo va a estar en el subdirectorio includes
    $mail->PluginDir = "assets/vendor/php/";
  
    //Con la propiedad Mailer le indicamos que vamos a usar un 
    //servidor smtp
    $mail->Mailer = "smtp";
  
    //Asignamos a Host el nombre de nuestro servidor smtp
    $mail->Host = "c2091346.ferozo.com";
  
    //Le indicamos que el servidor smtp requiere autenticación
    $mail->SMTPAuth = true;
  
    //Le decimos cual es nuestro nombre de usuario y password
    $mail->Username = "centrodealarmas@wisee.com.ar"; 
    $mail->Password = "DonRamon22";
  
    //Indicamos cual es nuestra dirección de correo y el nombre que 
    //queremos que vea el usuario que lee nuestro correo
    $mail->From = "centrodealarmas@wisee.com.ar" ;
    $mail->FromName = "Centro de Alarmas Wisee" ;
  
    //el valor por defecto 10 de Timeout es un poco escaso dado que voy a usar 
    //una cuenta gratuita, por tanto lo pongo a 30  
    $mail->Timeout=30;
  
    //Indicamos cual es la dirección de destino del correo
    $mail->AddAddress($Email);
  
    //Asignamos asunto y cuerpo del mensaje
    //El cuerpo del mensaje lo ponemos en formato html, haciendo 
    //que se vea en negrita
    $mail->Subject = $Title;
    
  
    $mail->Body = "<b>". $Message. "</b>";
  
    //Definimos AltBody por si el destinatario del correo no admite email con formato html 
    $mail->AltBody = $Message ;
  
    //se envia el mensaje, si no ha habido problemas 
    //la variable $exito tendra el valor true
    $exito = $mail->Send();
  
    //Si el mensaje no ha podido ser enviado se realizaran 4 intentos mas como mucho 
    //para intentar enviar el mensaje, cada intento se hara 5 segundos despues 
    //del anterior, para ello se usa la funcion sleep	
    $intentos=1; 
    while ((!$exito) && ($intentos < 5)) {
      sleep(5);
           //echo $mail->ErrorInfo;
           $exito = $mail->Send();
           $intentos=$intentos+1;	
      
     }
   
          
     if(!$exito)
     {
      echo "Problemas enviando correo electrónico a ".$valor;
      echo "<br/>".$mail->ErrorInfo;	
     }
     else
     {
      echo "OK";
     }     
  }
  


?>