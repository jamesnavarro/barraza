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
    $consulta= "select a.*, b.*, c.* from precios_insumos a, insumos b, sis_empresa c  WHERE a.id_empresa=c.id_empresa and b.id=a.id_insumo and a.id_precio=".$_GET["up"]."";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
    $idprecio=$fila['id_precio'];
$idate=$fila['id_insumo'];
$idemp=$fila['id_empresa'];
$ne=$fila['nombre_emp'];
$na=$fila['nombre_insumo'];
$pr=$fila['precio'];
}
}

?>
    <article class="module width_full">
			<header><h3>Insumos</h3></header>
                        <font color="red">Aviso: (*)Indica un campo requerido</font>
           
            <form name="insertar" action="<?php if (isset($_GET['up'])){echo "../modelo/insertar_precio_insumo.php?editar=".$_GET['up']."&cod=".$_GET['cod']." ";}else{echo '../modelo/insertar_precio_insumo.php?cod='.$_GET['cod'].' ';} ?>" method="post" enctype="multipart/form-data" >
                <table>
							<tr>
                                                            <td><label>nombre de la atención : *</label></td>
                                                            <td> <select name="atencion">
                                                             <?php if(isset($idate)){ echo '<option value="'.$idate.'">'.$na.'</option>';} ?>
                                                          <option value="">Seleccione uno..</option>
                                                          <?php
                                                            include "modelo/conexion.php";
                                                            $consulta= "select * from insumos";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1=$fila['id'];
                                                            $valor2=$fila['nombre_insumo'];
                                                         

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
                                                                <button> <a href="../vistas/checkeds_insumos.php?cod=<?php echo $_GET['cod']; ?>" title="Seleccionar Multiples Insumos" target="_blank" onClick="window.open(this.href, this.target, 'width=800,height=800'); return false;"><img src="../images/icn_categories.png"> Multiples</a></button></td></tr>
                                                          
                                                     </table></form>
	
                    
		</article>
                
                
                <article class="module width_full">
			<header><h3>Empresa: <?php if (isset($_GET['cod'])){echo $nombre;} ?> </h3></header>
                        <hr>
                        
<?php 
$request=mysql_query("SELECT a.*, b.nombre_insumo FROM precios_insumos a, insumos b WHERE a.id_empresa='".$_GET['cod']."' and b.id=a.id_insumo");
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th>'.'Numero'.'</th>';
              $table = $table.'<th>'.'Empresa'.'</th>';
              $table = $table.'<th>'.'Precio'.'</th>';
              $table = $table.'<th>'.'Fecha Modificacion'.'</th>';
              $table = $table.'<th>'.'Editar'.'</th>';
              $table = $table.'<th>'.'Eliminar'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
       
	while($row=mysql_fetch_array($request))
	{       
                
          
           if($editar_prod=='Habilitado'){$b='<a href="../vistas/?id=precios_insumos&cod='.$_GET['cod'].'&up='.$row["id_precio"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>';}else{$b='';}
           if($eliminar_prod=='Habilitado'){$c='<a href="../vistas/?id=precios_insumos&cod='.$_GET['cod'].'&eliminar='.$row["id_precio"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>';}else{$c='';}
           

          
          
           
            $table = $table.'<tr><td>'.$row["id_precio"].'<font></a></td></td>
               <td>'.$row["nombre_insumo"].'</font></td><td>$'.$row["precio"].'</font></td>
                   <td>'.$row["fecha_registro_pr"].'</font></td>
                       <td>'.$b.'</td>
                           <td>'.$c.'</td></tr>';   
               
           
               
	}
        
	$table = $table.'</table>';
        
	echo $table;
                                                              if(isset($_GET['eliminar']))
    {
        $Codigo=$_GET['eliminar'];
        $sql = "DELETE FROM precios_insumos WHERE id_precio='$Codigo'";
        mysql_query($sql, $conexion);
       echo '<script lanquage="javascript">alert("Registro Eliminado");location.href="../vistas/?id=precios_insumos&cod='.$_GET['cod'].'"</script>'; 
    }   
}
?>
                      
		</article> 

