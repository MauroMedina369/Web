<?php  
    session_start();
    //header('Access-Control-Allow-Origin: *');
    include "config.php";
    ini_set('max_execution_time', 5); 



    //error_reporting( E_PARSE);
    $Email =$_SESSION['Email'];   
    $querystr = "Select * from ajustes where Email = '".$Email."' order by State desc"; 
    #$querystr = "Select * from Dispositivos"; 
    //logmsg($querystr);   

    $db =  ConnectMySQL();
    $sql = $db->prepare($querystr); 
    $sql->execute(); 
   // logmsg($sql->rowCount());
   //$data[]=array();
   $offline=0;
   $total=0;
   $online=0;
   while($row= $sql->fetch(PDO::FETCH_ASSOC)){
            
    $diferencia = DiffTime($row["LastUpdateFecha"], $row["LastUpdateHora"]); //Diferencia en minutos
    //logmsg("Diferencia: "  . $diferencia);

    if ($diferencia >= 5) {$offline++;};
    $total++;
     
   }   
   $data["online"]=$online;     
   $data["total"]=$total;     
   $data["offline"]=$offline;     
   $db= null;
   $sql = null; // obligado para cerrar la conexión                               while($row= $sql->fetch(PDO::FETCH_ASSOC)){   

    //$row=SelectMultiDB($querystr);
   echo json_encode($data, JSON_FORCE_OBJECT);   

?>