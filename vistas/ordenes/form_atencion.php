<?php
include "../modelo/conexion.php";
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <script> 
var ventana_secundaria 

function atencion(){  
ventana_secundaria = window.open("../seleccion/atenciones.php","miventana","width=800,height=400,menubar=no") 
} 

function cerrarVentana(){ 
ventana_secundaria.close() 
} 
 
</script>

        <title>Nuevo Proyecto</title>
        
    </head>
         <?php 
      if(isset($_GET["edit"])){
$consulta= "select a.*, b.* from actividad a, pacientes b WHERE a.id_paciente=b.id_paciente and a.orden_servicio=".$_GET["edit"]." limit 1";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
$id_ta=$fila['Id'];
$asunto=$fila['Subject'];
$fecha_vencimiento=$fila['EndTime'];
$cod_aten=$fila['cod_aten'];
$fecha_inicio=$fila['StartTime'];
$prioridad_act=$fila['prioridad'];
$asignado=$fila['user'];
$descripcion_act=$fila['Description'];
$estado_act=$fila['estado'];
$relacion_act=$fila['relacionado'];
$id_seleccionado=$fila['id_seleccionado'];
$id_contacto=$fila['id_contacto'];
$orden_ext=$fila['orden_externa'];
$fecha_registro=$fila['fecha_reg_ta'];
$fecha_registro_mod=$fila['fecha_mod_ta'];
$orden_ser=$fila['orden_servicio'];
$idp=$fila['id_paciente'];$porcentaje=$fila['porcentaje']; $tratamiento=$fila['inf_adicional'];  
$nombre=$fila['nombres'];
$apellido=$fila['apellidos'];
$cant=$fila['cant'];$dias=$fila['cada'];$vdias=$fila['vdias'];
$valoracion=$fila['obs'];
$archivo=$fila['archivo'];
$precio=$fila['precio_total'];
$prueba=$fila['prueba'];
$fechaprueba=$fila['fechaprueba'];
$resultado=$fila['resultado'];
 }}
       $sql1 = "select max(orden_servicio) from actividad";
        $fila =mysql_fetch_array(mysql_query($sql1));
        $max=$fila['max(orden_servicio)']+1;
     ?>
    <body onLoad="cerrar()">
        
        
				
                               
                                   <form name="insertar" action="<?php if(isset($_GET["edit"])){echo '../modelo/insertar_visitas.php?edit='.$_GET['edit'].' ';}else{echo '../modelo/insertar_visitas.php';} ?>" method="post" enctype="multipart/form-data">
				<div class="module_content"> 
                               
                                   <font color="red">Aviso: (*)Indica un campo requerido</font>
                                            
            
                                        <br>             
                <table class="table table-bordered table-striped table-hover">                                <tr>
                                                           <td><label># orden interna :<font color="red"> *</font> </label></td>
                                                           <td><input type="text" name="orden" readonly style="width:25%;" value="<?php if(isset($_GET["edit"])){echo $_GET["edit"];}else{echo $max; } ?>" required> 
                                                               <label></label><input type="text" name="orden_ext" id="orden_ext" placeholder="#orden externa" style="width:25%;" value="<?php if(isset($_GET["edit"])){echo $orden_ext;} ?>"><span id="ver"></span>
                                                           </td>
                                                        </tr>
							<tr>
                                                           <td><label>cantidad de visitas :<font color="red"> *</font> </label></td>
                                                           <td><input type="text" maxlength="3" name="numero" style="width:25%;" value="<?php if(isset($_GET["edit"])){echo $cant;} ?>" required></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>Fecha Inicio :<font color="red"> *</font> </label></td>
                                                            <td><input type="text" name="fecha_inicial" placeholder="2014-12-01" id="datepicker1" style="width:70px;height:20px;" value="<?php if(isset($_GET["edit"])){echo $fecha_inicio;} ?>" required>(a&ntilde;o-mes-dia, ej: 2014-01-31)</td>
                                                        </tr>
                                                           <tr>
                                                            <td><label>Fecha Final :<font color="red"> *</font> </label></td>
                                                            <td><input type="text" name="fecha_final" id="datepicker2"  placeholder="2014-12-31"  style="width:70px;height:20px;" value="<?php if(isset($_GET["edit"])){echo $fecha_vencimiento;} ?>" required>(a&ntilde;o-mes-dia, ej: 2014-01-31)</td></tr>
                                                           <tr>
                                                            <td><label>Asignado a :<font color="red"> *</font></label></td>
                                                            <td>
                                                                <select name="usuario" class="span6" id="select2_1" required> 
                             <?php
                                                                   if(isset($_GET['edit'])){echo '<option value="'.$asignado.'">'.$asignado.'</option>';}else{echo '<option value="">Seleccione</option>';}
                                                                  
                                                           $consulta2= "SELECT * FROM `usuarios` where estado_empleado='Activo'";                     
                                                            $result2=  mysql_query($consulta2);
                                                            while($fila2=  mysql_fetch_array($result2)){
                                                          
                                                            $usuarios=$fila2['usuario'].' - '.$fila2['nombre'].' '.$fila2['apellido'];
                                                            $usuario=$fila2['usuario'];
                                                            echo"<option value='".$usuario."'>".$usuarios."</option>";
                                                            
                                                            }
                                                            ?>
                                                     </select>
                                                                </td>
                                                          </tr>
                                                         <tr>
                                                            <td><label>Nombre Del Paciente : <font color="red"> *</font></label></td>
                                                            <td><input type="text" name="name" id="valor1" readonly style="width:200px;height:20px;" value="<?php echo "$nombre".' '."$nombre2".' '."$apellido".' '."$apellido2"; ?>" required/>
                                                                <input type="hidden" name="paciente" readonly id="valor2" style="width:2px;height:2px;" value="<?php echo $idp ?>"/>
