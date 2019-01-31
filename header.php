<?php
session_start();
require_once 'config.php';
require_once 'conect_comision.php';

if(isset($_SESSION['usuario'])){
  $usuario= $_SESSION['usuario'];
  $nombre=$_SESSION['nombre'];
  $id_usuario=$_SESSION['id_usuario'];
}else{
  header("Location: index.php");
}
 ?>
 <head>
   <link href="css/header.css" rel="stylesheet" >
   <link href="css/pago.css" rel="stylesheet" >
   <link href="css/footer.css" rel="stylesheet" >
   <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.quicksearch/2.2.1/jquery.quicksearch.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.4/sweetalert2.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
  


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.4/sweetalert2.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

 </head>
<div id="banner">
<img id="logo" src="images/logo_bas_completo.png" alt="BAS"  width="190">

<div class="top-nav clearfix">
<ul class="nav pull-right top-menu">
<li style="margin-top: 10px; margin-right: 5px; margin-bottom: 5px;">

</li>

<li class="dropdown">
    <a data-toggle="dropdown" id="usuario" class="dropdown-toggle icon-user" href="#">

        <i class="fa fa-user" ></i>
        <label id="nombre"><?php echo $nombre; ?></label>
        <b class="caret" ></b>
    </a>
    <ul class="dropdown-menu extended logout">
        <li><a href="logout.php"><i class="fa fa-key"></i> Cerrar Sesión</a></li>
    </ul>
</li>

</ul>
</div>
<br>

</div>
