<?php 

 require '../modelo/consulta_autorizacion.php'; 
require '../modelo/consultar_permisos.php';
$sql1 = "SELECT MAX(id_autorizacion) as id FROM autorizacion";
        $fila1 =mysql_fetch_array(mysql_query($sql1));
        $idx = $fila1["id"]+1;
      
?>
<head>
<script language='javascript'>
function contacto()
{
catPaises = window.open('../vistas/form_contacto.php', 'contacto', 'width=500,height=600');
}
function enfermedad()
{
      catPaises = window.open('../vistas/agregar_enfermedad.php', 'contacto', 'width=500,height=600');
}
function empresa()
{
catPaises = window.open('../vistas/form_empresa.php', 'contacto', 'width=800,height=900');
}
function seleccionar()
{
catPaises = window.open('../vistas/seleccionar.php', 'contacto', 'width=1000,height=600');
}
function alquiler()
{
catPaises = window.open('../seleccion/equipos.php', 'contacto', 'width=1000,height=600');
}
function atencion()
{
catPaises = window.open('../seleccion/atenciones.php', 'contacto', 'width=1000,height=600');
}
</script>
<script language="javascript" type="text/javascript">
function datos(val1, val2){
    document.getElementById('valor1').value = val1;
    document.getElementById('valor2').value = val2;
}
function datos3(val3, val4){
    document.getElementById('valor3').value = val3;
    document.getElementById('valor4').value = val4;
}
function user(val6){
    document.getElementById('valor6').value = val6;
    
}
function dato(val7, val8){
    document.getElementById('valor7').value = val7;
    document.getElementById('valor8').value = val8;
}
function datos2(val3, val4, val5){
    
    document.getElementById('valor3').value = val3;
    document.getElementById('valor4').value = val4;
    document.getElementById('valor5').value = val5;
}

</script>
</head>
    
<div class="row-fluid">	
    <section class="body">
        <div class="body-inner">
            <div class="span12 widget dark stacked">
                <header>
                    <ul class="toolbar pull-left">
                        <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>
                    </ul>
                 </header>
		<section id="collapse1" class="body collapse in">
                    <div class="body-inner">
                        <form  action="../modelo/insertar_cups.php?autorizar=<?php echo $_GET['autorizar']; ?>&add=<?php echo $idx; ?>" method="post" enctype="multipart/form-data">
                            <article class="module width_full">
                                <table class="table table-bordered table-striped table-hover" id="">
                                    <tr>
                                        <td><label><b>Manejo integral según guia de:</b></label></td>
                                        <td><input type="text"  name="manejo" style="width:90%;"  value="" required="true"></td>
                                        <td colspan="5"></td>

                                    </tr>
                                    <tr>
                                        <td><label><b>Codigo CUPS:</b></label></td>
                                        <td>
                                            <input name="buscar" type="button" value="Alquiler" onclick="alquiler()">
                                            <input name="buscar" type="button" value="Atenciones" onclick="atencion()">
                                            <input  readonly="true" required="true"type="text" id="valor4" name="cups" value="" style="width:60px;" maxlength="7"/>
                                        </td>
                                        <td colspan="2"> <label><b>Cantidad:</b></label> </td>
                                        <td><input required="true" type="text"  name="cant" value="" style="width:40px;"/><input type="hidden" id="valor5" name="" value="" style="width:4px; height: 2px;"/></td>
                                        <td><label><b>Descripción:</b></label> </td>
                                        <td><input required="true" type="text" id="valor3" name="descr" style="width:210px;" value=""/>&nbsp;&nbsp;<input name="add" type="submit" value="AGREGAR"></td>

                                    </tr>
                                </table> 
                                <?php 
                                if(isset($_GET['autorizar'])){       
                                include '../modelo/conexion.php';
                                $request1=  mysql_query("select * from cups where id_autorizacion=".$idx);
                                if($request1){
                                $table = '<table class="table table-bordered table-striped table-hover" id="tabla">';
                                $table = $table.'<thead>';
                                $table = $table.'<tr>';
                                $table = $table.'<th>'.'Codigo CUPS'.'</th>';
                                $table = $table.'<th>'.'cantidad'.'</th>';
                                $table = $table.'<th>'.'Descripcion'.'</th>';
                                $table = $table.'<th>'.'Eliminar'.'</th>';
                                $table = $table.'</tr>';
                                $table = $table.'</thead>';
                                $t1=0;
                                while($row=mysql_fetch_array($request1))
                                {       
                                    $table = $table.'<tr><td>'.$row["codigo"].'</td><td>'.$row['cantidad'].'</td><td>'.$row['descripcion'].'</td>
                                    <td><a href="../vistas/?id=autorizacion&eliminar='.$row["id_cups"].'&autorizar='.$_GET["autorizar"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a></td></tr>';
                                }
                                $table = $table.'</table>';
                                echo $table;
                                }}

                                ?>
                            </article>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </section>
