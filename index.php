<?php
require("admin/conex_bd.php");
require("admin/funciones.php");

session_name("bd_gameBros");
session_start();

if($conexion= conectar())
{
// BLOQUEO DE IP SEGÚN LISTA NEGRA
$ip_usuario = getUserIP();
$consulta_lista_negra = "SELECT * FROM lista_negra WHERE ip = '$ip_usuario'";
if($resultado_lista_negra = mysqli_query($conexion,$consulta_lista_negra))
{
	if(mysqli_num_rows($resultado_lista_negra) > 0)
	{
		exit("Lo sentimos su IP se encuentra baneada actualmente");
	}
}
mysqli_set_charset($conexion,'utf8');
// CONTROL DE ATAQUE POR DICCIONARIO O FUERZA BRUTA
if(isset($_SESSION["controlLogin"]))
						{
							if($_SESSION["controlLogin"] == 5)
							{
								$ip_desconfiable = getUserIP();
								$insert_ip_negra = "INSERT INTO lista_negra (ip) VALUES ('$ip_desconfiable')";
								mysqli_query($conexion,$insert_ip_negra);
								error_log("ALERTA: Posible Ataque",3,'rodriguezfernandezjose20@ieskursaal.com');
								unset($_SESSION["controlLogin"]);
								exit("Sesión BLOQUEADA. Contacta con el adminsitrador.");
							}
						}
		if(isset($_POST["btnAceptarRegistro"]))
		{
			include("registro.php");
		}
					}// AQUÍ DENTRO VA LA LOGICA DE LA  SESION
					//  POR AQUÍ LO HE DEJADOOOOOOOOOOOOOOOO
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<!DOCTYPE html>
<html>
<head>
	<title>Game Bros</title>

   
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="css/index.css"/>
</head>
<body>
<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>GameBros</h3>
				<div class="d-flex justify-content-end social_icon">
					<span><i class="fab fa-facebook-square"></i></span>
					<span><i class="fab fa-google-plus-square"></i></span>
					<span><i class="fab fa-twitter-square"></i></span>
				</div>
			</div>
			<div class="card-body">
				<form>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="Usuario">
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="Contraseña">
					</div>
					<div class="row align-items-center remember">
						<input type="checkbox">Recuerdame
					</div>
					<div class="form-group">
						<input type="submit" value="Entrar" class="btn float-right login_btn">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					¿No tienes aún cuenta?<a href="vista_registro.php">Registrate</a>
				</div>
				<div class="d-flex justify-content-center">
					<a href="#">¿Olvidaste tu contraseña?</a>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>