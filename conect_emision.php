<?php


 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "";
 $db = "basagent_emision_dos";


 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);


 return $conn;

function CloseConn($conn)
 {
 $conn -> close();
 }

?>
