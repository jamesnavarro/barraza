<script> 
   $(document).ready(function(){
       facturas(1);
        $('#numero').change(function(){
            facturas(1);
        });
        $('#tipo').change(function(){
            facturas(1);
        });
        $('#mes').change(function(){
            facturas(1);
        });
        $('#dia').change(function(){
            facturas(1);
        });
        $('#empresa').change(function(){
            facturas(1);
        });
        $('#paciente').change(function(){
            facturas(1);
        });
         $('#apellido').change(function(){
            facturas(1);
        });
         $('#t').change(function(){
            facturas(1);
        });
    });
    function Down(fact){
        window.open('../vistas/archivo_siigo_1.php?f='+fact,'Form','width=500, height= 200');
    }

    function facturas(page){
        var numero = $("#numero").val();
        var empresa = $("#empresa").val();
        var ano = $("#ano").val();
        var mes = $("#mes").val();
        var dia = $("#dia").val();
        var tipo = $("#tipo").val();
        var pac = $("#paciente").val();
        var ape = $("#apellido").val();
        var t = $("#t").val();
//        if(t=='OLD'){
        $.ajax({
            type:'GET',
            data:'numero='+numero+'&t='+t+'&empresa='+empresa+'&tipo='+tipo+'&pac='+pac+'&ape='+ape+'&est='+t+'&page='+page+'&ano='+ano+'&mes='+mes+'&dia='+dia,
            url:'../vistas/facturacion/mostrar_facturas.php',
            success : function(d){
                 $("#mostrar_facturas").html(d);
            }    
        });
//        }else{
//            $.ajax({
//            type:'GET',
//            data:'numero='+numero+'&t='+t+'&empresa='+empresa+'&tipo='+tipo+'&pac='+pac+'&ape='+ape+'&page='+page+'&ano='+ano+'&mes='+mes+'&dia='+dia,
//            url:'../vistas/facturacion/mostrar_facturas_fb.php',
//            success : function(d){
//                 $("#mostrar_facturas").html(d);
//            }    
//        });
//        }
    }
    </script>
<article class="module width_full">
			
            
           
                     
				<div class="module_content">
                                <header><h4 class="title">Lista de 
                                        <select id="t">
                                            <option value="">Factura Electronica</option>
                                            <option value="OLD">Facturas Viejas</option>   
                                        </select>
                                        
                                    </h4></header>
                                      
                                  <div>
                                  
                                              
                                        
                                      <table style="width:100%">
                                             <tr>
                                                 <td>Factura</td>
                                                 <td><input type="number" id="numero" value="" placeholder="# Factura"></td>
                                                 <td>Año de Facturacion</td>
                                                 <td><input id="ano" type="number" style="width:100px;" value="<?php echo date("Y"); ?>"></td>
                                             </tr>
                                             <tr>
                                                 <td>Tipo de Servicio :</td>
                                                 <td><select id="tipo" style="width:100px;height:30px;">
                                                        <option value="0">Todas</option>
                                                        <option value="1">Alquiler</option>
                                                        <option value="2">Atenciones</option>
                                                        <option value="3">Ventas</option>
                                                    </select></td>
                                                 <td>Mes de Facturacion</td>
                                                 <td> <select id="mes" style="width:100px;">
                                                                   <option value="%">Todas</option>
                                                                   <option value="01">Enero</option>
                                                                   <option value="02">Febrero</option>
                                                                   <option value="03">Marzo</option>
                                                                   <option value="04">Abril</option>
                                                                   <option value="05">Mayo</option>
                                                                   <option value="06">Junio</option>
                                                                   <option value="07">Julio</option>
                                                                   <option value="08">Agosto</option>
                                                                   <option value="09">Septiembre</option>
                                                                   <option value="10">Octubre</option>
                                                                   <option value="11">Noviembre</option>
                                                                   <option value="12">Diciembre</option>
                                                                   
                                                                   
                                                </select></td>
                                             </tr>
                                             <tr>
                                                 <td>Empresa</td>
                                                 <td><select id="empresa">     
                                                          <option value="">Seleccione la empresa</option>
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
                                                        </select></td>
                                                 <td>Dia de Facturacion</td>
                                                 <td> <input id="dia" style="width:40px;" value="" placeholder="Dia" type="number"></td>
                                             </tr>
                                             <tr>
                                                 <td>Nombre del Paciente</td>
                                                 <td><input id="paciente" value="" placeholder="" type="text"></td>
                                                 <td>Apellidos</td>
                                                 <td><input id="apellido" value="" placeholder="" type="text"></td>
                                             </tr>
                                                 
                                             
                                             
                                        </table>
                                      <input type="button" name="buscar" value="Buscar" class="alt_btn" onclick="facturas(1);">
                                                <input type="reset" value="Limpiar">
                                        
                                        
                                    
                                                        
				    </div>
                                    <div id="mostrar_facturas">
                                        
                                    </div>
     
                                        
                                               
                                  </fieldset>   
				</div>
                       
		</article>
