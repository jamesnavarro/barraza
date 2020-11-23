<?php  require '../modelo/consulta_usuario.php'; ?>
<script type="text/javascript" language="javascript" src="../vistas/liquidacion/funciones.js"></script>
 <script> 
var ventana_secundaria 
function change_pass(){  
ventana_secundaria = window.open("../vistas/form_contrasena.php","miventana","width=500,height=200,menubar=no");
} 
</script>
<article class="module width_full">
              <article class="">
			<header  onload="recargar()"><h3>Lista de liquidaciones</h3></header>
                        <hr>
                         Año <input type="year" id="ano" class="span1" value="<?php echo date("Y") ?>"> Mes: 
                        <select id="mes" class="span2">
                            <option value="">Todas</option>
                        <option value="01" <?php if(date("m")=='01'){ echo 'selected'; } ?>>Enero</option>
                        <option value="02" <?php if(date("m")=='02'){ echo 'selected'; } ?>>Febrero</option>
                        <option value="03" <?php if(date("m")=='03'){ echo 'selected'; } ?>>Marzo</option>
                        <option value="04" <?php if(date("m")=='04'){ echo 'selected'; } ?>>Abril</option>
                        <option value="05" <?php if(date("m")=='05'){ echo 'selected'; } ?>>Mayo</option>
                        <option value="06" <?php if(date("m")=='06'){ echo 'selected'; } ?>>Junio</option>
                        <option value="07" <?php if(date("m")=='07'){ echo 'selected'; } ?>>Julio</option>
                        <option value="08" <?php if(date("m")=='08'){ echo 'selected'; } ?>>Agosto</option>
                        <option value="09" <?php if(date("m")=='09'){ echo 'selected'; } ?>>Septiembre</option>
                        <option value="10" <?php if(date("m")=='10'){ echo 'selected'; } ?>>Octubre</option>
                        <option value="11" <?php if(date("m")=='11'){ echo 'selected'; } ?>>Noviembre</option>
                        <option value="12" <?php if(date("m")=='12'){ echo 'selected'; } ?>>Diciembre</option>
                        </select>
                         Profesional <input type="text" id="pro" class="span3"> No. Orden <input type="text" id="ord" class="span1">
                        <button type="button" class="btn-primary" onclick="MostrarLista(1)">
                             Filtrar</button> <span id="load"></span>
                        <div id="lista">
                             <?php 
                                 include '../vistas/liquidacion/lista_liquidaciones.php'; 
                             ?>
                        </div>
                       
		</article></article>


