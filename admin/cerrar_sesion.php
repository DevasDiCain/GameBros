<?php
	require("conex_bd.php");

     if($conexion= conectar())
     {
          session_name("bd_gameBros");
          session_start();
          session_destroy();  
     
     
          $valor_cookie = $_COOKIE["recordarPass"];
          $consulta_delete_cookie =  "DELETE  FROM cookies WHERE valor='$valor_cookie'";
          mysqli_query($conexion,$consulta_delete_cookie);
          setcookie("recordarPass",null,-1,"/Proyectos/Puesta_en_produccion_segura/Proyecto Final");
          unset($_COOKIE["recordarPass"]);

          session_start();
          session_regenerate_id(true);
          header("Location: ../index.php");
          exit;
     }
    

?>
