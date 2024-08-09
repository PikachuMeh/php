
<?php 
    $bandera = 0;
    require ("Noticias/conexion.php");

    require ("Noticias/funciones.php");
        

    $usuario = usuarios($conexion);

    $usu = $_POST['usuario'];

    $clave = $_POST['clave'];
    $bandera = 0;
    while ($row2 = mysqli_fetch_array($usuario)) {
        $bandera = 1;
        if(strcmp($row2['usuario'],$usu) == 0 && strcmp($row2['clave'],$clave) == 0){
            session_start();
            session_set_cookie_params(600);
            
            $_SESSION['usuario'] = $usu;
            $_SESSION['nombre'] = $row2['nombre'];
            $_SESSION['apellido'] = $row2['apellido'];

            header("Location: /php/pagina.php");

        }else{
            $bandera++;
        }
        if( $bandera > 50){
            header("Location: /php/");
        }
    }


?>
