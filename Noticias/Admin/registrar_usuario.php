
<?php 
    session_start();
    if(isset($_SESSION['usuario'])){  
        $nombre = $_SESSION['usuario'];
        $apellido = $_SESSION['apellido'];
    } else {
        header("Location: /php/");
        exit();
    }
?>
<html lang="es">
    
    <head>
        <title>Mintur - Inicio</title>
        <meta charset="UFT-8">
        
        
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
                                <form action="validar_usuarios.php" method="POST" class="form-signin" id="registroForm">
                                    <label for="usuario">
                                        <span>Usuario</span> <br>
                                        <input type="text" id="usuario" name="usuario" class="form-control form-control-lg" placeholder="Ingrese su nombre de usuario" required maxlength="10" minlength="4">
                                    </label>
                                    <br><br>
                                    <label for="nombre">
                                        <span>Nombre</span> <br>
                                        <input type="text" id="nombre" name="nombre" class="form-control form-control-lg" placeholder="Ingrese su nombre" required maxlength="20" minlength="4">
                                    </label>
                                    <br><br>
                                    <label for="apellido">
                                        <span>Apellido</span> <br>
                                        <input type="text" id="apellido" name="apellido" class="form-control form-control-lg" placeholder="Ingrese su apellido" required maxlength="20" minlength="4">
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
                                        <input type="number" class="form-control form-control-lg" name ="cedula" id="cedula" maxlength="9" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" />
                                    </label>
                                    <label for="fecha_nac">
                                        <span>Fecha de nacimiento</span> <br>
                                        <input type="date" id="fecha_nac" name="fecha_nac" class="form-control form-control-lg" required min="1940-01-01" max="2010-12-31">
                                    </label>
                                    <br><br>
                                    <div class="form-group row margin mb-1 pb-1">
                                        <label for="inicio-platzi">
                                            <span class="text-size">Descripcion</span>
                                            <div class="col-12">
                                                <textarea class="form-control" id="descripcion" name="desc" placeholder="Descripcion de tu perfil (opcional)"></textarea>
                                            </div>
                                        </label>
                                    </div>
                                    <br><br>
                                    <label for="correo">
                                        <span>Correo</span> <br>
                                        <input type="email" id="correo" name="correo" placeholder="ingrese su correo" class="form-control form-control-lg" required>
                                    </label>
                                    <br><br>
                                    <label for="clave">
                                        <span>Clave</span> <br>
                                        <input type="password" id="clave" name="clave" placeholder="ingrese su clave" class="form-control form-control-lg" required>
                                    </label>
                                    <br><br>
                                    <label for="pais">
                                        <span>Seleccione un Pais:</span>
                                        <div id="select_pais">
                                            <select id="paisSelect" name="paisSelect">
                                                <option value="0" disabled>Ingrese una opcion:</option>
                                            </select>
                                        </div>
                                    </label>
                                    <br><br>
                                    <label for="estado">
                                        <span>Selecione un estado:</span>
                                        <div id="select_estado">
                                            <select id="estadoSelect" name="estadoSelect">
                                                <option value="0" disabled>Ingrese una opcion:</option>
                                            </select>
                                        </div>
                                    </label>
                                    <br>
                                    <br><br>
                                    <input type="hidden" id="randomCode" name="randomCode">
                                    <input type="hidden" id="rol" name="rol" value="3">
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
   
<script>
    function generateRandomCode(length) {
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var result = '';
        var charactersLength = characters.length;
        for (var i = 0; i < length; i++) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
    }
    document.addEventListener("DOMContentLoaded", function() {
        var randomCode = generateRandomCode(6);
        document.getElementById('randomCode').value = randomCode;
        document.getElementById('rol').value = 3
    });
</script>
<script src="https://cdn.ckeditor.com/ckeditor5/37.0.1/classic/ckeditor.js"></script>    
<script>
    ClassicEditor
        .create(document.querySelector('#descripcion'))
        .catch(error => {
            console.error(error);
        });
</script>

</html>