</div>

		
<div class="row-fluid">	
    <section class="body">
        <div class="body-inner">
            <div class="span12 widget dark stacked">
                <header>
                    
                    <ul class="toolbar pull-left">
                        <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>
                    </ul>
                 </header>
		<section id="collapse1" class="body collapse in">
                    <div class="body-inner">
                        <form  action="../modelo/insertar_autorizacion.php?autorizar=<?php echo $_GET['autorizar']; ?>" method="post" enctype="multipart/form-data">
                            <article class="module width_full">
                                <header>
                                    <h5 align="center">MINISTERIO DE LA PROTECCION SOCIAL</h5>
                                </header>
                                <h3 align="center"><b>SOLICITUD DE AUTORIZACION DE SERVICIOS DE SALUD</b></h3><br>
                                <h3><font color="green">Solicitud Numero:</font><?php echo $idx; ?></h3>
                                <div class="tabbable" style="margin-bottom: 25px;">
                                    <div class="tab-content">
                                        <div class="" id="tab1">
                                            <div class="row-fluid">
                                                <div class="span12 widget lime">
                                                    <section class="body">
                                                        <header>
                                                            <h5> INFORMACION DEL PRESTADOR(Solicitante)</h5>
                                                        </header>
                                                        <table class="table table-bordered table-striped table-hover" id="">
                                                            <tr>
                                                                <td>Nombre:</td>
                                                                <td><input type="text" name="Nombre" style="width:260px;height:20px;" value="<?php echo $nombre_emp;?> "></td>
                                                                <td>NIT <input type="radio" name="nit_emp" checked  value="Sí" <?php if($nit_emp=='nit'){echo 'checked'; } ?>> </td>
                                                                <td> CC <input type="radio" name="nit_emp"  value=""/></td>
                                                                <td><input type="text" name="numero" style="width:100px;height:20px;" value="<?php echo $nit_emp;?>" /></td>
                                                           </tr>  
                                                           <tr>
                                                                <td>Código:</td>
                                                                <td><input type="text" name="Codigo" style="width:100px;height:20px;" value="<?php echo $infi;?>"/></td>
                                                                <td colspan="3"></td> 
                                                            </tr>
                                                            <tr>
                                                                <td>Direccion del prestador:</td> 
                                                                <td><input type="text" name="Direccion" style="width:260px;height:20px;" value="<?php echo $direccion;?>"/></td>
                                                                <td colspan="3"></td> 
                                                            </tr>
                                                            <tr>                         
                                                                <td><label>Departamento:</label></td> 
                                                                <td><input type="text" name="dpto" style="width:30px;height:20px;" value="<?php echo $dapartamento;?> "></td>
                                                                <td colspan="3"></td>
                                                            </tr>
                                                            <tr>
                                                                <td><label>Municipio :</label></td> 
                                                                <td><input type="text" name="municipio" style="width:40px;height:20px;" value="<?php echo $municipio;?> "></td>
                                                                <td colspan="3"></td>
                                                            </tr> 	
                                                            <tr>  
                                                           <td><label>Telefono: </label></td> 
                                                              <td><input type="text" name="Nombre" style="width:40px;height:20px;" value="035">,<input type="text" name="numero" style="width:110px;height:20px;" value="<?php echo $telefono_1;?>  "> </td>
                                                              <td colspan="3"></td>
                                                            </tr>
                                                            <tr><td colspan="5"><label></label></td></tr>
                                                        </table>
                                                    </section>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                             </article>
                            <div></div>
                            <article class="module width_full">
                                <header>
                                    <h5>ENTIDAD A LA QUE SE LE SOLICITA (Pagador) <input type="text" name="entidad" style="width:250px;height:20px;" maxlength="6" value="<?php echo $empresa ?>"  /> </h5>
                                </header>
                                <h5 align="center">DATOS DEL PACIENTE</h5><br>
                                <div class="tabbable" style="margin-bottom: 25px;">
                                    <div class="tab-content">
                                        <div class="" id="tab1">
                                            <div class="row-fluid">
                                                <div class="span12 widget lime">
                                                    <section class="body">
                                                        <table class="table table-bordered table-striped table-hover" id="">
                                                            <tr>
                                                                <td>Primer Apellido: <input type="text" name="apellido" style="width:100px;height:20px;" value="<?php echo $apellido;?> "> </td>
                                                                <td>Segundo Apellido: <input type="text" name="apellido2" style="width:100px;height:20px;" value="<?php echo $apellido2;?> "> </td>
                                                                <td>Primir Nombre: <input type="text" name="nombre" style="width:100px;height:20px;" value="<?php echo $nombre;?> "> </td>
                                                                <td>Segundo Nombre: <input type="text" name="nombre2" style="width:100px;height:20px;" value="<?php echo $nombre2;?> "> </td>
                                                            </tr>
                                                            <tr>  
                                                                <td><label><b>Tipo de identificacion:</b></label></td>
                                                                <td></td><td></td><td></td>
                                                            </tr>
                                                            <tr>
                                                                <td><input type="radio" name="documento" value="RC" <?php if($documento=='RC'){echo 'checked'; } ?>   /> <label>Registro Civil</label></td>
                                                                <td> <input type="radio" name="documento" value="PA" <?php if($documento=='PS'){echo 'checked'; } ?> /> <label>Pasaporte</label></td>
                                                                <td></td><td></td>
                                                            </tr>
                                                            <tr>
                                                                <td> <input type="radio" name="documento" value="TI" <?php if($documento=='TI'){echo 'checked'; } ?> /> <label>Targeta de Identidad</label></td>
                                                                <td> <input type="radio" name="documento" value="AS" <?php if($documento=='AS'){echo 'checked'; } ?> /> <label>Adulto sin identificacion</label></td>
                                                                <td></td><td></td>
                                                            </tr>
                                                            <tr>
                                                               <td> <input type="radio" name="documento" value="CC"  <?php if($documento=='CC'){echo 'checked'; } ?>/> <label>Cedula de Ciudadanía</label></td>
                                                                <td> <input type="radio" name="documento" value="MS" <?php if($documento=='MS'){echo 'checked'; } ?> /> <label>Menor sin Identificacion</label></td>
                                                                <td></td><td></td>
                                                            </tr>
                                                            <tr>
                                                               <td> <input type="radio" name="documento" value="CE"  <?php if($documento=='CE'){echo 'checked'; } ?> /> <label>Cedula de Extrangería</label></td>
                                                               <td></td><td></td><td></td>  
                                                            </tr>
                                                            <tr>
                                                                <td>Numero De Identificación: <input type="text" name="numero_doc" value="<?php echo $numero_doc;?> " /></td>
                                                                <td>Fecha De Nacimiento : <input type="text" style="width:30%;" name="fecha" value="<?php echo $fecha_n;?>" class="tcal"></td>
                                                                <td></td><td></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Dirección De Residencia: <input type="text" name="dir1" style="width:262px;height:20px;" value="<?php echo $dir1;?>" /></td>
                                                                <td>Telefono: <input type="text" name="tel_1" style="width:100px;height:20px;" value="<?php echo $tel1;?>" /></td>
                                                                <td>Celular: <input type="text" name="celular" style="width:100px;height:20px;" value="<?php echo $celular;?>" /></td>
                                                                <td>Correo Electronico: <input type="text" name="email2" style="width:270px;height:20px;" value="<?php echo $ema2;?>" /></td>
                                                            </tr>
                                                            <tr>                         
                                                                <td>Departamento: <input type="text" name="dpto" style="width:30px;height:20px;" value="<?php echo $dep;?> "></td>
                                                                <td>Municipio: <input type="text" name="municipio" style="width:40px;height:20px;" value="<?php echo $muni;?> ">
                                                                <td></td><td></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4"><h3><b>Cobertura En Salud</b></h3></td>
                                                                
                                                            </tr>
                                                            <tr>
                                                                <td> <input type="radio" name="regimen" value="Regimen Contributivo"  /> <label>Regimen Contributivo</label></td>
                                                                <td> <input type="radio" name="regimen" value="Regimen subsidiado-parcial"  /> <label>Regimen subsidiado-parcial</label></td>
                                                                <td> <input type="radio" name="regimen" value="Poblacion pobre no asegurada sin SISBEN"  /> <label>Poblacion pobre no asegurada sin SISBEN</label></td>
                                                                <td> <input type="radio" name="regimen" value="Plan adicional de salud"  /> <label>Plan adicional de salud</label></td>
                                                            </tr>
                                                            <tr>
                                                                <td> <input type="radio" name="regimen" value="Regimen Regimen subsidiado-total"  /> <label>Regimen Regimen subsidiado-total</label></td>
                                                                <td> <input type="radio" name="regimen" value="Población pobre no asegurada con SISBEN"  /> <label>Población pobre no asegurada con SISBEN</label></td>
                                                                <td> <input type="radio" name="regimen" value="Desplazado"  /> <label>Desplazado</label></td>
                                                                <td> <input type="radio" name="regimen" value="Otro"  /> <label>Otro</label></td>
                                                            </tr>
                                                        </table>
                                                     </section>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <div></div>
                            <article class="module width_full">
                                <header>
                                    <h3 align ="center"><b>INFORMACIÓN DE LA ATENCIÓN Y SERVICIOS SOLICITADOS</b></h3>
                                </header>
                                <div class="tabbable" style="margin-bottom: 25px;">
                                    <div class="tab-content">
                                        <div class="" id="tab1">
                                            <div class="row-fluid">
                                                <div class="span12 widget lime">
                                                    <section class="body">
                                                        <table class="table table-bordered table-striped table-hover" id="">  
                                                            <tr>
                                                                <td><label><b>Origen de la atención</b></label></td>
                                                                <td></td><td></td><td><label><b>Tipo de Servicios Solicitados</b></label></td>
                                                                <td><label><b>Prioridad de la</b></label>
                                                            </tr>
                                                            <tr>
                                                                <td> <input type="radio" name="origen" value="Enfermedad General"  /> <label>Enfermedad General</label></td>
                                                                <td> <input type="radio" name="origen" value="Accidente de trabajo"  /> <label>Accidente de trabajo</label></td>
                                                                <td> <input type="radio" name="origen" value="Evento Catastrofico"  /> <label>Evento Catastrofico</label></td>
                                                                <td> <input type="radio" name="tipo" value="Posterior a la atención inicial de urgencia"  /> <label>Posterior a la atención inicial de urgencia</label></td>
                                                                 <td> <input type="radio" name="prioridad" value="Prioritaria"  /> <label>Prioritaria</label></td>
                                                            </tr>
                                                            <tr>
                                                                <td> <input type="radio" name="origen" value="Enfermedad Profesionalí"  />    <label>Enfermedad Profesional</label></td>
                                                                <td> <input type="radio" name="origen" value="Accidente de Transito"  />    <label>Accidente de Transito</label></td>
                                                                <td> </td>
                                                                <td> <input type="radio" name="tipo" value="Atencion Domiciliaria"  />    <label>Atencion Domiciliaria</label></td>
                                                                <td> <input type="radio" name="prioridad" value="No prioritaria"  />    <label>No prioritaria</label></td>
                                                            </tr>
                                                        </table>
                                                    </section>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <div></div>
                            <article class="module width_full">
                                <header>
                                    <h3 align ="center"><b>UBICACION DEL PACIENTE AL MOMENTO DE LA SOLICITUD DE AUTORIZACION</b></h3>
                                </header>
                                <div class="tabbable" style="margin-bottom: 25px;">
                                    <div class="tab-content">
                                        <div class="" id="tab1">
                                            <div class="row-fluid">
                                                <div class="span12 widget lime">
                                                    <section class="body">      
                                                        <table class="table table-bordered table-striped table-hover" id="">
                                                            <tr>
                                                                <td> <input type="radio" name="ubicacion" value="Consulta Externa"  /> <label>Consulta Externa</label></td>    
                                                                <td><input type="radio" name="ubicacion" value="Hospitalizacion"  /> <label>Hospitalizacion</label></td>
                                                                <td><label>Servicio</label> <input type="text" name="servicio" style="width:260px;height:20px;" value=""  /></td>
                                                                <td> </td>
                                                            </tr>
                                                            <tr>
                                                                <td> <input type="radio" name="ubicacion" value="Sí"  /> <label>Urgencias</label></td>
                                                                <td><input type="radio" name="ubicacion" value="Hospitalizacion Domiciliaria"  /> <label>Hospitalizacion Domiciliaria</label></td>
                                                                <td></td><td></td>
                                                            </tr>
                                                        </table>
                                                    </section>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            <div></div>
                            <article class="module width_full">
                                <header>
                                    <h5>Justificación Clinica</h5>
                                </header>
                                 <textarea style="width:60%;" rows="8" name="justificacion"></textarea>
                            </article> 
                            <div></div><br>
                            <article class="module width_full">
                                <div class="tabbable" style="margin-bottom: 25px;">
                                    <div class="tab-content">
                                        <div class="" id="tab1">
                                            <div class="row-fluid">
                                                <div class="span12 widget lime">
                                                    <section class="body">      
                                                        <table class="table table-bordered table-striped table-hover" id="">
                                                            <tr>
                                                                <td> <label><b>Impresión Diagnóstica:</b></label> </td>
                                                                <td></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Diagnóstico Principal: <input type="text" name="Diag" value="<?php echo $enfermedad;?>"/></td>
                                                                <td>Descripción: <input type="text" name="desc" style="width:90%;" rows="10" value="<?php echo $descripcion_enf;?> "/></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Diagnóstico Relacionado 1: <input type="text" name="diagnostico1" value=" "/></td>
                                                                <td>Descripción: <input type="text" name="descripcion1" style="width:90%;" rows="10" value=""/></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Diagnóstico Relacionado 2: <input type="text" name="diagnostico2" value=" "/> </td>
                                                                <td>Descripción: <input type="text" name="descripcion2" style="width:90%;" rows="10" value=""/> </td>
                                                            </tr>
                                                        </table>
                                                    </section>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                             <div></div>
                            <article class="module width_full">
                                <header>
                                    <h5 align="center"><b>INFORMACIÓN DE LA PERSONA QUE SOLICITA</b></h5><br>
                                </header>
                                <div class="tabbable" style="margin-bottom: 25px;">
                                    <div class="tab-content">
                                        <div class="" id="tab1">
                                            <div class="row-fluid">
                                                <div class="span12 widget lime">
                                                    <section class="body">      
                                                        <table class="table table-bordered table-striped table-hover" id="">
                                                            <tr>
                                                                <td></td><td></td><td></td>
                                                                <td><label><b>Indicativo</b>______<b>Número</b>______<b>Extensión</b></label></td>
                                                            </tr>
                                                            <tr>
                                                                <td><label><b>Nombre de que solicita</b></label></td> 
                                                                <td><input type="text" name="Nomb" style="width:260px;height:20px;"value=" "/></td>
                                                                <td><label><b>Telefono</b></label></td>
                                                                <td><input type="text" name="indicativo" style="width:50px;height:20px;" maxlength="4" value=" "/>  <input type="text" maxlength="8" name="numero" style="width:90px;height:20px;" value=" "/> <input type="text" maxlength="4" name="extencion" style="width:50px;height:20px;" value=" "/></td>
                                                            </tr>
                                                        </table>
                                                        <input type="submit" name="enviar" value="Guardar" class="alt_btn">
                                                        <a href="../vistas/?id=pacientes"><input type="button" value="Cancelar"></a><br><br> 
                                                    </section>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </section>
</div>
<div class="spacer"></div>
<?php 
if(isset($_GET['eliminar']))
{
$Codigo=$_GET['eliminar'];
$sql = "DELETE FROM cups WHERE id_cups='$Codigo'";
mysql_query($sql, $conexion);
echo '<script lanquage="javascript">alert("Registro Eliminado");location.href="../vistas/autorizacion.php?autorizar='.$_GET['autorizar'].'"</script>'; 
}
?>

