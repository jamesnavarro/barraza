<?php
require("conexion.php");
session_start();
$status = "";
$sql = "SELECT MAX(id_contacto_pot) as id FROM sis_contacto_potencial";
$fila =mysql_fetch_array(mysql_query($sql));
$id = $fila["id"]+1;
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
if ($_POST["nombre"]=="" && $_POST["apellido"]=="") {
    echo '<script lanquage="javascript">alert("Por favor digite los campos obligatorios");location.href="../vistas/formulario_contacto_potencial.php"</script>';
}else{
       $subcodigo = strtoupper($_POST["subcodigo"]);
        $documento = strtoupper($_POST["documento"]);
        $numero = strtoupper($_POST["numero"]);
        $id_emp = strtoupper($_POST["empresa"]);
        $regimen = strtoupper($_POST["regimen"]);
	$nombre = strtoupper($_POST["nombre"]);
	$apellido = strtoupper($_POST["apellido"]);
        $nombre2 = strtoupper($_POST["nombre2"]);
	$apellido2 = strtoupper($_POST["apellido2"]);
        $fecha = strtoupper($_POST["fecha"]); 
        function edad($edad){
list($anio,$mes,$dia) = explode("-",$edad);
$anio_dif = date("Y") - $anio;
$mes_dif = date("m") - $mes;
$dia_dif = date("d") - $dia;
if ($dia_dif < 0 || $mes_dif < 0)
$anio_dif--;
return $anio_dif;
}
$vr=$_POST["fecha"];

        $edad = edad($vr);
	$zona = strtoupper($_POST["zona"]);
	$sexo = strtoupper($_POST["sexo"]);
             
        $estado = $_POST["estado_pot"];
        $empresa_lab = strtoupper($_POST["empresa_labor"]);
        $tel_empresa = strtoupper($_POST["tel_empresa"]);

        $enfermedad = strtoupper($_POST["enfermedad"]);     
        $descripcion_enf = strtoupper($_POST["descripcion_enf"]);
        $tel_casa = $_POST["tel_casa"];
        $tel_oficina = $_POST["telefono"];
        $fax = $_POST["fax"];
        $celular = $_POST["celular"];       
        $depart = $_POST["departamento"];
        $municipio = $_POST["municipio"];
        $direccionf = strtoupper($_POST["direccion1"]);
        $direccione = strtoupper($_POST["direccion2"]);
        $email1 = $_POST["email1"];
        $email2 = $_POST["email2"];
        $email3 = $_POST["email3"];
        $informacion = $_POST["info"];
        $fecha_modi = date("Y-m-d").' '.$hora.' por '.$_SESSION['k_username'];
        $fecha_registro = date("Y-m-d").' '.$hora.' por '.$_SESSION['k_username'];
        $nom_acu = strtoupper($_POST["nom_acu"]);
        $ced_acu = $_POST["ced_acu"];
        $tel_acu = $_POST["tel_acu"];
        $parentesco = $_POST["parentesco"];
        $estado_civ = $_POST["estado_civ"];
        $tipo_s = $_POST["tipo_s"];
        $ocupacion = $_POST["ocupacion"];
        $dir_pariente = $_POST["dir_pariente"];
      $parentesco2 = $_POST["parentesco2"];
      $porque = $_POST["porque"];
  
         $checkuser = mysql_query("SELECT numero_doc FROM pacientes WHERE numero_doc='$numero'");
			$username_exist = mysql_num_rows($checkuser);
			
			if ($username_exist>0) {
				
                                echo '<script lanquage="javascript">alert("El numero de documento ya esta registrado");location.href="../vistas/formulario_contacto_potencial.php"</script>';
			}else{
        
	

	$sql = "INSERT INTO `pacientes`(`civil`, `tipo_s`, `ocupacion`, `dir_pariente`, `subcodigo`, `documento`, `numero_doc`, `id_empresa`, `regimen`, `nombres`, `apellidos`, `nombre2`, `apellido2`, `edad`, `zona`, `sexo`, `fecha_nacimiento`, `estado`, `empresa_lab`, `tel_empresa`, `enfermedad`, `descripcion_enf`, `tel_1`, `tel_2`, `tel_3`, `celular`, `departamento`, `municipio`, `direccion1`, `direccion2`, `email1`, `email2`, `email3`, `informacion`, `fecha_mod`, `fecha_reg`, `nombre_acudiente`, `cedula_acudiente`, `telefono_acudiente`, `parentesco` , `parentesco2`, `porque`) ";

        $sql.= "VALUES ('".$estado_civ."', '".$tipo_s."', '".$ocupacion."', '".$dir_pariente."', '".$subcodigo."', '".$documento."', '".$numero."', '".$id_emp."', '".$regimen."', '".$nombre."', '".$apellido."', '".$nombre2."', '".$apellido2."', '".$edad."', '".$zona."', '".$sexo."', '".$fecha."', '".$estado."', '".$empresa_lab."', '".$tel_empresa."', '".$enfermedad."', '".$descripcion_enf."', '".$tel_casa."','".$tel_oficina."', '".$fax."', '".$celular."', '".$depart."', '".$municipio."', '".$direccionf."', '".$direccione."', '".$email1."', '".$email2."', '".$email3."', '".$informacion."', '".$fecha_modi."', '".$fecha_registro."', '".$nom_acu."', '".$ced_acu."', '".$tel_acu."', '".$parentesco."', '".$parentesco2."', '".$porque."')";

	mysql_query($sql);
                       
	$status = "ok";
        echo "<script language='javascript' type='text/javascript'>";
       echo "location.href='../vistas/contacto_potencial.php'";
       
     
        echo "</script>";
        
        
}}
?>
 