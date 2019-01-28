<?php

include('config.php');

$fecha=date('Y-m-d');
$total=$_POST['total'];
$id_usuario=$_POST['id_usuario'];


$sql="INSERT INTO folio_pago (fecha,total,id_usuario)
VALUES ('".$fecha."','".$total."','".$id_usuario."')";

if(mysqli_query($con,$sql)){
  $id=mysqli_insert_id($con);
  echo $id;

}else{
  echo 1;
}

 ?>
