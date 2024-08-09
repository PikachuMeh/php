<?php 
    session_start();
    if(isset($_SESSION['usuario'])){  
        $nombre = $_SESSION['usuario'];
        $apellido = $_SESSION['apellido'];
    } else {
        header("Location: /php/");
        exit();
    }

    require "../conexion.php";
    require "../funciones.php";

    $titulo = sacar_noticias($conexion);
    $bandera = 0;
    $usuario = usuario_admin($conexion,$nombre);

    $usuariox = mysqli_fetch_array($usuario);
    //Ruta externa a PHP
    $r_php = "Noticias/";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=" ../../css/Bootstrap/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../css/style.css">
    <script src="../../js/Bootstrap/bootstrap.bundle.min.js"></script> 
</head>
<body>
    <div class="background">
        <!--Menu-->
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Bienvenido/a <?php echo $nombre .' '. $apellido?></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">   
                    </ul>
                    <div class="d-flex" role="search">

                        <form action="/php/pagina.php">
                            <button class="btn btn-primary ms-1 me-1">Noticias</button>
                        </form>
                        <form action="cerrar_sesion.php">
                            <button class="btn btn-primary ms-1 me-1">Cerrar sesion</button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>

        <div class="container">     
            <div class="row">             

                

            </div>    
        </div> 
    </div>
</body>
</html>
