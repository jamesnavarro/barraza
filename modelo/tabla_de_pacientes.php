   <a href="../vistas/?id=pacientes&ok&up">Actualizar Estado</a> <?php
                                                    if($page>1){?>
                                                    <a href="../vistas/?id=pacientes&ok&page=1"><img src="../images/a1.png"></a>
                                                    <a href="../vistas/?id=pacientes&ok&page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a>
                                                    <?php
                                                    }else{
                                                    ?><img src="../images/ant.png"><?php
                                                    }
                                                    ?>
                                                    (Pagina <?php echo $page;?> de <?php echo $last_page;?>)
                                                    <?php
                                                    if($page<$last_page){?>
                                                    <a href="../vistas/?id=pacientes&ok&page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>
                                                    <a href="../vistas/?id=pacientes&ok&page=<?php echo $last_page;?>"><img src="../images/p11.png"></a>
                                                    <?php
                                                    }else{
	?><img src="../images/nex.png">  <?php
}
     $fecha = date('Y-m-d');
$nuevafecha = strtotime ( '-1 month' , strtotime ( $fecha ) ) ;
$newfecha = date ( 'Y-m-d' , $nuevafecha );
?>
        
<?php
$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
  if(isset($_GET['up'])){
       $requestx=mysql_query("SELECT * FROM actividad a, pacientes b where a.id_paciente=b.id_paciente group by b.id_paciente ");
$t = 0;
       while($r=  mysql_fetch_array($requestx))
	{
    $consulta3=  mysql_query("select EndTime from actividad WHERE  id_paciente=".$r['id_paciente']."  group by id_paciente, EndTime desc limit 1");
$ux=  mysql_fetch_array($consulta3);
    if($ux["EndTime"]<=$newfecha){
        $t += 1;
             $sql = "UPDATE `pacientes` SET `estado`='No Activo' WHERE `id_paciente` = ".$r['id_paciente'].";"; 
   $error =  mysql_query($sql, $conexion) or die(mysql_error());  
        }
}
   }
if(isset($_POST['empresa'])){
   
$request=mysql_query("SELECT * FROM actividad a, pacientes b where concat(b.nombres,' ',b.nombre2,' ',b.apellidos,' ',b.apellido2) like '%".$_POST['nombre']."%' and b.id_empresa like '".$_POST['empresa']."%' and a.id_paciente=b.id_paciente group by a.id_paciente");
 
}else{
$request=mysql_query("SELECT * FROM actividad a, pacientes b where b.estado='ACTIVO' and a.id_paciente=b.id_paciente group by a.id_paciente order by a.EndTime desc ".$limit);
  }
   

echo $newfecha;
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
              $table = $table.'<th class="hidden-phone">'.'Editar..'.'</th>';
             
            
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        echo $num_items;
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=  mysql_fetch_array($request))
	{       

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
                             <td class="hidden-phone">'.$u["EndTime"].'</font></td><td><a href="../vistas/?id=paciente&cod='.$row['id_paciente'].'">'.$up.'</a></td>
                               </tr>';   
      
        }
        
        
	$table = $table.'</table>';
        if(!isset($_GET['up'])){
	echo $table;
        }else{
            echo '<br>Total de pacientes actualizados '.$t.' ';
        }
        
     
}
?>