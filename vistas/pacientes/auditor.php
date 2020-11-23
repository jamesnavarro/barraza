<div class="row-fluid">
    <section class="body">
        <div class="body-inner">
            <div class="span12 widget dark stacked">
                <header>
                    <h4 class="title">Auditoria de  Pacientes</h4>
                        <ul class="toolbar pull-left">
                            <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>
                        </ul>
                </header>
                <section id="collapse1" class="body collapse in">
                    <div class="body-inner">
                        <form class="" action="" method="post" id="" enctype="multipart/form-data">
                            <div class="control-group">
                                <label class="control-label">Buscar</label>
                                <div class="controls">
                                    <div class="row-fluid">
                                       <div class="span4">
                                           <input type="text" class="span2" name="ano" value="<?php if(isset($_POST['Buscar'])){echo $_POST['ano']; }else{ echo date("Y");} ?>" required>
                                            <select  name="mes"  class="span3">
                                                <?php if(isset($_POST['Buscar'])){echo '<option value="'.$_POST['mes'].'">'.$_POST['mes'].'</option>'; } ?>
                                                <option value='<?php echo date("m") ?>'><?php echo date("m") ?></option>
                                                <option value='01'>01</option>
                                                <option value='02'>02</option>
                                                <option value='03'>03</option>
                                                <option value='04'>04</option>
                                                <option value='05'>05</option>
                                                <option value='06'>06</option>
                                                <option value='07'>07</option>
                                                <option value='08'>08</option>
                                                <option value='09'>09</option>
                                                <option value='10'>10</option>
                                                <option value='11'>11</option>
                                                <option value='12'>12</option>
                                            </select> 
                                           <select  name="estado"  class="span6">
                                                <?php if(isset($_POST['Buscar'])){echo '<option value="'.$_POST['estado'].'">'.$_POST['estado'].'</option>'; } ?>
                                               
                                               <option value="">Todos</option>
                                               <option value="Activo">Activo</option>
                                               <option value="No Activo">No Activo</option>
                                           </select>
                                           <input type="submit" class="btn" name="Buscar" value="Buscar">
                                            <?php
                                                if (isset($_POST['Buscar'])){ ?>
                                                <button type="button" class="btn"><a href="../vistas/auditoria_excel.php?ano=<?php echo $_POST['ano'].'&mes='.$_POST['mes'] ?>">Exportar</a></button>
                                            <?php } ?>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </form><br>
                        
                        <div class="tabbable" style="margin-bottom: 25px;">
                            <div class="tab-content">
                                <div class="" id="tab1">
                                    <div class="row-fluid">
                                        <div class="span12 widget lime">
                                            <section class="body">
                                                <div class="body-inner no-padding">
                                                     <?php
                                                    
     $fecha = date('Y-m-d');
$nuevafecha = strtotime ( '-1 month' , strtotime ( $fecha ) ) ;
$newfecha = date ( 'Y-m-d' , $nuevafecha );
?>
        
<?php

if(isset($_POST['Buscar'])){
$fer = $_POST['ano'].'-'.$_POST['mes'];
$est = $_POST['estado'];
$request=mysql_query("SELECT * FROM actividad a, pacientes b where b.fecha_reg like '".$fer."%' and b.estado like '".$est."%' and a.id_paciente=b.id_paciente group by a.id_paciente order by a.EndTime desc ");

if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th width="20%">'.'Nombre de Paciente'.'</th>'; 
              $table = $table.'<th width="8%">'.'Cedula'.'</th>';
              $table = $table.'<th width="30%">'.'Empresa'.'</th>';
              $table = $table.'<th width="8%">'.'Telefeno'.'</th>';
              $table = $table.'<th width="8%">'.'Celular'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Acudiente'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Alta temprana'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Ultima Atencion..'.'</th>';
              $table = $table.'<th class="hidden-phone">Fecha de Ingreso</th>';
             
            
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=  mysql_fetch_array($request))
	{     $total2 +=1;  

$consulta2= "select * from sis_empresa WHERE  rips='".$row['id_empresa']."'";
$result2=  mysql_query($consulta2);
$fila=  mysql_fetch_array($result2);
$idempresa=$fila['id_empresa'];
$empresa=$fila['nombre_emp'];
$consulta3=  mysql_query("select EndTime from actividad WHERE  id_paciente=".$row['id_paciente']."  group by id_paciente, EndTime desc limit 1");
$u=  mysql_fetch_array($consulta3);
$cont=0;
          if($editar_pac=='Habilitado'){$up = '<img src="../imagenes/modificar.png">';}else{$up = '';}
           if($eliminar_pac=='Habilitado'){$del= '<img src="../imagenes/eliminar.png">';}else{$del = '';}
          
            $table = $table.'<tr>
                <td width="20%"><a href="../vistas/?id=ver_paciente&cod='.$row['id_paciente'].'">  '.$row['nombres'].' '.$row['nombre2'].' '.$row['apellidos'].' '.$row['apellido2'].'</a></td> 
                <td width="8%">'.$row['numero_doc'].'<font></a></td>
                    <td width="30%"><a href="../vistas/?id=ver_empresa&cod='.$idempresa.'">'.$empresa.'</a></td>
               <td class="hidden-phone">'.$row["tel_1"].'</font></td><td class="hidden-phone">'.$row["celular"].'</font></td><td class="hidden-phone">'.$row["nombre_acudiente"].'</font></td><td class="hidden-phone">'.$row["estado"].'</font></td>
                             <td class="hidden-phone">'.$u["EndTime"].'</font></td><td>'.$row["fecha_reg"].'</td>
                               </tr>';   
      
        }
        
        
	$table = $table.'</table>';
      echo  '<br>Total de pacientes Registrado '.$total2.' ';
	echo $table;
       
      
        
     
}
}else{
    ?> 
                                                    <p><h4>Reporte de pacientes ingresados por mes.<br><hr>!Seleccione el año y el mes para imprimir el reporte¡</h4></p>                                              
                                                    <?php
}

?>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</div>
