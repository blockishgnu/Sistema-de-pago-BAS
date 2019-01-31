<?php
$consulta_certificados = mysqli_query($conne,"SELECT DISTINCT * , IF( administracion.valor_dolar = '' AND tipo_cambio.moneda = 'Dólares', 'Dolares', 'Pesos' ) AS MONEDAA, ca.kilometros, pa.tipo FROM administracion
  			INNER JOIN grupos_certificados ON administracion.Vendedor = grupos_certificados.id_usuario AND administracion.id = grupos_certificados.id_certificado
  			INNER JOIN tipo_cambio ON tipo_cambio.id_aseguradora = administracion.Aseguradora
  			LEFT JOIN basagent_emision_dos.certificado_ambiental AS ca ON ca.folio = administracion.folio AND administracion.id_certificado_emision = ca.id_certificado
  			LEFT JOIN basagent_emision_dos.producto_ambiental AS pa ON pa.id_producto_ambiental = ca.id_producto_ambiental
  			WHERE Asegurado = '".$_SESSION['asegurado']."' AND STATUS IN ('4') AND ultimo = '1'
  			ORDER BY grupos_certificados.id_incremental DESC , MONEDAA DESC , administracion.id ASC");

 ?>
