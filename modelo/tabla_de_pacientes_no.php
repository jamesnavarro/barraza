           <?php
                                                    if($page>1){?>
                                                    <a href="../vistas/?id=pacientes&no&page=1"><img src="../images/a1.png"></a>
                                                    <a href="../vistas/?id=pacientes&no&page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a>
                                                    <?php
                                                    }else{
                                                    ?><img src="../images/ant.png"><?php
                                                    }
                                                    ?>
                                                    (Pagina <?php echo $page;?> de <?php echo $last_page;?>)
                                                    <?php
                                                    if($page<$last_page){?>
                                                    <a href="../vistas/?id=pacientes&no&page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>
                                                    <a href="../vistas/?id=pacientes&no&page=<?php echo $last_page;?>"><img src="../images/p11.png"></a>
                                                    <?php
                                                    }else{
	?><img src="../images/nex.png">  <?php
}

?>
        
<?php
  if(isset($_GET['up'])){
       $requestx=mysql_query("SELECT * FROM pacientes a where a.alta='Vinculado' and (select count(*) from actividad b where b.id_paciente=a.id_paciente)=0 ");
$t = 0;
       while($r=  mysql_fetch_array($requestx))
	{

  $sql = "UPDATE `pacientes` SET `estado`='No Activo' WHERE `id_paciente` = ".$r['id_paciente'].";"; 
   $error =  mysql_query($sql, $conexion) or die(mysql_error());  
        
}
   }
$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;

if(isset($_POST['empresa'])){
 $request=mysql_query("SELECT * FROM pacientes b where concat(b.nombres,' ',b.nombre2,' ',b.apellidos,' ',b.apellido2) like '%".$_POST['nombre']."%' and b.id_empresa like '".$_POST['empresa']."%' ");

}else{
$request=mysql_query("SELECT * FROM pacientes a where a.alta='Vinculado' and (select count(*) from actividad b where b.id_paciente=a.id_paciente)=0 ".$limit);
  }
     
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th width="20%">'.'Nombre de Contacto'.'</th>'; 
              $table = $table.'<th width="8%">'.'Cedula'.'</th>';
              $table = $table.'<th width="30%">'.'Empresa'.'</th>';
              $table = $table.'<th width="8%">'.'Telefeno'.'</th>';
              $table = $table.'<th width="8%">'.'Celular'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Acudiente'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Alta temprana'.'</th>';
            
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

$request4=mysql_query("SELECT * FROM actividad a, pacientes b where a.id_paciente=b.id_paciente and b.id_paciente='".$row['id_paciente']."' group by a.orden_servicio");
$cont=0;
$r = mysql_num_rows($request4);
if($r==0){$sub = '<strike><font color="red">'.$row['nombres'].' '.$row['nombre2'].' '.$row['apellidos'].' '.$row['apellido2'].'</font></strike> ';}else{$sub=''.$row['nombres'].' '.$row['nombre2'].' '.$row['apellidos'].' '.$row['apellido2'].'';}
           if($editar_pac=='Habilitado'){$up = '<img src="../imagenes/modificar.png">';}else{$up = '';}
           if($eliminar_pac=='Habilitado'){$del= '<img src="../imagenes/eliminar.png">';}else{$del = '';}
           
            $table = $table.'<tr>
                <td width="20%"><a href="../vistas/?id=ver_paciente&cod='.$row['id_paciente'].'">'.$sub.'</a></td> 
                <td width="8%">'.$row['numero_doc'].'<font></a></td>
                    <td width="30%"><a href="../vistas/?id=ver_empresa&cod='.$idempresa.'">'.$empresa.'</a></td>
               <td class="hidden-phone">'.$row["tel_1"].'</font></td><td class="hidden-phone">'.$row["celular"].'</font></td><td class="hidden-phone">'.$row["nombre_acudiente"].'</font></td><td class="hidden-phone">'.$row["estado"].'</font></td>
                            <td><a href="../vistas/?id=paciente&cod='.$row['id_paciente'].'">'.$up.'</a></td>
                               </tr>';   
      
        }
        
        
	$table = $table.'</table>';
         if(!isset($_GET['up'])){
	echo $table;
         }
        
     
}
?>