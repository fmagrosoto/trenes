<?php
include 'libreria/php/principal.php';

restricionAcceso();

// EXTRAER información de la cuenta
if(isset($_GET['accion']) && $_GET['accion'] == 'realizada'){
    if(isset($_GET['cuenta'])){
        $cuenta = $_GET['cuenta'];
        
        $queryX = "SELECT * FROM tbl_venta WHERE id = '$cuenta'";
        $resultX = mysql_query($queryX) or die(mysql_error());
        $datosX = mysql_fetch_array($resultX);
        $numDatosX = mysql_num_rows($resultX);
        
        $queryP = "SELECT * FROM tbl_productos_venta WHERE venta = '$cuenta'";
        $resP = mysql_query($queryP) or die(mysql_error());
        $datosP = mysql_fetch_array($resP);
        
        if($numDatosX == 0){
            header("Location: dashboard.php?error=nohayregistro");
            exit;
        } else {
            if($datosX['status'] != 2){
                header("Location: dashboard.php?error=noesventa");
                exit;
            }
        }
        
    } else {
        header("Location: dashboard.php");
        exit;
    }
} else {
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
            
            <!-- Navegación -->
            <nav>
                <ul>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="portero.php?accion=cerrarSesion">Cerrar sesión</a></li>
                    <li>| <em>Usuario activo: <?php echo $_SESSION['Nusuario']; ?></em></li>
                </ul>
            </nav>
            
            <!-- ZONA DEL CUERPO -->
            <section>
                <div class="titulo">
                    <h2>Venta realizada con éxito</h2>
                </div>
                
                <table class="ver-venta">
                    <tr>
                        <td>Venta realizada por: <?php echo nombreUsuario($datosX['usuario']); ?></td>
                    </tr>
                    <tr>
                        <td>Fecha: <?php echo mostrarFechaH($datosX['fecha'], 1) ?></td>
                    </tr>
                    <tr>
                        <td>Venta No: <?php echo $datosX['id'] ?></td>
                    </tr>
                </table>
                
                <table class="ver-productos">
                    <thead>
                        <tr>
                            <th>Concepto</th>
                            <th>Importe</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <td>Total de la venta:</td>
                            <td>$ <?php echo $datosX['total'] ?></td>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php do { ?>
                        <tr>
                            <td><?php echo utf8_encode($datosP['concepto']) ?></td>
                            <td>$ <?php echo $datosP['importe']; ?></td>
                        </tr>
                        <?php } while ($datosP = mysql_fetch_array($resP)); ?>
                    </tbody>
                </table>
                
                <hr />
                <div>
                    <button type="button"
                            name="nueva-venta"
                            onclick="nuevaVenta();">Nueva venta</button>
                    <button type="button"
                            name="imprimir"
                            onclick="imprimir();">Imprimir recibo</button>
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
