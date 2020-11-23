<?php
                   
if(isset($_GET['nombre'])){
                    $estado= $_GET['estado'];
                    $empresa = $_GET['empresa'];
                    include('../../modelo/conexion.php');
                    $colx = 'and concat(a.nombres," ",a.nombre2) like "%'.$_GET['nombre'].'%" and concat(a.apellidos," ",a.apellido2) like "%'.$_GET['apellido'].'%"';
            }else{
                    $colx='';
            }
if(isset($_GET['page'])){

                    $page = $_GET['page'];

            }else{
                    $page = 1;
            }
            $request=mysql_query('SELECT count(*) FROM pacientes a, sis_empresa b where a.id_empresa=b.rips and a.estado like "'.$estado.'%" and a.id_empresa like "'.$empresa.'%" '.$colx.' ');
            if($request){
                    $request = mysql_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 10;

            $last_page = ceil($num_items/$rows_by_page); ?>
            <div style="float:left">
               <?php if($page>1){?>
                        <img src="../images/a1.png"  onclick="MostrarClientes(1)" style="cursor: pointer;">
                        <img src="../images/a11.png"  onclick="MostrarClientes(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../images/ant.png"><?php
                }
                ?>
                (Pagina <?php echo $page;?> de <?php echo $last_page;?>)
                <?php
                if($page<$last_page){?>
                        <img src="../images/p1.png"  onclick="MostrarClientes(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../images/p11.png" onclick="MostrarClientes(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../images/nex.png">  <?php
                }echo 'Total de Registros: ('.$num_items.')';
                $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                ?></div>
                <div style="float: right">
                    <button type="button" class="btn-success btn-lg" data-toggle="modal" data-target="#myModal2">Subir Ordenes Internas.</button>
                    <button type="button" class="btn-info btn-lg" data-toggle="modal" data-target="#myModal">Subir Archivos.</button> 
                    <button type="button" onclick="formulario_cl(0,0)" class="btn-primary">Nuevo Paciente Part.</button> 
                    <button type="button" onclick="formulario_sub(0,0)" class="btn-primary">Nuevo Paciente Sub..</button>
                    <button type="button" onclick="formulario_subcov(0,0)" class="btn-primary">Paciente Covid-19</button>
                </div>
                        
                            <table class="table table-bordered table-condensed table-hover">
<!--                            <table class="table table-bordered table-striped table-hover" id="">-->
                                <thead>
                                    <tr  BGCOLOR="#C3D9FF">
                                        <th>C.C</th>
                                        <th>Nombre del Paciente</th>
                                        <th>Empresa de Salud</th>
                                        <th>Estado</th>
                                        <th>Acudiente</th>
                                        <th>Ult. Atencion</th>
                                        <th>Editar</th>
                                        
                                    </tr>
                                </thead>
                     
                                    <?php
                                    if(isset($_GET['nombre'])){
                                        $col = ' and concat(a.nombres," ",a.nombre2) like "%'.$_GET['nombre'].'%" and concat(a.apellidos," ",a.apellido2) like "%'.$_GET['apellido'].'%"';
                                    }else{
                                        $col = '';
                                    }
                                    $sql = mysql_query("SELECT *, a.id_empresa  FROM pacientes a, sis_empresa b where a.id_empresa=b.rips and a.estado like '".$estado."%' and a.id_empresa like '".$empresa."%' $col ".$limit);
			$item = 0;
			if(mysql_num_rows($sql)>0){
				while($mostrar = mysql_fetch_array($sql)){
					$item = $item+1;
                                         if($mostrar['estado']=='Activo' || $mostrar['estado']=='ACTIVO'){
                                            $class = 'yes';
                                        }else{
                                            $class = 'no';
                                        }
                                        if($mostrar['covid']=='Si'){
                                            
                                            $form = 'formulario_subcov';
                                        }ELSE{
                                            $form = 'formulario_sub';
                                        }
					echo '<tr>
<td><a href="../vistas/?id=ver_paciente&cod='.$mostrar['id_paciente'].'">'.$mostrar['numero_doc'].'</a></td>
<td>'.$mostrar['nombres'].' '.$mostrar['nombre2'].' '.$mostrar['apellidos'].' '.$mostrar['apellido2'].'<br><b>Tels:'.$mostrar['tel_1'].'-'.$mostrar['celular'].'</b></td>

<td>'.$mostrar['nombre_emp'].'</td>
<td class="'.$class.'">'.$mostrar['estado'].'</td><td>'.$mostrar['nombre_acudiente'].'</td><td>'.$mostrar['ultima_atencion'].'</td>'; ?>
                                <td><img src="../imagenes/modificar.png" class="btn"  onClick="<?php echo $form ?>('<?php echo $mostrar['numero_doc']; ?>','<?php echo $mostrar['id_empresa']; ?>')"></td></tr>
				<?php }
			}else{
				echo '<tr><td colspan="5">No se encontraron registros...</td></tr>';
			}
                                    
                                    ?>
                              
                            </table>
                        
