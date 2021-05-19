<?php
require_once("../admin/funciones.php");
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
	<link rel="stylesheet" type="text/css" href="../css/index.css"/>
</head>
<body>
<div class="container">
			<?php 

				if(isset($_GET["error"]))
					mostrar_error($_GET["error"]);
			?>
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Registrate</h3>
			</div>
			<div class="card-body">
				<form  action="../index.php" method="POST">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" name="usuario"  required class="form-control" placeholder="Usuario">
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" required name="contrasenia" class="form-control" placeholder="Contraseña">
					</div>
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-address-book"></i></span>
						</div>
						<input type="text" name="name" class="form-control" placeholder="Nombre completo">
						
					</div>
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-envelope"></i></span>
						</div>
						<input type="email"  required name="mail" class="form-control" placeholder="Correo Electrónico">
						
					</div>
				<div class="form-group">
               			 <input type="submit" name="btnAceptarRegistro" value="Entrar" class="btn float-right login_btn">
				</div>

				</form>
				<form action="../index.php" method="POST">
					<div class="form-group" >
							<input type="submit" value="Volver" name="btnvolver" class="btn float-left login_btn" >
					</div>
				</form>
			</div>
			
		</div>
	</div>
</div>
</body>
</html>