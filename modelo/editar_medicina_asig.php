<?php 
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I')); 
//print "&nbsp;$hora&nbsp;"; 
?>
<?php
session_start();
include "../modelo/conexion.php";
$status = "";
if(isset($_GET['editar'])){
        $consulta= "select * from medicamentos_asig WHERE id=".$_POST["insumo2"]."";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
$a=$fila['cantidad'];
$b=$fila['cantidad_rest'];
$c=$fila['cantidad_usada'];
    }
    
        $id = $_POST["insumo2"];
        $can = $_POST["cantidad"];
        $num = $_POST["numero"];
        
        if($_POST["numero"] > $a || $_POST["numero"] <= 0){
             echo '<script lanquage="javascript">alert("la cantidad a usar es mayor a la cantidad restante");location.href="../vistas/?id=llenar_atencion&codigo='.$_GET['codigo'].'&orden_servicio='.$_GET['orden_servicio'].'"</script>';
        }else{
            if($c <= $num){
                $t = $c - $num;
                $crt = $b + $t;
            }else{
                $t = $num - $c;
                $crt = $b - $t;
            }
            
         
        
        
        
         $sql3 = "UPDATE `cant_medicina` SET `cantidad_med`='".$num."' WHERE `id_medicina`='".$_POST["insumo2"]."' and id_visita='".$_GET['codigo']."';";
        mysql_query($sql3);
        
           $sql1 = "SELECT sum(cantidad_med) FROM cant_medicina where id_medicina='".$_POST["insumo2"]."'";
        $fila1 =mysql_fetch_array(mysql_query($sql1));
        $cm = $fila1["sum(cantidad_med)"];
        $r = $a - $cm;
        
        $sql2 = "UPDATE `medicamentos_asig` SET `cantidad_usada`='".$cm."', `cantidad_rest`='".$r."' WHERE `id`='".$_POST["insumo2"]."';";
        mysql_query($sql2);
        
         echo "<script language='javascript' type='text/javascript'>";
        echo "location.href='../vistas/?id=llenar_atencion&codigo=".$_GET['codigo']."&orden_servicio=".$_GET['orden_servicio']."'";
        echo "</script>";
        
}
}else{
    

if($_POST["numero"] =='' || $_POST["cantidad"] ==''|| $_POST["cantidad"] ==0){
            echo '<script lanquage="javascript">alert("la cantidad a usar es mayor a la cantidad restante o el numero es menor que cero (0)");location.href="../vistas/?id=llenar_atencion&codigo='.$_GET['codigo'].'&orden_servicio='.$_GET['orden_servicio'].'"</script>';
        }else{
if (isset($_POST["insumo2"])) {
    
     $sql= "select count(*) from cant_medicina where id_visita=".$_GET['codigo']." and id_medicina=".$_POST["insumo2"]." ";
$respuesta=  mysql_query($sql);
while($fila=  mysql_fetch_array($respuesta)){
$cx=$fila['count(*)'];  

 }
 if($cx!=0){
          echo '<script lanquage="javascript">alert("Ya ha sido asignada un medicamento de esta especificacion, por favor edite la cantidad de medicamento");location.href="../vistas/?id=llenar_atencion&codigo='.$_GET['codigo'].'&orden_servicio='.$_GET['orden_servicio'].'"</script>';
       
 }else{
     

    
    $consulta= "select * from medicamentos_asig WHERE id=".$_POST["insumo2"]."";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
$a=$fila['cantidad'];
$b=$fila['cantidad_rest'];
$c=$fila['cantidad_usada'];
    }
	$id = $_POST["insumo2"];
        $can = $_POST["cantidad"];
        $num = $c + $_POST["numero"];
        $to = $_POST["cantidad"] - $_POST["numero"];
        
        if($_POST["numero"] > $_POST["cantidad"] || $_POST["numero"] <= 0){
             echo '<script lanquage="javascript">alert("la cantidad a usar es mayor a la cantidad restante");location.href="../vistas/?id=llenar_atencion&codigo='.$_GET['codigo'].'&orden_servicio='.$_GET['orden_servicio'].'"</script>';
        }else{

        $sql2 = "UPDATE `medicamentos_asig` SET `cantidad_usada`='".$num."', `cantidad_rest`='".$to."' WHERE `id`='".$id."';";
//        $sql3 = "UPDATE `actividad` SET `cantidad_usada`='".$num."', `cantidad_rest`='".$to."' WHERE `id`='".$id."';";

       mysql_query($sql2);

       
       $sql = "INSERT INTO `cant_medicina`(`id_visita`, `cantidad_med`, `id_medicina`)";

       $sql.= "VALUES ('".$_GET['codigo']."', '".$_POST["numero"]."', '".$id."')";

	mysql_query($sql, $conexion);
  
       $status = "ok";
       
        echo "<script language='javascript' type='text/javascript'>";
      
        echo "location.href='../vistas/?id=llenar_atencion&codigo=".$_GET['codigo']."&orden_servicio=".$_GET['orden_servicio']."'";
      
        echo "</script>";
        
}
}
        }}}
    ?>