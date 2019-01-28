<?php


 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "";
 $db = "basagent_pago";


 $con = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);


 return $con;

function CloseCon($con){
 $con -> close();
 }

?>
