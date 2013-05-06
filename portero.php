<?php
include 'libreria/php/principal.php';

if(isset($_GET['accion']) && $_GET['accion'] == 'cerrarSesion'){
    session_destroy();
    header("Location: portero.php");
    exit;
}

if(isset($_POST['submit'])){
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    
    $query = "SELECT id, nombre, apellidos, usuario, password
        FROM tbl_usuarios
        WHERE usuario = '$usuario' AND password = '$password'";
    $result = mysql_query($query) or die(mysql_error());
    $datos = mysql_fetch_array($result);
    $numDatos = mysql_num_rows($result);
    
    if($numDatos != 0){
        $_SESSION['pdvAcceso'] = true;
        $_SESSION['Nusuario'] = utf8_encode($datos['nombre'])." ".utf8_encode($datos['apellidos']);
        $_SESSION['IDusuario'] = $datos['id'];
        $idusuario = $_SESSION['IDusuario'];
        $ip = $_SERVER['REMOTE_ADDR'];
        
        // log de accesos
        $qlog = "INSERT INTO tbl_accesos
            (usuario, ip, fecha)
            VALUES
            ('$idusuario','$ip', NOW())";
        mysql_query($qlog) or die(mysql_error());
        
    } else {
        header("Location: portero.php?mensaje=error");
        exit;
    }
    
}

if(isset($_SESSION['pdvAcceso'])){
    header("Location: dashboard.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="es-MX">
    <head>
        <meta charset="UTF-8" />
        <title>Sistema PDV Tezontle Express</title>
        <meta name="author" content="Fernando Magrosoto V. | info@fmagrosoto.com" />
        <meta name="description" content="Sistema PDV para Tezontle Express" />
        <meta name="keywords" content="PDV, magrosoto, tezontle, fernando magrosoto,
              nimbus, digitae" />
        <meta name="robots" content="INDEX,NOFOLLOW" />
        <link rel="stylesheet" type="text/css" href="css/principal.css" />
        <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,700' rel='stylesheet' type='text/css'>
        <script src="libreria/js/interno.js"></script>
    </head>
    <!-- Gracias por ver nuestro código
    Este sitio está hecho en HTML5.
    Desarrollado por Fernando Magrosoto V. - info@fmagrosoto.com -->
    <body>
        <!-- área del WRAPPER -->
        <div id="contenedor-principal">
            
            <!-- ZONA DE ENCABEZADO -->
            <header>
                <h1>Sistema PDV Tezontle Express</h1>
            </header>
            <!-- FIN ENCABEZADO -->
            
            <!-- ZONA DEL CUERPO -->
            <section>
                <?php if(isset($_GET['mensaje']) && $_GET['mensaje'] == 'error'){ ?>
                <div id="mensaje-error">
                    Lo sentimos, los datos introducidos no son válidos.<br />
                    favor de intentar de nuevo.
                </div>
                <script>
                    window.setTimeout(function(){
                        var nodo = document.getElementById('mensaje-error');
                        nodo.style.display = 'none';
                    },5000);
                </script>
                <?php } ?>
                <div id="inicioSesion">
                    <form name="iniciarSesion"
                          method="POST"
                          action="portero.php">
                        <fieldset>
                            <legend>Introduzca los datos de usuario</legend>
                            <div>
                                <input type="text"
                                       name="usuario"
                                       size="25"
                                       maxlength="10"
                                       required
                                       autocomplete = "off"
                                       placeholder="usuario"/>
                            </div>
                            <div>
                                <input type="password"
                                       name="password"
                                       size="25"
                                       maxlength="10"
                                       required
                                       placeholder="contraseña" />
                            </div>
                            <div>
                                <button type="submit"
                                        name="submit">Iniciar sesión</button>
                            </div>
                        </fieldset>
                    </form>
                    <p class="txt-advertencia">El acceso a éste sitio es privado.
                        Sólo podrá entrar personal autorizado. Queda estrictamente
                    prohibido intentar acceder a este portal con fines diferentes
                    a los establecidos originalmente por el dueño del sitio y por
                    el quipo de desarrolladores.</p>
                </div>
            </section>
            <!-- fin CUERPO -->
            
            <!-- ZONA DE PIE DE PÁGINA -->
            <footer>
                <div class="legales">
                    <p>&copy;2013 - Sistema PDV Tezontle Express</p>
                    <p>Todos los Derechos Reservados</p>
                </div>
                <div class="creditos">
                    <a href="javascript:void(0);"
                       onclick="nimbus();">
                        <img src="imagenes/logoNimbus.png"
                             alt="Tecnología NIMBUS"
                             title="Tecnología NIMBUS"
                             height="35" />
                    </a>
                </div>
            </footer>
            <!-- FIN DE PIE DE PÁGINA -->
            
        </div>
        <!-- fin WRAPPER -->
    </body>
</html>
