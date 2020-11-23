<?php
include('../../modelo/conexion.php');

$query = mysql_query('SELECT * from pacientes where numero_doc="'.$_POST['id'].'" ');
$f = mysql_fetch_array($query);
$p = array();
$p[0] = $f['numero_doc'];
$p[1] = $f['nombres'];
$p[2] = $f['direccion1'];
$p[3] = $f['tel_1'];
$p[4] = $f['nombre_acudiente'];
$p[5] = $f['telefono_acudiente'];
$p[6] = $f['fecha_mod'];
$p[7] = $f['fecha_reg'];
$p[8] = $f['id_empresa'];
$p[9] = $f['departamento'];
//$p[10] = $f['municipio'];
$p[11] = $f['estado'];
$p[12] = $f['descripcion_enf'];
$p[13] = $f['subcodigo'];
$p[14] = $f['nombre2'];
$p[15] = $f['apellidos'];
$p[16] = $f['apellido2'];
$p[17] = $f['celular'];
$p[18] = $f['deposito_alq'];
$p[19] = $f['enfermedad'];

$con= "SELECT * FROM `departamentos` where cod_dep='".$f['departamento']."' and cod_mun='".$f['municipio']."' ";
$res=  mysql_query($con);
$g = mysql_fetch_array($res);
$p[10] = $g['id'];
    
echo json_encode($p);
exit();