<?php

$request=mysql_query('SELECT a.*, b.*, c.* FROM actividad a, pacientes b, sis_empresa c WHERE b.id_empresa=c.rips and a.user="'.$user_u.'" and a.id_paciente=b.id_paciente group by a.orden_servicio order by orden_servicio desc');
if($request){
//    echo'<hr>';
    $table = '<table class="table table-bordered table-striped table-hover" id="">';

              $table = $table.'<thead>';
             $table = $table.'<tr>';
             $table = $table.'<th>'.'Orden Int.'.'</th>';
              $table = $table.'<th>'.'Nombre'.'</th>';
             
              $table = $table.'<th>'.'Fecha de Inicio'.'</th>';
              $table = $table.'<th>'.'Fecha de Final'.'</th>';
              $table = $table.'<th>'.'Atencion'.'</th>'; 
              $table = $table.'<th>'.'Cantidad'.'</th>'; 
                 $table = $table.'<th>'.'% Total'.'</th>';
                 $table = $table.'<th>'.'Liq.'.'</th>';

              
              $table = $table.'</thead>';

	
        
	//Por cada resultado pintamos una linea
        $a=date("H:i").':00';
        $cont=0;
        $sum = 0;
        $sum2 = 0;
        
	while($row=mysql_fetch_array($request))
	{       $cont = $cont + 1 ;
                  if($_SESSION["area"]=='OFICINA'){  $ver2='<a href="../vistas/?id=ver_orden_interna&ord='.$row["orden_servicio"].'">';}ELSE{$ver2 = '';}
                 if($modulo_pac=='Pacientes' && $ver_pac=='Habilitado'){$ver='<a href="../vistas/?id=ver_paciente&cod='.$row["id_paciente"].'">';}else{$ver='';}
           if($modulo_pac=='Pacientes' && $editar_pac=='Habilitado'){$b='<a href="../form_editar/formulario_editar_contacto_potencial.php?codigo='.$row["id_paciente"].'"><img src="../imagenes/modificar.png" alt="ver" height="15px" width="15px"></a>';}else{$b='';}
          if($row["id_contacto"]!=''){$por=''.number_format($row["id_contacto"]).'';}else{$por='0';}
          if($row["id_contacto"]>='99'){$liq = '<input type="checkbox" name="orden'.$cont.'" value="'.$row["orden_servicio"].'">'; } else {$liq = ''; }
           
           $sum = $sum + $row["positivo"];
           $sum2 = $sum2 + $row["negativo"];
           if(date("Y-m-d") > $row['EndTime']){$color='<font color="red">';}
           if(date("Y-m-d")== $row['EndTime']){$color='<font color="green">';}
           if(date("Y-m-d") < $row['EndTime']){$color='<font color="black">';}
           $tp = $row["positivo"] + $row["negativo"];
           $table = $table.'<tr><td>'.$ver2.''.$row["orden_servicio"].'</font></td><td>'.$ver.''.$row["nombres"].' '.$row["apellidos"].'<font></a></td>
              <td>'.$color.''.$row["StartTime"].'</font></td> <td>'.$color.''.$row["EndTime"].'</font></td><td>'.$row["Description"].'</font></td><td>'.$row["cant"].'</font></td>
                    
                        <td>'.$por.' %</td><td>'.$liq.'</td>
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
<?php } ?>
