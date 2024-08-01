<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Noticia</title>

    <link rel="stylesheet" href="../css/Bootstrap/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/style.css"> 
        
    <script src="js/Bootstrap/bootstrap.bundle.min.js"></script> 
</head>
<body>
    <div class="background">
        <?php
            session_start();
            if(isset($_SESSION['usuario'])){                    
        ?>
        <br>
        <div class="container">
            <div class="caja mx-auto text-edit">
                <form action="registro.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group row margin mt-1 mb-1 pt-5 pb-2">
                        <label for="nombre">
                            <span class="text-size">Titulo</span>
                            <div class="col-12">
                                <input class="form-control" type="text" name="Titulo" placeholder="Tu titulo">
                            </div>
                        </label>
                    </div>
                    
                    <div class="form-group row margin mb-1 pb-1">
                        <label for="inicio-platzi">
                            <span class="text-size">Descripcion</span>
                            <div class="col-12">
                                <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Descripcion de tu titular"></textarea>
                            </div>
                        </label>
                    </div>
                    <br>
                    <div class="form-group row margin mb-1 pb-1">
                        <label for="horario">
                            <span class="text-size">Fecha</span>
                            <div class="col-12">
                                <input class="form-control" type="date" name="fecha" placeholder="Fecha" required>
                            </div>
                        </label><br>
                    </div>

                    <?php 
                        require "conexion.php";
                        require "funciones.php";
                        $autor = sacar_autores($conexion);
                    ?>
                    <div class="form-group row margin mb-1 pb-1">
                        <span class="text-size">Autor</span><br>
                        <div class="col-12">
                            <select class="btn btn-secondary dropdown-toggle" id="menu-drop" name="autor">
                                <?php
                                    while($row = mysqli_fetch_assoc($autor)){
                                ?>
                                    <option><?php echo $row['nombre'];?></option>
                                <?php 
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <br><br>
                    <div class="form-group row margin mb-1 pb-2">
                        <input class="form-control" type="file" placeholder="Seleccione uno o varios archivos" id="foto" name="foto[]" multiple>
                    </div>
                    <br><br>

                    <div class="row">
                        <div class="col justify-content-center text-center">
                            <input class="btn btn-secondary text-center text-edit mb-3" type="submit" value="Enviar"/>
                        </div> 
                    </form>
                        <div class="col text-center">
                            <form action="../pagina.php">
                                <button class="btn btn-secondary text-center text-edit mb-3">Volver</button>
                            </form>
                            <?php
                            } else {
                                header("Location: PHP/");
                                exit();
                            }
                            ?>
                        </div>
                    </div>
            </div>
        </div>
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
