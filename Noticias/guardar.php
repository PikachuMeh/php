<?php

require "conexion.php";
require "funciones.php";

$arreglo = $_POST['arreglo'];
$array = explode("├", $arreglo);

$division = explode("/", $array[0]);
$tmp = explode("/", $array[5]);
$numero = 0;

// Ruta Externa a PHP
$r_php= "../Noticias/";
$tmp[1] = "../tmp/";
$tmp_f = $array[0];

$division[0] = "img/noticias/";
$foto = $r_php . $division[0] . $division[2];
$foto1 = $division[0] . $division[2];

// Verificar la noticia
$consulta = ver_noticia($conexion, $array[4]);
$row = mysqli_fetch_assoc($consulta);

if ($array[4] == $row['id_noticias']) {
    if (rename($tmp_f, $foto)) {
        editar_noticia($conexion, $array[1], $array[2], $foto1, $array[3], $array[4]);
    } else {
        echo "No se pudo mover la imagen";
    }
} else {
    echo "No se guardó";
}
?>
