<?php

include('config.php');

$id_usuario=$_POST['id_usuario'];
$id_factura=$_POST['id_factura'];
$cantidad=$_POST['cantidad'];
$id_folio=$_POST['id_folio'];

$sql="INSERT INTO pagos (id_factura,id_usuario,cantidad,id_folio)
VALUES ('".$id_factura."','".$id_usuario."','".$cantidad."','".$id_folio."')";

if(mysqli_query($con,$sql)){
  echo 0;

}else{
echo"Error: ".mysqli_error($con);
}

 ?>
