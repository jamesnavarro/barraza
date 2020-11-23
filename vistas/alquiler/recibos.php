<?php 
include "../modelo/conexion.php";
require '../modelo/consultar_permisos.php';
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
$request=  mysql_query('select count(*) from recibo_caja');
 
if($request){
	$request = mysql_fetch_row($request);
	$num_items = $request[0];
}else{
	$num_items = 0;
}
$rows_by_page = 10;

$last_page = ceil($num_items/$rows_by_page);

if(isset($_GET['page'])){
	$page = $_GET['page'];
}else{
	$page = 1;
}$_SESSION['formnn'] = $_POST;
if($_SESSION["area"]=='OFICINA'){
    //    include '../vistas/pagina_principal/listado.php';
    ?>
<div class="row-fluid">
    <section class="body">
        <div class="body-inner">
            <div class="span12 widget dark stacked">
                <header>
                    <h4 class="title"><span class="icon icone-crop"></span>RECIBO DE CAJA</h4>
                     <span class="label label-important"></span>
                </header>                
                <section id="collapse1" class="body collapse in">
                    <div class="body-inner">
                       
                            
                            <div class="tab-content">
                                
                                    <div class="row-fluid">
                                        <div class="span12 widget lime">
                                            
                                                <div class="body-inner no-padding">
                                                    <?php
                                                        include '../vistas/alquiler/tabla_alquileres.php';
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
   
