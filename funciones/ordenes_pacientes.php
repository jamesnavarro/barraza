<?php 
$request=mysql_query("SELECT *, a.estado FROM actividad a, pacientes b where a.id_paciente=b.id_paciente and b.id_paciente='".$idp."' group by a.orden_servicio");
if($request){
echo $nombre_cli.' <input type="text" name="emp" readonly value="'.$id_cliente.'" style="width:40px">';
     ?>
         <form name="buscarA" action="../vistas/?id=ver_paciente&cod=<?php echo $_GET['cod'] ?>&fact=<?php echo $nombre_cli.'&emp='.$id_cliente; ?>" method="post" enctype="multipart/form-data">
        <?php
    $table = '<table class="table table-bordered table-striped table-hover" id="">';

              $table = $table.'<thead>';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th>'.'Orden Interna'.'</th>';
           $table = $table.'<th>'.'Orden Externa'.'</th>';
              $table = $table.'<th>'.'Atencion'.'</th>';
              $table = $table.'<th>'.'Cantidad'.'</th>';
               $table = $table.'<th>'.'Porcentaje'.'</th>';
              $table = $table.'<th>'.'Estado'.'</th>';
              $table = $table.'<th>'.'Fecha de Registro'.'</th>';
               $table = $table.'<th>'.'Usuario'.'</th>';
              if($_SESSION["area"] == 'OFICINA'){ 
              IF($nombre_cli=='PARTICULARES'){
                  $table = $table.'<th>'.'# Recibo.'.'</th>';
              $table = $table.'<th>'.'Fact. Recibo'.'</th>'; 
                 }ELSE{
              $table = $table.'<th>'.'# Fact.'.'</th>';
              $table = $table.'<th>'.'# Liq.'.'</th>';
              $table = $table.'<th>'.'Facturar'.'</th>';   
              }}
              $table = $table.'<th>Firma</th>';  
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
       $cont=0;
	while($row=mysql_fetch_array($request))
	{     
         
                $cont = $cont + 1 ;
              if($_SESSION["area"] == 'OFICINA'){
                   $ver='<a href="../vistas/?id=ver_orden_interna&ord='.$row["orden_servicio"].'">';
              }else{
                  if($row['user']==$_SESSION['k_username']){
                      $ver='<a href="../vistas/?id=ver_orden_interna&ord='.$row["orden_servicio"].'">';
                  }else{
                      $ver='';
                  }
              }
            if($row["id_contacto"]==''){$n = '0 %';   }else{$n = number_format($row["id_contacto"]).' %';}
            
            if($row["id_contacto"]>98){$et ='Completado';}else{$et ='En Proceso';}
           
          
            $ver2='<a href="../vistas/contacto_potencial.php?codigo='.$row["id_paciente"].'">';
           if($_SESSION["admin"] == 'Si'){$b='<td><a href="../vistas/reg_orden.php?codigo='.$row["archivo"].'"><img src="../imagenes/modificar.png" alt="ver" height="20px" width="20px"></a></td>';}else{$b='';}
           if($_SESSION["admin"] == 'Si'){$c='<td><a href="../modelo/eliminar.php?orden='.$row["orden_servicio"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a></td>';}else{$c='';}
             
           if($_SESSION["admin"] == 'Si'){$d='<a href="../controlador/historial_autorizacion.php?autorizar='.$row["orden_servicio"].'"><img src="../images/autorizacion.png" alt="ver" height="20px" width="20px"></a>';}else{$d='';}
          $g='<td><a href="abrirVentana1()"><img src="../images/icn_alert_warning.png" alt="ver" height="20px" width="20px"></a></td>';
            if($_SESSION["area"] == 'OFICINA'){
                 if($row["prioridad"]!='Facturado' && $row["Location"]=='Revisado'){
                if($crear_fac=='Habilitado'){
                $check = '<input type="checkbox" name="valor'.$cont.'" value="'.$row["orden_servicio"].'">';
                }else{
                    $check='';
                }
            }else{
                $check='';
                
            }
                if($row["relacionado"]==''){$fac='';}else{$fac='<a href="../vistas/?id=facturacion_finalizada&fact='.$row["relacionado"].'&t='.$row["tipo_factura"].'">'.$row["relacionado"].' </a>';}
            }else{
                $fac='';
            }
            if($row["estado"]!='Anulada'){
                $check=$check;
            }else{
                $check='<b><font color="red">Anulada</font><b>';
            }
            $sw= mysql_query("select * from liquidaciones where orden='".$row["orden_servicio"]."' ");
            $l = mysql_fetch_array($sw);
            $liq = $l['id_liq'];
           $table = $table.'<tr><td>'.$ver.''.$row["orden_servicio"].'<font></a></td>'
                    . '<td>'.$ver.''.$row["orden_externa"].'<font></a></td>
               <td>'.$ver.''.$row["Description"].'</font></td><td>'.$row["cant"].'</font></td><td>'.$n.'<font></a></td>'
                    . '<td>'.$et.'<font></a></td>'
                    . '<td>'.$row["fecha_reg_ta"].'</font></td><td>'.$row["user"].'</font></td><td>'.$fac.'<font></a></td><td>'.$liq.'<font></a></td>'
                    . '<td>'.$check.'</td><td><a href="../vistas/firmas_digitadas.php?oi='.$row["orden_servicio"].'" target="_blank"><img src="../imagenes/tarea.png"></a></td></tr>';   
               
           
               
	}
        
	$table = $table.'</table>';
       
	echo $table;
        if($crear_fac=='Habilitado'){
        ?>
            <table>
                <tr>
                    <td><label><i>Total de Ordenes: </i></label> <input type="text" name="cant"  style="width:20px;height:20px;"  value="<?php echo $cont; ?>">
                        Tipo: 
                        <select name="tipo" required>
                           
                            <option value="FAC">Factura</option>
                            <option value="REC">Recibo</option>
                        </select>
                        <input type="submit" name="buscar" value="Facturar" class="alt_btn"></td>
                </tr>
                
            </table>  

            </form>
        <?php }
                                                              if(isset($_GET['eliminar']))
    {
        $Codigo=$_GET['eliminar'];
        $sql = "DELETE FROM ordenes WHERE id='$Codigo'";
        mysql_query($sql, $conexion);
       echo '<script lanquage="javascript">alert("Registro Eliminado");location.href="../vistas/reg_orden.php"</script>'; 
    }   
}?>
      
             