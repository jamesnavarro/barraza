<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
                require("../modelo/conexion.php");
               $sql1 = "select max(orden_servicio) from actividad";
        $fila =mysql_fetch_array(mysql_query($sql1));
        $max=$fila['max(orden_servicio)']+1;
        ?>
        <form action="" method="post">
            <input type="text" name="oi" placeholder="oi"><br>
            <input type="text" name="prioridad" placeholder="" value="activa"><br>
            <input type="text" name="oin" placeholder="orden nueva" value="<?php echo $max ?>"><br>
            <input type="text" name="relacionado" placeholder="factura"><br>
            <input type="text" name="archivo" placeholder="Archivo"><br>
            <input type="submit" name="duplicar" value="Duplicar">
            
        </form>
        <?php

        if(isset($_POST['duplicar'])){
        $query = mysql_query('select * from actividad where orden_servicio='.$_POST['oi'].' ');
        while($r = mysql_fetch_array($query)){
            	$sql = "INSERT INTO `actividad`(`relacionado`,`PA`,`PULSO`,`FR`,`cant_med`,`Valoracion`, `inf_adicional`,`cada`, `obs`,`prioridad`,`aviso`,`Subject`, `StartTime`, `EndTime`, `tarea`, `Description`, `Color`, `estado`, `fecha_reg_ta`, `fecha_mod_ta`, `id_paciente`, `porcentaje`, `orden_servicio`, `precio_total`, `cod_aten`, `cant`, `cant_ins`, `id_empresa`, `user`, `orden_externa`, `archivo`, `est_motivo`, `desc_motivo`)";
                $sql.= "VALUES ('', '".$r['PA']."','".$r['PULSO']."','".$r['FR']."','".$r['cant_med']."','".$r['Valoracion']."','".$r['inf_adicional']."','".$r['cada']."','".$r['obs']."','".$_POST['prioridad']."','".$r['aviso']."','".$r['Subject']."', '".$r['StartTime']."', '".$r['EndTime']."', '".$r['tarea']."', '".$r['Description']."', '".$r['Color']."', '".$r['estado']."', '".$r['fecha_reg_ta']."', '".$r['fecha_mod_ta']."', '".$r['id_paciente']."', '".$r['porcentaje']."',"
                                                                                                                                                      . " '".$_POST['oin']."', '".$r['precio_total']."', '".$r['cod_aten']."', '".$r['cant']."', '".$r['cant_ins']."', '".$r['id_empresa']."', '".$r['user']."', '".$r['orden_externa']."', '".$_POST['archivo']."', '".$r['est_motivo']."', '".$r['desc_motivo']."')";
        mysql_query($sql);
        }
        $insumos = mysql_query('select * from insumos_asignados where rel_atencion='.$_POST['oi'].' ');
        while($i = mysql_fetch_array($insumos)){
            	$sqli = "INSERT INTO `insumos_asignados`(`facturado`,`numero_orden`, `cod_insumo`, `cantidad`, `cant_restante`, `sub_precio`, `fecha_asignacion`, `rel_atencion`,  `inf_adicional`, `fecha_registro`, `autorizacion`, `asignado_a`)";
                $sqli.= "VALUES ('','".$_POST['archivo']."', '".$i['cod_insumo']."', '".$i['cantidad']."', '".$i['cant_restante']."', '".$i['sub_precio']."', '".$i['fecha_asignacion']."', '".$_POST['oin']."', '".$i['inf_adicional']."', '".$i['fecha_registro']."', '".$i['autorizacion']."', '".$i['asignado_a']."')";
                mysql_query($sqli);
            
        }
        
        $medi = mysql_query('select * from medicamentos_asig where rel_atencion='.$_POST['oi'].'  ');
        while($m = mysql_fetch_array($medi)){
            	$sqlm = "INSERT INTO `medicamentos_asig`(`facturado`,`numero_orden`, `cod_med`, `cantidad`, `cantidad_rest`, `sub_precio_m`, `fecha_asig`, `rel_atencion`, `info`, `fecha_registro`, `autorizacion`, `asignado_a`)";
                $sqlm.= "VALUES ('','".$_POST['archivo']."', '".$m['cod_med']."', '".$m['cantidad']."', '".$m['cantidad_rest']."', '".$m['sub_precio_m']."', '".$m['fecha_asig']."', '".$_POST['oin']."', '".$m['info']."', '".$m['fecha_registro']."', '".$m['autorizacion']."', '".$m['asignado_a']."')";
	        mysql_query($sqlm, $conexion);
        }
        
                echo "<script language='javascript' type='text/javascript'>";
                echo "location.href='../vistas/duplicar.php'";
                 echo "</script>";
        }

        ?>
    </body>
</html>
