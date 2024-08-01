
<!DOCTYPE html> 
<html lang="es">
    
    <head>
        <title>Mintur - Inicio</title>
        <meta charset="UFT-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1, maximun-scale=1, minimun-scale=1,">
        
        <link rel="stylesheet" href="css/fontello.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/Bootstrap/bootstrap.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        
        
        <script src="js/Bootstrap/bootstrap.bundle.min.js"></script> 
    </head>
    <body>  
    <div class="area" >
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
                                <h3 class="mb-5">Inicie Sesión</h3>
                                <form action="login.php" method="POST" class="form-signin">
                                    <label for="usuario">
                                        <span>Usuario</span> <br>
                                        <input type="text" name="usuario" class="form-control form-control-lg" placeholder="Ingrese su nombre de usuario">
                                    </label>
                                    <br><br>
                                    <label for="inicio-platzi">
                                        <span>Clave</span> <br>
                                        <input type="password" name="clave" placeholder="ingrese su clave" class="form-control form-control-lg" >
                                    </label>
                                    <br>
                                    <br><br>
                                    <input class="btn btn-primary btn-lg btn-block mb-2" type="submit" value="Enviar"/> 
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
