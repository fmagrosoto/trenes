<?php
include 'libreria/php/principal.php';
$hoy = date("Y-m-d H:i:s");

restricionAcceso();

// CANCELAR cuenta
if(isset($_GET['accion']) && $_GET['accion'] == 'cancelar'){
    $cuenta = $_GET['cuenta'];
    $queryCancelar = "UPDATE tbl_venta SET status=3 WHERE id='$cuenta'";
    mysql_query($queryCancelar) or die(mysql_error());
    header("Location: venta.php");
    exit;
}

// REALIZAR venta
if(isset($_GET['accion']) && $_GET['accion'] == 'realizar'){
    $cuenta = $_GET['cuenta'];
    $queryCancelar = "UPDATE tbl_venta SET status=2 WHERE id='$cuenta'";
    mysql_query($queryCancelar) or die(mysql_error());
    header("Location: venta_realizada.php?accion=realizada&cuenta=$cuenta");
    exit;
}

// AGREGAR producto
if(isset($_GET['accion']) && $_GET['accion'] == 'agregar'){
    $personas = $_GET['personas'];
    $importe = $_GET['importe'];
    $concepto = $_GET['concepto'];
    $cuenta = $_GET['cuenta'];
    $IDusuario = $_SESSION['IDusuario'];
    
    if($cuenta == 'nueva'){ // crear nueva cuenta
        
        $queryNueva = "INSERT INTO tbl_venta
            (usuario, total, status, fecha)
            VALUES
            ('$IDusuario', '0.00', 1, '$hoy')";
        mysql_query($queryNueva) or die(mysql_error());
        $cuenta = mysql_insert_id();
    }
    
    // Agregar producto
    $queryAgregar = "INSERT INTO tbl_productos_venta
            (venta, concepto, importe, personas)
            VALUES
            ('$cuenta', '$concepto', '$importe', '$personas')";
    mysql_query($queryAgregar) or die(mysql_error());
    
    // Actualizar cuenta
    $queryTotal = "SELECT total FROM tbl_venta WHERE id = '$cuenta'";
    $resultTotal = mysql_query($queryTotal) or die(mysql_error());
    $datosTotal = mysql_fetch_array($resultTotal);
    
    $total = $datosTotal['total'];
    $nuevoTotal = $total + $importe;
    
    $queryActualizar = "UPDATE tbl_venta SET total = '$nuevoTotal' WHERE id = '$cuenta'";
    mysql_query($queryActualizar) or die(mysql_error());
    
    // enviar a la página de ventas con la venta agregada
    header("Location: venta.php?accion=agregado&cuenta=$cuenta");
    exit;
}

// Revisar la cuenta
if(isset($_GET['cuenta'])){
    $cuenta = $_GET['cuenta'];
} else {
    $cuenta = 'nueva';
}

// Extraer tabla de productos
$queryTabla = "SELECT * FROM tbl_productos_venta WHERE venta = '$cuenta'";
$resultTabla = mysql_query($queryTabla) or die(mysql_error());
$datosTabla = mysql_fetch_array($resultTabla);

// Extraer total de la cuenta
$queryTcuenta = "SELECT total, status FROM tbl_venta WHERE id = '$cuenta'";
$resultTcuenta = mysql_query($queryTcuenta) or die(mysql_error());
$datosTcuenta = mysql_fetch_array($resultTcuenta);
$numdatosTcuenta = mysql_num_rows($resultTcuenta);

if($numdatosTcuenta != 0){
    if($datosTcuenta['status'] != 1){
        header("Location: venta.php");
        exit;
    }
}

// Extraer lista de precios
$queryPrecios = "SELECT * FROM tbl_precios ORDER BY id";
$resultPrecios = mysql_query($queryPrecios) or die(mysql_error());
$datosPrecios = mysql_fetch_array($resultPrecios);

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
                    <li><em>Usuario activo: <?php echo $_SESSION['Nusuario']; ?></em></li>
                </ul>
            </nav>
            
            <!-- ZONA DEL CUERPO -->
            <section>
                <div class="titulo">
                    <h2>Venta</h2>
                </div>
                
                <div class="doble-columna">
                    <div class="botones">
                        <?php do { ?>
                        <div>
                            <button type="button"
                                    name="1persona"
                                    class="boton-ventas"
                                    onclick="agregarProducto('<?php echo $datosPrecios['personas']; ?>','<?php echo $datosPrecios['importe']; ?>','<?php echo utf8_encode($datosPrecios['concepto']); ?>','<?php echo $cuenta ?>');"><?php echo utf8_encode($datosPrecios['concepto']). "<br />$ ".$datosPrecios['importe']; ?></button>
                        </div>
                        <?php } while ($datosPrecios = mysql_fetch_array($resultPrecios));?>
                    </div>
                    <div class="cuenta">
                        <div id="mostrar-cuenta">
                            <p><?php echo mostrarFechaH($hoy, 1) ?></p>
                            <hr />
                            <p>Venta hecha por: <em><?php echo $_SESSION['Nusuario'] ?></em></p>
                            <hr />
                            
                            <div class="tabla-de-cuentas">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Concepto</th>
                                            <th>Importe</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <td>Total de la cuenta</td>
                                            <td>$ <?php echo $datosTcuenta['total'] ?></td>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php do { ?>
                                        <tr>
                                            <td><?php echo utf8_encode($datosTabla['concepto']); ?></td>
                                            <td>$ <?php echo $datosTabla['importe']; ?></td>
                                        </tr>
                                        <?php } while ($datosTabla = mysql_fetch_array($resultTabla)); ?>
                                    </tbody>
                                </table>
                            </div>
                            <hr style="clear: both;" />

                        </div>
                        <div class="mas-botones">
                            <button type="button"
                                    name="cerraVenta"
                                    id="cerrarVenta"
                                    class="botonesVenta"
                                    onclick="cerrarVenta('<?php echo $cuenta; ?>');"
                                    disabled>Cerrar venta</button>
                            <button type="button"
                                    name="cancelarVenta"
                                    id="cancelarVenta"
                                    class="botonesVenta"
                                    onclick="cancelarCuenta('<?php echo $cuenta; ?>');"
                                    disabled>Cancelar venta</button>
                        </div>
                    </div>
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
        <?php if(isset($_GET['accion']) && $_GET['accion'] == 'agregado') { ?>
        <script>
            document.getElementById('cerrarVenta').disabled = false;
            document.getElementById('cancelarVenta').disabled = false;
        </script>
        <?php } ?>
    </body>
</html>
