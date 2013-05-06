<?php
session_start();
include 'openDB.php';

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

?>
