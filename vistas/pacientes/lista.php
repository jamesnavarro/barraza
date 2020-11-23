<?php 
if(isset($_GET['no'])){
    $request2=mysql_query('SELECT * FROM pacientes where estado="No Activo" ');
    $no_act = mysql_num_rows($request2);
}
 $request=mysql_query('SELECT * FROM pacientes where estado="ACTIVO" ');
if($request){
	$request = mysql_num_rows($request);
        if(isset($_GET['no'])){
            $num_items = $no_act - $request;
        }else{
           $num_items = $request; 
        }
	
}else{
	$num_items = 0;
}
$rows_by_page = 30;

$last_page = ceil($num_items/$rows_by_page);

if(isset($_GET['page'])){
	$page = $_GET['page'];
}else{
	$page = 1;
}
?>  

<div class="row-fluid">
    <section class="body">
        <div class="body-inner">
            <div class="span12 widget dark stacked">
                <header>
                    <h4 class="title">Lista de Pacientes</h4>
                        <ul class="toolbar pull-left">
                            <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>
                        </ul>
                </header>
                <section id="collapse1" class="body collapse in">
                    <div class="body-inner">
                        <form class="" action="" method="post" id="" enctype="multipart/form-data">
                            <div class="control-group">
                                <label class="control-label">Buscar</label>
                                <div class="controls">
                                    <div class="row-fluid">
                                       <?php
                                       include '../modelo/buscar_paciente.php';
                                       ?>
                                    </div>
                                </div>
                            </div>
                        </form><br>
                     
                        <div class="tabbable" style="margin-bottom: 25px;">
                            <div class="tab-content">
                                <div class="" id="tab1">
                                    <div class="row-fluid">
                                        <div class="span12 widget lime">
                                            <section class="body">
                                                <div class="body-inner no-padding">
                                                    <?php
                                                    if(isset($_GET['ok'])){
                                                    include '../modelo/tabla_de_pacientes.php';
                                                    }else{
                                                        include '../modelo/tabla_de_pacientes_no.php';
                                                    }
                                                    ?>
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
<?php
 if(isset($_GET['del'])){
     if($eliminar_pac!='Habilitado'){
     echo '<script lanquage="javascript">alert("Usted no tiene permiso para eliminar");location.href="../vistas/?id=pacientes"</script>'; 
}else{
     echo '<script lanquage="javascript">alert("Usted no puede eliminar un registro de paciente");location.href="../vistas/?id=pacientes"</script>'; 

}
 }
?>