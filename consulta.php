<?php
$consulta_certificados = mysqli_query($conne,"SELECT *
        FROM administracion
  			WHERE Asegurado = '".$_SESSION['asegurado']."' AND STATUS IN ('4') AND ultimo = '1'
  			ORDER BY facturareporte DESC , Moneda DESC ");

 ?>
