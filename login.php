
<?php 
    $bandera = 0;
    require ("Noticias/conexion.php");

    require ("Noticias/funciones.php");
        

    $usuario = usuarios($conexion);

    $usu = $_POST['usuario'];

    $clave = $_POST['clave'];
    
    while ($row2 = mysqli_fetch_assoc($usuario)) {
    
        if(strcmp($row2['nombre'],$usu) === 0 && strcmp($row2['clave'],$clave) === 0){
            
            session_start();
            session_set_cookie_params(600);
            
            $_SESSION['usuario'] = $usu;
            $_SESSION['nombre'] = $row2['nombre'];
            $_SESSION['apellido'] = $row2['apellido'];

            header("Location: /php/pagina.php");

        }else{
            $bandera++;
        }
        if($bandera == 5 || $bandera > 5){
            header("Location: /php/");
        }
    }


?>
