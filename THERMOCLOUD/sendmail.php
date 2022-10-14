<?php
  // primero hay que incluir la clase phpmailer para poder instanciar
  //un objeto de la misma

  
  //require '/assets/vendor/php/Exception.php';
  require 'assets/vendor/php/PHPMailerAutoload.php';
  //instanciamos un objeto de la clase phpmailer al que llamamos 
  //por ejemplo mail
  $mail = new PHPMailer();

  $Alarm=$_GET["Alarm"];
  $Value=$_GET["Value"];
  $DeviceID=$_GET["DeviceID"];
  $DeviceName=$_GET["DeviceName"];

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
  $mail->AddAddress($_GET['Email']);

  //Asignamos asunto y cuerpo del mensaje
  //El cuerpo del mensaje lo ponemos en formato html, haciendo 
  //que se vea en negrita
  $mail->Subject = "Alerta de Wisee " . $DeviceID ;
  $Message="";
  if ($Alarm == "MaxGas") $Message= "Se ha superado el valor de PPM en el equipo ". $DeviceName . " (ID#: " . $DeviceID."). El valor registrado fue de <strong>" .$Value. " °C </strong>."; 
  if ($Alarm == "MaxTemp") $Message= "Se ha superado la temperatura en el equipo ". $DeviceName . " (ID#: " . $DeviceID.") . El valor registrado fue de " .$Value. " °C."; 
  if ($Alarm == "MaxHR") $Message= "Se ha superado la humedad en el equipo ". $DeviceName . " (ID#: " . $DeviceID."). El valor registrado fue de " .$Value. " %.";
  if ($Alarm == "MinTemp") $Message= "Se ha alcanzado el valor inferior de temperatura mínima en el equipo ". $DeviceName . " (ID#: " . $DeviceID."). El valor registrado fue de " .$Value. " °C.";
  if ($Alarm == "MinHR") $Message= "Se ha alcanzado el valor inferior de humedad mínimo en el equipo ". $DeviceName . " (ID#: " . $DeviceID."). El valor registrado fue de " .$Value. " %.";
  if ($Alarm == "MinSoil") $Message= "Se necesita RIEGO en ". $DeviceName . " (ID#: " . $DeviceID."). El valor registrado fue de " .$Value. " %.";          
  //$Alarm= $_GET['Alarm'];

  $mail->Body = "<p> ATENCION: </p><p> " . $Message . "</p>";

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
	echo "Problemas enviando correo electrónico a ";
	echo "<br/>".$mail->ErrorInfo;	
   }
   else
   {
	echo "OK";
   } 
?>

