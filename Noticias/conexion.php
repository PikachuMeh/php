<?php

error_reporting (E_ALL ^ E_NOTICE);
$user_name = "root";
$password = "";
$database = "login";
$host_name = "localhost";
$conexion=mysqli_connect($host_name,$user_name,$password, $database);
mysqli_select_db($conexion, $database);

//function conectar(){
	if($conexion){
	
		return $conexion;
	}else{

		echo 'Lo sentimos. No fue posible realizar la conexión.';

	}
//}


//tablas para hacer. usuario,noticias

// usuario tiene nombre,apellido,clave,cedula,preg_sec,resp_sec
// noticias tiene id, titular, descripcion, autor, fecha 


?>


