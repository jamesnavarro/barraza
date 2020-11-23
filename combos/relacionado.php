<?php
include "../modelo/conexion.php";
$rpta="";
//1
if ($_POST["elegido"]=="Empresas") {
    $con= "SELECT * FROM `sis_empresa` order by `id_empresa`";
    $res=  mysql_query($con);
    
    while($f=  mysql_fetch_array($res)){
    $idco=$f['id_empresa'];
    $nombre1=$f['nombre_emp'];
    
    
    $rpta= $rpta.'<option value="'.$idco.'">'.$nombre1.'</option>';
    }
  
	
        
}
if ($_POST["elegido"]=="Pacientes") {
    $con= "SELECT * FROM `pacientes` order by `id_paciente`";
    $res=  mysql_query($con);
    
    while($f=  mysql_fetch_array($res)){
    $idco=$f['id_paciente'];
    $nombre1=$f['nombres'].' '.$f['nombre2'].' '.$f['apellidos'].' '.$f['apellido2'];
    
    
    $rpta= $rpta.'<option value="'.$idco.'">'.$nombre1.'</option>';
    }
  
	
        
}

//2
if ($_POST["elegido"]=="Incidencia") {
	 $con= "SELECT * FROM `sis_incidencias` order by `id_incidencia`";
    $res=  mysql_query($con);
    
    while($f=  mysql_fetch_array($res)){
    $idco=$f['id_incidencia'];
    $nombre1=$f['asunto_inc'];
    
    
    $rpta= $rpta.'<option value="'.$idco.'">'.$nombre1.'</option>';
    }	
}
//3
if ($_POST["elegido"]=="Casos") {
	 $con= "SELECT * FROM `sis_casos` order by `id_caso`";
    $res=  mysql_query($con);
    
    while($f=  mysql_fetch_array($res)){
    $idco=$f['id_caso'];
    $nombre1=$f['asunto_caso'];
    
    
    $rpta= $rpta.'<option value="'.$idco.'">'.$nombre1.'</option>';
    }	
}
//4
if ($_POST["elegido"]=="Contactos") {
	$con= "SELECT * FROM `sis_contacto` where tipo='Contactado' order by `id_contacto`";
    $res=  mysql_query($con);
    
    while($f=  mysql_fetch_array($res)){
    $idco=$f['id_contacto'];
    $nombre1=$f['nombre_cont'];
    $apellido1=$f['apellido_cont'];
    $id_empr=$f['id_empresa'];
       $sql='select * from sis_empresa where id_empresa='.$id_empr.'';
 $fil =mysql_fetch_array(mysql_query($sql));
        $empresa= $fil["nombre_emp"];
    $rpta= $rpta.'<option value="'.$idco.'">'.$nombre1.' '.$apellido1.' - '.$empresa.'</option>';
    }	
}
//5
if ($_POST["elegido"]=="Contactos Potencial") {
	 $con= "SELECT * FROM `sis_contacto` where tipo='Potencial'  order by `id_contacto`";
    $res=  mysql_query($con);
    
    while($f=  mysql_fetch_array($res)){
    $idco=$f['id_contacto'];
    $nombre1=$f['nombre_cont'];
    $apellido1=$f['apellido_cont'];
    
    $rpta= $rpta.'<option value="'.$idco.'">'.$nombre1.' '.$apellido1.'</option>';
    }	
}
//6

if ($_POST["elegido"]=="Oportunidad") {
	 $con= "SELECT * FROM `sis_oportunidades` order by `id_oportunidad`";
    $res=  mysql_query($con);
    
    while($f=  mysql_fetch_array($res)){
    $idco=$f['id_oportunidad'];
    $nombre1=$f['nombre_opo'];
    
    
    $rpta= $rpta.'<option value="'.$idco.'">'.$nombre1.'</option> ';
    }	
}
//7	
if ($_POST["elegido"]=="Producto") {
	 $con= "SELECT * FROM `producto`";
    $res=  mysql_query($con);
    
    while($f=  mysql_fetch_array($res)){
    $idco=$f['id_p'];
    $nombre1=$f['producto'];
    
    
    $rpta= $rpta.'<option value="'.$idco.'">'.$nombre1.'</option> ';
    }	
}
//8	
if ($_POST["elegido"]=="Proyectos") {
	 $con= "SELECT * FROM `sis_proyecto` order by `id_proyecto`";
    $res=  mysql_query($con);
    
    while($f=  mysql_fetch_array($res)){
    $idco=$f['id_proyecto'];
    $nombre1=$f['nombre_pro'];
    
    
    $rpta= $rpta.'<option value="'.$idco.'">'.$nombre1.'</option>';
    }	
}
//9

//10
if ($_POST["elegido"]=="Email") {
		 $con= "SELECT * FROM `correos`";
    $res=  mysql_query($con);
    
    while($f=  mysql_fetch_array($res)){
    $idco=$f['id_correo'];
    $nombre1=$f['correo'];
    
    
    $rpta= $rpta.'<option value="'.$idco.'">'.$nombre1.'</option> ';
    }	
}
//11	
if ($_POST["elegido"]=="Tarea") {
	 $con= "SELECT * FROM `actividad` where tarea='Tarea'";
    $res=  mysql_query($con);
    
    while($f=  mysql_fetch_array($res)){
    $idco=$f['Id'];
    $nombre1=$f['Subject'];
    
    
    $rpta= $rpta.'<option value="'.$idco.'">'.$nombre1.'</option>';
    }	
}
//12
if ($_POST["elegido"]=="Nota") {
	 $con= "SELECT * FROM `sis_notas` order by `id_nota`";
    $res=  mysql_query($con);
    
    while($f=  mysql_fetch_array($res)){
    $idco=$f['id_nota'];
    $nombre1=$f['asunto_n'];
    
    
    $rpta= $rpta.'<option value="'.$idco.'">'.$nombre1.'</option>';
    }	
}
//13
if ($_POST["elegido"]=="Documento") {
	 $con= "SELECT * FROM `sis_notas` order by `id_nota`";
    $res=  mysql_query($con);
    
    while($f=  mysql_fetch_array($res)){
    $idcoe=$f['id_nota'];
    $nombre1e=$f['asunto_n'];
    
    
    $rpta= $rpta.'<option value="'.$idcoe.'">'.$nombre1e.'</option>';
    }	
}

echo $rpta;
?>