<?php
ob_start();
session_start();
require_once 'config.php';

if(isset($_SESSION['usuario'])){

 header("Location: pagos.php");

}

$navegador = $_SERVER['HTTP_USER_AGENT'];
$deshabilitar_campos = " disabled";

//validación de navegadores
if(strpos($navegador,"Firefox") || strpos($navegador,"Chrome") || strpos($navegador,"Safari"))//strpos($navegador,"Mobile") <-- Para bloquear los mobiles tambien -->
{
	$deshabilitar_campos = "";
	echo "<input type='hidden' id='navegador' value='0'>";
}else
	echo "<input type='hidden' id='navegador' value='1'>";

?>
<head>
<meta charset="UTF-8">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="css/style.css" rel="stylesheet" >
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
</head>
<?php
	 $msg = '';

	 if (isset($_POST['login']) && !empty($_POST['username'])
			&& !empty($_POST['password'])) {

				$encrip=md5($_POST['password']);
				$result = mysqli_query($con,"SELECT * FROM users WHERE user='".$_POST['username']."' AND password='".$encrip. "'  ") or die(mysqli_error($con));

			if (mysqli_num_rows($result)>0) {

				$row=mysqli_fetch_row($result);


				 $_SESSION['valid'] = true;
				 $_SESSION['timeout'] = time();
         $_SESSION['id_usuario']=$row[0];
				 $_SESSION['nombre'] = $row[1];
				 $_SESSION['usuario']=$row[2];
				 $_SESSION['asegurado']=$row[4];

				 header ("Location: pagos.php");


				 echo 'Contraseña correcta';
			}else {
				 $msg = 'Usuario y/o contraseña incorrecta';
			}
	 }
?>
<body>
	<div id="login">
    <h3 class="text-center text-white pt-5"></h3>
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div class="login-box col-md-12">
                    <form id="login-form" class="form" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"
											 method = "post">
                        <h3 class="text-center text-info"><img src="images/logo_login_color.png" alt="BAS" height="98" width="210"></h3>
												<h4 class = "form-signin-heading" style="color:red;"><b> <?php echo $msg; ?></b></h4>
												<br>
												<div class="form-group">
                            <label for="username"><b>Usuario:</b></label><br>
                            <input type="text" name="username" id="username" class="form-control">
                        </div>
                        <div class="form-group" >
                            <label for="password"><b>Contraseña:</b></label><br>
                            <input type = "password" name="password" id="password" class="form-control">
                        </div>
                        <div class="form-group">
                          <br>
                            <button type="submit" class="ingresar" name = "login"><b>INGRESAR</b></input>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
		<br>
		<br>
		<div style="text-align:center; color: #fff;">
			© Copyright <?php echo date("Y") ?> BAS Agente de Seguros y de Fianzas S.A. de C.V. <br />Developed by: Hello Digital S. de R.L. de C.V.
		</div>
</div>
</body>
