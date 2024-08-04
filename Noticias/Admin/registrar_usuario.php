
<html lang="es">
    
    <head>
        <title>Mintur - Inicio</title>
        <meta charset="UFT-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximun-scale=1, minimun-scale=1,">
        
        <!--<link rel="stylesheet" href="../../css/fontello.css">-->
        <link rel="stylesheet" href="../../css/style.css">
        <link rel="stylesheet" href="../../css/Bootstrap/bootstrap.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <script type="module" src="../../js/paises.js"></script>
        <script type="module" src="../../js/api_paises.js"></script>
        <script src="../../js/Bootstrap/bootstrap.bundle.min.js"></script> 
    </head>
    <body>  
    <div class="area2" >
        <ul class="circles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>

    <div class="context">  
        <section>
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card shadow-2-strong box-shadow" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center">
                                <h3 class="mb-5">Registro de Usuario</h3>
                                <form action="registro_usu.php" method="POST" class="form-signin">
                                    <label for="usuario">
                                        <span>Usuario</span> <br>
                                        <input type="text" name="usuario" class="form-control form-control-lg" placeholder="Ingrese su nombre de usuario" required>
                                    </label>
                                    <br><br>
                                    <label for="nombre">
                                        <span>Nombre</span> <br>
                                        <input type="text" name="nombre" class="form-control form-control-lg" placeholder="Ingrese su nombre" required>
                                    </label>
                                    <br><br>
                                    <label for="apellido">
                                        <span>Apellido</span> <br>
                                        <input type="text" name="apellido" class="form-control form-control-lg" placeholder="Ingrese su apellido" required>
                                    </label>
                                    <br><br>
                                    <label for="cedula">
                                    <span>cedula</span> <br>
                                        <select name="cod_ced" required>
                                            <option value="V" selected>V</option>
                                            <option value="J">J</option>
                                            <option value="E">E</option>
                                            <option value="I">I</option>
                                        </select>

                                        <input type="number" name="cedula" placeholder="ingrese su cedula"  minlength="8" maxlength="9" class="form-control form-control-lg" required>

                                    </label>
                                    <br><br>
                                    <label for="descripcion_per">
                                        <span>Correo</span> <br>
                                        <input type="desc_per" name="descripcion_per" class="form-control form-control-lg" required>
                                    </label>
                                    <br><br>
                                    <label for="correo">
                                        <span>Correo</span> <br>
                                        <input type="email" name="correo" placeholder="ingrese su correo" class="form-control form-control-lg" required>
                                    </label>
                                    <br><br>
                                    <label for="inicio-platzi">
                                        <span>Clave</span> <br>
                                        <input type="password" name="clave" placeholder="ingrese su clave" class="form-control form-control-lg" required>
                                    </label>
                                    <br><br>
                                    <label for="pais">
                                        <span>Seleccione un Pais:</span>
                                        <div id = "select_pais">
                                        <select id="paisSelect">
                                            <option  value = "0" disabled>Ingrese una opcion:</option>
                                        </select>
                                        </div>
                                    </label>
                                    <br><br>
                                    <label for="estado">
                                        <span>Selecione un estado:</span>
                                        <div id = "select_estado">
                                        <select id="estadoSelect">
                                            <option value = "0" disabled>Ingrese una opcion:</option>
                                        </select>
                                        </div>
                                    </label>
                                    <br>
                                    <br><br>
                                    <input class="btn btn-primary btn-lg btn-block mb-2" type="submit" value="Enviar"/> 
                                </form>

                                <form action="../../pagina.php" method="post">
                                    <button type="submit" name="salir" class="btn btn-primary btn-lg btn-block mb-2">volver</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
        
    
    </body>
   


</html>
