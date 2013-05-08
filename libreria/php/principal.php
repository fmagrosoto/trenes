<?php
session_start();
include 'openDB.php';
date_default_timezone_set('America/Mexico_City');

/*
 * FUNCION PARA RESTRINGIR EL ACCESO A LAS PÁGINAS INTERNAS
 * 
 * Función sencilla para restringir el acceso a las
 * páginas internas del sistema PDV
 */
function restricionAcceso(){
    if(!isset($_SESSION['pdvAcceso'])){
        header("Location: portero.php");
        exit;
    }
}

// tratar FECHA con hora
function mostrarFechaH($fecha, $phora){
	$fechaO = explode(" ",$fecha);
    $fechaA = $fechaO[0];
    $hora = $fechaO[1];
    
    $fechaB = explode("-",$fechaA);
    $agno = $fechaB[0];
    $mes = $fechaB[1];
    $dia = $fechaB[2];
    
    switch ($mes){
        case "01":
            $Nmes = "enero";
            break;
        case "02":
            $Nmes = "febrero";
            break;
        case "03":
            $Nmes = "marzo";
            break;
        case "04":
            $Nmes = "abril";
            break;
        case "05":
            $Nmes = "mayo";
            break;
        case "06":
            $Nmes = "junio";
            break;
        case "07":
            $Nmes = "julio";
            break;
        case "08":
            $Nmes = "agosto";
            break;
        case "09":
            $Nmes = "septiembre";
            break;
        case "10":
            $Nmes = "octubre";
            break;
        case "11":
            $Nmes = "noviembre";
            break;
        case "12":
            $Nmes = "diciembre";
            break;
    }
    if($phora == 1){
		$salidaFecha = $dia. " de ".$Nmes." de ".$agno. " - ".$hora;	
	} else if($phora == 0) {
		$salidaFecha = $dia. " de ".$Nmes." de ".$agno;
	}
    
    echo $salidaFecha;
}

/*
 * EXTRAER NOMBRE DE USUARIO
 */
function nombreUsuario($usuario){
    $query = "SELECT nombre, apellidos FROM tbl_usuarios WHERE id = '$usuario'";
    $result = mysql_query($query) or die(mysql_error());
    $datos = mysql_fetch_array($result);
    
    $nombre = utf8_encode($datos['nombre']). " " .utf8_encode($datos['apellidos']);
    return $nombre;
}

?>
