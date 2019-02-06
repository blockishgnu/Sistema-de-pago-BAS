<?php
session_start();
include 'conect_comision.php';

$usuario= $_SESSION['asegurado'];
$id_factura=$_POST["factura"];

$result=mysqli_query($conne,"SELECT * FROM administracion WHERE facturareporte ='".$id_factura."' AND Asegurado='".$usuario."' ");
echo "
<thead>
<tr>
<th>Folio</th>
<th>Certificado</th>
<th>Prima</th>
</tr>
</thead>
<tbody>
";
while ($row=mysqli_fetch_array($result)) {
  echo "
  <tr>

  <td>".$row['Folio']."</td>
  <td>".$row['Certificado']."</td>
  <td>$ ".number_format($row['PrimaTotal'],2,".",",")."</td>



  </tr>

  ";
}

echo "</tbody>";

 ?>
