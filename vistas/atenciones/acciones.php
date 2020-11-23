<?php
include('../../modelo/conexion.php');
// sw = 
// 0 Insertar
// 1 Actualizar
// 2 Mostrar
// 3 Eliminar
switch ($_GET['sw']) {
        case 0:
                    $ced = $_GET['ced'];
                    $nom = $_GET['nom'];
                    $no2 = $_GET['no2'];
                    $ape = $_GET['ape'];
                    $ap2 = $_GET['ap2'];
                    $dir = $_GET['dir'];
                    $bar = $_GET['bar'];
                    $mun = $_GET['mun'];
                    $dep = $_GET['dep'];
                    $tel = $_GET['tel'];
                    $cel = $_GET['cel'];
                    $fam = $_GET['fam'];
                    $tfa = $_GET['tfa'];
                    $fin = $_GET['fin'];
                    $fde = $_GET['fde'];
                    $emp = $_GET['emp'];
                    $est = $_GET['est'];
                    $depo = $_GET['depo'];
                    $sub = $_GET['sub'];
                    $enf = $_GET['enf'];
                    $obs = $_GET['obs'];
                    $cons= "SELECT * FROM `departamentos` where id='".$mun."' ";
                    $res=  mysql_query($cons);
                    $g = mysql_fetch_array($res);
                    $muni = $g['cod_mun'];
                    

                    $comprobar = mysql_num_rows(mysql_query("SELECT * FROM pacientes WHERE numero_doc = '".$ced."'"));
                    if($comprobar == 0){
                    $ok = mysql_query("INSERT INTO pacientes "
                            . "(`documento`,"
                            . " `numero_doc`,"
                            . "`nombres`,"
                            . "`nombre2`,"
                            . "`apellidos`,"
                            . "`apellido2`,"
                            . " `direccion1`,"
                            . " `departamento`,"
                            . " `municipio`,"
                            . " `tel_1`,"
                            . " `celular`,"
                            . " `nombre_acudiente`,"
                            . " `telefono_acudiente`,"
                            . " `fecha_reg`,"
                            . " `fecha_mod`,"
                            . "`id_empresa`,"
                            . "`estado`,"
                            . "`deposito_alq`,"
                            . "`subcodigo`,"
                            . "`enfermedad`,"
                            . "`descripcion_enf`)"
                            . "VALUES('CC','$ced','$nom','$no2','$ape','$ap2','$dir',"
                            . "'$dep','$muni','$tel','$cel','$fam','$tfa','$fin','$fde','$emp','$est','$depo','$sub','$enf','$obs') ") or die(mysql_error());
                    echo $ok;
                    
                    }
            break;
        case 1:
                    $ced = $_GET['ced'];
                    $nom = $_GET['nom'];
                    $no2 = $_GET['no2'];
                    $ape = $_GET['ape'];
                    $ap2 = $_GET['ap2'];
                    $dir = $_GET['dir'];
                    $bar = $_GET['bar'];
                    $mun = $_GET['mun'];
                    $dep = $_GET['dep'];
                    $tel = $_GET['tel'];
                    $cel = $_GET['cel'];
                    $fam = $_GET['fam'];
                    $tfa = $_GET['tfa'];
                    $fin = $_GET['fin'];
                    $fde = $_GET['fde'];
                    $emp = $_GET['emp'];
                    $est = $_GET['est'];
                    $depo = $_GET['depo'];
                    $sub = $_GET['sub'];
                    $enf = $_GET['enf'];
                    $obs = $_GET['obs'];
                    $cons= "SELECT * FROM `departamentos` where id='".$mun."' ";
                    $res=  mysql_query($cons);
                    $g = mysql_fetch_array($res);
                    $muni = $g['cod_mun'];

                    $ok = mysql_query("update pacientes set nombres='".$nom."' ,"
                            . "nombre2='".$no2."',"
                            . "apellidos='".$ape."',"
                            . "apellido2='".$ap2."',"
                            . "direccion1='".$dir."',"
                            . "departamento='".$dep."',"
                            . "municipio='".$muni."',"
                            . "tel_1='".$tel."',"
                            . "celular='".$cel."',"
                            . "nombre_acudiente='".$fam."',"
                            . "telefono_acudiente='".$tfa."',"
                            . "fecha_reg='".$fin."',"
                            . "fecha_mod='".$fde."',"
                            . "id_empresa='".$emp."',"
                            . "estado='".$est."',"
                            . "deposito_alq='".$depo."',"
                            . "subcodigo='".$sub."',"
                            . "enfermedad='".$enf."',"
                            . "descripcion_enf='".$obs."' where numero_doc='".$ced."' ");
                    mysql_error();
                    echo $ok+1;
           break;
        case 2:
                   include 'mostrar_tabla.php';
           break;
        case 3:
                    $cod = $_GET['codigo'];
                    $resultado = mysql_query("DELETE FROM contactos WHERE nitcc ='".$cod."' ");
                    echo $resultado;
        break;
        case 4:                  
          $cod = $_GET['orden'];
          $causa = $_GET['causa'];
          $ok = mysql_query("update actividad set prioridad='No Facturable', estado='Anulada', Location='Revisado', desc_motivo='$causa' where orden_servicio='".$cod."' ") or die(mysql_error());
          echo $ok;
        break;
        case 5:

                    $page = $_GET['page'];
            $atencion = $_GET['atencion'];
            $paciente = $_GET['paciente'];
            $usuario = $_GET['usuario'];
            $externa = $_GET['externa'];
            $interna = $_GET['interna'];
            $fecha = $_GET['fecha'];
                    $fi = 20;

            $request=mysql_query("SELECT * FROM actividad  WHERE prioridad!='Facturado' AND 
                                Location!='Revisado' AND
                                aviso IN ('En proceso') 
                                AND id_contacto<99 AND orden_servicio like '%".$interna."%' AND orden_externa like '%".$externa."%' and user like '%".$usuario."%' and vencimiento <= '".$fecha."' and id_contacto!='' and Subject like '%".$paciente."%'
                                GROUP BY orden_servicio
                                ORDER BY vencimiento DESC");
            if($request){
                    $request = mysql_num_rows($request);
                    $num_items = $request;
            }else{
                    $num_items = 0;
            }
            $rows_by_page = $fi;

            $last_page = ceil($num_items/$rows_by_page);
            echo '<tr><td colspan="8">';
                if($page>1){?>
                        <img src="../images/a1.png"  onclick="MostrarBloquedas(1)" style="cursor: pointer;">
                        <img src="../images/a11.png"  onclick="MostrarBloquedas(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../images/ant.png"><?php
                }
                ?>
                (Pagina <?php echo $page;?> de <?php echo $last_page;?>)
                <?php
                if($page<$last_page){?>
                        <img src="../images/p1.png"  onclick="MostrarBloquedas(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../images/p11.png" onclick="MostrarBloquedas(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../images/nex.png">  <?php
                }echo '<b>Total de Registros: (<font color="red">'.$num_items.'</font>)</b>';
                ?>
                        
                <?php        
                $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                echo '</td>';
                $result = mysql_query("SELECT * FROM actividad  WHERE prioridad!='Facturado' AND 
                                Location!='Revisado' AND
                                aviso IN ('En proceso')
                                AND id_contacto<99 AND orden_servicio like '%".$interna."%' AND orden_externa like '%".$externa."%' and user like '%".$usuario."%' and vencimiento <= '".$fecha."'  and id_contacto!='' and Subject like '%".$paciente."%'
                                GROUP BY orden_servicio
                                ORDER BY vencimiento DESC ".$limit);
                while ($r = mysql_fetch_array($result)){
                    if($r['id_contacto']==''){
                        $est = 'No iniciada';
                    }else if($r['id_contacto']>1 and $r['id_contacto']<98){
                        $est = 'En Proceso';
                    }else{
                        $est = 'Completada';
                    }
                    $fecha = "'".$r['vencimiento']."'";
                    echo '<tr>'
                            . '<td><a href="../vistas/?id=ver_orden_interna&ord='.$r['orden_servicio'].'" target="_blank">'.$r['orden_servicio'].'</a> '
                            . '<button data-toggle="modal" data-target="#exampleModal" onclick="pasar('.$r['orden_servicio'].','.$fecha.')"> up </button></td>'
                            . '<td><a href="../vistas/?id=ver_orden_interna&ord='.$r['orden_servicio'].'" target="_blank">'.$r['orden_externa'].'</a></td>'
                            . '<td>'.$r['Description'].'</td>'
                            . '<td>'.number_format($r['id_contacto'],2).'%</td>'
                            . '<td>'.$r['vencimiento'].'</td>'
                            . '<td>'.substr($r['Subject'], 13).'</td>'
                            . '<td>'.$est.'</td>'
                            . '<td>'.$r['user'].'</td>'
                            . '<td></td>';
                }
            break;
        case 6:
            $oi = $_GET['oi'];
            $fv = $_GET['fv'];
            echo mysql_query("update actividad set vencimiento='$fv' where orden_servicio='$oi' ") or die(mysql_error());
            break;
}

?>