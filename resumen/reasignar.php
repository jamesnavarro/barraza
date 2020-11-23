<?php
session_start();
include "../modelo/conexion.php";

date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
?>
<!DOCTYPE html>
<html>
    <head>
         <link rel="stylesheet" href="../css/css_tablas.css" type="text/css" media="screen" />
        <script> 
var ventana_secundaria 

function abrirVentana(){  
ventana_secundaria = window.open("../vistas/contacto.php","miventana","width=500,height=410,menubar=no") 
} 

function cerrarVentana(){ 
ventana_secundaria.close() 
} 

  function cerrar() 
	
	 window.close();
   
</script>
        <title>Adicionar Orden externa</title>
    </head>
    <body>
       
				<div class="module_content"> 
                               
                                Reasignar orden a otro usuario
            <hr>   
                                              <fieldset style="width:100%; float:center; margin-right: 3%;">
            <?php 
            if(isset($_GET['editar'])){
            function formRegistro(){ 
                $sql1 = "SELECT *, count(orden_servicio) as t FROM actividad where estado='No iniciada' and orden_servicio='".$_GET["editar"]."' group by orden_servicio";
        $fila1 =mysql_fetch_array(mysql_query($sql1));
        $user = $fila1["user"];
        $oe = $fila1["orden_externa"];
        $t = $fila1["t"];
        $ff = $fila1["EndTime"];
        $atencion = $fila1["Description"];
        
        $sql2 = "SELECT max(orden_servicio) as max FROM actividad";
        $fila2 =mysql_fetch_array(mysql_query($sql2));
        $or = $fila2["max"]+1;
          if($t==''){
                            echo 'No se puede reagsinar esta orden';}else{
                                
                                  ?>
         <form name="insertar" action="../vistas/reasignar.php?cod=<?php echo $_GET['editar'] ?>" method="post" enctype="multipart/form-data">
                <table>
							<tr>
                                                           <td><label>Orden Interna : </label></td>
                                                           <td><input type='text' name='ordeni' readonly style="width:30px;height:20px;" value='<?php echo $_GET['editar'] ?>'>
                                                               <label>es Reasignada a la orden:</label><input type='text' name='orden_new' readonly style="width:30px;height:20px;" value='<?php echo $or ?>'>
                                                           </td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Orden Externa: </label></td>
                                                            <td><input type='text' name='ordene' readonly style="width:70px;height:20px;" value='<?php echo $oe ?>'></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Usuario : </label></td>
                                                            <td><select name="usuario" style="width:150px;height:20px;">
                                                                   <option value='<?php echo $user ?>'><?php echo $user ?></option>
                                                                   <?php
                                                                   include "../modelo/conexion.php";
                                                           $consulta= "SELECT * FROM `usuarios`";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1=$fila['usuario'];
                                                            $valor2=$fila['nombre'].' '.$fila['apellido'];
                                                         

                                                            echo"<option value='".$valor1."'>".$valor2."</option>";
                                                            
                                                            }
                                                            ?>
                                                               </select></td></tr>
                                                        <tr>
                                                            <td><label>atenciones restantes: </label></td>
                                                            <td><input type='text' name='cantidad' value='<?php echo $t ?>'  style="width:70px;height:20px;"></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Fecha Final: </label></td>
                                                            <td><input type='text' name='fecha' class='tcal' value='<?php echo $ff ?>'  style="width:70px;height:20px;"></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Atencion: </label></td>
                                                            <td><input type='text' name='atencion' value='<?php echo $atencion ?>'  style="width:300px;height:20px;"></td>
                                                        </tr>
                                                          
                                                          
                                                     </table>
		   
                                   
                                    
                                     <br>
                        <input type="submit" name="enviar" value="Guardar" class="alt_btn"  onclick="">
					<input type="button" value="Cerrar" onclick="javascript:window.opener.document.location.reload();self.close();"></form>
				 </fieldset></div>
                    
                            <?php }}}else{ ?>
                 <fieldset>
            <article class="module width_full">
                <header  onload="recargar()"><h3>Paciente : <?php if(isset($_GET['pac'])){echo $_GET['pac'];} ?></h3></header>
                        <hr>
                        
                      
                      
                       <?php 

if(isset($_GET['orden'])) {  
    if($_SESSION["admin"] == 'Si'){
$request=mysql_query('select * from actividad where estado="Completada" and archivo="'.$_GET['orden'].'" group by orden_servicio');
    }else{
     $request=mysql_query('select * from actividad where user="'.$_SESSION['k_username'].'" and estado="No iniciada" and archivo='.$_GET['orden']);   
    }
if($request){
//    echo'<hr>';
    $table = '<table class="lista1">';


           $table = $table.'<tr>';
              $table = $table.'<td>'.'Orden Int'.'</td>';
              $table = $table.'<td>'.'Orden Ext'.'</td>';
              $table = $table.'<td>'.'Usuario'.'</td>';
              
              $table = $table.'<td>'.'Descripcion'.'</td>';
              $table = $table.'<td>'.'Editar'.'</td>';
               $table = $table.'</tr>';

	
        
	//Por cada resultado pintamos una linea
       
	while($row=mysql_fetch_array($request))
	{       
                if($row['estado']=="Completada" || $row['estado']=="Aplazada"){
                    $ca = $row['cant'] - $row["id_seleccionado"];
                    $b='<a href="../vistas/reasignar.php?editar='.$row["orden_servicio"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a>';
		$table = $table.'<tr><td>'.$row["orden_servicio"].'</td><td>'.$row["orden_externa"].'</td><td>'.$row["user"].'</td><td>'.$row['Description'].'</td><td>'.$b.'</td>';
                
                }
               
	}
       
	$table = $table.'</table>';
        
	echo $table;
        
}}


                       ?>
		</article>
		    </fieldset>
                
           <?php }
        if (isset($_POST["ordeni"])) {
	
        
        $es ='activa';
        $mo ='esta orden se encuentra';
        $orden = $_POST["orden_new"];
        $usuario = $_POST["usuario"];
        $fecha = $_POST["fecha"];
        $cantidad = $_POST["cantidad"];
        $n = $_POST["cantidad"];
        $por = 100 / $n;
        $pos='0';
        
        $total_por='0';
         $sql = "UPDATE actividad SET EndTime= '".$fecha."', orden_servicio='$orden', user='$usuario', est_motivo='$es', desc_motivo='$mo', cant='$cantidad', positivo='$pos', porcentaje='$por', id_contacto='$total_por', id_seleccionado='$pos' WHERE orden_servicio =".$_GET['cod']." and estado='No iniciada'";
         mysql_query($sql);
 $sqla = "SELECT count(*), min(Id)  FROM actividad where orden_servicio='".$orden."'";
        $filaa =mysql_fetch_array(mysql_query($sqla));
        $cantu = $filaa["count(*)"];
        $minid = $filaa["min(Id)"];
        
        $r = 0;
        for($x=1; $x<=$cantu; $x=$x+1){
               
                $t = $minid + $r;
                $r = $r + 1 ;
                
                $sqlu = "UPDATE `actividad` SET `cant_ins`='".$x."' WHERE  `orden_servicio`='".$orden."' and Id='".$t."'";
                mysql_query($sqlu);
            }
            
            $sql2 = "SELECT count(orden_servicio) as t FROM actividad where estado='Completada' and orden_servicio='".$_POST["ordeni"]."' group by orden_servicio";
        $fil =mysql_fetch_array(mysql_query($sql2));
        $mx = $fil["t"];
        
         $sql3 = "UPDATE `actividad` SET `cant`='".$mx."' WHERE  `orden_servicio`='".$_POST["ordeni"]."'";
         mysql_query($sql3);
        
                                
echo "<script language='javascript' type='text/javascript'>";
echo "window.opener.document.location.reload();self.close();";
echo "</script>";
				?>
				
				<?php
			
		
	
}else{
    if(isset($_GET['orden'])){
        
    }else{
        formRegistro();
    }
	
}
        ?>
    </body>
</html>