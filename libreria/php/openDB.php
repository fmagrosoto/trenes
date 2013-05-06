<?php

$dbhost = '68.178.139.161'; // Servidor de la BD
$dbuser = 'BDtezontle'; // Usuario
$dbpass = 'PDVbd2013!'; // Password
$dbname = 'BDtezontle'; // Base de datos

// Conexión
$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
mysql_select_db($dbname);

?>
