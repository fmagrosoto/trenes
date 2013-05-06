<?php

$dbhost = 'localhost'; // Servidor de la BD
$dbuser = 'root'; // Usuario
$dbpass = ''; // Password
$dbname = 'pdv_trenes'; // Base de datos

// Conexión
$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
mysql_select_db($dbname);

?>
