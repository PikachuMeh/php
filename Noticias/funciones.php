<?php
require 'conexion.php';

function recibir_noticia($conexion) {
    //query para envio de formulario a la base de datos
    $query = "SELECT * FROM noticias"; //sql para cambiar, esta de prueba
    $consulta = mysqli_query($conexion, $query);

    $n1 = 0;

    //escoger la noticia de la base de datos
    while ($row = mysqli_fetch_assoc($consulta)) {
        $noticia['titulo'] = $row['titular'];
        $noticia['descripcion'] = $row['descripcion'];
        $noticia['autor'] = $row['autor'];
        $noticia['fecha'] = $row['fecha'];
        $noticia['foto'] = $row['foto'];

        $foto = $noticia['foto'];
        $n1++;

        echo '<tr>
                <br>'."<img src='$foto'>".'</td>
                <br>'.$noticia['titulo'].'</td>
                <br>'.$noticia['descripcion'].'</td>
                <br>'.$noticia['autor'].'</td>
                <br>'.$noticia['fecha'].'</td>
              </tr><br>';
    }
    //guardar dicha noticia en un arreglo para mostrar en la pagina
}

function recibir_ultimas_noticia($conexion) {
    //SQL para sacar las ultimas 3 noticias con su id
    $query = "SELECT id, titular, descripcion, foto, MAX(fecha) as fecha FROM noticias GROUP BY id ORDER BY fecha DESC LIMIT 3;";
    $consulta = mysqli_query($conexion, $query);
    while ($row = mysqli_fetch_assoc($consulta)) {
        $noticia['titulo'] = $row['titular'];
        $noticia['descripcion'] = $row['descripcion'];
        $noticia['autor'] = $row['autor'];
        $noticia['fecha'] = $row['fecha'];
        $noticia['foto'] = $row['foto'];

        echo '<tr>
                <br>'."<img src='{$noticia['foto']}'>".'</td>
                <br>'.$noticia['titulo'].'</td>
                <br>'.$noticia['descripcion'].'</td>
                <br>'.$noticia['autor'].'</td>
                <br>'.$noticia['fecha'].'</td>
              </tr><br>';
    }
}

function envio_noticia($conexion) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validar campos de entrada
        if (!empty($_POST['Titulo']) && !empty($_POST['descripcion']) && !empty($_POST['fecha']) && !empty($_POST['autor'])) {
            $Titulo = mysqli_real_escape_string($conexion, $_POST['Titulo']);
            $descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion']);
            $autor = mysqli_real_escape_string($conexion, $_POST['autor']);
            $fecha = mysqli_real_escape_string($conexion, $_POST['fecha']);
            
            if (isset($_FILES['foto']) && $_FILES['foto']['error'][0] == 0) {
                // Definimos la carpeta donde se va a guardar el archivo
                $directorio_destino = 'img/noticias/';
                
                // Comprobamos si el directorio existe, si no, lo creamos
                if (!is_dir($directorio_destino)) {
                    mkdir($directorio_destino, 0777, true);
                }
                
                // Obtenemos la cantidad de archivos subidos
                $cantidad_archivos = count($_FILES['foto']['name']);

                // Creamos un arreglo para almacenar los nombres de los archivos
                $archivos = array();

                // Recorremos cada archivo subido
                for ($i = 0; $i < $cantidad_archivos; $i++) {
                    // Obtenemos el nombre y la extensión del archivo
                    $nombre_archivo = basename($_FILES['foto']['name'][$i]);
                    $extension_archivo = pathinfo($nombre_archivo, PATHINFO_EXTENSION);

                    // Creamos un nombre único para el archivo para evitar colisiones
                    $nombre_archivo_unico = uniqid() . '.' . $extension_archivo;

                    // Definimos la ruta completa donde se guardará el archivo
                    $ruta_archivo = $directorio_destino . $nombre_archivo_unico;

                    // Movemos el archivo de la carpeta temporal al directorio de destino
                    if (move_uploaded_file($_FILES['foto']['tmp_name'][$i], $ruta_archivo)) {
                        // Agregamos el nombre del archivo al arreglo
                        $archivos[] = $ruta_archivo;
                    } else {
                        echo 'Error al guardar el archivo ' . $nombre_archivo . '<br>';
                    }
                }

                // Convertimos el arreglo de archivos a una cadena separada por comas
                $archivos_str = implode(",", $archivos);

                // Consulta preparada para evitar inyecciones SQL
                $query = "INSERT INTO noticias (titular, descripcion, autor, fecha, foto) VALUES (?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($conexion, $query);
                
                if (!$stmt) {
                    echo "Error al preparar la consulta: " . mysqli_error($conexion);
                    return;
                }
                
                $stmt ->bind_param('sssss', $Titulo, $descripcion, $autor, $fecha, $archivos_str); 
                var_dump($archivos_str);
                if ($stmt ->execute()) {
                    // Redirecciona después de la operación
                    header("Location: ../pagina.php");
                    exit(); // Asegura que el script se detiene después de la redirección
                } else {
                    echo "Error al insertar la noticia: " . mysqli_error($conexion);
                }

                mysqli_stmt_close($stmt);
            } else {
                echo 'No se ha subido ningún archivo o hubo un error en la subida<br>';
                var_dump($_FILES['foto']['error']);
            }
        } else {
            echo 'Por favor complete todos los campos<br>';
        }
    } else {
        echo '<br>Ha ocurrido un error<br>';
    }
}



