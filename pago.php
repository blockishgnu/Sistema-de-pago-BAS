<?php
include('config.php');


$fecha=date('Y-m-d');
$total=$_POST['total'];
$id_usuario=$_POST['id_usuario'];
$moneda=$_POST['moneda'];


$sql="INSERT INTO folio_pago (fecha,total,moneda,id_usuario)
VALUES ('".$fecha."','".$total."','".$moneda."','".$id_usuario."')";

if(mysqli_query($con,$sql)){
  $id=mysqli_insert_id($con);
  echo $id;


}else{
  echo 1;
}

 ?>
