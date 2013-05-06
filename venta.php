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
                </ul>
            </nav>
            
            <!-- ZONA DEL CUERPO -->
            <section>
                <div class="titulo">
                    <h2>Venta</h2>
                </div>
                
                <div class="doble-columna">
                    <div class="botones">
                        <div>
                            <button type="button"
                                    name="1persona"
                                    id="1persona"
                                    class="boton-ventas">1 persona - [$00.00]</button>
                        </div>
                        <div>
                            <button type="button"
                                    name="2personas"
                                    id="2personas"
                                    class="boton-ventas">2 personas - [$00.00]</button>
                        </div>
                        <div>
                            <button type="button"
                                    name="3personas"
                                    id="3personas"
                                    class="boton-ventas">3 personas - [$00.00]</button>
                        </div>
                        <div>
                            <button type="button"
                                    name="4personas"
                                    id="4personas"
                                    class="boton-ventas">Pase familiar - [$00.00]</button>
                        </div>
                    </div>
                    <div class="cuenta">
                        <div id="mostrar-cuenta">
                            <p>31 de septiembre de 2013 - 10:55:55</p>
                            <hr />
                            <p>Venta hecha por: <em>[nombre de vendedor]</em></p>
                            <p>Venta No: <em>[No de venta]</em></p>
                            <hr />
                            <table class="tabla-cuenta">
                                <tr>
                                    <td>1 pase individual =></td>
                                    <td class="precio">$ 00.00</td>
                                </tr>
                                <tr>
                                    <td>1 pase doble =></td>
                                    <td class="precio">$ 00.00</td>
                                </tr>
                            </table>
                            <hr />
                            <table class="tabla-cuenta">
                                <tr>
                                    <td>Total de la cuenta:</td>
                                    <td class="precio">$ 1000.00</td>
                                </tr>
                            </table>
                            <hr />
                        </div>
                        <div class="mas-botones">
                            <button type="button"
                                    name="cerraVenta"
                                    class="botonesVenta">Cerrar venta</button>
                            <button type="button"
                                    name="cancelarVenta"
                                    class="botonesVenta">Cancelar venta</button>
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
    </body>
</html>
