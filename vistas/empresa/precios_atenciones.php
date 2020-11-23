<?php 
include "../modelo/conexion.php";
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
if (isset($_GET['cod'])){
    $consulta= "select * from sis_empresa WHERE  id_empresa=".$_GET["cod"]."";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){


$nombre=$fila['nombre_emp'];



}

}
if (isset($_GET['up'])){
    $consulta= "select a.*, b.*, c.* from precios_atenciones a, atenciones b, sis_empresa c  WHERE a.id_empresa=c.id_empresa and a.id_atencion=b.id_atencion and a.id_precio=".$_GET["up"]."";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
    $idprecio=$fila['id_precio'];
$idate=$fila['id_atencion'];
$idemp=$fila['id_empresa'];
$ne=$fila['nombre_emp'];
$na=$fila['nombre_atencion'];
$pr=$fila['precio'];
}

}

?>
    <article class="module width_full">
			<header><h3>Atenciones</h3></header>
                        <font color="red">Aviso: (*)Indica un campo requerido</font>
           
            <form name="insertar" action="<?php if (isset($_GET['up'])){echo "../modelo/insertar_precio_atencion.php?editar=".$_GET['up']."&cod=".$_GET['cod']." ";}else{echo '../modelo/insertar_precio_atencion.php?cod='.$_GET['cod'].' ';} ?>" method="post" enctype="multipart/form-data">
                <table>
							<tr>
                                                            <td><label>nombre de la atención : *</label></td>
                                                            <td> <select name="atencion">
                                                             <?php if(isset($idate)){ echo '<option value="'.$idate.'">'.$na.'</option>';} ?>
                                                          <option value="">Seleccione uno..</option>
                                                          <?php
                                                            include "modelo/conexion.php";
                                                            $consulta= "select * from atenciones";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1=$fila['id_atencion'];
                                                            $valor2=$fila['nombre_atencion'];
                                                         

                                                            echo"<option value='".$valor1."'>".$valor2."</option>";
                                                            
                                                            }
                                                            ?>
                                                            
                                                            
                                                        </select></td></tr>
                                                       
                                                        <tr>
                                                           <td><label>precio: <font color="red"> *</font> $</label></td>
                                                           <td><input type="text" name="precio" style="width:130px;" value="<?php if (isset($_GET['up'])){echo $pr;} ?>"/></td>
                                                        </tr>
                                                          
                                                         
                                                          <tr><td><input type="submit" name="enviar" value="Guardar" class="alt_btn" onclick="">
					                          <input type="reset" value="Limpiar">
                                                                  <button type="button"> <a href="../vistas/checkeds_atenciones.php?cod=<?php echo $_GET['cod']; ?>" title="Seleccionar Multiples Insumos" target="_blank" onClick="window.open(this.href, this.target, 'width=800,height=800'); return false;"><img src="../images/icn_categories.png"> Multiples</a></button></td></tr>
                                                          
                                                          
                                                     </table></form>
	
                    
		</article>
                
                
                <article class="module width_full">
			<header><h3>Empresa: <?php if (isset($_GET['cod'])){echo $nombre;} ?> </h3></header>
                        <hr>
                        <form action="" method="post">                     
<?php 
$request=mysql_query("SELECT a.*, b.nombre_atencion FROM precios_atenciones a, atenciones b WHERE a.id_empresa='".$_GET['cod']."' and a.id_atencion=b.id_atencion");
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th>'.'Numero'.'</th>';
              $table = $table.'<th>'.'Empresa'.'</th>';
              $table = $table.'<th>'.'Pagos'.'</th>';
              $table = $table.'<th>'.'Precio'.'</th>';
              $table = $table.'<th>'.'Fecha Modificacion'.'</th>';
              $table = $table.'<th>'.'Editar'.'</th>';
              $table = $table.'<th>'.'Eliminar'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
        $co = 0;
	while($row=mysql_fetch_array($request))
	{       $co +=1;

           if($editar_prod=='Habilitado'){$b='<a href="../vistas/?id=precios_atenciones&cod='.$_GET['cod'].'&up='.$row["id_precio"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>';}else{$b='';}
           if($eliminar_prod=='Habilitado'){$c='<a href="../vistas/?id=precios_atenciones&cod='.$_GET['cod'].'&eliminar='.$row["id_precio"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>';}else{$c='';}

            $table = $table.'<tr><td>'.$row["id_precio"].'<input type="hidden" name="id'.$co.'" value="'.$row["id_precio"].'" class="span6"></td></td>
               <td>'.$row["nombre_atencion"].'</font></td><td><input type="text" name="pago'.$co.'" value="'.$row["pagos"].'" class="span6"></td><td>$'.$row["precio"].'</font></td>
                   <td>'.$row["fecha_registro_pr"].'</font></td>
                       <td>'.$b.'</td>
                           <td>'.$c.'</td></tr>';     
	}
        
	$table = $table.'</table>';
        
	echo $table;
        ?>
                            <input type="hidden" name="cant" value="<?php echo $co ?>"> <input type="submit" value="Actualizar" name="update">
        </form>
        
 <?php
    if(isset($_GET['eliminar']))
    {
        $Codigo=$_GET['eliminar'];
        $sql = "DELETE FROM precios_atenciones WHERE id_precio='$Codigo'";
        mysql_query($sql, $conexion);
       echo '<script lanquage="javascript">alert("Registro Eliminado");location.href="../vistas/?id=precios_atenciones&cod='.$_GET['cod'].'"</script>'; 
    }   
    
        if(isset($_POST['update']))
    {
        $C=$_POST['cant'];
        for($i=1;$i<=$C;$i++){
                
                mysql_query("update precios_atenciones set pagos='".$_POST['pago'.$i]."' where id_precio='".$_POST['id'.$i]."'  ");
         }
       echo '<script lanquage="javascript">alert("Registros actualizado");location.href="../vistas/?id=precios_atenciones&cod='.$_GET['cod'].'"</script>'; 
    } 
}
?>
                      
		</article> 

