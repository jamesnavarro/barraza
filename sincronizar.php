<?PHP
include "modelo/conexion.php";
$result=mysql_query("select * from facturas a, pacientes b where a.id_paciente=b.id_paciente");
while($row = mysql_fetch_array($result)){
    echo $error = mysql_query("UPDATE facturas SET id_empresa='".$row["id_empresa"]."' where id_paciente='".$row["id_paciente"]."' ") or die(mysql_error());
} 
?>
