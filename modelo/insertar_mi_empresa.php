<?php
require("conexion.php");
$status = "";
$_GET['cod'] = 4;
if (isset($_GET['cod'])){
    $consulta= "select * from inf_empresa";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
$id_emp=  $fila['id_emp']; 
$nombre=$fila['nombre'];
$web_empe=$fila['web_emp'];
$siglas=$fila['siglas'];
$prop=$fila['gerente'];
$ni=$fila['nit_emp'];
$facti=$fila['factura_inicial'];
$factf=$fila['factura_final'];
$te1=$fila['telefono_1'];
$fax1=$fila['telefono_2'];
$cel_emp=$fila['telefono_3'];
$depa=$fila['dapartamento'];
$munici=$fila['municipio'];
$dire1=$fila['direccion'];
$emai1=$fila['email'];
$info=$fila['inf'];
if(isset($_GET['up'])){
$consulta= mysql_query("select * from rangos_facturas where id_rango=".$_GET['up']." ");
$res = mysql_fetch_array($consulta);
$resolucion = $res['resolucion'];
}
}

}

else{
if (isset($_POST["nombre_emp"])){
if ($_POST["nombre_emp"]=="") {
        echo '<script lanquage="javascript">alert("Por favor digite los campos obligatorios");location.href="../vistas/formulario_mi_empresa.php"</script>';
}else{
$nombre = $_POST["nombre_emp"];
	$web = $_POST["web"];
	$simbolo = $_POST["simbolo"];
        $propietario = $_POST["propietario"];
        $telefono_emp = $_POST["telefono_emp"];
        $fax_emp = $_POST["fax_emp"];
        $celular_emp = $_POST["celular_emp"];
        $nit = $_POST["nit"];
        $fact1 = $_POST["fact1"];
        $fact2 = $_POST["fact2"];
        $departamento_emp = $_POST["departamento_emp"];
        $municipio_emp = $_POST["municipio_emp"];
        $direccion_emp = $_POST["direccion_emp"];
        $email_emp1 = $_POST["email_emp1"];
        $inf_emp = $_POST["inf_emp"];
	

	$sql = "INSERT INTO `inf_empresa`(`nombre`, `web_emp`, `siglas`, `gerente`, `nit_emp`, `telefono_1`, `telefono_2`, `telefono_3`, `factura_inicial`, `factura_final`, `dapartamento`, `municipio`, `direccion`, `email`, `inf`)";

        $sql.= "VALUES ('".$nombre."', '".$web."', '".$simbolo."', '".$propietario."', '".$nit."', '".$telefono_emp."', '".$fax_emp."', '".$celular_emp."','".$fact1."','".$fact2."', '".$departamento_emp."', '".$municipio_emp."', '".$direccion_emp."', '".$email_emp1."', '".$inf_emp."')";

	mysql_query($sql);

	$status = "ok";
        $sql1 = "SELECT MAX(id_emp) as id FROM inf_empresa";
        $fila1 =mysql_fetch_array(mysql_query($sql1));
        $idll1 = $fila1["id"];
        echo "<script language='javascript' type='text/javascript'>";
        echo "location.href='../vistas/mi_empresa.php?codigo=".$idll1."'";
     
        echo "</script>";
        
}}}
?>
 