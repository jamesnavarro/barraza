<?php 
 require '../modelo/consulta_autorizacion.php'; 
//  require '../modelo/consulta_contacto_potencial.php';
require '../modelo/consultar_permisos.php';

$sql1 = "SELECT MAX(id_autorizacion) as id FROM autorizacion";
        $fila1 =mysql_fetch_array(mysql_query($sql1));
        $idx = $fila1["id"];
?>
<div class="row-fluid">
    <section class="body">
        <div class="body-inner">
            <div class="span12 widget dark stacked">
                <header>
                    <h4 class="title"><span class="icon icone-crop"></span>INTERNACION DOMICILIARIA BARRAZA</h4>
                     <span class="label label-important"></span>
                </header>
                <b>Fecha</b> <?php echo $fechaa; ?>
                        <b>Hora</b> <?php echo $horaa; ?>
                        <b>Estado : </b><font color="red"><?php echo $estado_auto; ?></font>
                    <section id="collapse1" class="body collapse in">
                        <div class="body-inner">
                            <div class="tabbable" style="margin-bottom: 25px;">
                                <h3 align="center"><b>SOLICITUD DE AUTORIZACION DE SERVICIOS DE SALUD</b></h3>
                                 <a href="../vistas/mostrar_autorizacion.php?autorizar=<?php echo $_GET['autorizar'] ?>&aprobar=<?php echo $id_autorizacion ?>"><input type="button" value="Aprobar"></a>
                    <a href="../vistas/mostrar_todo.php"><input type="button" value="Cancelar"></a>
					<a target="_blank" href="../imprimir_autorizacion.php?imprimir=<?php echo $numero_orden; ?>"><input type="button" value="Imprimir"></a>
                        <br>
<br>                       
			<header><h5> INFORMACION DEL PRESTADOR(Solicitante)</h5></header>
                         <table  class="table table-bordered table-striped table-hover">
<tr>
<td><label>Empresa: </label></td>
<td><?php echo $nombre_emp;?> </td>
<td> Tipo de Documento:</td>
<td><?php echo $nit_emp;?></td>
<tr>

<td><label>Código:</label>  </td>
<td></td> <td></td><td></td>
</tr>

<tr>
<td><label>Direccion del prestador:</label></td> 
<td><?php echo $direccion;?></td>
<td><label>Departamento:</label></td> 
<td><?php echo $dapartamento;?></td> 
</tr>
<tr>
<td><label>Municipio :</label></td>
<td><?php echo $municipio;?></td>
<td><label>Telefono: </label></td> 
<td><?php echo $telefono_1;?> </td> 
</tr>
                       </table>
                        <header><h5>ENTIDAD A LA QUE SE LE SOLICITA (Pagador): <?php echo $entidad;?></h5></header>
                         
                        <h5 align="center">DATOS DEL PACIENTE</h5> 
                         <table  class="table table-bordered table-striped table-hover"> 
<tr>
<td><label>1er Apellido: </label><?php echo $apellido;?></td>
<td><label>2do Apellido: </label><?php echo $apellido2;?> </td>
<td><label>1er nombre: </label><?php echo $nombre;?> </td>
<td><label>2do nombre: </label><?php echo $nombre2;?></td>

</tr>

<tr>  
<td><label><b>Tipo de identificacion:</b></label><td><?php echo $documento?> </td><td></td><td></td>
</tr>

<tr>

<td><label><b>Numero documento de identificación :</b></label></td>
<td><?php echo $numero_doc;?></td>
<td><label>fecha de nacimiento :</td>
<td><?php echo $fecha_n;?></td>
</tr>

<tr>
<td><label><b>Dirección de residencia Habitual:</b></label></td>
<td><?php echo $dir1;?> </td>
<td></td><td><label>Telefono:</label><?php echo $tel1;?></td>
</tr>
<tr>                         

<td><label>Departamento:</label></td>
<td> <?php echo $dep;?></td> 
<td><label>Municipio:</label></td>
<td> <?php echo $muni;?>

</td>  

