<?php  
header('Access-Control-Allow-Origin: *');
include "config.php";
ini_set('max_execution_time', 5); 
//error_reporting( E_PARSE);
$DeviceID = $_GET['DeviceID'];    
$Temp = $_GET['Temp'];
$HR = $_GET['HR'];
$Fecha= _GetDate();
$Hora =_GetTime();
$Color1=0;
$Color2=0;

    $ValoresString = "'".$DeviceID . "','" .  $Temp. "','" . $HR. "','"  .$Fecha."','" . $Hora. "'"  ;
    $ValoresString2 = "`DeviceID` = '".$DeviceID."',`Temp` =  '".$Temp."',`HR` =  '".$HR."',`Fecha` = '".$Fecha."',`Hora` = '".$Hora."'";
    
    $querystr = "INSERT INTO  Historial (DeviceID, Temp , HR, Fecha,Hora) VALUES (".$ValoresString.") ON DUPLICATE KEY UPDATE ".$ValoresString2;
    InsertDBMySQL($querystr);

    $out=array();
    $out =CheckLimits($DeviceID,$Temp,$HR);  
    $Color1=$out[0]; //Color de Temperatura
    $Color2=$out[1]; //Color de Humedad
    $querystr = "UPDATE Ajustes SET Value1 = '" . $Temp. "', Value2 = '" . $HR. "', LastDateUpdate = '" . $Fecha. "', LastTimeUpdate = '" . $Hora. "', State = '1',Color1 = '".$Color1."',Color2= '".$Color2."' WHERE DeviceID = '". $DeviceID."'";
    InsertDBMySQL($querystr); 

    logmsg($querystr);

    echo json_encode($out[3], JSON_FORCE_OBJECT);   

function CheckLimits($DeviceID,$_Temp,$_HR){ //Chequea límites e invoca a InsertAlert()
    $querystr = "Select * from Ajustes where DeviceID = '" . $DeviceID . "'";
    $row = SelectDB($querystr);    
    $out=array();
    $retorno="";    
    $t1= (float)$row["TempLimitMenor"];
    $t2= (float)$row["TempLimitMayor"];
    $hr1=(float)$row["HRLimitMenor"];
    $hr2=(float)$row["HRLimitMayor"];
    $Email = $row["Email"];
    $Temp = (float)$_Temp;
    $HR=(float)$_HR;
    $Color1=0;
    $Color2=0;
    if ($Temp > $t2 ) {InsertAlert($DeviceID,"TempMax",$Temp,$Email); $retorno = "TMax,";$Color1=2;}
    if ($Temp < $t1 ) {InsertAlert($DeviceID,"TempMin",$Temp,$Email);$retorno =$retorno. "TMin,";$Color1=1;}
    if ($HR > $hr2 ) {InsertAlert($DeviceID,"HRMax",$HR,$Email);$retorno = $retorno."HRMax,";$Color2=2;}
    if ($HR < $hr1 ) {InsertAlert($DeviceID, "HRMin", $HR,$Email);$retorno = $retorno."HRMin,";$Color2=1;}
    $out[0]=$Color1;
    $out[1]=$Color2;
    $out[3]=$retorno;
    return $out;
}

function InsertAlert($DeviceID, $Tipo, $Valor,$Email) {
    $Fecha= _GetDate();
    $Hora =_GetTime();
    //logmsg ($Fecha);
    $querystr = "Select * from Alertas where Tipo = '".$Tipo ."' and DeviceID= '". $DeviceID . "' order by fecha desc, hora desc limit 1";
    $row = SelectDB($querystr); 
    $Diferencia = DiffTime($row["Fecha"], $row["Hora"]);
    logmsg($Tipo);
    logmsg($Diferencia);
    if ($Diferencia >= 180) {
        $ValoresString = "'".$DeviceID . "','" .  $Tipo. "','" . $Valor. "','"  .$Fecha."','" . $Hora. "','0','0','".$Email."'";
        $ValoresString2 = "`DeviceID` = '".$DeviceID."',`Tipo` =  '".$Tipo."',`Valor` =  '".$Valor."',`Fecha` = '".$Fecha."',`Hora` = '".$Hora."'";    
        $querystr = "INSERT INTO  Alertas (DeviceID, Tipo , Valor, Fecha,Hora,Visto,Notificado,Email) VALUES (".$ValoresString.") ON DUPLICATE KEY UPDATE ".$ValoresString2;    
        InsertDBMySQL($querystr);  //Se fija que la alerta anterior tenga al menos 3 horas de diferencia
        logmsg($querystr);
    }
}

?>