<?php
   session_start();
   unset($_SESSION["usuario"]);
   unset($_SESSION["password"]);
   unset($_SESSION['tipo']);

   echo 'Cerrando sesión, redireccionando a iniciar sesión';
   header('Refresh: 1; URL = index.php');
?>
