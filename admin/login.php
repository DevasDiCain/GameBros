<?php

            if(isset($_POST['btnEntrar']))
			{
                $usuario=clean($conexion,$_POST["user"]);
                $clave=clean($conexion,$_POST["password"]);

                if($usuario=="" || $clave=="")
                {
                    $_SESSION['error1']="vacio";
                    header("Location: index.php");
                    exit;
                }
                
                $pre_consulta = "SELECT sal FROM usuarios WHERE usuario='$usuario'";
                if($resultado_pre_consulta=mysqli_query($conexion,$pre_consulta))
                {
                    if($sal_usu_arr = mysqli_fetch_assoc($resultado_pre_consulta))
                    {
                        $sal_usu = $sal_usu_arr["sal"];
                        // HASHEO DE CLAVES
                        $hash_login=generarHash($clave.$sal_usu);
                        $consulta="SELECT * FROM usuarios WHERE usuario='".$usuario."' AND password='$hash_login'";

                        if($resultado = mysqli_query($conexion,$consulta))  
                        {
                            if(mysqli_num_rows($resultado) > 0)
                            {
                                if(isset($_POST["recordarPass"]))
                                {
                                    if($usu_datos = mysqli_fetch_assoc($resultado))
                                    {
                                    $ip_usuario = getUserIP();
                                    $sal_cookie = generarSal();
                                    $cookieUser = generarHashCookie($ip_usuario,$_SERVER['HTTP_USER_AGENT'],$sal_cookie);
                                    $fecha_hoy  = date('Y-m-d');
                                    setcookie("recordarPass","$cookieUser",time()+5259600);  // 5259600 segundos = 2 meses
                                    $consulta_insert_cookie = "INSERT INTO cookies (id_usuario,valor,fecha_creacion) VALUES ('".$usu_datos['idUsuario']."','$cookieUser','$fecha_hoy')";
                                    mysqli_query($conexion,$consulta_insert_cookie);
                                    }
                                }
                                session_regenerate_id(true);
                                $_SESSION['usuario']=$usuario;
                                $_SESSION['clave']=$hash_login;
                                $_SESSION['sesion']=time();
                                
                                $_SESSION['userAgent'] = $_SERVER['HTTP_USER_AGENT'];
                                $_SESSION['userIp'] = getUserIP();

                                header("Location: ./index.php");
                                exit;
                            }else
                            {
                                mysqli_free_result($resultado);
                                $_SESSION['error']="malUsuario";
                                header("Location: index.php");
                                exit;
                            }

                            }else
                            {
                                die("Imposible conectar. Error número: ".mysqli_errno($conexion). ":".mysqli_error($conexion));  
                                header("Location: ./index.html");
                                exit;
                            }
                      

                     }else
                    {
                         mysqli_free_result($resultado);
                         $_SESSION['error']="malUsuario";
                         header("Location: index.php");
                         exit;
                     }
                }
			}else{
                require("funciones.php");
                require("conex_bd.php");
                session_name("bd_gameBros");
                session_start();
               
                if($conexion= conectar())
                {

                $ip_desconfiable = getUserIP();
                $hoy = date("Y-m-d H:i:s");
				$insert_ip_desconfiable = "INSERT INTO lista_intrusiones (ip,fecha,tipo) VALUES ('$ip_desconfiable','$hoy','Acceso por URL al Loggin')";
				mysqli_query($conexion,$insert_ip_desconfiable);
                }
                $_SESSION['error']="restringido";
                header("Location: ../index.php");
                exit;
            }
?>