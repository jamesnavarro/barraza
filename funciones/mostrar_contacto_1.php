                  
<?php

$request=mysql_query('SELECT a.*, b.*, c.* FROM actividad a, pacientes b, sis_empresa c WHERE b.id_empresa=c.rips and a.user="'.$user_u.'" and a.id_paciente=b.id_paciente group by a.orden_servicio');
if($request){
//    echo'<hr>';
    $table = '<table class="table table-bordered table-striped table-hover" id="tabla">';

              $table = $table.'<thead>';
             $table = $table.'<tr>';
             $table = $table.'<th>'.'Orden Int.'.'</th>';
              $table = $table.'<th>'.'Nombre'.'</th>';
             
              $table = $table.'<th>'.'Fecha de Inicio'.'</th>';
              $table = $table.'<th>'.'Fecha de Final'.'</th>';
              $table = $table.'<th>'.'Atencion'.'</th>'; 
              
               $table = $table.'<th>'.'% ( + )'.'</th>';
                $table = $table.'<th>'.'% ( - )'.'</th>';
                 $table = $table.'<th>'.'% Total'.'</th>';

              
              $table = $table.'</thead>';

	
        
	//Por cada resultado pintamos una linea
        $a=date("H:i").':00';
        $cont=0;
        $sum = 0;
        $sum2 = 0;
        
	while($row=mysql_fetch_array($request))
	{       
                  if($_SESSION["area"]=='OFICINA'){  $ver2='<a href="../vistas/?id=ver_orden_interna&ord='.$row["orden_servicio"].'">';}ELSE{$ver2 = '';}
                 if($modulo_pac=='Pacientes' && $ver_pac=='Habilitado'){$ver='<a href="../vistas/?id=ver_paciente&cod='.$row["id_paciente"].'">';}else{$ver='';}
           if($modulo_pac=='Pacientes' && $editar_pac=='Habilitado'){$b='<a href="../form_editar/formulario_editar_contacto_potencial.php?codigo='.$row["id_paciente"].'"><img src="../imagenes/modificar.png" alt="ver" height="15px" width="15px"></a>';}else{$b='';}
          if($row["id_contacto"]!=''){$por='<td>'.$row["id_contacto"].' %<font></a></td>';}else{$por='<td>0 %</td>';}
          
           $cont = $cont + 1 ;
           $sum = $sum + $row["positivo"];
           $sum2 = $sum2 + $row["negativo"];
           if(date("Y-m-d") > $row['EndTime']){$color='<font color="red">';}
           if(date("Y-m-d")== $row['EndTime']){$color='<font color="green">';}
           if(date("Y-m-d") < $row['EndTime']){$color='<font color="black">';}
           $tp = $row["positivo"] + $row["negativo"];
           $table = $table.'<tr><td>'.$ver2.''.$row["orden_servicio"].'</font></td><td>'.$ver.''.$row["nombres"].' '.$row["apellidos"].'<font></a></td>
              <td>'.$color.''.$row["StartTime"].'</font></td> <td>'.$color.''.$row["EndTime"].'</font></td><td>'.$row["Description"].'</font></td>
                    <td><font color="blue">'.$row["positivo"].' %</font></td><td><font color="orange">'.$row["negativo"].' %</font></td>
                        <td>'.$tp.' %</td>
</tr>';
                 
	}
        
	$table = $table.'</table>';
        
	echo $table;
        if(isset($p1)){
            $p1=0;
            $p2=0;
        }else{
        if($sum==0){
             $p1=0;
            $p2=0;
        }else{
        $p1 = $sum / $cont;
        $p2 = $sum2 / $cont;
        }}
        
}
if($_SESSION['admin']=='Si'){
?>
<table class="table table-bordered table-striped table-hover">
    <tr>
        <td><label>Promedio de cumplimiento = </label><?php echo $p1  ?> %</td>
        <td><label>Estado :</label><?php if($p1 != 0){ if($p1 == 100){echo '<font color="green">El Usuario esta cumpliendo al maximo sus obligaciones</font>';}else{
            if($p2 > 70){echo '<font color="red">El Usuario no esta cumpliendo al maximo sus obligaciones</font>';}else{echo '<font color="purple">El Usuario tiene un rendimientp normal</font>';}
        }}else{echo 'El usuario no tiene ninguna orden disponible';} ?></td>
            
    </tr>
    <tr>
        <td><label>Promedio de no cumplimiento = </label><?php echo $p2  ?> %</td>
        <td></td>
    </tr>
</table><?php } ?>
