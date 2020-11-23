<?php
include "../../modelo/conexion.php";
?>
<script>
function marcar(source) {
        checkboxes = document.getElementsByName('item'); //obtenemos todos los controles del tipo Input
        for (i=0;i<checkboxes.length;i++) { //recoremos todos los controles
                if (checkboxes[i].type === "checkbox") { //solo si es un checkbox entramos
                        
                        checkboxes[i].checked = source.checked; //si es un checkbox le damos el valor del checkbox que lo llamó (Marcar/Desmarcar Todos)
                }
        }
}
</script>
<?php
include('../../modelo/conexion.php');
?>
<button  id="factu" class="btn btn-primary" onclick="PreFactura();">Facturar</button>
<button  id="anular_orden" class="btn btn-danger" onclick="anular_orden();">Anular Orden</button> 
|
<input  type="text" id="aut" value="" placeholder="Numero de autorizacion"> <button  id="factur" class="btn btn-primary" onclick="autorizaciones();">Actualizar Autorizaciones</button>
|
<input  type="text" id="pre" value="" placeholder="Valor Atencion"> <button  id="factu" class="btn btn-primary" onclick="autorizaciones2();">Cambiar Precio</button>

                        
                            <table class="table table-bordered table-condensed table-hover">
                               <thead>
                                    <tr bgcolor="#ecf0f5">
                                        
                                        <th>Orden Ext.</th>
                                        <th>Nombre del Paciente</th>
                                        <th>Codigo</th>
                                        <th>Consulta</th>
                                        <th>Precio a EPS</th>
                                        
                                        <th>Cantidad</th>
                                        <th>Copago</th>
                                        <th>Total</th>
                                        <th>Fecha Consulta</th>
                                        <th>Atendido por</th>
                                        <th><input type="checkbox" onclick="marcar(this);" /></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                         if(isset($_GET['pac'])){
                             $pac = ' and concat(a.Subject) like "%'.$_GET['pac'].'%" ';
                         }else{
                             $pac = '';
                         }
                         if(isset($_GET['ced'])){
                             $ced = ' and b.numero_doc like "%'.$_GET['ced'].'%" ';
                         }else{
                             $ced = '';
                         }
                         if(isset($_GET['ano'])){
                             if($_GET['mes']==''){
                                 $fecha = $_GET['ano'].'-';
                             }else{
                                 $fecha = $_GET['ano'].'-'.$_GET['mes'].'-';
                             }
                            
                         }else{
                            
                         }
                         echo $_GET['empresa'];
                        $sql = mysql_query('SELECT *, max(b.fecha_registro) as a, max(b.fecha_final) as b FROM equipos_asig a, ordenes b, pacientes c WHERE'
        . ' c.id_paciente=b.id_paciente and b.id=a.numero_orden_a and b.facturado like "%" and b.fecha_registro like "'.$fecha.'%" and c.numero_doc like "%'.$_GET['ced'].'%"'
        . ' and c.id_empresa like "'.$_GET['empresa'].'%" and c.regimen like "%%"  and a.autorizacion like "%" group by b.id_paciente order by a desc ');
			//$sql = mysql_query("SELECT * FROM actividad a, pacientes b where a.id_paciente=b.id_paciente and checki='".$_GET['sel']."' and cod_aten like '".$_GET['cod']."%' and b.id_empresa='".$_GET['empresa']."' and concat(Subject,' ',numero_doc) like '%".$_GET['paciente']."%' and Location = '".$_GET['est']."'  and fecha_reg_ta between '".$_GET['ini']."' and '".$_GET['fin']."'  and a.prioridad='activa'  group by a.orden_servicio ");
                        $co = 0; $copago = 0; $pago = 0;
			if(mysql_num_rows($sql)>0){
                            
				while($mostrar = mysql_fetch_array($sql)){
					$co = $co+1;
                                        $copago += $mostrar['cuota_pagada']; 
                                        
                                        if($mostrar['regimen']==1){
                                            $regimen = 'Contributivo';
                                        }
                                        if($mostrar['regimen']==2){
                                            $regimen = 'Subsidiado';
                                        }
                                        if($mostrar['regimen']==3){
                                            $regimen = 'Vinculado';
                                        }
                                        if($mostrar['regimen']==4){
                                            $regimen = 'Particular';
                                        }if($mostrar['regimen']==5){
                                            $regimen = 'Otro';
                                        }
                                        $total=($mostrar['precio_a']*$mostrar['cantidad']);
                                        $pago += $total;
                                        if($mostrar['id_contacto']>=98){  
                                            //if($mostrar["prioridad"]!='Facturado' && $mostrar["Location"]=='Revisado'){
                                            if($mostrar['checki']=='0'){  
                                                $checked = '';
                                            }else{
                                                $checked = 'checked';
                                            }
                                            $disa = '<input type="checkbox" '.$checked.'  id="'.$mostrar['orden_servicio'].'" value="'.$mostrar['orden_servicio'].'" name="item" onclick="seleccionar('.$mostrar['orden_servicio'].')">';
//                                            }else{
//                                                $disa = '';
//                                            }
                                        }else{
                                           $disa = '';
                                        }
                                        if($mostrar["id_contacto"]==''){$n = '0 %';   }else{$n = number_format($mostrar["id_contacto"]).' %';}
                                        if($mostrar["id_contacto"]>98){$et ='Completado';}else{$et ='En Proceso';}
                                        if($mostrar["Location"]==''){$etl ='<font color="red"><button onclick="est('.$mostrar['orden_servicio'].')">Sin revisar</button></font>';}else{$etl ='<font color="green">Revisadas</font>';}
                                        echo '<tr>
                                       
                                        <td><input type="text" id="oe'.$mostrar['numero_orden_a'].'" value="'.$mostrar['orden_externa'].'"  onchange="up_orden('.$mostrar['numero_orden_a'].')" style="width:50px"><br>'.$n.' '.$et.'</td>'
                                        . '<td>'.$mostrar['documento'].':'.$mostrar['numero_doc'].'-'.substr($mostrar['Subject'],13).'<br> '.$regimen.'<br> '.$mostrar['tipo_s'].'</td>
                                            <td><input type="text" id="co'.$mostrar['numero_orden_a'].'" value="'.$mostrar['cod_aten'].'" style="width:30px" onchange="up_codigo('.$mostrar['numero_orden_a'].')">                                        
                                            <td><textarea rows="3" cols="15" id="de'.$mostrar['numero_orden_a'].'" disabled>'.$mostrar['Description'].'</textarea></td>'
                                        . '<td style="text-align:right;"><input type="text" id="pr'.$mostrar['numero_orden_a'].'" onchange="up_orden('.$mostrar['numero_orden_a'].')" value="'.$mostrar['precio_total'].'"  style="width:50px">'
                                        . ''
                                                . '<input type="hidden" id="precio'.$mostrar['numero_orden_a'].'" onchange="up_orden('.$mostrar['numero_orden_a'].')" value="'.$mostrar['precio_total'].'" style="width:30px"></td>'
                                        . '<td style="text-align:right;"><input type="text" id="copago'.$mostrar['numero_orden_a'].'" disabled onchange="up_orden('.$mostrar['numero_orden_a'].')" value="'.$mostrar['cant'].'" style="width:30px"></td>'
                                                . '<td style="text-align:right;"><input type="text" id="cop'.$mostrar['numero_orden_a'].'" onchange="up_orden('.$mostrar['numero_orden_a'].')" value="'.$mostrar['cuota_pagada'].'"  style="width:40px">'
                                        . '<td style="text-align:right;"><input type="text" id="precio_total'.$mostrar['numero_orden_a'].'" value="'.($total-$mostrar['cuota_pagada']).'" style="width:40px" disabled></td>
                                        <td>'.$mostrar['StartTime'].'</td><td>'.$mostrar['user'].'<br>'.$etl.'</td>
                                        <td>'.$disa.' '
                   
                    . '                </td>
							</tr>';
                
				}
			}else{
				echo '<tr><td colspan="5">No se encontraron registros...</td></tr>';
			}
                                    
                                    ?>
                                    <tr bgcolor="#ecf0f5">
                                        <th style="text-align:center;"><?php echo number_format($co); ?></th>
                            
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th style="text-align:right;"><input type="text" disabled id="subpagos" value="<?php echo $pago ?>" style="width: 70px;text-align: right"></th>
                                        <th></th>
                                        <th style="text-align:right;"><input type="text" disabled id="copagos" value="<?php echo $copago ?>" style="width: 50px;text-align: right"></th>
                                        
                                        <th style="text-align:right;"><input type="text" id="pagos" value="<?php echo ($pago - $copago) ?>" disabled style="width: 70px;text-align: right"></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>

                                    </tr>
                                </tbody>
                            </table>
                      