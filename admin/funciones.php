<?php
	
	function repetido_n($columna,$valor,$conex)
			{
				$rep=false;
				$consulta="select usuario from usuarios where ".$columna."='".$valor."'";
				if($resultado=mysqli_query($conex,$consulta))
				{
					if(mysqli_num_rows($resultado)>0)
					{
						$rep=true;
						mysqli_free_result($resultado);
					}
					
					
				}
				else
				{
					$error="Imposible realizar la consulta. Error número: ".mysqli_errno($conex). ":".mysqli_error($conex);
					mysqli_close($conex);
					die($error);	
				}

				return $rep;

			}
	function repetido($conexion,$v_bd,$v_form,$column)
	{
		if($v_bd==$v_form)
			$repetido=false;
		else
		{
			$consulta="select usuario from usuarios where ".$column."='".$v_form."'";
		
			if($resultado=mysqli_query($conexion,$consulta))
			{
				$repetido=mysqli_num_rows($resultado)>0;
				mysqli_free_result($resultado);
			}
			else
			{
				$error="Imposible realizar la consulta. Error número: ".mysqli_errno($conexion). ":".mysqli_error($conexion);
				mysqli_close($conexion);
				die($error);
			}
		
		}
		return $repetido;

	}

	
	function repetido_Categoria($columna,$valor,$conex)
			{
				$rep=false;
				$consulta="select valor from categorias where ".$columna."='".$valor."'";
				if($resultado=mysqli_query($conex,$consulta))
				{
					if(mysqli_num_rows($resultado)>0)
					{
						$rep=true;
						mysqli_free_result($resultado);
					}
					
					
				}
				else
				{
					$error="Imposible realizar la consulta. Error número: ".mysqli_errno($conex). ":".mysqli_error($conex);
					mysqli_close($conex);
					die($error);	
				}

				return $rep;

			}
			function repetido_Noticia($columna,$valor,$conex,$categoria)
			{
				$rep=false;
				$consulta="select titulo from noticias where ".$columna."='".$valor."' AND idCategoria='".$categoria."'";
				if($resultado=mysqli_query($conex,$consulta))
				{
					if(mysqli_num_rows($resultado)>0)
					{
						$rep=true;
						mysqli_free_result($resultado);
					}
					
					
				}
				else
				{
					$error="Imposible realizar la consulta. Error número: ".mysqli_errno($conex). ":".mysqli_error($conex);
					mysqli_close($conex);
					die($error);	
				}

				return $rep;

			}

		function clean($conexion,$campo){
			return mysqli_real_escape_string($conexion,htmlspecialchars($campo));
		}

		function buscar_en_lista($archivo_json,$tipo_lista,$objetivo,$especificacion){
			$respuesta=false;

			if($datos = @file_get_contents($archivo_json))
				$listas = json_decode($datos, true);

			switch($tipo_lista)
			{
				case 'blanca': $lista_rellena = $listas["lista_blanca"]["$especificacion"];
					break;

				case 'negra': $lista_rellena = $listas["lista_negra"]["$especificacion"];
					break;
			}

			for ($i = 0; $i < count($lista_rellena); $i++)
			{
				if($lista_rellena[$i] == $objetivo)
					$respuesta=true;
			}
			return $respuesta;
		}

		function extraer_extension($archivo){// argumento = $_FILES["LOQUESEA"]["tmp_name"]
			$token=false;
			$respuesta="";
			for($i = 0; $i < strlen($archivo); $i++)
			{
				if($token)
				{  
					$respuesta=$respuesta.$archivo[$i];
				}
				if($archivo[$i]=="/")
				{
					$token=true;
				}
			}
			return $respuesta;
		}

		function comprobar_extension($archivo){

			$extension = extraer_extension($archivo);
			$lista_blanca_extensiones = ["jpeg","jpg","gif","x-png","png"];

			if(in_array($extension,$lista_blanca_extensiones))
				return true;
			else
				return false;

		}
		function mover_imagen($archivo_temporal,$nombre_nueva_foto){// argumento = $_FILES["LOQUESEA"]["tmp_name"]
			$ruta_destino = "assets/imagenes/";

			if(move_uploaded_file($archivo_temporal,$ruta_destino.$nombre_nueva_foto))
				return true;
			else
				return false;
		}

		function control_usuario($valor_introducido){
			$rep = true;
			$lista_blanca=["a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","0","1","2","3","4","5","6","7","8","9"];
			for($i=0;$i<strlen($valor_introducido);$i++)
			{
				if(!in_array($valor_introducido[$i],$lista_blanca))
						$rep=false;
			}
			return $rep;
		}

		function mostrar_error($error)
		{
			switch($error)
				{
					case 'restringido':error_log("Accediendo a una zona restringida");
							?> 
							<div class="alert alert-danger" >
								<strong>¡Error!</strong>Zona restringida <strong>¡Error!</strong>
							</div>	
							<?php
						break;
					case 'malUsuario': error_log("Login erróneo");
							?> 
							<div class="alert alert-danger" >
								<strong>¡Error!</strong>Usuario o contraseña inválidos <strong>¡Error!</strong>
							</div>	
							<?php
										if(!isset($_SESSION["controlLogin"]))
											$_SESSION["controlLogin"]=0;
										else
											$_SESSION["controlLogin"]++;
						break;
					case 'tiempo': error_log("Sesión caducada");
								?> 
								<div class="alert alert-danger" >
									<strong>¡Error!</strong>Sesión Caducada <strong>¡Error!</strong>
								</div>	
								<?php
						break;
					case 'moverImagen': error_log("Error al mover la imagen a la carpeta destino");
								?> 
								<div class="alert alert-danger" >
									<strong>¡Error!</strong>Error al mover la imagen a la carpeta destino <strong>¡Error!</strong>
								</div>	
								<?php
						break;
					case 'roboCookie':error_log("Intento de robo de cookie");
								?> 
								<div class="alert alert-danger" >
									<strong>¡Error!</strong>Intento de robo de cookie <strong>¡Error!</strong>
								</div>	
								<?php
						break;
					case 'cookie_expirada':error_log("La cookie ha expirado");
								?> 
								<div class="alert alert-danger" >
									<strong>¡Error!</strong>Tu cookie ha expirado <strong>¡Error!</strong>
								</div>	
								<?php
						break;
					case 'contrasenaEnviada':error_log("Recuperación de contrasenia inválido");
								?> 
								<div class="alert alert-danger" >
									<strong>¡Error!</strong>Tu contraseña ha sido enviada<strong>¡Error!</strong>
								</div>	
								<?php
						break;
					case 'camposVacios': error_log("Campos vacíos registro");
							?> 
							<div class="alert alert-danger" >
								<strong>¡Error!</strong>No puede haber campos vacíos <strong>¡Error!</strong>
							</div>	
							<?php
						break;
					case 'repetido': error_log("Campos vacíos registro");
							?> 
							<div class="alert alert-danger" >
								<strong>¡Error!</strong>Este usuario o email ya se encuentra en la base de datos <strong>¡Error!</strong>
							</div>	
							<?php
						break;
					default: error_log("Error desconocido");
						break;
				}
		}

		function getUserIP() {
			$ipaddress = '';
			if (isset($_SERVER['HTTP_CLIENT_IP']))
				$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
			else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
				$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
			else if(isset($_SERVER['HTTP_X_FORWARDED']))
				$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
			else if(isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
				$ipaddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
			else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
				$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
			else if(isset($_SERVER['HTTP_FORWARDED']))
				$ipaddress = $_SERVER['HTTP_FORWARDED'];
			else if(isset($_SERVER['REMOTE_ADDR']))
				$ipaddress = $_SERVER['REMOTE_ADDR'];
			else
				$ipaddress = 'UNKNOWN';
			return $ipaddress;
		}

	function generarHashCookie($ip,$navegador,$sal)
	{
		return generarHash($navegador.$ip.$sal);
	}

	function generarHash($password)
	{
        return md5($password);
	}

	function comprobarPassword($password,$hash)
	{
		return password_verify($password, $hash);
	}

	function generarSal(){

		$sal = random_int(1,9999999).random_int(1,9999999);
		$diccionario = ["a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","0","1","2","3","4","5","6","7","8","9"];

		$vueltas_A = random_int(1,27);
		$resto_A = random_int(0,4);
		for($i = 0 ; $i  < $vueltas_A  ; $i++)
		{
			if($resto_A > $vueltas_A)
			$sal = $sal.$diccionario[($resto_A+$i)-$vueltas_A];

		else
			$sal = $sal.$diccionario[($vueltas_A+$i)-$resto_A];
		
		}

		$vueltas_B = random_int(1,27);
		$resto_B = random_int(0,4);
		for($i = 0 ; $i  < $vueltas_B  ; $i++)
		{
			if($resto_B > $vueltas_B)
			    $sal = $sal.$diccionario[($resto_B+$i)-$vueltas_B];

			else
				$sal = $sal.$diccionario[($vueltas_B+$i)-$resto_B];
		}

		$sal = $sal.random_int(1,9999999).random_int(1,9999999);


		

		return $sal.random_int(1,9999999);
		
	}
	
	function verificarToken($token, $claveSecreta)
	{
		# La API en donde verificamos el token
		$url = "https://www.google.com/recaptcha/api/siteverify";
		# Los datos que enviamos a Google
		$datos = [
			"secret" => $claveSecreta,
			"response" => $token,
		];
		// Crear opciones de la petición HTTP
		$opciones = array(
			"http" => array(
				"header" => "Content-type: application/x-www-form-urlencoded\r\n",
				"method" => "POST",
				"content" => http_build_query($datos), # Agregar el contenido definido antes
			),
		);
		# Preparar petición
		$contexto = stream_context_create($opciones);
		# Hacerla
		$resultado = file_get_contents($url, false, $contexto);
		# Si hay problemas con la petición (por ejemplo, que no hay internet o algo así)
		# entonces se regresa false. Este NO es un problema con el captcha, sino con la conexión
		# al servidor de Google
		if ($resultado === false) {
			# Error haciendo petición
			return false;
		}

		# En caso de que no haya regresado false, decodificamos con JSON
		# https://parzibyte.me/blog/2018/12/26/codificar-decodificar-json-php/

		$resultado = json_decode($resultado);
		# La variable que nos interesa para saber si el usuario pasó o no la prueba
		# está en success
		$pruebaPasada = $resultado->success;
		# Regresamos ese valor, y listo (sí, ya sé que se podría regresar $resultado->success)
		return $pruebaPasada;
	}

	function mostrarJuegos($categoria,$conex)
	{
		$consulta="SELECT * FROM juegos WHERE categoria = '$categoria'";

				if($resultado=mysqli_query($conex,$consulta))
				{
					if(mysqli_num_rows($resultado)>0)
					{
						while($fila= mysqli_fetch_assoc($resultado))
						{	
							?>
						
								<div class="col-lg-4 col-md-6 mb-4">
									<div class="card h-100">
										<a href="#!"><img class="card-img-top" src="<?php echo $fila["portada"];?>" alt="..." /></a>
										<div class="card-body">
											<h4 class="card-title"><a href="#!"><?php echo $fila["titulo"];?></a></h4>
											<h5><?php echo $fila["precio"];?>$</h5>
											<p class="card-text"><?php echo $fila["informacion"];?></p>
										</div>
										<div class="card-footer"><small class="text-muted">★ ★ ★ ★ ☆</small></div>
									</div>
                      		</div>
							<?php
						}
						mysqli_free_result($resultado);
						
					}
					
					
				}
				else
				{
					$error="Imposible realizar la consulta. Error número: ".mysqli_errno($conex). ":".mysqli_error($conex);
					mysqli_close($conex);
					die($error);	
				}
	}
