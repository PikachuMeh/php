<?php
require "../conexion.php";
require "../funciones.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $descripcion_per = $_POST['desc'];
    $cod_ced = $_POST['cod_ced'];
    $cedula = $_POST['cedula'];
    $clave = $_POST['clave'];
    $correo = $_POST['correo'];
    $pais = $_POST['paisSelect'];
    $estado = $_POST['estadoSelect'];
    $codigo = $_POST['randomCode'];
    $fecha_nac = $_POST['fecha_nac'];
    $new_cedula = $cod_ced.'-'.$cedula;
    $rol = $_POST['rol'];

    if($_POST['paisSelect'] == NULL || $_POST['estadoSelect'] == NULL){
        header ('Location: registrar_usuario.php');

    }


    $result = usuario_validar( $conexion );

    if ($result->num_rows > 0) {

        $resultado = $result->fetch_assoc();

        
        
            
        if($usuario == $nombre){

            echo '<script>alert("El nombre de usuario y el nombre no pueden ser iguales");</script>';
            //header('Location: registrar_usuario.php');

        }else if ($new_cedula == $resultado['cedula']) {

            echo '<script>alert("Ya esta registrada la cedula");</script>';
            //header('Location: registrar_usuario.php');

        }else if ($correo == $resultado['correo']){

            echo '<script>alert("Ya esta registrado el correo");</script>';
            //header('Location: registrar_usuario.php');

        }else{

            registrar_usuarios($conexion,$usuario,$nombre,$apellido,$correo,$new_cedula,$fecha_nac,$clave,$descripcion_per,$pais,$estado,$rol,$codigo);
            echo '<script>alert("Usuario Registrado Correctamente");</script>';
            header('Location: ../../pagina.php');
        }
    
    } else {
        echo json_encode(["exists" => false]);
    }
}