<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="shortcut icon" href="../traz.ico">
    <title>Lista de profesionales</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, user-scalable=0, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="../css/style.css"> 
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" id="base-color" href="../css/color/serene.css"><!-- Base Theme Color -->
    <link rel="stylesheet" id="base-bg" href="../css/background/bg1.css"><!-- Boxed Background -->
    <link rel="stylesheet" href="../assets/themer/css/jquery.themer.min.css">
    <script src="../assets/modernizr/js/modernizr-2.6.2.min.js"></script>
<!-- indispensable para cargar municipios-->
    <script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
    <script src="../js/ajax.js" type="text/javascript"></script>
    <script>
    function pasar_puc(){
    window.opener.profesional(document.getElementById('usu').value);
    window.close();

}
function MostrarUsuarios(page){
    var asesor = $('#asesor').val();
    var estado = $('#estado').val();
		$.ajax({
				type: 'POST',
				data: 'estado='+estado+'&asesor='+asesor,
				url: '../combos/buscador_asesor.php',
				success: function(data){
			                        $('#asesores').html(data);
                                               
				}
			});
		return false;
}
$(function() {
           $('#asesor').change(function(){
		MostrarUsuarios(1);
	});
                $('#estado').change(function(){
		MostrarUsuarios(1);
	});
});
        </script>    
</head>
<body onload="pasar_puc();">
    
<div class="row-fluid">
                        <!-- START Form Wizard -->
                      <!-- START Widget Collapse -->
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Listado De Vendedores</h4>
                                <!-- START Toolbar -->

                                <!--/ END Toolbar -->
                            </header>
                            <section id="collapse2" class="body collapse in">
                                <div class="body-inner">
      
                                            <!-- Normal Tabs -->
                            
                            <div class="tabbable" style="margin-bottom: 25px;">
            
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab1">
                                         <!-- START Row -->
                    <div class="row-fluid">
                        <!-- START Datatable 2 -->
                        <div class="span12 widget lime">
                            
                            <section class="body">
                                <div class="body-inner no-padding">

<?php

include "../modelo/conexion.php";
     if(isset($_GET['codigo'])){
                     
     //$request2=mysql_query('SELECT * FROM `usuarios` where area = "Ventas" and id_user='.$_GET['codigo'].' order by nombre');
     $request2=mysql_query('SELECT * FROM `usuarios` where id='.$_GET['codigo'].' order by nombre');
     
     while($row2=mysql_fetch_array($request2))
	{     
          
              $id = $row2["id_user"];
              $doc = $row2["cod_barra"];
              $usuario = $row2["usuario"];
           ?>
    

    <input type="text" name="cost1" id="id" readonly value="<?php echo $id ?>" />
    <input type="text" name="cost2" id="doc" readonly value="<?php echo $doc ?>" />
    <input type="text" name="cost3" id="usu" readonly value="<?php echo $usuario ?>" />

<a href="" title="pasar valor" onload="javascript:pasar_puc();"><input type="button" name="cerrar" value="Cargar"  onclick="window.close();"></a>  
      
     <?php }
        }else{
                    
  ?> 
<input type="text" name="asesor" id="asesor" class="span8" autofocus autocomplete="off" placeholder="Buscar por nombre">
<select id="estado">
    <option value="Activo">Activo</option>
    <option value="No Activo">No Activo</option>
    <option value="Despedido">Despedido</option>
</select>
 <div id="asesores">
<?php   include '../combos/buscador_asesor.php'; ?>
     </div>   

  <?php

        }
  
?>

                                </div>
                            </section>
                        </div>
                        <!--/ END Datatable 2 -->
                    </div>
                    <!--/ END Row -->
                                    </div>
                                    <div class="tab-pane" id="tab2">
                                        <div class="row-fluid">
                  
                        <!--/ END Form Wizard -->
                    </div>
                                    </div>
                                </div>
                            </div><!--/ Normal Tabs -->
                                </div>
                            </section>
                        </div>
                    </div>
 </section></div>
</body>
</html>
        <?php require '../vistas/script.php';  ?>

         

                              
                                
