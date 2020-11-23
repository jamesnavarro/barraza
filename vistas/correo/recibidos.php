 <div class="row-fluid">
                        <!-- START Tabs -->
                        <div class="span6 widget dark stacked">
                            <header><h4 class="title">Lista de correos recibidos</h4></header>
                            <section class="body">
                                <div class="body-inner">
                                  
                                       <?php
$request=mysql_query("SELECT * FROM correos a, correos_para b, usuarios c where c.id=a.id_de and a.id_correo=b.id_correo and b.id_user=".$_SESSION['id_user']." and b.visto!=2 order by a.id_correo desc ");
 
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="tabla">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th width="5%">'.'Item'.'</th>';             
              $table = $table.'<th width="60%">'.'Asunto'.'</th>';
              
              $table = $table.'<th class="hidden-phone">'.'Enviado por'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Eliminar'.'</th>';     
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysql_fetch_array($request))
	{       
          
        if($row['visto']=='0'){
            $img =  '<a href="../vistas/?id=recibidos&cod='.$row['id_correo'].'"><img src="../imagenes/close.png"></a>';
        }else{
            $img = '<a href="../vistas/?id=recibidos&cod='.$row['id_correo'].'"><img src="../imagenes/open.png"></a>';   
        }
            $table = $table.'<tr><td width="5%">'.$img.'</td>
                <td width="60%">'.$row['asunto'].'<br>'.$row["fecha_registro"].'</td>
               
               <td class="hidden-phone">'.$row["nombre"].' '.$row["apellido"].'</font></td>
               <td class="hidden-phone"><a href="../vistas/?id=recibidos&del='.$row["id_para"].'"><img src="../imagenes/eliminar.png"></a></td></tr>';   
      
	}
        
        
	$table = $table.'</table>';
        
	echo $table;

        
     
}
?> 
                                </div>
                            </section>
                        </div>
                        <!--/ END Tabs -->

                        <!-- START Tabs Widget -->
                        <div class="span6 widget dark stacked">
                            <header><h4 class="title">Detalles del correo</h4></header>
                            <section class="body">
                                <div class="body-inner">
                                    
                                <?php
                                if(isset($_GET['cod'])){
                                
         
                                $consulta = mysql_query("select * from correos a, usuarios b, correos_para c where a.id_correo=c.id_correo and a.id_de=b.id and a.id_correo=".$_GET['cod']." and c.id_user=".$_SESSION['id_user']." ");
                                $d = mysql_fetch_array($consulta);
                                echo '<b>Asunto: </b> '.$d['asunto'].' ';
                                echo '<br><hr><b>De: </b> '.$d['nombre'].' '.$d['apellido'].'';
                                echo '<br><hr><b>Enviado: </b> '.$d['fecha_registro'].'';
                                ?> <a href="../vistas/responder.php?cod=<?php echo $d['id_de'].'&asunto='.$d['asunto'].'&msg='.$d['mensaje']; ?>" title="De click aqui para responder" target="_blank" onClick="window.open(this.href, this.target, 'width=400,height=500'); return false;"> Responder</a><?php
                                echo '<br><hr> '.$d['mensaje'].'';
                                    $sql2 = "UPDATE `correos_para` SET `visto`='1' WHERE `id_para`=".$d['id_para']." ;";            
                                    mysql_query($sql2, $conexion);
                                }else{
                                    echo '<h4>CORREOS</h4>';
                                  
                                    echo '<center><img src="../imagenes/logo.png"></center>';
                                      echo '<center><img src="../imagenes/emailt.jpg"></center>';
                                }
                            
                                ?>
                                </div>
                            </section>
                        </div>
                        <!--/ END Tabs Widget -->
 </div>
<?php
 if(isset($_GET['del'])){
     if($eliminar_lla!='Habilitado'){
     echo '<script lanquage="javascript">alert("Usted no tiene permiso para eliminar");location.href="../vistas/?id=recibidos"</script>'; 
}else{
  $sql2 = "UPDATE `correos_para` SET `visto` = '2'  WHERE `id_para`=".$_GET['del']." ;";            
         mysql_query($sql2, $conexion);
 echo '<script lanquage="javascript">alert("El correo a pasado a la papelera de reciclaje");location.href="../vistas/?id=recibidos"</script>'; 
}
      }
?>

