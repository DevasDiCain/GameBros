<?php
    if(isset($_POST["añadirJuego"]))
    {
        $titulo = clean($conexion,$_POST["titulo"]);
        $precio = clean($conexion,$_POST["precio"]);
        $sinopsis = clean($conexion,$_POST["sinopsis"]);
        $genero = clean($conexion,$_POST["genero"]);
        $portada = clean($conexion,$_POST["portada"]);

        $error_titulo=true;
        $error_precio=true;
        $error_sinopsis=true;
        $error_genero=true;
        $error_portada=true;

        $error_titulo=($titulo=="");
		$error_precio=($precio=="" || $precio < 0);
		$error_sinopsis=($sinopsis=="");
		$error_genero= ($genero=="");
        $error_portada= ($portada =="");

        $error= (!$error_portada && !$error_titulo && !$error_precio && !$error_sinopsis  && !$error_genero);
     
		if($error)
		{
            $consulta="INSERT INTO juegos (titulo,precio,informacion,categoria,portada) VALUES ('".$titulo."','$precio','".$sinopsis."','".$genero."','$portada')";
			
			if($resultado = mysqli_query($conexion,$consulta))
                header("Location: index.php?añadido=true");
			else
			{
			  $error="Error al realizar la consulta";
			  mysqli_close($conexion);
			  die($error);

			}
        }
        else
        {//CONTROL DE ERROR AL INTRODUCIR JUEGO
			if($titulo == "" || $precio == "" || $sinopsis == "" || $genero == "")
				header("Location: index.php?error=camposVacios"); 
            if($precio < 0)
                header("Location: index.php?error=negativo");
           
        }
	
    }
    if(isset($_POST["editarJuego"]))
    {
        $nuevo_titulo = clean($conexion,$_POST["nuevo_titulo"]);
        $nuevo_precio = clean($conexion,$_POST["nuevo_precio"]);
        $nueva_sinopsis = clean($conexion,$_POST["nueva_sinopsis"]);
        $nuevo_genero = clean($conexion,$_POST["nuevo_genero"]);
        $nueva_portada = clean($conexion,$_POST["nueva_portada"]);
        $id_juego = clean($conexion,$_POST["editarJuego"]);

        $error_titulo=true;
        $error_precio=true;
        $error_sinopsis=true;
        $error_genero=true;
        $error_portada=true;

        $error_titulo=($nuevo_titulo=="");
		$error_precio=($nuevo_precio=="" || $precio < 0);
		$error_sinopsis=($nueva_sinopsis=="");
		$error_genero= ($nuevo_genero=="");
        $error_portada= ($nueva_portada =="");

        $error= (!$error_portada && !$error_titulo && !$error_precio && !$error_sinopsis  && !$error_genero);
     
		if($error)
		{
            $consulta="UPDATE  juegos SET titulo = '$nuevo_titulo' , precio = '$nuevo_precio', informacion = '$nueva_sinopsis'  , categoria = '$nuevo_genero', portada = '$nueva_portada' WHERE id_juego='$id_juego'";
			
			if($resultado = mysqli_query($conexion,$consulta))
                header("Location: index.php?editado=true");
			else
			{
			  $error="Error al realizar la consulta";
			  mysqli_close($conexion);
			  die($error);

			}
        }
        else
        {//CONTROL DE ERROR AL INTRODUCIR JUEGO
			if($titulo == "" || $precio == "" || $sinopsis == "" || $genero == "")
				header("Location: index.php?error=camposVacios"); 
            if($precio < 0)
                header("Location: index.php?error=negativo");
           
        }
	
    }
    if(isset($_POST["borrarJuego"]))
    {
        $id_juego = clean($conexion,$_POST["borrarJuego"]);

        $consulta="DELETE FROM juegos WHERE id_juego='$id_juego'";

        if($resultado = mysqli_query($conexion,$consulta))
            header("Location: index.php?borrado=true");
        else
        {
          $error="Error al realizar la consulta";
          mysqli_close($conexion);
          die($error);

        }
    }
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>GameBros</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
         <!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#!">GameBros</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="#!">
                                Administración
                                <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item active"><a class="nav-link" href=""> <strong><?php echo $datos_usu["usuario"];?></strong></a></li>
                        <li class="nav-item"><a class="nav-link" href="admin/cerrar_sesion.php">Cerrar Sesión</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page Content-->
        <div class="container">
        <?php
                if(isset($_GET["error"]))
                mostrar_error($_GET["error"]);
        ?>
            <div class="row">
                <div class="col-lg-3">
                    <h1 class="my-4">Géneros</h1>
                    <div class="list-group">
                        <a class="list-group-item" href="index.php?ROL=true">ROL</a>
                        <a class="list-group-item" href="index.php?MMORPG=true">MMORPG</a>
                        <a class="list-group-item" href="index.php?SHOOTER=true">SHOOTER</a>
                    </div>
                    <div class="list-group" style="margin-top:5em;">
                        <a class="list-group-item" href="index.php?add=true">Añadir Juego</a>
                    </div>
                </div>

                <?php
                if(isset($_GET["ROL"]))
                {
                ?>
                <div class="col-lg-9">
                    <div class="carousel slide my-4" id="carouselExampleIndicators" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li class="active" data-target="#carouselExampleIndicators" data-slide-to="0"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active"><img class="d-block img-fluid" src="https://rolgratis.com/images/204.jpg" alt="Hecatombe" /></div>
                            <div class="carousel-item"><img class="d-block img-fluid" src="https://gaelcon.com/wp-content/uploads/2019/10/lordoftherings.png" alt="Mundo Mágico" /></div>
                            <div class="carousel-item"><img class="d-block img-fluid" src="https://3.bp.blogspot.com/-kuucjOv5IZ0/V7-93DWIAHI/AAAAAAAADwI/UJ5krtumgLUp8Z-L-flJa_1JQe6pyoeEQCLcB/s1600/Sin%2Bt%25C3%25ADtulo.png" alt="Imperium" /></div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>

                    <div class="row">

                        <?php 
                        mostrarJuegos("ROL",$conexion);
                        ?>
                  
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Trabajo Final &copy; Desarrollado por  Devas       </p></div>
            <div class="container"><p class="m-0 text-center text-white"> Testeado por Loucrer - Documentado por Sara y Sergio</p></div>
        </footer>
                <?php
                }elseif(isset($_GET["MMORPG"]))
                {
                ?>
   <div class="col-lg-9">
                    <div class="carousel slide my-4" id="carouselExampleIndicators" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li class="active" data-target="#carouselExampleIndicators" data-slide-to="0"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active"><img class="d-block img-fluid" src="https://rolgratis.com/images/204.jpg" alt="Hecatombe" /></div>
                            <div class="carousel-item"><img class="d-block img-fluid" src="https://gaelcon.com/wp-content/uploads/2019/10/lordoftherings.png" alt="Mundo Mágico" /></div>
                            <div class="carousel-item"><img class="d-block img-fluid" src="https://3.bp.blogspot.com/-kuucjOv5IZ0/V7-93DWIAHI/AAAAAAAADwI/UJ5krtumgLUp8Z-L-flJa_1JQe6pyoeEQCLcB/s1600/Sin%2Bt%25C3%25ADtulo.png" alt="Imperium" /></div>
                            
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>

                    <div class="row">

                        <?php 
                        mostrarJuegos("MMORPG",$conexion);
                        ?>
                  
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Trabajo Final &copy; Desarrollado por  Devas       </p></div>
            <div class="container"><p class="m-0 text-center text-white"> Testeado por Loucrer - Documentado por Sara y Sergio</p></div>
        </footer>
                <?php

                }elseif(isset($_GET["SHOOTER"]))
                {
                    ?>
                     <div class="col-lg-9">
                    <div class="carousel slide my-4" id="carouselExampleIndicators" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li class="active" data-target="#carouselExampleIndicators" data-slide-to="0"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active"><img class="d-block img-fluid" src="https://rolgratis.com/images/204.jpg" alt="Hecatombe" /></div>
                            <div class="carousel-item"><img class="d-block img-fluid" src="https://gaelcon.com/wp-content/uploads/2019/10/lordoftherings.png" alt="Mundo Mágico" /></div>
                            <div class="carousel-item"><img class="d-block img-fluid" src="https://3.bp.blogspot.com/-kuucjOv5IZ0/V7-93DWIAHI/AAAAAAAADwI/UJ5krtumgLUp8Z-L-flJa_1JQe6pyoeEQCLcB/s1600/Sin%2Bt%25C3%25ADtulo.png" alt="Imperium" /></div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>

                    <div class="row">

                        <?php 
                        mostrarJuegos("SHOOTER",$conexion);
                        ?>
                  
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Trabajo Final &copy; Desarrollado por  Devas       </p></div>
            <div class="container"><p class="m-0 text-center text-white"> Testeado por Loucrer - Documentado por Sara y Sergio</p></div>
        </footer>
                    <?php
                }elseif(isset($_GET["add"]))
                {
                   ?> 
                   <form style="margin:8em; width:30em;" action="index.php" method="POST">
                        <div class="form-group">
                            <label for="titulo">Título</label>
                            <input type="text" name="titulo" class="form-control" id="titulo" aria-describedby="titulo" placeholder="Título">
                        </div>
                        <div class="form-group">
                            <label for="precio">Precio</label>
                            <input type="number"  name="precio" class="form-control" id="precio" placeholder="Precio">
                            <small id="emailHelp" class="form-text text-muted">En dólares $$</small>
                        </div>
                
                        <div class="form-group">
                            <label for="sinopsis">Sinopsis</label>
                            <textarea name="sinopsis" class="form-control" id="sinopsis" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="portada">Portada</label>
                            <input type="text" name="portada" class="form-control" id="portada" aria-describedby="portada" placeholder="Portada">
                            <small id="portada" class="form-text text-muted">Añadir URL. Tamaño 700x400</small>
                        </div>
                        <div class="form-group">
                            <select name="genero" class="form-control form-control-lg">
                                <option>ROL</option>
                                <option>MMORPG</option>
                                <option>SHOOTER</option>
                            </select>
                        </div>
                        <button type="submit" name="añadirJuego" class="btn btn-primary">Submit</button>
                     </form>
                   <?php
                }
                elseif(isset($_GET["edit"]))
                {
                    $pre_consulta_edit = "SELECT * FROM juegos WHERE id_juego='".$_GET["edit"]."'";

                        if($resultado=mysqli_query($conexion,$pre_consulta_edit))
                        {
                                if($fila= mysqli_fetch_assoc($resultado))
                                {
                                    ?> 
                                    <form style="margin:8em; width:30em;" action="index.php" method="POST">
                                         <div class="form-group">
                                             <label for="titulo">Título</label>
                                             <input type="text" name="nuevo_titulo" class="form-control" id="titulo" aria-describedby="titulo" value="<?php echo $fila["titulo"];?>">
                                         </div>
                                         <div class="form-group">
                                             <label for="precio">Precio</label>
                                             <input type="number"  name="nuevo_precio" class="form-control" id="precio" value="<?php echo $fila["precio"];?>">
                                             <small id="emailHelp" class="form-text text-muted">En dólares $$</small>
                                         </div>
                                 
                                         <div class="form-group">
                                             <label for="sinopsis">Sinopsis</label>
                                             <textarea name="nueva_sinopsis" class="form-control" id="sinopsis" rows="3"><?php echo $fila["informacion"];?></textarea>
                                         </div>
                                         <div class="form-group">
                                             <label for="portada">Portada</label>
                                             <input type="text" name="nueva_portada" class="form-control" id="portada" aria-describedby="portada" value="<?php echo $fila["portada"];?>">
                                             <small id="portada" class="form-text text-muted">Añadir URL. Tamaño 700x400</small>
                                         </div>
                                         <div class="form-group">
                                             <select name="nuevo_genero" class="form-control form-control-lg">
                                                 <option <?php if($fila["categoria"]=="ROL") echo "selected";?>>ROL</option>
                                                 <option <?php if($fila["categoria"]=="MMORPG") echo "selected";?>>MMORPG</option>
                                                 <option <?php if($fila["categoria"]=="SHOOTER") echo "selected";?>>SHOOTER</option>
                                             </select>
                                         </div>
                                         <button type="submit" name="editarJuego" value='<?php echo $fila["id_juego"];?>' class="btn btn-primary">Submit</button>
                                      </form>
                                    <?php
                                }
                
                        }
                        else
                        {
                            $error="Imposible realizar la consulta. Error número: ".mysqli_errno($conex). ":".mysqli_error($conex);
                            mysqli_close($conex);
                            die($error);	
                        }	
                  
                }elseif(isset($_GET["delete"]))
                {
                    ?> 
                     <form style="margin:8em; width:30em;" action="index.php" method="POST">
                                         <div class="form-group">
                                             <label for="titulo">¿Estás seguro que desea eliminar el juego con ID <strong> <?php echo $_GET["delete"];?></strong>?</label>     
                                         </div>
                                         <div class="form-group">
                                            <button type="submit" name="borrarJuego" value='<?php echo $_GET["delete"];?>' class="btn btn-primary">Submit</button>
                                        </div>
                    </form>
                    <?php
                }
                ?>
               
        <!-- Bootstrap core JS-->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="../js/scripts.js"></script>
    </body>
</html>
