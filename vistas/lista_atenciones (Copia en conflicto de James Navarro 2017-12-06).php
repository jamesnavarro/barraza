<?php 
include('../modelo/conexion.php');
?>
<script type="text/javascript" language="javascript" src="../vistas/atenciones/funciones.js"></script>
<script>
 $(document).ready(function() {
   $("#panel").load("atenciones/estados.php");
//   $("#mostrar").load("atenciones/mostrar_tabla.php");
   var refreshId = setInterval(function() {
      $("#panel").load('atenciones/estados.php');
   }, 10000);
   $.ajaxSetup({ cache: false });
});
function Receta(oi){
    window.open('../resumen/receta.php?cod='+oi,'Form','width=800,height=800');
}
</script>
<body onload="MostrarAtenciones(1);">
<div class="row-fluid">
    <section class="body">
        <div class="body-inner">
            <div class="span12 widget dark stacked">
                <header>
                    <h4 class="title">Ordenes Internas</h4>
                        <ul class="toolbar pull-left">
                            <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>
                        </ul>
                </header>
                <section id="collapse1" class="body collapse in">
                    <div class="body-inner">
  
                            <div class="control-group">
                
                                <div class="controls">
                                    <div class="row-fluid">
                                            <table style="border:1px solid #000000;width: 100%" bgcolor="afcae3">
                                             <tr>
                                               
                                            
                                            <td><label># Orden Interna</label></td>
                                                <td><input id="interna" style="width:130px;" placeholder="Orden Interna" autofocus></td>
                                                <td><label>Estado de la orden:</label></td>
                                                           <td><select id="estado" style="width:130px">
                                                                  <?php if($_SESSION["area"]=='OFICINA'){ ?> <option value="">..Todas...</option><?php } ?>
                                                                   <option value="0">No Iniciada</option>
                                                                   <option value="97">En proceso</option>
                                                                   <?php if($_SESSION["area"]=='OFICINA'){ ?>
                                                                   <option value="99">Completada</option>
                                                                   <option value="101">No Iniciada y En proceso</option>
                                                                       <?php } ?>
                                                               </select></td>
                                                </tr>
                                                
                                                 <tr>
                                                     <td><label># Orden Externa:</label></td>
                                                     <td><input id="externa" style="width:130px;" placeholder="Orden Externa" ></td>
                                                
                                                           <td><label>Facturadas :</label></td>
                                                           <td><select id="facturadas" style="width:130px;">
                                                                   <option value="">..Todas...</option>
                                                                   <option value="activa">No Facturado</option>
                                                                   <option value="Facturado">Facturado</option>   
                                                                   <option value="No Facturable">No Facturable</option> 
                                                                </select></td>
                                                 </tr> 
                                                           <tr>
                                                                <td><label># documento:</label></td>
                                                                <td><input id="documento" style="width:130px;" placeholder="Numero Cedula"></td>
                                                
                                                           <td><label>Ordenes Revisadas :</label></td>
                                                           <td><select id="revisadas" style="width:130px;">
                                                                   <option value="">..Todas...</option>
                                                                   <option value="x">Sin Revisar</option>
                                                                   <option value="Revisado">Revisadas</option>
                                                                 </select></td>
                                                               
                                                           </tr> 
                                                           <tr>
                                                  <td><label>Nombre del Paciente</label></td>
                                                  <td><input id="nombre" style="width:90px;" placeholder="Nombres"> <input id="apellido" style="width:90px;" placeholder="Apellidos"></td>
                                                           <td><label>asignado a :</label></td>
                                                           <td><input type="text" id="asignado" onclick="list_user()" style="width:90px;" placeholder="Usuarios"></td>
                                                           </tr> 
                                                           <tr>
                                                               <td><label>Empresa :</label></td>
                                                               <td>
                                                                   <select id="empresa" style="width:150px;">
                                                                   
                                                          <option value="">Todas..</option>
                                                          <?php
                                                            include "../modelo/conexion.php";
                                                            $consulta= "select * from sis_empresa where cliente='Si'";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1=$fila['rips'];
                                                            $valor2=$fila['nombre_emp'];
                                                         

                                                            echo"<option value='".$valor1."'>".$valor2."</option>";
                                                            
                                                            }
                                                            ?>
                                                            
                                                            
                                                        </select>
                                                               </td>
                                                               <td><label>Fecha de ingreso Del :</label></td>
                                                               <td><input id="desde"  type="text" placeholder="2016/12/01" value="" style="width:120px;"></td>
                                                           </tr>
                                            
                                            <tr>
                                                <td><input type="button" onclick="MostrarAtenciones(1);" value="Buscar" class="btn-primary">
                                                    <input type="reset" value="Limpiar" onclick="limpiar_atenciones();"  class="btn-danger"><span  id="cargar"></span></td><td><select id="filas" style="width: 60px" title="Mostrar Filas de:" data-toggle="tooltip">
                                                           <option value="5">5</option>
                                                           <option value="10">10</option>
                                                           <option value="25">25</option>
                                                           <option value="50">50</option>
                                                       </select></td>
                                                <td><label>Hasta :</label></td><td><input id="hasta" type="text" placeholder="2016/12/30" value="" style="width:120px;"></td>
                                              
                                               
                                            </tr>
                                        </table>    
                                    </div>
                                </div>
                            </div>
                     <br>
                     
                        <div class="tabbable" style="margin-bottom: 25px;">
                            <div class="tab-content">
                                <span id="panel">Cargando Panel de Estado....</span> 
                                <div class="" id="tab1">
                                    <div class="row-fluid">
                                        <div class="span12 widget lime">
                                            <input type="hidden" id="permiso" value="<?php echo $_SESSION['k_username']; ?>" >
                                            <section class="body">
                                                <div class="body-inner no-padding">
                                                       <p id="msg"></p>
                                                     
        <div id="mostrar">
            <img src="../imagenes/spinner.gif"> Cargando datos espere unos cuantos segundos....
        </div>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</div>

</body>