function sacar_noticias($conexion) {
    $query = "SELECT * FROM noticias ORDER BY id_noticias DESC";
    //para sacar las tablas
    $consulta = mysqli_query($conexion, $query);
    return $consulta;
}

function sacar_autores($conexion) {
    $query = "SELECT nombre FROM usuarios";
    $consulta = mysqli_query($conexion, $query);
    return $consulta;
}

function sacar_noticia_selec($conexion, $var) {
    $query = "SELECT * FROM noticias WHERE id_noticias = '$var'";
    //para sacar las tablas
    $consulta = mysqli_query($conexion, $query);
    return $consulta;
}


function borrar_noticia($var, $conexion) {
    // Verifica que la solicitud es de tipo POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require "borrar.php";
        
        // Prepara la consulta para borrar la noticia
        $query = "DELETE FROM noticias WHERE id_noticias = '$var'";
        
        // Ejecuta la consulta
        $consulta = mysqli_query($conexion, $query);
        
        // Verifica si la consulta fue exitosa
        if ($consulta) {
            // Llama a la función borrar para eliminar el archivo relacionado
            borrar($conexion, $var);
            echo "Se borró con éxito la tabla seleccionada";
        } else {
            echo "Error al borrar la noticia: " . mysqli_error($conexion);
        }
        
        // Redirecciona después de procesar la eliminación
        header("Location: ../pagina.php");
        exit(); // Asegura que el script se detiene después de la redirección
    } else {
        echo "Error, no eligió ninguna opción";
        header("Location: ../pagina.php");
        exit(); // Asegura que el script se detiene después de la redirección
    }
}


function editar_noticia($conexion, $titulo, $descripcion, $foto, $fecha, $id) {
    $query = "UPDATE noticias SET titular = '$titulo', descripcion = '$descripcion', foto = '$foto', fecha = '$fecha' WHERE id_noticias = $id";
    echo("<br>");

    mysqli_query($conexion, $query);
    printf("<script> window.location='../pagina.php';</script>");
    echo("Consulta hecha correctamente");
}

function usuarios($conexion) {
    $query = "SELECT nombre, clave FROM usuarios ORDER BY id_usuarios";
    $consulta = mysqli_query($conexion, $query);
    return $consulta;
}

function ver_noticia($conexion, $var) {
    $query = "SELECT * FROM noticias WHERE id_noticias = '$var'";
    $consulta = mysqli_query($conexion, $query);
    return $consulta;
}
?>
