<?php
$archivo = $_POST['archivo'];
if (isset($archivo)) {
    if (file_exists($archivo)) {
        unlink($archivo);
        echo "<script> window.location='../pagina.php';</script>";
    }
}

function borrar($conexion, $var) {
    $sql = "SELECT * FROM noticias WHERE id_noticias = $var";
    $consulta = mysqli_query($conexion, $sql);
    $row = mysqli_fetch_assoc($consulta);

    if ($row) {
        echo "Se borró con éxito el archivo seleccionado";
        $r_php = "../../";
        $archivo = $row['foto'];

        if (isset($archivo)) {
            $ruta_completa = $r_php . $archivo;
            if (file_exists($ruta_completa)) {
                unlink($ruta_completa);
            }
        }
    } else {
        echo "No se encontró la noticia con ID $var";
    }
}
?>
