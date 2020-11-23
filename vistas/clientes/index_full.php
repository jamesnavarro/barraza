<!DOCTYPE html>
<?php
   include '../../modelo/conexion.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Formulario de Registro de Pacientes Subsidiados</title>
            <link href="../../css/bootstrap.min.css" rel="stylesheet">
<link href="../../css/estilo.css" rel="stylesheet">
<script src="../../js/jquery.js"></script>
<script src="../../js/funcion_global.js"></script>
<script src="funciones.js?v=1.9"></script>
<script src="../../js/bootstrap.min.js"></script>
    </head>
    <body onload="Llenar_pac('<?php echo $_GET['id'] ?>');pagina(1,'<?php echo $_GET['emp'] ?>');">
        <div>
            <h3>Registro de Pacientes Subsidiados</h3>
        </div>
        <div   class="border"> 

            <div  style="float:left">
                   <img src="../../images/save.png" class="panel" id="GuardarSub" title="Guardar Registro"  data-toggle="tooltip">  <img src="../../images/borrar.png" class="panel"  id="Eliminar" title="Borrar Registro"  data-toggle="tooltip">  <img src="../../images/nuevo.png" class="panel"  id="Nuevo" title="Nuevo Registro"  data-toggle="tooltip">  <img src="../../images/printer.png" class="panel"  id="Imprimir" title="Imprimir Registro"  data-toggle="tooltip">  <img src="../../images/salir.png" class="panel"  id="Salir"title="Salir del Formulario"  data-toggle="tooltip">
               </div>
               <div id="paginacion"  style="float:right">

               </div>

            </div>
 
   <hr>
            
            <div  class="border">
            <fieldset>
 

  <h2>Formulario de Registro   <input id="emp" type="text" class="span1" readonly value="<?php echo $_GET['emp'] ?>"><span id="mensaje"></span></h2>
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Datos Basicos</a></li>
    <li><a data-toggle="tab" href="#menu1">Direcciones</a></li>
    <li><a data-toggle="tab" href="#menu2">Familiares</a></li>
    <li><a data-toggle="tab" href="#menu3">Diagnosticos</a></li>
    <li><a data-toggle="tab" href="#menu4">Condiciones de Vivienda </a></li>
    <li><a data-toggle="tab" href="#menu5">Encuesta COVID-19 </a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <h3>Datos Basicos</h3>
      				<table class="tbl-registro" width="100%">
                                    <tr>
                                        <td>Alta Temprana</td>
                                        <td><select name="alta" id="alta" title="Alta Temprana" data-toggle="tooltip">
   
               <option label="" value="Vinculado">Vinculado</option>
               <option label="" value="No Vinculado">No Vinculado</option>
                                            </select></td><td></td><td></td>
                                    </tr>
                	<tr>
                            <td width="180px">N° de Documento : <b>*</b></td>
                            <td><input type="text" class="sp1" maxlength="11" id="ced" placeholder="" value=""/> <input type="hidden" class="sp4" id="sw" placeholder="" value="4"/></td>
                       
                            <td>Tipo de Documento</td><td>
                                        <select name="documento" id="doc">
                                            <option value="">Seleccione</option>
           <option label="" value="CC">Cédula de Ciudadanía -- CC</option>
           <option label="" value="TI">Targeta de identidad -- TI</option>
           <option label="" value="PA">Pasaporte -- PA</option>
           <option label="" value="CE">Cédula de Extrangería -- CE</option>
           <option label="" value="RC">Registro civil -- RC</option>
           <option label="" value="AS">Adulto sin identificación-- AS</option>
           <option label="" value="MS">Menor sin identificación -- MS</option>
           <option label="" value="SC">SALVO CONDUCTO -- SC</option>
          </select>
                            </td>
                            
                        <tr>
                    	<td>Primer Nombre: <b>*</b></td>
                        <td><input type="text" class="sp1" id="nom"  autofocus placeholder=""/></td>
                    	<td>Segundo Nombre: </td>
                        <td><input type="text" class="sp1" id="no2"   placeholder=""/></td>
                        <tr>
                    	<td>Primer Apellido: <b>*</b></td>
                        <td><input type="text" class="sp1" id="ape"   placeholder=""/></td>
                    	<td>Segundo Apellido: <b>*</b></td>
                        <td><input type="text" class="sp1" id="ap2"   placeholder=""/></td>
                        <tr>
                    	<td>Fecha de Ingreso: </td>
                        <td><input type="text" class="sp1" id="fin"  placeholder="<?php echo date('Y-m-d') ?>" disabled/></td>
                    	<td>Fecha de Modificacion: </td>
                        <td><input type="text" class="sp1" id="fde"  placeholder="<?php echo date('Y-m-d') ?>" disabled/></td>
                        <tr>
                    	<td>Empresa de Salud: </td>
                        <td><select id="empresa" title="Seleccione la empresa de salud" data-toggle="tooltip"  class="sp1">
                                <option value="">Seleccione</option>
                                                        <?php
                                                           $query = mysql_query("select * from sis_empresa where cliente='Si' ");
                                                           while($s = mysql_fetch_array($query)){
                                                               echo '<option value="'.$s['rips'].'">'.$s['nombre_emp'].'</option>';
                                                           }
                                                        ?>
                            </select>
                        </td>
                                                    <td>Estado: <b>*</b></td>
                        <td><select id="est" class="sp1">
                                <option value="Activo">Activo</option>
                                <option value="No Activo">No Activo</option>
                            </select></td>
                        <tr>
                            <td>Regimen:<font color="red">*</font></td>
                             <td> <select id="regi" style="width:220px;">       
           <option value="">Seleccione</option>
           <option value="1">1. Contributivo</option>
           <option value="2">2. Subsidiado</option>
           <option value="4">4. Particular</option>
           <option value="3">3. Vinculado</option>
           <option value="5">5. Otro</option>
           <option value="7">7. Plan Complementario</option>
           <option value="8">8. Poliza</option>
           <option value="9">9. Arl</option>
           <option value="No aplica">No aplica</option>
       </select></td>
                              <td>Tipo de usuario:<font color="red">*</font></td>
                               <td><select id="tipo">
                                       <option value="">Seleccione</option>
            <option value="Cotizante">Cotizante</option>
            <option value="Beneficiario">Beneficiario</option>
       </select></td>
                        </tr>
                        <tr>
                            <td>Sexo</td>
                             <td><select id="sexo" required>
                                     <option value="">Seleccione</option>
         <option value="M">Masculino</option>
         <option value="F">Femenino</option>
       </select></td>
                              <td>Fecha de Nacimiento</td>
                               <td><input type="date" id="naci" placeholder="2000-01-31" value="" required></td>
                        </tr>
                        <tr>
                            <td>Estado civil <b>*</b></td>
                            <td><select id="civi" required>
                                    <option value="">Seleccione</option>
        <option value="Soltero/a">Soltero/a</option>
         <option value="Casado/a">Casado/a</option>
         <option value="Divorciado/a">Divorciado/a</option>
         <option value="Viudo/a">Viudo/a</option>
         <option value="Separado/a">Separado/a</option>
         <option value="Union Libre">Union Libre</option>
       </select></td>
       <td>Ocupacion <b>*</b></td>
                            <td><input required type="text" id="ocup" value=""/> </td>
                        </tr>
                        
                      
                     <tr>
                        <td>Ultima Atención: </td>
                        <td><input type="text" class="sp1" disabled id="uat" data-toggle="tooltip" title="Fecha de ultima atencion prestada"/></td>
                    	<td>Ultimo Alquiler: </td>
                        <td><input type="text" class="sp1" disabled id="ual" data-toggle="tooltip" title="Fecha de ultimo alquiler"/></td>
                    </tr>
                    <tr>
                        <td>Edad:</td><td colspan="3"><input type="text" class="sp1" disabled id="edad"/></td>
                    </tr>
                </table>
    </div>
    <div id="menu1" class="tab-pane fade">
      <h3>Direcciones</h3>
      <table>
                                  <tr>
                    	<td>Telefono: <b>*</b></td>
                        <td><input type="text" class="sp1"  id="tel"  autofocus placeholder=""/></td>
                        <td>Celular: </td>
                        <td><input type="text" class="sp1"  id="cel"  autofocus placeholder=""/></td>
          <tr>
                    	<td>Departamento: </td>
                        <td><select  class="sp1"  name="ciudad" id="dep">
                         <?php
                               echo '<option value="">Seleccione el Departamento...</option>';
                                        
                               $consulta= "SELECT * FROM `departamentos` group by nombre_dep";                     
                                $result=  mysql_query($consulta);

                                while($fila=  mysql_fetch_array($result)){
                                $valor1=$fila['cod_dep'];
                                 $valor2=$fila['nombre_dep'];

                               echo '<option value="'.$valor1.'">'.$valor2.'</option>';

                                }
                                
                                ?>
                                            </select>
                        </td>
                    	<td>Ciudad: </td>
                        <td><select  class="sp1"  name="municipio" id="mun">  
                      <?php   
                          echo '<option value="">Seleccione el Municipio...</option>';
                          $consulta2= "SELECT * FROM `departamentos` ";                     
                                $result2=  mysql_query($consulta2);
                                while($fi=  mysql_fetch_array($result2)){
                                    $valor3=$fi['id'];
                                $valor1=$fi['cod_mun'];
                                 $valor2=$fi['nombre_mun'];

                               echo '<option value="'.$fi['id'].'">'.$fi['nombre_mun'].'</option>';
                                }
                       ?>  
                            </select></td>
          </tr>
          <tr>
                    	<td>Zona: <b>*</b></td>
                        <td><select id="zona"  required>
                           
                            <option value="U">Urbano</option>
                            <option value="R">Rural</option>
                        </select></td>
                    	<td>Barrio: </td>
                        <td><input type="text" class="sp1" id="bar"   placeholder=""/></td>
          </tr>
          <tr>
              <td>Direccion</td>
              <td colspan="3"><textarea id="dir" cols="4" style="width: 100%"></textarea></td>
          </tr>
          <tr>
              <td>Email</td><td><input type="text" class="sp1" id="email"   placeholder="paciente@tucorreo.com"/></td>
          </tr>
      </table>
    </div>
    <div id="menu2" class="tab-pane fade">
      <h3>Familiares</h3>
      <table>
                                  <tr>
                    	<td>Nombre del Familiar: <b>*</b></td>
                        <td><input type="text" class="sp1"  id="fam"  autofocus placeholder=""/></td>
                    	<td>Tel. Familiar <b>*</b></td>
                        <td><input type="text" class="sp1" id="tfa" maxlength="9" placeholder=""/></td>
                                  </tr>
                                  <tr>
                                      <td>Parentesco <b>*</b></td>
                                      <td><select id="pare" required>
          <option value="">Seleccione</option>
          <option value="Padres">Padres</option>
          <option value="Conyugue">Conyugue</option>
          <option value="hermano(a)">hermano(a)</option>
          <option value="hijo(a)">hijo(a)</option>
          <option value="Primo/a">Primo/a</option>
          <option value="Particular">Particular</option>
          <option value="Cuñado/a">Cuñado/a</option>
          <option value="Abuelo/a">Abuelo/a</option>
          <option value="Vecino">Vecino</option>
          <option value="Tio/a">Tio/a</option>
          <option value="Suegro/a">Suegro/a</option>
          <option value="Sobrino/a">Sobrino/a</option>
        </select></td>
                                      <td></td>
                                      <td></td>
                                  </tr>
                                  <tr>
                                      <td>Nombre del Acompañante:<font color="red">*</font></td>
                                      <td><input required type="text" id="aco2" value=""/></td>
                                      <td>Tel ó /Cel:<font color="red">*</font></td>
                                      <td><input required type="text" id="tela" value="<?php if(isset($_GET['cod'])){echo $dir_pariente;} ?>"/></td>
                                  </tr>
                                  <tr>
                                      <td>Parentesco <b>*</b></td>
                                      <td><select id="par2" required>
