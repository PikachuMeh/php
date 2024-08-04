<?php 
    session_start();
    if(isset($_SESSION['usuario'])){  
        $nombre = $_SESSION['usuario'];
        $apellido = $_SESSION['apellido'];
    } else {
        header("Location: /php/");
        exit();
    }

    require "Noticias/conexion.php";
    require "Noticias/funciones.php";

    $titulo = sacar_noticias($conexion);
    $bandera = 0;
    $usuario = usuario_admin($conexion);
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
    <link rel="stylesheet" href=" css/Bootstrap/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/Bootstrap/bootstrap.bundle.min.js"></script> 
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
                        <form action="Noticias/registrar_noticia.php">
                            <button class="btn btn-primary ms-1 me-1">Registrar Noticias</button>
                        </form>
                        <form action="cerrar_sesion.php">
                            <button class="btn btn-primary ms-1 me-1">Cerrar sesion</button>
                        </form>
                        <?php
                            if($usuariox['roles_idroles'] == 1){
                        ?>
                        <form action = "Noticias/Admin/registrar_usuario.php">
                            <button class="btn btn-primary ms-1 me-1">Registrar Usuario</button>
                        </form>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </nav>

        <div class="container">     
            <div class="row">             
                <?php
                    //recorrer el arreglo para conseguir el titular a borrar o editar
                    while ($row = mysqli_fetch_assoc($titulo)) {     
                        $foto1 = explode(",", $row['foto']);
                        
                ?>
                <!--Carta que muestra NOTICIAS-->
                <div class="col-sm-6 col-lg-4 mt-5 mb-5" style="height: 400px;">
                    <div class="card mx-auto box-shadow h-200" style="width:20rem;">
                        <img src="<?php echo $r_php.$foto1[0];?>" class="card-img-top" alt="..." style="height:13rem;">

                        <div class="card-body">
                            <label class="card-title" for="nombre">Titulo: <?php echo strlen($row['titular']) > 40 ? substr($row['titular'], 0, 40).'...' : $row['titular']; ?></label>
                            <p class="card-text">  
                                <?php
                                    $descripcion = $row['descripcion'];
                                    if (strlen($descripcion) > 80) {
                                        echo substr($descripcion, 0, 80) . '...';
                                    } else {
                                        echo $descripcion;
                                    }
                                ?>
                            </p>
                        </div>
                        <!--Botones-->
                        <div class="card-body">
                            <div class="d-flex justify-content-center">
                                <form action="Noticias/editar.php" method="post">
                                    <button value="<?php echo $row['id_noticias']?>" name="editar" class="card-link btn btn-secondary">Editar</button>
                                    <button value="<?php echo $row['id_noticias']?>" name="borrar" class="card-link btn btn-secondary">Borrar</button>
                                </form>
                                <form action="Noticias/ver_noticia.php" method="post">
                                    <button type="submit" name="leer_mas" value="<?php echo $row['id_noticias']?>" class="btn btn-primary mx-3">Leer más</button>
                                </form>
                            </div>
                        </div>
                    </div> 
                </div>
                <?php 
                    }
                ?>
            </div>    
        </div> 
    </div>
</body>
</html>
