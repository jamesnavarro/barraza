<?php
include('../../modelo/conexion.php');
session_start();
switch ($_GET['sw']) {
        case 0:
                $consulta= "select * from actividad where archivo='".$_GET["arc"]."' and orden_servicio='".$_GET["orden"]."' limit 1";
                $result=  mysql_query($consulta);
                $fila=  mysql_fetch_array($result);
                $id_emp=$fila['orden_externa'];
                $user=$fila['user'];

       
                $s = "SELECT * FROM insumos where codigo='".$_GET["cod"]."' ";
                $fi =mysql_query($s);
                $p= $fi["precio_ins"];
                $bod = $_GET["bod"];
                $inv = $_GET["inv"];
                $fac = $_GET["fac"];
                $orden = $_GET["arc"];
                $insumo = $_GET["cod"];
                $descripcion = '';
                $numero = $_GET["cant"];
                $autorizacion = $_GET["orden"];
                $fecha = date("Y-m-d");
                if($inv=='Si'){
                    $in = 0;
                    $c_x = 0;
                }else{
                    $in = 1;
                    
                    $c_x = $_GET["cant"];
                }
                if($fac==0){
                $factura = 'nada';
                }else{
                $factura = $fac;
                }
                $precio = $p;
                $fecha_reg= date("Y-m-d");
               $query= "select * from insumos_asignados where cod_insumo='".$_GET["cod"]."' and rel_atencion='".$_GET["orden"]."'";                     
               $resultado=  mysql_query($query);
               $rows=  mysql_fetch_array($resultado);
               $idis = $rows['id_ia'];
               $existe= mysql_num_rows($resultado);

               if($existe!=0){
                   
                        $mv = mysql_query('select * from movimientos where orden_servicio='.$autorizacion.' and id_bod='.$bod.' ');
                        $ma = mysql_fetch_array($mv);
                        $id_mov = $ma['id_mov'];
                   
                        $sql = "UPDATE `insumos_asignados` SET  `cantidad` = `cantidad`+'".$numero."',`cant_restante` = `cant_restante`+'".$numero."',`cant_x` = `cant_x`+'".$c_x."' WHERE `id_ia` = '".$idis."'";
                        $oke =  mysql_query($sql, $conexion) or die(mysql_error());
                        if($inv=='Si'){
                        $sqlm = "update movimientos_items set cant=cant+'$numero', usuario='".$_SESSION['k_username']."' WHERE id_mov='".$id_mov."' and codigo='".$insumo."' ";
                        mysql_query($sqlm, $conexion) or die(mysql_error());
                       
                        $act_inv = "UPDATE `insumos` SET  `cant_disponible` = `cant_disponible`-'".$numero."' WHERE `codigo` = '".$insumo."'";
                        mysql_query($act_inv, $conexion) or die(mysql_error());
                          }

                        $sqlr = "INSERT INTO `modificaciones` (`descripcion`,`id_cotizacion`, `por`, `modulo`) ";
                        $sqlr.= "VALUES ('".$_SESSION['k_username']." Modifico el insumo ".$insumo."  ', '".$autorizacion."', '".$_SESSION['k_username']."', 'Atenciones')";
                        mysql_query($sqlr);
                        $ok = $oke + 1;

               }else{
                   $mv = mysql_query('select * from movimientos where orden_servicio='.$autorizacion.' ');
                   $c = mysql_num_rows($mv);
                   //echo $c.'cero'.$inv.'-';
                   if($c==0){
                       if($inv=='Si'){
                       $sqlm = "INSERT INTO `movimientos` (`id_operaciones`,`id_usuario`, `orden_servicio`, `fecha_mov`, `id_bod`, `grupo`, `save`) ";
                       $sqlm.= "VALUES ('2', '".$_SESSION['id_user']."', '".$autorizacion."', '".$fecha_reg."', '$bod', 'Orden','1')";
                       mysql_query($sqlm);
                       $mas = mysql_query("select max(id_mov) from movimientos");
                       $m = mysql_fetch_array($mas);
                       $id_mov = $m['max(id_mov)'];
                       }
                   }else{
                       $ma = mysql_fetch_array($mv);
                       $id_mov = $ma['id_mov'];
                   }
                   if($inv=='Si'){
                   $sqlmi = "INSERT INTO `movimientos_items` (`id_mov`,`codigo`, `cant`,`estado_mov`,`usuario`,`f_reg`) ";
                   $sqlmi.= "VALUES ('$id_mov', '".$insumo."', '".$numero."', 'Ok', '".$_SESSION['k_username']."', '".$fecha_reg."')";
                   mysql_query($sqlmi);
                   }
                   $sql = "INSERT INTO `insumos_asignados`(`cant_x`,`AfecInv`,`facturado`,`numero_orden`, `cod_insumo`, `cantidad`, `cant_restante`, `sub_precio`, `fecha_asignacion`, `rel_atencion`,  `inf_adicional`, `fecha_registro`, `autorizacion`, `asignado_a`)";
                   $sql.= "VALUES ('".$c_x."','".$in."','".$factura."','".$orden."', '".$insumo."', '".$numero."', '".$numero."', '".$precio."', '".$fecha."', '".$autorizacion."', '".$descripcion."', '".$fecha_reg."', '".$id_emp."', '".$user."')";
                   $ok = mysql_query($sql) or die(mysql_error());
                   if($inv=='Si'){
                   $act_inv = "UPDATE `insumos` SET  `cant_disponible` = `cant_disponible`-'".$numero."' WHERE `codigo` = '".$insumo."'";
                   $oke =  mysql_query($act_inv, $conexion) or die(mysql_error());
                   }
                   $sqlr = "INSERT INTO `modificaciones` (`descripcion`,`id_cotizacion`, `por`, `modulo`) ";
                   $sqlr.= "VALUES ('".$_SESSION['k_username']." Registro el insumo ".$_GET["cod"]."  ', '".$_GET["orden"]."', '".$_SESSION['k_username']."', 'Atenciones')";
                   mysql_query($sqlr);
                   }
                   echo $ok;
                    
        break;
        case 1:
                    $Codigo=$_GET['id'];
                    $inv = $_GET["inv"];
                    
                    $con = mysql_query('select * from movimientos where orden_servicio='.$_GET['orden'].' ');
                    $i = mysql_fetch_array($con);
                    $id_mov = $i['id_mov'];
                    
                    $query= "select * from insumos_asignados where id_ia='".$Codigo."' ";                     
                    $resultado=  mysql_query($query);
                    $rows=  mysql_fetch_array($resultado);
                    $cod = $rows['cod_insumo'];
                    $numero = ($rows['cantidad'] - $rows['cant_x']);
                    
                    $act_inv = "UPDATE `insumos` SET  `cant_disponible` = `cant_disponible`+'".$numero."' WHERE `codigo` = '".$cod."'";
                    $oke =  mysql_query($act_inv, $conexion) or die(mysql_error());
                    
                    $sql = "DELETE FROM insumos_asignados WHERE id_ia='$Codigo'";
                    mysql_query($sql, $conexion);
                    
                    $sql = "update movimientos_items set estado_mov='Anulado', usuario='".$_SESSION['k_username']."' WHERE id_mov='".$id_mov."' and codigo='".$cod."' ";
                    $ok = mysql_query($sql, $conexion) or die(mysql_error());

                    $sqlr = "INSERT INTO `modificaciones` (`descripcion`,`modulo`, `por`, `id_cotizacion`) ";
                    $sqlr.= "VALUES ('Se elimino insumo de la Orden # ".$Codigo." del archivo ".$_GET['arc']." por ".$_SESSION['k_username']." ', 'Archivo General', '".$_SESSION['k_username']."', '".$_GET['arc']."')";
                    mysql_query($sqlr, $conexion);
                    $sqlr2 = "INSERT INTO `modificaciones` (`descripcion`,`modulo`, `por`, `id_cotizacion`) ";
                    $sqlr2.= "VALUES ('Se elimino insumo de la Orden # ".$Codigo." del archivo ".$_GET['arc']." por ".$_SESSION['k_username']." ', 'Atenciones', '".$_SESSION['k_username']."', '".$Codigo."')";
                    mysql_query($sqlr2, $conexion);
//                    echo $ok;
        break;
        case 2:
       $consulta= "select * from actividad where archivo='".$_GET["arc"]."' and orden_servicio='".$_GET["orden"]."' limit 1";
       $result=  mysql_query($consulta);
       while($fila=  mysql_fetch_array($result)){
       $id_emp=$fila['orden_externa'];
       $user=$fila['user'];
       }
       
       $s = "SELECT * FROM medicamentos where codigo='".$_GET["cod"]."' ";
       $fi =  mysql_query($s);
       $p= $fi["precio_med"];
        $bod = $_GET["bod"];
        $orden = $_GET["arc"];
        $precio = $p;
        $insumo = $_GET["cod"];
        $inv = $_GET["inv"];
        $fac = $_GET["fac"];
        $descripcion = '';
	$numero = $_GET["cant"];
        $fecha = date("Y-m-d");
        $autorizacion = $_GET["orden"];
                 if($inv=='Si'){
                    $in = 0;
                    $c_x = 0;
                }else{
                    $in = 1;
                    $c_x = $_GET["cant"];
                }
        if($fac==0){
                $factura = 'nada';
                }else{
                $factura = $fac;
                }
        $fecha_reg= date("Y-m-d");
            $query= "select * from medicamentos_asig where cod_med='".$_GET["cod"]."' and rel_atencion='".$_GET["orden"]."'";                     
            $resultado=  mysql_query($query);
           $rows=  mysql_fetch_array($resultado);
               $id = $rows['id'];
             $existe= mysql_num_rows($resultado);
             if($existe!=0){
                 $mv = mysql_query('select * from movimientos where orden_servicio='.$autorizacion.' and id_bod='.$bod.' ');
                   $ma = mysql_fetch_array($mv);
                       $id_mov = $ma['id_mov'];
                       
                        $sql = "UPDATE `medicamentos_asig` SET  `cantidad` = `cantidad`+'".$numero."', `cantidad_rest` = `cantidad_rest`+'".$numero."', `cant_x` = `cant_x`+'".$c_x."' WHERE `id` = '".$id."'";
                        $oke =  mysql_query($sql, $conexion) or die(mysql_error());
                        if($inv=='Si'){
                        $act_inv = "UPDATE `medicamentos` SET  `cant_disponible` = `cant_disponible`-'".$numero."' WHERE `codigo_int` = '".$insumo."'";
                         mysql_query($act_inv, $conexion) or die(mysql_error());
                         
                         $sqlm = "update movimientos_items set cant=cant+'$numero', usuario='".$_SESSION['k_username']."' WHERE id_mov='".$id_mov."' and codigo='".$insumo."' ";
                         mysql_query($sqlm, $conexion) or die(mysql_error());
                        }
                        $sqlr = "INSERT INTO `modificaciones` (`descripcion`,`id_cotizacion`, `por`, `modulo`) ";
                        $sqlr.= "VALUES ('".$_SESSION['k_username']." Modifico el insumo ".$insumo."  ', '".$autorizacion."', '".$_SESSION['k_username']."', 'Atenciones')";
                        mysql_query($sqlr);
                       $ok = $oke + 1;
             }else{
                   $mv = mysql_query('select * from movimientos where orden_servicio='.$autorizacion.' and id_bod='.$bod.' ');
                   $c = mysql_num_rows($mv);
                   if($c==0){
                       if($inv=='Si'){
                       $sqlm = "INSERT INTO `movimientos` (`id_operaciones`,`id_usuario`, `orden_servicio`, `fecha_mov`, `id_bod`, `grupo`, `save`) ";
                       $sqlm.= "VALUES ('2', '".$_SESSION['id_user']."', '".$autorizacion."', '".$fecha_reg."', '$bod','Orden', '1')";
                       mysql_query($sqlm);
                       $mas = mysql_query("select max(id_mov) from movimientos");
                       $m = mysql_fetch_array($mas);
                       $id_mov = $m['max(id_mov)'];
                       }
                   }else{
                       $ma = mysql_fetch_array($mv);
                       $id_mov = $ma['id_mov'];
                   }
                   if($inv=='Si'){
                   $sqlmi = "INSERT INTO `movimientos_items` (`id_mov`,`codigo`, `cant`,`estado_mov`,`usuario`,`f_reg`) ";
                   $sqlmi.= "VALUES ('$id_mov', '".$insumo."', '".$numero."', 'Ok', '".$_SESSION['k_username']."', '".$fecha_reg."')";
                   mysql_query($sqlmi);
                   }

                   	$sql = "INSERT INTO `medicamentos_asig`(`cant_x`,`AfecInv`,`facturado`,`numero_orden`, `cod_med`, `cantidad`, `cantidad_rest`, `sub_precio_m`, `fecha_asig`, `rel_atencion`, `info`, `fecha_registro`, `autorizacion`, `asignado_a`)";
                        $sql.= "VALUES ('".$c_x."','".$in."','".$factura."','".$orden."', '".$insumo."', '".$numero."', '".$numero."', '".$precio."', '".$fecha."', '".$autorizacion."', '".$descripcion."', '".$fecha_reg."', '".$id_emp."', '".$user."')";
                        $ok = mysql_query($sql) or die(mysql_error());
                        if($inv=='Si'){
                        $act_inv = "UPDATE `medicamentos` SET  `cant_disponible` = `cant_disponible`-'".$numero."' WHERE `codigo_int` = '".$insumo."'";
                         mysql_query($act_inv, $conexion) or die(mysql_error());
                        }
                   $sqlr = "INSERT INTO `modificaciones` (`descripcion`,`id_cotizacion`, `por`, `modulo`) ";
                   $sqlr.= "VALUES ('".$_SESSION['k_username']." Registro el insumo ".$_GET["cod"]."  ', '".$_GET["orden"]."', '".$_SESSION['k_username']."', 'Atenciones')";
                   mysql_query($sqlr);
             }
            echo $ok;
                   
        break;
        case 3:
            $Codigo=$_GET['id'];
                    $inv = $_GET["inv"];
                    
                    $con = mysql_query('select * from movimientos where orden_servicio='.$_GET['orden'].' and id_bod=2 ');
                    $i = mysql_fetch_array($con);
                    $id_mov = $i['id_mov'];
                    
                    $query= "select * from medicamentos_asig where id='".$Codigo."' ";                     
                    $resultado=  mysql_query($query);
                    $rows=  mysql_fetch_array($resultado);
                    $cod = $rows['cod_med'];
                    $numero = ($rows['cantidad'] - $rows['cant_x']);
                    
                    $act_inv = "UPDATE `medicamentos` SET  `cant_disponible` = `cant_disponible`+'".$numero."' WHERE `codigo_int` = '".$cod."'";
                    mysql_query($act_inv, $conexion) or die(mysql_error());
                    
                    $sql = "DELETE FROM medicamentos_asig WHERE id='$Codigo'";
                     $okc =  mysql_query($sql, $conexion);
                    
                     $sql = "update movimientos_items set estado_mov='Anulado', usuario='".$_SESSION['k_username']."' WHERE id_mov='".$id_mov."' and codigo='".$cod."' ";
                       $ok = mysql_query($sql, $conexion) or die(mysql_error());

                    $sqlr = "INSERT INTO `modificaciones` (`descripcion`,`modulo`, `por`, `id_cotizacion`) ";
                    $sqlr.= "VALUES ('Se elimino medicamentos de la Orden # ".$Codigo." del archivo ".$_GET['arc']." por ".$_SESSION['k_username']." ', 'Archivo General', '".$_SESSION['k_username']."', '".$_GET['arc']."')";
                    mysql_query($sqlr, $conexion);
                    $sqlr2 = "INSERT INTO `modificaciones` (`descripcion`,`modulo`, `por`, `id_cotizacion`) ";
                    $sqlr2.= "VALUES ('Se elimino medicamentos de la Orden # ".$Codigo." del archivo ".$_GET['arc']." por ".$_SESSION['k_username']." ', 'Atenciones', '".$_SESSION['k_username']."', '".$Codigo."')";
                    mysql_query($sqlr2, $conexion);
                    
        break;
       case 4:
                    
        break;
       case 5:
                    
       break;
}

?>