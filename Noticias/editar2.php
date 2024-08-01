<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/Bootstrap/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        
    <script src="js/Bootstrap/bootstrap.bundle.min.js"></script> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <title>Noticias</title>
</head>
<body>
    <div class="background">
        <h1 class="text-center text-light pt-5">Editar noticia</h1>
        <br>
        <div class="container">
            <div class="caja mx-auto text-edit">
                <?php
                    require 'conexion.php';
                    require 'funciones.php';
                
                if(isset($_FILES['foto'])){
                    $directorio_destino = "../tmp/";        

                    // Obtenemos el nombre y la extensión del archivo
                    $nombre_archivo = $_FILES["foto"]["name"];
                    $extension_archivo = pathinfo($nombre_archivo, PATHINFO_EXTENSION);
                   
                    // Creamos un nombre único para el archivo para evitar colisiones
                    $nombre_archivo_unico = uniqid() . '.' . $extension_archivo;
        
                    // Definimos la ruta completa donde se guardará el archivo
                    $ruta_archivo = $directorio_destino . $nombre_archivo_unico;

                    if(move_uploaded_file($_FILES['foto']['tmp_name'], $ruta_archivo)){
                        
                        $id = $_POST['id'];
                        $titulo = $_POST['titulo'];
                        $descripcion = $_POST['descripcion'];
                        $fecha = $_POST['fecha'];
                        
                        $noticia = sacar_noticia_selec($conexion, $id);
                        $row = mysqli_fetch_array($noticia, MYSQLI_ASSOC);
                        
                        if (isset($_REQUEST['id'])) {
                            //crear la consulta
                            echo '<tr>  
                                    <center><br><img class="img-fluid px-5 py-4 rounded" id="border-box" src="' . $ruta_archivo . '"</td></center>
                                    <div class="px-5">
                                    <br><h3>Título:</h3><div class="pb-3"><b>' . $titulo . '</b></div></td>
                                    <br><h3>Descripción:</h3><textarea">' . $descripcion . '</textarea></td>
                                    <center><br><h3>Autor</h3>' . $row['autor'] . '</td></center>
                                    <center><br><h3>Fecha</h3>' . $fecha . '</td></center>
                                    </div>
                            </tr><br>';    

                            $arreglo = array($ruta_archivo, $titulo, $descripcion, $fecha, $id, $_FILES['foto']['tmp_name']);
                        }
                    ?>
                    <div class="row">
                        <div class="col justify-content-center text-center mb-2">
                            <form action="guardar.php" method="post">
                                <button class="btn btn-secondary text-center text-edit" type="text" readonly name="arreglo" value='<?php echo implode("├", $arreglo); ?>'>Guardar</button>    
                            </form>
                        </div>
                        <div class="col justify-content-center text-center mb-2">
                            <form action="borrar.php" method="POST">
                                <button class="btn btn-secondary text-center text-edit" type="submit" name="archivo" value="<?php echo $ruta_archivo; ?>">Volver</button> 
                            </form>
                        </div>
                    </div>
                    <?php
                    } else {
                        echo 'Error al guardar el archivo';
                    }
                }
                ?>
            </div>    
        </div>  
    </div>    
</body>
</html>
