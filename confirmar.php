<?php
session_start();
include 'conect_comision.php';

$usuario= $_SESSION['asegurado'];
$id_factura=$_POST['id_factura'];
$cantidad=$_POST['cantidad'];
$t=0;
$consulta_facturas = mysqli_query($conne,"SELECT * FROM administracion WHERE facturareporte='".$id_factura."' AND Asegurado='".$usuario."'");
while ($registro_facturas = mysqli_fetch_array($consulta_facturas)){

   $t+=$registro_facturas['PrimaTotal'];
}

if(number_format($t,2,".","")!=$cantidad){
  echo 1;
}else{

  echo 0;
}



 ?>
