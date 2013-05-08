<?php
include 'libreria/php/principal.php';
restricionAcceso();
$usuario = $_SESSION['IDusuario'];

$fecha = date("Y-m-d");

// EXTRAER número de ventas
$queryVentas = "SELECT COUNT(id) AS ventas FROM tbl_venta
    WHERE usuario = '$usuario' AND status = 2 AND fecha LIKE '$fecha%'";
$resultVentas = mysql_query($queryVentas) or die(mysql_error());
$datosVentas = mysql_fetch_array($resultVentas);
$numVentas = $datosVentas['ventas'];

// EXTRAER importe de ventas
$queryImporte = "SELECT SUM(total) AS importe FROM tbl_venta
    WHERE usuario = '$usuario' AND status = 2 AND fecha LIKE '$fecha%'";
$resultImporte = mysql_query($queryImporte) or die(mysql_error());
$datosImporte = mysql_fetch_array($resultImporte);
$importeVentas = number_format($datosImporte['importe'],2);


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
                    <li><a href="venta.php">Nueva venta</a></li>
                    <li><a href="portero.php?accion=cerrarSesion">Cerrar sesión</a></li>
                    <li><em>Usuario activo: <?php echo $_SESSION['Nusuario']; ?></em></li>
                </ul>
            </nav>
            
            <!-- ZONA DEL CUERPO -->
            <section>
                <div class="titulo">
                    <h2>Dashboard</h2>
                </div>
                <div>
                    <table class="mostrar-datos">
                        <thead>
                            <tr>
                                <th>Actividades en el día</th>
                                <th>Números</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <td colspan="3">Actividades del usuario: <em><?php echo $_SESSION['Nusuario']; ?></em></td>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr>
                                <td>Ventas realizadas</td>
                                <td><span>$ <?php echo $importeVentas; ?></span></td>
                                <td class="acciones"><a href="detalles.php">Ver detalles</a></td>
                            </tr>
                            <tr>
                                <td>No. de boletos vendidos</td>
                                <td><span><?php echo $numVentas; ?></span></td>
                                <td class="acciones"><a href="detalles.php">Ver detalles</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="espacio"></div>
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
