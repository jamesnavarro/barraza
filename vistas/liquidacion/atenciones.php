 <?php
 include '../../modelo/conexion.php';
        ?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Lista de atenciones</title>
        <style>
            table {
                font-family: 'Arial';
                font-size: 13px;
            }
        </style>
         <script src="../../js/jquery-1.5.2.min.js" type="text/javascript"></script>
        <script type="text/javascript" language="javascript" src="funciones.js"></script>
    </head>
    <body>
        <?php
        $precios = mysql_query("SELECT d.pagos, a.*, b.* FROM actividad a, ordenes b, atenciones c, precios_atenciones d, pacientes e, sis_empresa f WHERE  a.cod_aten=c.codigo_atencion
 AND c.`id_atencion`=d.`id_atencion` 
 AND b.id=a.archivo 
 AND a.orden_servicio='".$_GET['ord']."'
 AND a.`id_paciente`=e.`id_paciente`
 AND e.`id_empresa`=f.`rips`
 AND f.`id_empresa`=d.`id_empresa` GROUP BY a.orden_servicio");
        $p = mysql_fetch_array($precios);
        
            $request=mysql_query("select a.*, b.* from actividad a, ordenes b where b.id=a.archivo and a.orden_servicio='".$_GET['ord']."' order by a.cant_ins");
     
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th>'.'Atencion'.'</th>';
              
              $table = $table.'<th>'.'# Orden Ext.'.'</th>';
              $table = $table.'<th>'.'Visita #'.'</th>';
                $table = $table.'<th>'.'Ir Cada'.'</th>';
              $table = $table.'<th>'.'Fecha Inicial'.'</th>';
              $table = $table.'<th>'.'Fecha Final'.'</th>';
              $table = $table.'<th>'.'Realizado el Dia'.'</th>';
              
              $table = $table.'<th>'.'Estado'.'</th>';
              $table = $table.'<th>'.'Asignado a'.'</th>';
              $table = $table.'<th>'.'Cant.'.'</th>';
              $table = $table.'<th>'.'Valor.'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $as='';$total2=0;$cc = 0; $prof = ''; $ate='';
	while($row=mysql_fetch_array($request))
	{       
                $total2 +=1;
                $cc = $p['pagos'];
           $prof = $row['user'];
           $ate=$row['Description'];
      
           if($row['estado']=='Completada'){$color='<font color="green">';}
           if($row['estado']=='No iniciada'){$color='<font color="red">';}
    
          
          
     if($row['vencimiento']=='0000-00-00'){
          $vence = $row['vencimiento'];
     }else{
         $fecha = $row['vencimiento'];
$nuevafecha = strtotime( '-1 day' , strtotime($fecha));
$vencimiento = date('Y-m-d' , $nuevafecha);
           $vence = $vencimiento;
     }

          $as = $row['user'];
               $var= $row['porcentaje'];
            $table = $table.'<tr><td>'.$color.''.$row['Description'].'</font></td>'
                    . '<td>'.$color.''.$row['orden_externa'].'</font></td>'
                    . '<td>'.$color.''.$row["cant_ins"].'<font></a></td>
                        <td>'.$row["cada"].' Dias</a></td>
               <td>'.$color.''.$row["StartTime"].'</font></td><td>'.$color.''.$row["EndTime"].'</font></td>'
                    . '<td>'.$color.''.$row["fecha_mod_ta"].'</font></td>
                   <td>'.$color.''.$row['estado'].'</font></td><td>'.$color.''.$row['user'].'</font></td>
                       <td>'.$color.''.$row['cant'].'</font></td><td><input type="text" id="valor" value="'.$p['pagos'].'" style="width:80px">'
                    . ''
                    . '</tr>';   
           
		
               
	}
        
        
	$table = $table.'</table>';

	echo $table;   
} ?>
        <div>
            <table>
                <tr>
                    <td>Orden: </td>
                    <td> <input type="text" id="orden" disabled style="width:80px" value="<?php echo $_GET['ord']; ?>"></td>
                </tr>
                <tr>
                    <td>Profesional: </td>
                    <td> <input type="text" id="pro" disabled style="width:80px" value="<?php echo $prof; ?>"></td>
                </tr>
                <tr>
                    <td>Atencion: </td>
                    <td> <input type="text" id="atencion" disabled style="width:380px" value="<?php echo $ate; ?>"></td>
                </tr>
                <tr>
                    <td>Cantidad a Liquidar: </td>
                    <td> <input type="text" id="cant"  style="width:80px" value="<?php if($_GET['pen']!=0){ echo $_GET['pen']; }else{echo $total2;} ?>" <?php if($_GET['pen']!=0){ echo 'disabled'; } ?>> 
                        (Total:<input type="text" id="cant_ori" disabled  style="width:40px" value="<?php if($_GET['pen']!=0){ echo $_GET['pen']; }else{echo $total2;} ?>">)
                        pendientes <input type="text" id="pend"  style="width:80px" value="" disabled style="border:1px #000"></td>
                </tr>
                <tr>
                    <td>Valor Und:</td>
                    <td><input type="text" id="und"  style="width:80px" value="<?php echo $cc; ?>"></td>
                </tr>
                <tr>
                    <td>Valor Total: </td>
                    <td><input type="text" id="total" disabled style="width:80px" value="<?php echo ($cc*$total2); ?>"></td>
                </tr>
                <tr>
                    <td>Liquidacion : </td>
                    <td><select id="liq" disabled><option value="Total">Total</option><option value="Parcial">Parcial</option></select></td>
                </tr>
                <tr>
                    <td>Observacion</td>
                    <td><input type="text" id="obs" disabled  style="width:380px" value=""></td>
                </tr>
                 <tr>
                    <td>Mes: </td>
                    <td><input type="text" id="fi" disabled style="width:80px" value="<?php if($_GET['fi']!=''){ echo $_GET['fi'];}else{echo date("Y-m-d");} ?>"> al <input type="text" id="ff" disabled style="width:80px" value="<?php if($_GET['ff']!=''){ echo $_GET['ff'];}else{echo date("Y-m-d");} ?>"></td>
                </tr>
            </table>
<?php 
    if($_GET['pen']==0){
         if($_GET['liq']!=0){
              $disabled = 'disabled';
         }else{
             $disabled = '';
         }       
    }else{
        $disabled = '';
    }
?> 
            <button type="button" id="pagar" <?php echo $disabled ?>>Liquidar</button> <span id="load"></span>
            

        </div>   
    </body>
</html>
