<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8"/>
        <script>if (history.forward(1)){location.replace(history.forward(1))}</script>
	<title>sistema Integral</title>
	
	<link rel="stylesheet" href="css/stilo1.css" type="text/css" media="screen" />
	<script src="js/jquery-1.5.2.min.js" type="text/javascript"></script>
	<script src="js/jquery.tablesorter.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.equalHeight.js"></script>
        <link rel="stylesheet" type="text/css" href="resources/screen.css" />
    <link rel="stylesheet" type="text/css" href="resources/style.css" />
    <link href="css/login-box.css" rel="stylesheet" type="text/css" />
        


</head>


<body>
    <header id="header">
		<hgroup>
			<h1 class="site_title"><a href="index.php">Virtual Diseño</a></h1>
			
		</hgroup>
    </header>
    
   <div style="padding: 50px 0 0 400px;">


<div id="login-box">

<H2>Restablece tu Contraseña</H2>

<br />
<br />
<?php function formRegistro(){ ?>
<form action="recover.php?lost=ok" method="post">
<div id="login-box-name" style="margin-top:20px;">Direccion de Correo:
</div>
<div id="login-box-field" style="margin-top:20px;">
    <input name="correo" class="form-login" title="Por Favor Digite su Correo" value="" size="30" maxlength="2048" />
</div>

<br />
<br /><div align="right"><input type="submit" name="enviar" value="enviar"></div>
<br>

<!--<a href="../sistema/validar_usuario.php"><img src="images/login-btn.png" width="103" height="42" style="margin-left:90px;" /></a>-->
</form>
<?php
include "modelo/conexion.php";
}
if(isset($_GET["lost"]))
{
if($_POST["correo"]==''){
    echo 'Por Favor Digite Un Correo Valido';
    formRegistro();
    echo '<br>';
echo '<a href="index.php">Volver al Inicio</a>';
}else{
    include "modelo/conexion.php";
    $correo = $_POST["correo"];
    $consulta= "SELECT * FROM `usuarios` WHERE email='".$correo."'";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){

    $email=$fila['email'];
    $user=$fila['usuario'];
    $c=$fila['celular'];

   $b=$fila['id'];
}
if(isset($user)){
    echo $user. ', Dentro de unos momentos recibira un correo con la nueva Contraseña , Si no aparece en la bandeja de entrada
        verifique en correos no deseados Gracias .'; 

        $password= $b.'vd'.$c;
        $sql2 = "UPDATE `usuarios` SET `password`='".md5($password)."' WHERE  `usuario`='".$user."'";
        mysql_query($sql2);
        //espacio para enviar correo
        
$nombre = 'Virtual Diseno';
$mail = 'virtualdiseno.com';


$header = 'From: ' . $mail . " \r\n";
$header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
$header .= "Mime-Version: 1.0 \r\n";
$header .= "Content-Type: text/plain";

$mensaje = "Este mensaje fue enviado por " . $nombre . " \r\n";
$mensaje .= "Su e-mail es: " . $email . " \r\n";
$mensaje .= "Su contraseña reseteada es: " . $password . " \r\n";
$mensaje .= "Enviado el " . date('d/m/Y', time());

$para = $email;
$asunto = 'Recuperacion de Password VD ';

mail($para, $asunto, utf8_decode($mensaje), $header);

echo '<br>';
echo '<a href="index.php">Volver al Inicio</a>';
        
        //fin de envio de correo
}else{
   
   echo 'La direccion de correo no existe en el sistema, por favor comuniquese con el administrador del sistema';
    formRegistro();
    echo '<br>';
echo '<a href="index.php">Volver al Inicio</a>';
}

}

}else{
    formRegistro();
    echo '<br>';
echo '<a href="index.php">Volver al Inicio</a>';
}

?>



</div>

</div>

               

</body>
<div class='pies'>
<p>Desarrollado por: <a href="http://www.virtualdiseno.com">Virtual Diseño</a></p>
<div><a href="http://www.virtualdiseno.com"><img src="images/logovirtual.png" alt="" width="120" height="40"/></a></div></div>
</div>
</html>