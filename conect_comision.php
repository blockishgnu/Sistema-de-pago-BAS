<?php


 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "";
 $db = "basagent_comisiones";


 $conne = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conne -> error);


 return $conne;

function CloseConne($conne)
 {
 $conne -> close();
 }

?>
