<?php 
include "../modelo/conexion.php";
//session_start();
require '../modelo/consultar_permisos.php';
if($_SESSION["area"]=='OFICINA'){
    //    include '../vistas/pagina_principal/listado.php';
    ?>
<?php 
include '../vistas/alquiler/facturacion_recibo/consulta.php';
 ?>
  <script> 
var ventana_secundaria 


function editar(){  
ventana_secundaria = window.open("../vistas/editar_precio_alq.php?cod=<?php echo $arch.'&fact='.$_GET['fact'] ?>","miventana","width=600,height=600,menubar=no") 
} 

function cerrarVentana(){ 
ventana_secundaria.close() 
} 
</script>
<div class="row-fluid">
    <section class="body">
        <div class="body-inner">
            <div class="span12 widget dark stacked">
                <header>
                    <h4 class="title"><span class="icon icone-crop"></span>Recibo de Caja No : <?php echo $num_fact ?></h4>
                     <span class="label label-important"></span>
                </header>                
                <section id="collapse1" class="body collapse in">
                    <div class="body-inner">
                        <div class="tab-content">
                            <div class="row-fluid">
                                <div class="span12 widget lime">
                                    <div class="body-inner no-padding">
                                        <?php
                                        include '../vistas/alquiler/facturacion_recibo/tabla1.php';
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>    
                </section>
            </div>           
        </div>
    </section>
      <section class="body">
        <div class="body-inner">
            <div class="span12 widget dark stacked">
                <header>
                    <h4 class="title"><span class="icon icone-crop"></span>SERVICIOS PRESTADOS/ELEMENTOS  <input type="button" name="cancelar" value="Editar Precios" onclick="editar()"></h4>
                     <span class="label label-important"></span>
                </header>                
                <section id="collapse1" class="body collapse in">
                    <div class="body-inner">
                        <div class="tab-content">
                            <div class="row-fluid">
                                <div class="span12 widget lime">
                                    <div class="body-inner no-padding">
                                        <?php
                                        include '../vistas/alquiler/facturacion_recibo/tabla2.php';
                                        ?>
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
<?php
}?>
   