<?php
require("../../modelo/conexion.php");


//$_GET['name_startsWith']='ana';
//$_GET['type']= 'country';
if($_GET['type'] == 'country'){

	$matricula=$_GET['name_startsWith'];
$consulta = "SELECT numero_doc,concat (nombres,' ',nombre2,' ',apellidos,' ',apellido2) as nomc,id_empresa FROM pacientes WHERE estado like 'Activo'
	AND concat(nombres,' ',nombre2,' ',apellidos,' ',apellido2)  LIKE '$matricula%'";	
	//echo $consulta;
	$result = mysqli_query($conexion,$consulta);	

	$data = array();
	//echo mysqli_num_rows($result);
	while ($row  = mysqli_fetch_array($result)) {
		$f=$row[1]."-". $row[0];
		array_push($data,$f);
		//echo $f;	
	}	
	echo json_encode($data);
}

?>	

	

