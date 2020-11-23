<?php
require("conexion.php");
session_start();
$status = "";
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));

if ($_POST["nombre"]=="" && $_POST["apellido"]=="" && $_POST["apellido2"]=="" && $_POST["documento"]=="" && $_POST["enfermedad"]=="" && $_POST["email2"]=="") {
    echo '<script lanquage="javascript">alert("Por favor digite los campos obligatorios");location.href="../vistas/pacientes/paciente.php"</script>';
}else{
    if (isset($_GET['editar'])) {
          function edad($edad){
       list($anio,$mes,$dia) = explode("-",$edad);
       $anio_dif = date("Y") - $anio;
       $mes_dif = date("m") - $mes;
       $dia_dif = date("d") - $dia;
       if ($dia_dif < 0 || $mes_dif < 0)
       $anio_dif--;
       return $anio_dif +1;
       } 
        $vr              =$_POST["fecha"];
        $idp             =$_GET['editar'];
        $documento       = $_POST["documento"];
        $numero          = $_POST["numero"];
        $id_emp          = $_POST["empresa"];
        $regimen         = $_POST["regimen"];
	$nombre          = strtoupper($_POST["nombre"]);
	$apellido        = strtoupper($_POST["apellido"]);
        $nombre2         = strtoupper($_POST["nombre2"]);
	$apellido2       = strtoupper($_POST["apellido2"]);    
        $edad            = edad($vr);
	$zona            = $_POST["zona"];
	$sexo            = $_POST["sexo"];
        $fecha           = $_POST["fecha"];      
        $estado          = $_POST["estado_pot"];
        $empresa_lab     = $_POST["empresa_labor"];
        $tel_empresa     = $_POST["tel_empresa"];
        $enfermedad      = $_POST["enfermedad"];     
        $descripcion_enf = $_POST["descripcion_enf"];
        $diagnostico      = $_POST["enfermedad2"];     
        $descripcion_diag2 = $_POST["descripcion_enf2"];
        $tel_casa        = $_POST["tel_casa"];
        $tel_oficina     = $_POST["telefono"];
        $fax             = $_POST["fax"];
        $celular         = $_POST["celular"];       
        $depart          = $_POST["departamento"];
        $municipio       = $_POST["municipio"];
        $direccionf      = $_POST["direccion1"];
        $direccione      = $_POST["direccion2"];
        $email1          = $_POST["email1"];
        $email2          = $_POST["email2"];
        $email3          = $_POST["email3"];
        $informacion     = $_POST["info"];
        $fecha_modi      = date("Y-m-d").' '.$hora.' por '.$_SESSION['k_username'];
        $nom_acu         = strtoupper($_POST["nom_acu"]);
        $ced_acu         = $_POST["ced_acu"];
        $tel_acu         = $_POST["tel_acu"];
        $parentesco      = strtoupper($_POST["parentesco"]);
        $subcodigo       = $_POST["subcodigo"];
        $estado_civ      = $_POST["estado_civ"];
        $tipo_s          = $_POST["tipo_s"];
        $ocupacion       = $_POST["ocupacion"];
        $dir_pariente    = $_POST["dir"];
        $parentesco2     =strtoupper($_POST["parentesco2"]);
        $porque          = $_POST["porque"];
        $alta            = $_POST["alta"];
        
       $sql = "UPDATE `pacientes` SET `alta`='".$alta."',`dir_pariente`='".$dir_pariente."', `ocupacion`='".$ocupacion."', `tipo_s`='".$tipo_s."', `civil`='".$estado_civ."', `subcodigo`='".$subcodigo."', `documento`='".$documento."',`numero_doc`='".$numero."',`id_empresa`='".$id_emp."',`regimen`='".$regimen."', `nombres`='".$nombre."',`apellidos`='".$apellido."', `nombre2`='".$nombre2."',`apellido2`='".$apellido2."', `edad`='".$edad."',`zona`='".$zona."',`sexo`='".$sexo."',`fecha_nacimiento`='".$fecha."',`estado`='".$estado."',`empresa_lab`='".$empresa_lab."',`tel_empresa`='".$tel_empresa."',`enfermedad`='".$enfermedad."',`descripcion_enf`='".$descripcion_enf."',`diagnostico2`='".$diagnostico."',`descripcion_diag2`='".$descripcion_diag2."', `tel_1`='".$tel_casa."',`tel_2`='".$tel_oficina."',`tel_3`='".$fax."',`celular`='".$celular."',`departamento`='".$depart."',`municipio`='".$municipio."',`direccion1`='".$direccionf."',`direccion2`='".$direccione."',`email1`='".$email1."',`email2`='".$email2."',`email3`='".$email3."',`informacion`='".$informacion."',`fecha_mod`='".$fecha_modi."',`nombre_acudiente`='".$nom_acu."',`cedula_acudiente`='".$ced_acu."',`telefono_acudiente`='".$tel_acu."',`parentesco`='".$parentesco."',`parentesco2`='".$parentesco2."',`departamento`='".$depart."',`municipio`='".$municipio."',`porque`='".$porque."' WHERE `pacientes`.`id_paciente`='".$_GET['editar']."';";
       mysql_query($sql);
           $sqlr = "INSERT INTO `modificaciones` (`descripcion`,`id_cotizacion`, `por`, `modulo`) ";
$sqlr.= "VALUES ('Informacion modificada por ".$_SESSION['k_username']."  ', '".$_GET['editar']."', '".$_SESSION['k_username']."', 'Archivo General')";
mysql_query($sqlr);
        echo "<script language='javascript' type='text/javascript'>";
        echo "location.href='../vistas/?id=ver_paciente&cod=".$_GET['editar']."'";
        echo "</script>";
    }else{
        $subcodigo  = strtoupper($_POST["subcodigo"]);
        $documento  = strtoupper($_POST["documento"]);
        $numero     = strtoupper($_POST["numero"]);
        $id_emp     = strtoupper($_POST["empresa"]);
        $regimen    = strtoupper($_POST["regimen"]);
	$nombre     = strtoupper($_POST["nombre"]);
	$apellido   = strtoupper($_POST["apellido"]);
        $nombre2    = strtoupper($_POST["nombre2"]);
	$apellido2  = strtoupper($_POST["apellido2"]);
        $fecha      = strtoupper($_POST["fecha"]); 

        function edad($edad){
       list($anio,$mes,$dia) = explode("-",$edad);
       $anio_dif = date("Y") - $anio;
       $mes_dif = date("m") - $mes;
       $dia_dif = date("d") - $dia;
       if ($dia_dif < 0 || $mes_dif < 0)
       $anio_dif--;
       return $anio_dif +1;
       }



$vr=$_POST["fecha"];

        $edad                = edad($vr);
	$zona                = strtoupper($_POST["zona"]);
	$sexo                = strtoupper($_POST["sexo"]);         
        $estado              = $_POST["estado_pot"];
        $empresa_lab         = strtoupper($_POST["empresa_labor"]);
        $tel_empresa         = strtoupper($_POST["tel_empresa"]);
        $enfermedad          = strtoupper($_POST["enfermedad"]);     
        $descripcion_enf     = strtoupper($_POST["descripcion_enf"]);
        $diagnostico         = strtoupper($_POST["enfermedad2"]);     
        $descripcion_diag2   = strtoupper($_POST["descripcion_enf2"]);
        $tel_casa            = $_POST["tel_casa"];
        $tel_oficina         = $_POST["telefono"];
        $fax                 = $_POST["fax"];
        $celular             = $_POST["celular"];       
        $depart              = $_POST["departamento"];
        $municipio           = $_POST["municipio"];
        $direccionf          = strtoupper($_POST["direccion1"]);
        $direccione          = strtoupper($_POST["direccion2"]);
        $email1              = $_POST["email1"];
        $email2              = $_POST["email2"];
        $email3              = $_POST["email3"];
        $informacion         = $_POST["info"];
        $fecha_modi          = date("Y-m-d").' '.$hora.' por '.$_SESSION['k_username'];
        $fecha_registro      = date("Y-m-d").' '.$hora.' por '.$_SESSION['k_username'];
        $nom_acu             = strtoupper($_POST["nom_acu"]);
        $ced_acu             = $_POST["ced_acu"];
        $tel_acu             = $_POST["tel_acu"];
        $parentesco          = $_POST["parentesco"];
        $estado_civ          = $_POST["estado_civ"];
        $tipo_s              = $_POST["tipo_s"];
        $ocupacion           = $_POST["ocupacion"];
        $dir_pariente        = $_POST["dir"];
        $parentesco2         = $_POST["parentesco2"];
        $porque              = $_POST["porque"];
        $alta                = $_POST["alta"];
  
$checkuser = mysql_query("SELECT numero_doc FROM pacientes WHERE numero_doc='$numero'");
$username_exist = mysql_num_rows($checkuser);
if ($username_exist>0) {
    echo '<script lanquage="javascript">alert("El numero de documento ya esta registrado");location.href="../vistas/?id=paciente"</script>';
}else{

    $sql = "INSERT INTO `pacientes`(`alta`,`civil`, `tipo_s`, `ocupacion`, `dir_pariente`, `subcodigo`, `documento`, `numero_doc`, `id_empresa`, `regimen`, `nombres`, `apellidos`, `nombre2`, `apellido2`, `edad`, `zona`, `sexo`, `fecha_nacimiento`, `estado`, `empresa_lab`, `tel_empresa`, `enfermedad`, `descripcion_enf`,`diagnostico2`, `descripcion_diag2`, `tel_1`, `tel_2`, `tel_3`, `celular`, `departamento`, `municipio`, `direccion1`, `direccion2`, `email1`, `email2`, `email3`, `informacion`, `fecha_mod`, `fecha_reg`, `nombre_acudiente`, `cedula_acudiente`, `telefono_acudiente`, `parentesco` , `parentesco2`, `porque`) ";
    $sql.= "VALUES ('".$alta."', '".$estado_civ."', '".$tipo_s."', '".$ocupacion."', '".$dir_pariente."', '".$subcodigo."', '".$documento."', '".$numero."', '".$id_emp."', '".$regimen."', '".$nombre."', '".$apellido."', '".$nombre2."', '".$apellido2."', '".$edad."', '".$zona."', '".$sexo."', '".$fecha."', '".$estado."', '".$empresa_lab."', '".$tel_empresa."', '".$enfermedad."', '".$descripcion_enf."', '".$diagnostico."', '".$descripcion_diag2."', '".$tel_casa."','".$tel_oficina."', '".$fax."', '".$celular."', '".$depart."', '".$municipio."', '".$direccionf."', '".$direccione."', '".$email1."', '".$email2."', '".$email3."', '".$informacion."', '".$fecha_modi."', '".$fecha_registro."', '".$nom_acu."', '".$ced_acu."', '".$tel_acu."', '".$parentesco."', '".$parentesco2."', '".$porque."')";
    mysql_query($sql);
    
    $sqlr = "INSERT INTO `modificaciones` (`descripcion`,`id_cotizacion`, `por`, `modulo`) ";
$sqlr.= "VALUES ('Informacion Registrada por ".$_SESSION['k_username']."  ', '".$_GET['cod']."', '".$_SESSION['k_username']."', 'Archivo General')";
mysql_query($sqlr);

    $status = "ok";
    echo "<script language='javascript' type='text/javascript'>";
    echo "location.href='../vistas/?id=pacientes'";
    echo "</script>";
        
        
}}}
?>

