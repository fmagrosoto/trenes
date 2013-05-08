<?php
date_default_timezone_set('America/Mexico_City');

$hoy = date("I,e, Y-m-d H:i:s");

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Prueba de fechas</title>
    </head>
    <body>
        <h1>Prueba de fechas</h1>
        <hr />
        <p>La fecha de hoy es: <?php echo $hoy; ?></p>
    </body>
</html>