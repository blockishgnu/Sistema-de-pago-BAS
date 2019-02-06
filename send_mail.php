<?php

require("phpmailer/class.phpmailer.php");
require("phpmailer/class.smtp.php");


$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = "ssl";
$mail->Host = "server.basagentes.mx";
$mail->Port = 465;
$mail->Username = "envio_certificados@basagentes.mx";
$mail->Password = "hx69wEid,n7x";

$mail->From = "envio_certificados@basagentes.mx";
$mail->FromName = utf8_decode("Sistema de Pago");
$mail->Subject = "Confirmacion de pago y proceso de acreditacion";
$mail->AddAddress($correo,$nombre);
//$mail->AddCC("usuariocopia@correo.com");
$mail->AddBCC("programacion2@hellodigital.mx","Arturo");

$mail->AddEmbeddedImage('images/logo_bas_completo.png', 'logo');

$mail->MsgHTML("

	<style type='text/css'>
		.borde
		{
			border:solid 1px #cccccc;
			background-color:#ffffff;
		}
		.texto
		{
			font-size:16px;
			color: #00000;
			font-family:Arial;
		}
		.copy
		{
			font-size:9px;
			color: #00000;
			font-family:Arial;
		    text-align:center;
		}
    #logo{
      margin:10px;
    }
    .banner{

      margin-bottom: 40px;

      background: rgba(3,123,235,1);
      background: -moz-linear-gradient(left, rgba(3,123,235,1) 0%, rgba(3,49,99,1) 100%);
      background: -webkit-gradient(left top, right top, color-stop(0%, rgba(3,123,235,1)), color-stop(100%, rgba(3,49,99,1)));
      background: -webkit-linear-gradient(left, rgba(3,123,235,1) 0%, rgba(3,49,99,1) 100%);
      background: -o-linear-gradient(left, rgba(3,123,235,1) 0%, rgba(3,49,99,1) 100%);
      background: -ms-linear-gradient(left, rgba(3,123,235,1) 0%, rgba(3,49,99,1) 100%);
      background: linear-gradient(to right, rgba(3,123,235,1) 0%, rgba(3,49,99,1) 100%);
      filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#037beb', endColorstr='#033163', GradientType=1 );

      color: white;

      -webkit-box-shadow: 0px 12px 14px -1px rgba(0,0,0,0.7);
      -moz-box-shadow: 0px 12px 14px -1px rgba(0,0,0,0.7);
       box-shadow: 0px 12px 14px -1px rgba(0,0,0,0.7);

    }
	</style>
  <div class='banner'>
  <img id='logo' src='cid:logo' alt='BAS'  width='120'>
  </div class='banner'>
	<table width=100% border='0' cellpadding='0' cellspacing='0' class='borde'>
	<tr>
	    <td>
			<div align=center width=100%;>
			<table width=500; border='0' cellpadding='10' cellspacing='0'>
			<tr>
				<td>
					<div class='texto'>
						Hola, se ha realizado el pago correctamente, Folio: <strong>".$folio."</strong>
						con un costo total de $ <strong>".number_format(ceil($total), 2, ".", ",")."</strong> el cual esta en proceso de acreditacion. <br/><br/>
						Contacte al vendedor para mas informacion.
					</div>
				</td>
			</tr>
			</table>
			</div>

	    </td>
	</tr>
	</table>
	");
//$mail->AltBody = "Hola amigo\nprobando PHPMailer\n\nSaludos";
//$mail->AddAttachment("images/foto.jpg", "foto.jpg");
$mail->addStringAttachment($pdfdoc, 'Recibo-pago-folio:'.$folio.'.pdf');
$mail->IsHTML(true);
$mail->Send();


 ?>