</tr> 	
<tr>
<td><label>Telefono<b>(celular):</b></label></td>
<td><?php echo $celular;?></td>
<td><label>Correo electronico<b>:</b></label></td>
<td> <?php echo $ema2;?> </td>
</tr> 
                                      </table>
                        <table  class="table table-bordered table-striped table-hover">
                                                                <tr>
                                                                    <td><label><b>Cobertura en salud: </b></label><?php echo $regimenA;?>
                                                                </tr>
                                                               
                                      </table>  
                        <header><h3 align ="center"><b>INFORMACIÓN DE LA ATENCIÓN Y SERVICIOS SOLICITADOS</b></h3></header>
                
				 
                          
                        <table  class="table table-bordered table-striped table-hover"> 
                            <tr>
                                            <td><label><b>Origen de la atención</b></label> <?php echo $origen_atencion;?></td>
                                            <td></td><td></td><td><label><b>Tipo de Servicios Solicitados</b></label> <?php echo $tipo_servicio;?></td>
                                            <td><label><b>Prioridad de la</b> <?php echo $prioridad;?></label>
                                        </tr>
                                            
                                   </table>
                            <header><h5><b>Ubicación del paciente al momento de la solicitud de autorizacíon</b></h5></header>
                                      
                                     <table  class="table table-bordered table-striped table-hover"> 
                                          <tr>
                                                                    <td><label><?php echo $ubicacion;?></label></td>    
                                                                    <td><label>Servicio: </label><label><?php echo $servicio;?></td>
                                                                   
                                                                    <td></td>
                                               </tr>
                                              
                                      
                                    </table>
                              <table  class="table table-bordered table-striped table-hover"> 
                         
                                               <tr>
                                                   
                                                    <td><label><b>Manejo integral según guia de:</b></label></td>
                                          
                                                    <td><?php echo $manejo;?></td>
                                                   
                               
                                                </tr>

                              </table><br><hr> 
                            <?php 
     if(isset($_GET['autorizar'])){              
$request= mysql_query('select * from cups where id_autorizacion="'.$_GET['autorizar'].'"');

if($request){
//    echo'<hr>';
    $table = '<table  class="table table-bordered table-striped table-hover"> ';

$table = $table.'<thead>';
           $table = $table.'<tr>';
              $table = $table.'<th>'.'Codigo'.'</th>';
              $table = $table.'<th>'.'cantidad'.'</th>';
              $table = $table.'<th>'.'Descripcion'.'</th>';
              $table = $table.'</tr>';

$table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $t1=0;
	while($row=mysql_fetch_array($request))
	{       
                
		$table = $table.'<tr><td>'.$row["codigo"].'</td><td>'.$row['cantidad'].'</td><td>'.$row['descripcion'].'</td></tr>';
               
	}

	$table = $table.'</table>';
        
	echo $table;
     }}

?>
                                <header><h5>Justificación Clinica</h5></header>
                      
                  <table  class="table table-bordered table-striped table-hover">
                         
                         
                         <tr> 
                                     <td><?php echo $justificacion;?> </td>
                               
                                 </tr>
                     </table>
                                <table  class="table table-bordered table-striped table-hover">
                                                                <tr>
                                                   <td> <label><b>Impresión Diagnóstica:</b></label> </td>
                                                   <td> <label><b>Código CIE10:</b></label> </td>
                                                   <td></td><td></td>
                                               </tr>
                                              <tr>
                                                    <td> <label>Diagnóstico Principal:</label> </td>
                                                    <td><?php echo $enfermedad;?></td>
                                                     <td><label><b>Descripción:</b></label> </td><td><?php echo $descripcion_enf;?></td>
                                                  
                                               </tr>
                                               <tr>
                                                    <td> <label>Diagnóstico Relacionado 1:</label> </td>
                                                    <td><?php echo $diagnostico1;?></td>
                                                     <td><label><b>Descripción:</b></label> </td><td><?php echo $descripcion1;?></td> 
                                               </tr>
                                                <tr>
                                                    <td> <label>Diagnóstico Relacionado 2:</label> </td>
                                                    <td><?php echo $diagnostico2;?></td>
                                                     <td><label><b>Descripción:</b></label> </td><td><?php echo $descripcion2;?></td> 
                                               </tr>
                                               
                                               
                                
                                               </table>
     
                                    <header><h5 align="center"><b>INFORMACIÓN DE LA PERSONA QUE SOLICITA</b></h5></header>
                                    
                                      <table  class="table table-bordered table-striped table-hover">
                                        <tr>
                                            <td><label><b>Nombre de que solicita</b></label></td> 
                                            <td><?php echo $nombre_solicita;?></td>
                                            <td><label><b>Telefono</b></label></td>
                                            <td><?php echo $indicativo;?> - <?php echo $numero;?> - <?php echo $extencion;?></td>
                                             
                                             
                                    </tr>
                                  
                                        
                                        
                                        
                                        
                                    </table>
                                       <a href="../vistas/mostrar_todo.php"><input type="button" value="Cancelar"></a>
					<a href="../imprimir_autorizacion.php?imprimir=<?php echo $numero_orden; ?>"><input type="button" value="Imprimir"></a>
                                        <br>
                                        <br>
                            </div>
                        </div>
                    </div>    
                </section>


            </div>
