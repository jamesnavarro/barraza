<?php
//define('DB_HOST', 'webtemplado.com');
//define('DB_USER', 'webtem5_templado');
//define('DB_PASS', '20031123003');
//define('DB_NAME', 'webtem5_aluvmix');
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'medinter_crm_medico');
 
    $con=@mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if(!$con){
        die("imposible conectarse: ".mysqli_error($con));
    }
    if (@mysqli_connect_errno()) {
        die("Conexión falló: ".mysqli_connect_errno()." : ". mysqli_connect_error());
    }
?>