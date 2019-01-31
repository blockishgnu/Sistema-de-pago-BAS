<?php

require('fpdf/fpdf.php');
require('config.php');

session_start();
$usuario= $_SESSION['asegurado'];

$folio=$_POST['folio'];
$items=$_POST['facturas'];

$consulta_pago=mysqli_query($con,"SELECT * FROM folio_pago WHERE id_folio='".$folio."'");
$registro_pago = mysqli_fetch_array($consulta_pago);



$pdf=new FPDF();
$pdf->AddPage();
$pdf->Image('images/marca_agua.jpg', 0, 0, 210,300);
$pdf->SetFont('Arial','B',16);

$pdf->SetXY(25, 20);

$pdf->Cell(40,10,'Recibo de pago');
$pdf->Image('images/logo_login_color.png',150,15,-130);
$pdf->SetFont('Arial','B',10);
$cliente="Cliente: ".$usuario;
$pdf->SetXY(25, 40);
$pdf->MultiCell(90,10,$cliente,1,"L");
$informacion="Folio: ".$folio."           fecha: ".$registro_pago['fecha'];
$pdf->SetXY(25, 60);
$pdf->Cell(150,10,$informacion,1,0,"C");

$pdf->SetXY(40, 80);
$pdf->SetFillColor(0,73,135);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(85,10,"Factura",1,0,"C",true);
$pdf->Cell(50,10,"Cantidad",1,1,"C",true);
$total=0;
$pdf->SetTextColor(0,0,0);


foreach ($items as $item) {
  foreach ($item as $fact) {
    $pdf->SetX(40);
    $pdf->Cell(85,10,$fact['name'],1,0,"C");
    $pdf->Cell(50,10,number_format($fact['price'],2)." ".$registro_pago['moneda'],1,1,"R");
    $total+=$fact['price'];
  }
}

$pdf->SetX(75);
$pdf->Cell(50,10,"Total:",1,0,"C");
$pdf->Cell(50,10,number_format($total,2)." ".$registro_pago['moneda'],1,1,"R");
ob_end_clean();
$pdfdoc = $pdf->Output('', 'S');
require 'send_mail.php';



 ?>
