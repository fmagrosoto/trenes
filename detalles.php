<?php
include 'libreria/php/principal.php';

restricionAcceso();

$fecha = date("Y-m-d");
$hora = date("H:i:s");
$hoy = $fecha. " " .$hora;
$usuario = $_SESSION['IDusuario'];

// EXTRAER informaciónde la venta
$queryVentas = "SELECT id, total FROM tbl_venta WHERE usuario = '$usuario' AND fecha LIKE '$fecha%'";
$resultVentas = mysql_query($queryVentas) or die(mysql_error());
$datosVentas = mysql_fetch_array($resultVentas);
$numDatosVentas = mysql_num_rows($resultVentas);

$queryTotales = "SELECT SUM(total) AS totales FROM tbl_venta WHERE usuario = '$usuario' AND fecha LIKE '$fecha%'";
$resultTotales = mysql_query($queryTotales) or die(mysql_error());
$datosTotales = mysql_fetch_array($resultTotales);

/*
 * EXTRAER NÚMERO DE PERSONAS DE UNA CUENTA
 * 
 * Extracción del número de personas de una cuenta pasada como parámetro
 */
function mostrarNumPersonas($venta){
    $query = "SELECT SUM( personas ) AS personas
FROM tbl_productos_venta
WHERE venta = '$venta'";
    $result = mysql_query($query) or die(mysql_error());
    $datos = mysql_fetch_array($result);
    return $datos['personas'];
}

function numUsuarios($usuario, $fecha){
    $cuenta = 0;
    
    $queryVentas = "SELECT id FROM tbl_venta WHERE usuario = '$usuario' AND fecha LIKE '$fecha%'";
    $resultVentas = mysql_query($queryVentas) or die(mysql_error());
    $datosVentas = mysql_fetch_array($resultVentas);
    
    do {
        
        $venta = $datosVentas['id'];
        $query = "SELECT SUM( personas ) AS personas FROM tbl_productos_venta
            WHERE venta = '$venta'";
        $result = mysql_query($query) or die(mysql_error());
        $datos = mysql_fetch_array($result);
        
        $suma = $datos['personas'];
        $cuenta += $suma;
        
    } while($datosVentas = mysql_fetch_array($resultVentas));
    

    return $cuenta;
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
                <h1><img src="imagenes/express.png" alt="" /></h1>
            </header>
            <!-- FIN ENCABEZADO -->
            
            <!-- Navegación -->
            <nav>
                <ul>
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="portero.php?accion=cerrarSesion">Cerrar sesión</a></li>
                    <li><em class="tip">Usuario activo: <?php echo $_SESSION['Nusuario']; ?></em></li>
                </ul>
            </nav>
            
            <!-- ZONA DEL CUERPO -->
            <section>
                <div class="titulo">
                    <h2>Detalles de venta del día</h2>
                </div>
                
                <div class="fecha">Fecha: <?php echo mostrarFechaH($hoy, 1) ?></div>
                
                <table class="detalles">
                    <thead>
                        <tr>
                            <th>ID de venta</th>
                            <th>Importe</th>
                            <th>No. de personas</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <td><?php echo $numDatosVentas; ?> ventas</td>
                            <td>Total $ <?php echo number_format($datosTotales['totales'], 2); ?></td>
                            <td><?php echo numUsuarios($usuario, $fecha); ?> usuarios del tren</td>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php do { ?>
                        <tr>
                            <td><?php echo $datosVentas['id'] ?></td>
                            <td>$ <?php echo $datosVentas['total'] ?></td>
                            <td><?php echo mostrarNumPersonas($datosVentas['id']) ?></td>
                        </tr>
                        <?php } while ($datosVentas = mysql_fetch_array($resultVentas)); ?>
                    </tbody>
                </table>
                
                <hr />
                <div>
                    <button type="button"
                            name="nueva-venta"
                            onclick="nuevaVenta();">Nueva venta</button>
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
