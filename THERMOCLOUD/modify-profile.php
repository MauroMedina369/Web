<?php  
session_start();
    include "config.php";
    ini_set('max_execution_time', 5); 
    error_reporting( E_PARSE);
    $Email =$_SESSION['Email'];   
    $Datos= $_GET['Datos'];   
    $parametros = json_decode($Datos);
    $t1= $parametros->{'Name'};
    $t2= $parametros->{'LastName'};
    $t3= $parametros->{'Email'};
    $t4= $parametros->{'Password'};   

    $querystr = "UPDATE usuarios SET Name = '" . $t1. "',LastName = '" . $t2. "' , Email = '" . $t3. "' WHERE Email = '".$Email ."'";
    InsertDBMySQL($querystr);        
    $row="OK";
    echo json_encode($row, JSON_FORCE_OBJECT);   
?>