<!--                                                                <a href='javascript: contacto()'><input type="button" name="cancelar" value="Seleccionar"></a>-->
                                                            </td></tr>
                                                          <tr>
                                                            <td><label>Codigo Atencion :</label></td>
                                                            <td>
                                                             <input type="text"  onclick="atencion()"  name="atencion2" required id="valor4" style="width:120px;height:20px;" value="<?php if(isset($_GET["edit"])){echo $cod_aten;} ?>"/>
                                                                <input type="button" onclick="atencion()" name="cancelar" value="Seleccionar">
                                                                <input type="hidden" name="precioss" id="valor5" style="width:20px;height:20px;" value="<?php if(isset($_GET["edit"])){echo $precio;} ?>"/>
                                                            </td>
                                                          </tr>
                                                         
                                                            
                                                         
                                                          <tr>
                                                            <td><label>Atencion Prestada :</label></td>
                                                            <td>
                                                            <textarea style="width:90%;" rows="2" name="descripcion" required id="valor3"><?php if(isset($_GET["edit"])){echo $descripcion_act;} ?></textarea><br><br>
                                                            </td>
                                                          </tr>
                                                          <tr>
                                                            <td><label>Observaciones:</label></td>
                                                            <td>
                                                            <textarea style="width:90%;" rows="2" name="obs" id="valor3"><?php if(isset($_GET["edit"])){echo $valoracion;} ?></textarea><br><br>
                                                            </td>
                                                          </tr>
                                                           <tr>
                                                            <td><label>Atencion Cada</label></td>
                                                            <td><input type="number" name="dias" style="width:5%;" value="<?php if(isset($_GET["edit"])){ echo $dias ;}else{ echo '3';} ?>"> Dias | En el dia <input type="number" name="vdias" style="width:5%;" value="<?php if(isset($_GET["edit"])){ echo $vdias ;}else{ echo '1';} ?>"> Veces</td>
                                                          </tr>
                                                          <tr>
                                                            <td><label>Archivo :</label></td>
                                                            <td><input type="text" readonly name="archivo" id="archivo" style="width:5%;" value="<?php echo $_GET['cod'] ?>"></td>
                                                          </tr>
                                                          <tr>
                                                            <td><label>Fecha de ingreso :<font color="red"> *</font> </label></td>
                                                            <td><input   type="text" name="fecha_reg" value="<?php echo date("Y-m-d")  ?> " required class="tcal" style="width:70px;height:20px;">(a&ntilde;o-mes-dia, ej: 2014-01-31)</td></tr>
                                                           <tr>
                                                               <tr>
                                                            <td><label>Urgente?:<font color="red"> *</font> </label></td>
                                                            <td><select name="urg">
                                                                    <option value="No">No</option>
                                                                    <option value="Si">Si</option>
                                                                </select></td></tr>
                                                           <tr>
                                                                <tr>
                                                            <td><label>Prueba COVID<font color="red"> *</font> </label></td>
                                                            <td><select name="prucov" style="width:80px" required>
                                                                    <?php 
                                                                     if(isset($_GET['edit'])){echo '<option value="'.$prueba.'">'.$prueba.'</option>';}else{echo '<option value="">Seleccione</option>';} ?>
                                                                    <option value="No">No</option>
                                                                    <option value="Si">Si</option>
                                                                </select> | Fecha Resultado:
                                                                <input type="date" name="fecpru" id="fecpru"   style="width:120px;height:20px;" value="<?php if(isset($_GET["edit"])){echo $fechaprueba;} ?>">
                                                                | Resultado <select name="respru" style="width:80px;">
                                                                    <?php 
                                                                     if(isset($_GET['edit'])){echo '<option value="'.$resultado.'">'.$resultado.'</option>';}else{echo '<option value="">Sin_definir</option>';} ?>
                                                                    <option value="Positivo">Positivo</option>
                                                                    <option value="Negativo">Negativo</option>
                                                                </select> 
                                                            </td></tr>
                                                           <tr>
                                                         
                                                          
                                                          
                                                     </table>
                                        <input type="submit" name="enviar" id="boton_enviar" value="Guardar" class="btb btn-primary" >
					
                                        <a href="../vistas/?id=add_atenciones&cod=<?php echo $orden_interna ?>"><INPUT TYPE="button" VALUE="Cancelar"></a>
		    </fieldset>
                                   
                                    
                                     <hr><br>
             
				</div>
                    </form>
                    
    </body>
</html>