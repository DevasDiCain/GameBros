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
                                Inicio
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
            <div class="row">
                <div class="col-lg-3">
                    <h1 class="my-4">Géneros</h1>
                    <div class="list-group">
                        <a class="list-group-item" href="index.php?ROL=true">ROL</a>
                        <a class="list-group-item" href="index.php?MMORPG=true">MMORPG</a>
                        <a class="list-group-item" href="index.php?SHOOTER=true">SHOOTER</a>
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
                }
                
                ?>
               
        <!-- Bootstrap core JS-->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="../js/scripts.js"></script>
    </body>
</html>
