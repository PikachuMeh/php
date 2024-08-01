<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Noticia</title>
    <link rel="stylesheet" href="../css/Bootstrap/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="js/Bootstrap/bootstrap.bundle.min.js"></script> 
</head>
<body>
<div class="background">
    <?php 
    require "conexion.php";
    require "funciones.php";
    session_start();

    if(isset($_SESSION['usuario'])){
        $titulo = sacar_noticias($conexion);
        $var2 = 1;

        while($row = mysqli_fetch_assoc($titulo)){
            $var = $row['id_noticias'];
            if (isset($_POST['borrar'])) {
                if ($_POST['borrar'] == $var){
                    borrar_noticia($var, $conexion);
                    $var2 = 0;
                    break;
                }
            } else if(isset($_POST['editar'])){
                if ($_POST['editar'] == $var){
                    echo '<h1 class="text-center text-light pt-5">Editar noticia</h1>';
                    $result = sacar_noticia_selec($conexion, $var);
                    $row2 = mysqli_fetch_assoc($result);
                    ?>
                    <br>
                    <div class="container">
                        <div class="caja mx-auto text-edit">
                            <form action="editar2.php" method="POST" enctype="multipart/form-data">
                                <div class="form-group row margin mt-1 mb-1 pt-5 pb-2">
                                    <label for="titulo" class="col-sm-6 col-md-6 col-lg-4 col-form-label text-size">Titulo:</label>
                                    <div class="col-sm-6 col-md-6 col-lg-8">
                                        <input class="form-control" type="text" name="titulo" id="titulo" value="<?php echo $row2['titular']; ?>">
                                    </div>
                                </div>
                                <div class="form-group row margin mt-1 mb-1 pt-2 pb-2">
                                    <label for="descripcion" class="tex-edit col-sm-6 col-md-6 col-lg-4 col-form-label text-size">Descripcion:</label>
                                    <div class="col-sm-6 col-md-6 col-lg-8">
                                        <textarea name="descripcion" id="descripcion" class="form-control" style="height: 1000px;"><?php echo $row2['descripcion']; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group row margin mt-1 mb-1 pt-2 pb-2">
                                    <label for="fecha" class="col-sm-6 col-md-6 col-lg-4 col-form-label text-size">Fecha:</label>
                                    <div class="col-sm-6 col-md-6 col-lg-8">
                                        <input class="form-control" type="date" name="fecha" id="fecha" value="<?php echo $row2['fecha']; ?>">
                                    </div>
                                </div>
                                <div class="form-group row margin mt-1 mb-1 pt-2 pb-2">
                                    <label for="autor" class="col-sm-6 col-md-6 col-lg-4 col-form-label text-size">Autor:</label>
                                    <div class="col-sm-6 col-md-6 col-lg-8"> 
                                        <input class="form-control" disabled type="text" name="autor" id="autor" value="<?php echo $row2['autor']; ?>">
                                    </div>
                                </div>
                                <div class="form-group row margin mt-1 mb-1 pt-2 pb-2">
                                    <label for="foto" class="col-sm-6 col-md-6 col-lg-4 col-form-label text-size">Foto:</label>
                                    <div class="col-sm-6 col-md-6 col-lg-8">
                                        <input class="form-control" type="file" name="foto" id="foto">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col justify-content-center text-center">
                                        <button class="btn btn-secondary text-center text-edit" value="<?php echo $row2['id_noticias'];?>" name="id">Guardar</button>
                                    </div>
                                </div>
                            </form>
                            <div class="col text-center">
                                <form action="../pagina.php">
                                    <button class="btn btn-secondary text-center text-edit">Atras</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php 
                    $var2 = 0;
                    break;
                }
            }
        }
        if($var2 == 1){
            echo("<br>Escoja bien la opcion");  
        }
    } else {
        header("Location: /ConexionPostgresphp/");
        exit();
    }
    ?>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/37.0.1/classic/ckeditor.js"></script>    
<script>
    ClassicEditor
        .create(document.querySelector('#descripcion'))
        .catch(error => {
            console.error(error);
        });
</script>
</body>
</html>