<option value="">Seleccione</option>
          <option value="Padres">Padres</option>
          <option value="Conyugue">Conyugue</option>
          <option value="hermano(a)">hermano(a)</option>
          <option value="hijo(a)">hijo(a)</option>
          <option value="Primo/a">Primo/a</option>
          <option value="Particular">Particular</option>
          <option value="Cuñado/a">Cuñado/a</option>
          <option value="Abuelo/a">Abuelo/a</option>
          <option value="Vecino">Vecino</option>
          <option value="Tio/a">Tio/a</option>
          <option value="Suegro/a">Suegro/a</option>
          <option value="Sobrino/a">Sobrino/a</option>
        </select></td>
                                      <td></td>
                                      <td></td>
                                  </tr>
      </table>
    </div>
    <div id="menu3" class="tab-pane fade">
      <h3>Enfermedades</h3>
      <table>
            <tr>
                        <td>Codigo Enfermedad: </td>
                        <td><input type="text" class="sp3" id="enf"  placeholder=""/><img src="../../images/buscar.png" onclick="enfermedad();"></td>
                    	<td>Descripcion de enfermedad: </td>
                        <td><input type="text" class="sp1" id="obs" data-toggle="tooltip" title="Descripcion de la enferemedad"/></td>
                    </tr>
                     <tr>
                        <td>Codigo Enfermedad 2: </td>
                        <td><input type="text" class="sp3" id="enf2"  placeholder=""/><img src="../../images/buscar.png" onclick="enfermedad2();"></td>
                    	<td>Descripcion de enfermedad 2: </td>
                        <td><input type="text" class="sp1" id="obs2" data-toggle="tooltip" title="Descripcion de la enferemedad"/></td>
                    </tr>
                    <tr>
                    	<td>Deposito: </td>
                        <td><input type="text" class="sp1" id="depo"  placeholder=""/></td>
                        <td>SubCodigo</td>
                        <td><input type="text" class="sp1" id="sub"  placeholder=""/></td>
                    <tr>
                        <td>Esp. que ordena tratamiento:</td>
                        <td><input type="text" id="prof"  value="" /></td>
                        <td>No. Contrato</td>
                        <td><input type="text" id="cont"  value="" /></td>
                    </tr>
                    <tr>
                        <td>Posible COVID:</td>
                        <td>
                            <select id="cov" required>
                                    <option value="">Seleccione</option>
                                    <option value="Si">Si</option>
                                     <option value="No">No</option>
                             
                             </select>
                        </td>
                        <td>Observaciones COVID</td>
                        <td><input type="text" id="obscov"  value="" /></td>
                    </tr>
      </table>
    </div>
          <div id="menu4" class="tab-pane fade">
      <h3>Condiciones minima de vivienda</h3>
      <table border="1" style="width: 100%">
          <thead>
              <tr>
                  <th>REQUISITOS</th>
                  <th>CUMPLE / NO CUMPLE</th>

                  <th>OBSERVACIONES</th>
              </tr>
          </thead>
          <tbody>
              <tr>
                  <td>CONFORT</td>
                          <td>
                              <select id="cond1">
                                  <option value="">Seleccione</option>
                                  <option value="Si">Si</option>
                                  <option value="No">No</option>
                              </select>
                          </td>
                          <td><textarea id="obser1"></textarea></td>

              </tr>
              <tr>
                  <td>ENERGIA ELECTRICA</td>
                  <td>
                              <select id="cond2">
                                  <option value="">Seleccione</option>
                                  <option value="Si">Si</option>
                                  <option value="No">No</option>
                              </select>
                          </td>
                          <td><textarea id="obser2"></textarea></td>
              </tr>
              <tr>
                  <td>LINEA TELEFONICA</td>
                  <td>
                              <select id="cond3">
                                  <option value="">Seleccione</option>
                                  <option value="Si">Si</option>
                                  <option value="No">No</option>
                              </select>
                          </td>
                          <td><textarea id="obser3"></textarea></td>
              </tr>
              <tr>
                  <td>ACUEDUCTO</td>
                 <td>
                              <select id="cond4">
                                  <option value="">Seleccione</option>
                                  <option value="Si">Si</option>
                                  <option value="No">No</option>
                              </select>
                          </td>
                          <td><textarea id="obser4"></textarea></td>
              </tr>
              <tr>
                  <td>ALCANTARILLADO</td>
                  <td>
                              <select id="cond5">
                                  <option value="">Seleccione</option>
                                  <option value="Si">Si</option>
                                  <option value="No">No</option>
                              </select>
                          </td>
                          <td><textarea id="obser5"></textarea></td>
              </tr>
              <tr>
                  <td>NEVERA</td>
                  <td>
                              <select id="cond6">
                                  <option value="">Seleccione</option>
                                  <option value="Si">Si</option>
                                  <option value="No">No</option>
                              </select>
                          </td>
                          <td><textarea id="obser6"></textarea></td>
              </tr>
              <tr>
                  <td>BAÑO</td>
                  <td>
                              <select id="cond7">
                                  <option value="">Seleccione</option>
                                  <option value="Si">Si</option>
                                  <option value="No">No</option>
                              </select>
                          </td>
                          <td><textarea id="obser7"></textarea></td>
              </tr>
              <tr>
                  <td>CUIDADOR</td>
                  <td>
                              <select id="cond8">
                                  <option value="">Seleccione</option>
                                  <option value="Si">Si</option>
                                  <option value="No">No</option>
                              </select>
                          </td>
                          <td><textarea id="obser8"></textarea></td>
              </tr>
              <tr>
                  <td>ACCESIBILIDAD</td>
                  <td>
                              <select id="cond9">
                                  <option value="">Seleccione</option>
                                  <option value="Si">Si</option>
                                  <option value="No">No</option>
                              </select>
                          </td>
                          <td><textarea id="obser9"></textarea></td>
              </tr>
              <tr>
                  <td>ALMACENAMIENTO DE RESIDUOS</td>
                  <td>
                              <select id="cond10">
                                  <option value="">Seleccione</option>
                                  <option value="Si">Si</option>
                                  <option value="No">No</option>
                              </select>
                          </td>
                          <td><textarea id="obser10"></textarea></td>
              </tr>
              <tr>
                  <td>SEGURIDAD EN ENTORNO</td>
                  <td>
                              <select id="cond11">
                                  <option value="">Seleccione</option>
                                  <option value="Si">Si</option>
                                  <option value="No">No</option>
                              </select>
                          </td>
                          <td><textarea id="obser11"></textarea></td>
              </tr>
              <tr>
                  <td colspan="2">FUNCIONARIO QUE VERIFICA</td>
                  <td><select id="profx">
                                  <option value="">Seleccione</option>
                                  <?php
                                  $result3 = mysql_query("select usuario from usuarios where estado_empleado='Activo' ");
                                  while($r = mysql_fetch_array($result3)){
                                      echo '<option value="'.$r[0].'">'.$r[0].'</option>';
                                      
                                  }
                                  ?>
                              </select></td>
              </tr>
              <tr>

                  <td colspan="3">
                      <input type="text" id="idcon">
                      <button onclick="add_condiciones()">Guardar Condiciones</button> 
                      <button onclick="impc()">Imprimir</button>
                  </td>
              </tr>
          </tbody>
      </table>

  
    </div>
      
       <div id="menu5" class="tab-pane fade">
      <h3>FORMATO ENCUESTA COVID-19</h3>
      <table border="1" style="width: 100%">
          <thead>
              <tr>
                  <th colspan="2">¿Ha estado en alguno de estos países en los últimos 14 días? </th>

              </tr>
          </thead>
          <tbody>
              <tr>
                  <td>CHINA</td>
                          <td>
                              <select id="enc1">
                                  <option value="">Seleccione</option>
                                  <option value="Si">Si</option>
                                  <option value="No">No</option>
                              </select>
                          </td>
              </tr>
              <tr>
                  <td>ITALIA</td>
                          <td>
                              <select id="enc2">
                                  <option value="">Seleccione</option>
                                  <option value="Si">Si</option>
                                  <option value="No">No</option>
                              </select>
                          </td>
              </tr>
              <tr>
                  <td>JAPON</td>
                          <td>
                              <select id="enc3">
                                  <option value="">Seleccione</option>
                                  <option value="Si">Si</option>
                                  <option value="No">No</option>
                              </select>
                          </td>
              </tr>
              <tr>
                  <td>IRAN </td>
                          <td>
                              <select id="enc4">
                                  <option value="">Seleccione</option>
                                  <option value="Si">Si</option>
                                  <option value="No">No</option>
                              </select>
                          </td>
              </tr>
              <tr>
                  <td>VENEZUELA</td>
                          <td>
                              <select id="enc5">
                                  <option value="">Seleccione</option>
                                  <option value="Si">Si</option>
                                  <option value="No">No</option>
                              </select>
                          </td>
              </tr>
              <tr>
                  <td>PERU</td>
                          <td>
                              <select id="enc6">
                                  <option value="">Seleccione</option>
                                  <option value="Si">Si</option>
                                  <option value="No">No</option>
                              </select>
                          </td>
              </tr>
              <tr>
                  <td>COREA DEL SUR</td>
                          <td>
                              <select id="enc7">
                                  <option value="">Seleccione</option>
                                  <option value="Si">Si</option>
                                  <option value="No">No</option>
                              </select>
                          </td>
              </tr>
              <tr>
                  <td>ALEMANIA</td>
                          <td>
                              <select id="enc8">
                                  <option value="">Seleccione</option>
                                  <option value="Si">Si</option>
                                  <option value="No">No</option>
                              </select>
                          </td>
              </tr>
              <tr>
                  <td>ESTADOS UNIDOS</td>
                          <td>
                              <select id="enc9">
                                  <option value="">Seleccione</option>
                                  <option value="Si">Si</option>
                                  <option value="No">No</option>
                              </select>
                          </td>
              </tr>
              <tr>
                  <td>ESPAÑA</td>
                          <td>
                              <select id="enc10">
                                  <option value="">Seleccione</option>
                                  <option value="Si">Si</option>
                                  <option value="No">No</option>
                              </select>
                          </td>
              </tr>
              <tr>
                  <td>ECUADOR</td>
                          <td>
                              <select id="enc11">
                                  <option value="">Seleccione</option>
                                  <option value="Si">Si</option>
                                  <option value="No">No</option>
                              </select>
                          </td>
              </tr>
              <tr>
                  <td>PANAMA</td>
                          <td>
                              <select id="enc12">
                                  <option value="">Seleccione</option>
                                  <option value="Si">Si</option>
                                  <option value="No">No</option>
                              </select>
                          </td>
              </tr>
              <tr>
                  <th colspan="2"> ¿Ha tenido usted alguno de estos síntomas en los últimos 14 días?</th>

              </tr>
              <tr>
                  <td>MALESTAR GENERAL</td>
                          <td>
                              <select id="enc13">
                                  <option value="">Seleccione</option>
                                  <option value="Si">Si</option>
                                  <option value="No">No</option>
                              </select>
                          </td>
              </tr>
              <tr>
                  <td>DOLOR DE GARGANTA</td>
                          <td>
                              <select id="enc14">
                                  <option value="">Seleccione</option>
                                  <option value="Si">Si</option>
                                  <option value="No">No</option>
                              </select>
                          </td>
              </tr>
              <tr>
                  <td>DIFICULTAD PARA RESPIRAR</td>
                          <td>
                              <select id="enc15">
                                  <option value="">Seleccione</option>
                                  <option value="Si">Si</option>
                                  <option value="No">No</option>
                              </select>
                          </td>
              </tr>
              <tr>
                  <td>FIEBRE</td>
                          <td>
                              <select id="enc16">
                                  <option value="">Seleccione</option>
                                  <option value="Si">Si</option>
                                  <option value="No">No</option>
                              </select>
                          </td>
              </tr>
              <tr>
                  <td>TOS</td>
                          <td>
                              <select id="enc17">
                                  <option value="">Seleccione</option>
                                  <option value="Si">Si</option>
                                  <option value="No">No</option>
                              </select>
                          </td>
              </tr>
               <tr>
                  <td>MALESTAR ESTOMACAL</td>
                          <td>
                              <select id="enc19">
                                  <option value="">Seleccione</option>
                                  <option value="Si">Si</option>
                                  <option value="No">No</option>
                              </select>
                          </td>
              </tr>
              <tr>
                  <td>DIARREA</td>
                          <td>
                              <select id="enc20">
                                  <option value="">Seleccione</option>
                                  <option value="Si">Si</option>
                                  <option value="No">No</option>
                              </select>
                          </td>
              </tr>
              <tr>
                  <td>FATIGA</td>
                          <td>
                              <select id="enc21">
                                  <option value="">Seleccione</option>
                                  <option value="Si">Si</option>
                                  <option value="No">No</option>
                              </select>
                          </td>
              </tr>
              <tr>
                  <td>PERDIDA DEL OLFATO</td>
                          <td>
                              <select id="enc22">
                                  <option value="">Seleccione</option>
                                  <option value="Si">Si</option>
                                  <option value="No">No</option>
                              </select>
                          </td>
              </tr>
              <tr>
                  <td>PERDIDA DEL GUSTO</td>
                          <td>
                              <select id="enc23">
                                  <option value="">Seleccione</option>
                                  <option value="Si">Si</option>
                                  <option value="No">No</option>
                              </select>
                          </td>
              </tr>
              <tr>
                  <th colspan="2"> ¿En los últimos 14 días ha estado en contacto con personas que tuvieran alguno de los anteriores síntomas? </th>

              </tr>
              <tr>
                  <td></td>
                          <td>
                              <select id="enc18">
                                  <option value="">Seleccione</option>
                                  <option value="Si">Si</option>
                                  <option value="No">No</option>
                              </select>
                          </td>
              </tr>
     

              <tr>

                  <td colspan="2">
                      <input type="text" id="idenc">
                      <button onclick="add_encuenta()">Guardar Encuesta</button> 
                      <button onclick="impe()">Imprimir</button>
                  </td>
              </tr>
          </tbody>
      </table>

  
    </div>
  </div>
</div>
                  
                    
                    </legend>

 
                <b>Los campos que tienen * son obligatorios.</b>
                </fieldset>
            
              

    </body>
</html>
