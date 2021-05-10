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
	
			
		if(isset($_SESSION['usuario']) && isset($_SESSION['clave']) && isset($_SESSION['sesion']))
		{
			$hash=$_SESSION['clave'];

			$consulta="SELECT *  FROM usuarios WHERE usuario='".$_SESSION['usuario']."' and password='$hash'";
	 
			if($resultado=mysqli_query($conexion,$consulta))
			{
				 if(mysqli_num_rows($resultado) > 0)
				 {
						 if($datos_usu = mysqli_fetch_assoc($resultado))
						 {
							 mysqli_free_result($resultado);
	 
							 $tiempoActual = time();
							 $tiempoTranscurrido = $tiempoActual - $_SESSION['sesion'];
							 if($tiempoTranscurrido > 60*5)
							 {
								 $_SESSION['error']="tiempo";
								 unset($_SESSION['usuario']); 
								 unset($_SESSION['clave']);
								 unset($_SESSION['sesion']);
								 header("Location: index.php");
								 exit;
							 }else
							 {
								 $_SESSION['sesion']=time();
								 // CONTROL DE ROBO DE COOKIE
								 if(!isset($_SESSION["userIp"]) || !isset($_SESSION["userAgent"]))
								 { 
									 
									 $_SESSION['error']="roboCookie";
									 unset($_SESSION['usuario']); 
									 unset($_SESSION['clave']);
									 unset($_SESSION['sesion']);
									 header("Location: index.php");
									 exit;
								 }
								 else
								 {
									 if($_SESSION["userAgent"] != $_SERVER['HTTP_USER_AGENT'] || $_SESSION["userIp"] != getUserIP())
									 {
										 $_SESSION['error']="roboCookie";
										 unset($_SESSION['usuario']); 
										 unset($_SESSION['clave']);
										 unset($_SESSION['sesion']);
										 header("Location: index.php?robo");
										 exit;
									 }
									 //BIFURCACIÓN ADMIN /  NORMAL
									 if($datos_usu['tipo']=="normal")
									 {
										 require("vistas/vista_normal.php");
									 }else
									 {
										 require("vistas/vista_admin.php");
									 }
								 }
							 
							 }
							 
						 }
						 else{
							 die("No se ha podido extraer los datos con éxito");
						 }
				 }else
				 {
					 $_SESSION['error']="restringido";
					 mysqli_free_result($resultado);
					 header("Location: index.php");
				 }
			}else
			{
				$error="Error de conexion nº ".mysqli_errno($conexion)." : ".mysqli_error($conexion);
			}
		 
			 
		}else
		 {
			if(isset($_POST["btnAceptarRegistro"]))
			{
				include("registro.php");
			}
			 // CONTOL DE COOKIE
			 if(isset($_COOKIE["recordarPass"]))
			 {
				 $consulta_cookie = "SELECT * FROM cookies WHERE valor='".$_COOKIE["recordarPass"]."'";
		 
				 if($resultado_cookie=mysqli_query($conexion,$consulta_cookie))
				 {
					  if(mysqli_num_rows($resultado_cookie) > 0)
					  { 
						 if($datos_usu_cookie = mysqli_fetch_assoc($resultado_cookie))
							 {
								 $datos_usu_cookie["fecha_creacion"];
			 
							 if(($datos_usu_cookie["fecha_creacion"] + 5259600) > time())
							 {
								 $_SESSION['error']="cookie_expirada";
								 setcookie("recordarPass",-1);
								 unset($_COOKIE["recordarPass"]);
								 header("Location: index.php");
								 exit;
							 }
							 else
							 {
								 $id_usuario = $datos_usu_cookie ["id_usuario"];
								 $consulta_cookie_correcta = "SELECT * FROM usuarios WHERE idUsuario = $id_usuario";
								 if($resultado_cookie_correcta=mysqli_query($conexion,$consulta_cookie_correcta))
								 {
									  if(mysqli_num_rows($resultado_cookie_correcta) > 0)
									  {
											  if($datos_usu_cookie_correcta = mysqli_fetch_assoc($resultado_cookie_correcta))
											  {
												  mysqli_free_result($resultado_cookie_correcta);
												  $_SESSION['usuario']=$datos_usu_cookie_correcta["usuario"];
												  $_SESSION['clave']=$datos_usu_cookie_correcta["password"];
												  $_SESSION['sesion']=time();
												  
												  $_SESSION['userAgent'] = $_SERVER['HTTP_USER_AGENT'];
												  $_SESSION['userIp'] = getUserIP();
												 
						 
												  header("Location: index.php");
												  exit;
											  }
									  }
								 }
							 }
						 }
					  }
				 }
			 }
			
				 if(isset($_POST['btnEntrar']))
				 {
					 require("admin/login.php");
				 }
				 
	// AQUÍ DENTRO VA LA LOGICA DE LA  SESION
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
				<form action="index.php" method="POST">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" name="user" class="form-control" placeholder="Usuario">
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password"  name="password" class="form-control" placeholder="Contraseña">
					</div>
					<div class="row align-items-center remember">
						<input type="checkbox">Recuerdame
					</div>
					<div class="form-group">
						<input type="submit" name="btnEntrar" value="Entrar" class="btn float-right login_btn">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					¿No tienes aún cuenta?<a href="vistas/vista_registro.php">Registrate</a>
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
<?php
	}
}
?>