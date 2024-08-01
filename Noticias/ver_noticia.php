<?php
require_once("conexion.php");
require_once("funciones.php");
$noticia = $_POST['leer_mas'];

$ver = ver_noticia($conexion, $noticia);
$mostrar = mysqli_fetch_array($ver, MYSQLI_ASSOC);
$foto = explode(",", $mostrar['foto']);

//Ruta externa php
$r_php = "../../php/Noticias/";
?>
<link rel="stylesheet" href="../css/Bootstrap/bootstrap.css">
<link rel="stylesheet" href="../css/style.css">

<div class="container w-50">
    <h1 class="text-center mt-5"><?php echo $mostrar['titular'] ?></h1>
    <br>
    <div class="fs-5">
        <p class="text-justify">
        <?php echo nl2br($mostrar['descripcion']); ?>
        </p>
    </div>

    <div id="carouselExampleDark" class="carousel carousel-dark slide mt-5 w-75 h-75 mx-auto" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php
            for ($i = 0; $i < count($foto); $i++) {
                if ($i == 0) {
                    ?>
                    <div class="carousel-item active">
                        <img src="<?php echo $r_php . $foto[$i]; ?>" class="d-block" alt="..." style="width: 100%; height:460px;">
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="carousel-item">
                        <img src="<?php echo $r_php . $foto[$i]; ?>" class="d-block" alt="..." style="width: 100%; height:460px;">
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
