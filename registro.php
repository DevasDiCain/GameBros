<?php
   

	$error_user=true;
	$error_pass=true;
	$error_name=true;
	$error_mail=true;
	if(isset($_POST['btnvolver']))
	{
		header("Location: index.php");
		exit();
	}
	if(isset($_POST['btnAceptarRegistro']))
	{
		
		$usuario = clean($conexion,$_POST["usuario"]);
		$pass = clean($conexion,$_POST["contrasenia"]);
		$name = clean($conexion,$_POST["name"]);
		$mail = clean($conexion,$_POST["mail"]);


		$error_user=($usuario=="" || repetido_n("usuario",$usuario,$conexion) || !control_usuario($usuario));
		$error_pass=($pass=="" || !control_usuario($pass));
		$error_name=($name=="" || !control_usuario($name));
		$error_mail= ($mail=="" || repetido_n("email",$mail,$conexion));

		$error= (!$error_user && !$error_pass && !$error_name  && !$error_mail);
     
		if($error)
		{
	
			$nueva_sal = generarSal();
			$hash_registro=generarHash($pass.$nueva_sal);


			$consulta="INSERT INTO usuarios (usuario,password,nombre,email,sal) VALUES ('".$usuario."','$hash_registro','".$name."','".$mail."','$nueva_sal')";
			
			if($resultado = mysqli_query($conexion,$consulta))
			{
				
                $_SESSION['usuario']=$usuario;
                $_SESSION['clave']=$hash_registro;
                $_SESSION['sesion']= time();
                $_SESSION['userAgent'] = $_SERVER['HTTP_USER_AGENT'];
                $_SESSION['userIp'] = getUserIP();
                header("Location: ./index.php?registrado");
				
			}else
			{
			  $error="Error al realizar la consulta";
			  mysqli_close($conexion);
			  die($error);

			}
		}
        else
        {//CONTROL DE ERROR REGISTRO
			if($usuario == "" || $pass == "" || $name == "" || $mail == "")
				header("Location: vistas/vista_registro.php?error=camposVacios"); 
			if(repetido_n("usuario",$usuario,$conexion) || repetido_n("email",$mail,$conexion))
				header("Location: vistas/vista_registro.php?error=repetido"); 
           
        }
	
	
	

}
else
{
	session_name("bd_gameBros");
	session_start();
	$_SESSION['error']="restringido";
	header("Location: index.php");
	exit;
}
?>
