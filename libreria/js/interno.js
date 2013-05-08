/*
 ** NIMBUS INFO
 *
 * Información acerca de la tecnología NIMBUS
 */
var nimbus = function(){
    var leyenda = "NIMBUS es una marca propietaria de dIGITAE.";
    leyenda = leyenda + "\nPara mayores informes, por favor visite www.portalnimbus.com.";
    leyenda = leyenda + "\nO también puede visitar www.digitae.com.mx.";
    leyenda = leyenda + "\nMuchas gracias.";
    alert(leyenda);
};

var nuevaVenta = function(){
    window.location = "venta.php";
};


var agregarProducto = function(personas, importe, concepto, cuenta){
    window.location = "venta.php?accion=agregar&personas="+personas+"&importe="+importe+"&concepto="+concepto+"&cuenta="+cuenta;
};

var cancelarCuenta = function(cuenta){
    if(confirm('¿Está seguro de querer CANCELAR la cuenta?')){
        window.location = "venta.php?accion=cancelar&cuenta="+cuenta;
    }
};

var cerrarVenta = function(cuenta){
    if(confirm('¿Está seguro de querer REALIZAR la venta?')){
        window.location = "venta.php?accion=realizar&cuenta="+cuenta;
    }
};

var imprimir = function(){
  // alert('Próximamente; hace falta hacer pruebas con la impresora térmica.')
  window.print();
};