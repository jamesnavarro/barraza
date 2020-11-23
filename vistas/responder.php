<?php 
session_start();
include '../modelo/conexion.php';  ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="shortcut icon" href="../traz.ico">
    <title>Templado S.A</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, user-scalable=0, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="../css/style.css"> 
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" id="base-color" href="../css/color/serene.css"><!-- Base Theme Color -->
    <link rel="stylesheet" id="base-bg" href="../css/background/bg1.css"><!-- Boxed Background -->
    <link rel="stylesheet" href="../assets/jui/css/jquery-ui-1.10.3.min.css">
    <link rel="stylesheet" href="../assets/snippet/css/jquery.snippet.min.css">
    <link rel="stylesheet" href="../assets/scrollbar/css/perfect-scrollbar.min.css">
    <link rel="stylesheet" href="../assets/icheck/css/jquery.icheck.min.css">
    <link rel="stylesheet" href="../assets/select2/css/select2.min.css">
    <link rel="stylesheet" href="../assets/minicolor/css/jquery.minicolors.min.css">
    <link rel="stylesheet" href="../assets/wysiwyg/cleditor/css/jquery.cleditor.min.css">
    <link rel="stylesheet" href="../assets/formvalidation/validationengine/css/jquery.validationEngine.min.css">
    <link rel="stylesheet" href="../assets/tagit/css/jquery.tagit.min.css">
    <link rel="stylesheet" href="../assets/fullcalendar/css/fullcalendar.min.css">
    <link rel="stylesheet" href="../assets/prettyphoto/css/prettyphoto.min.css">
    <link rel="stylesheet" href="../assets/datatable/css/dataTables-bootstrap.min.css">
    <link rel="stylesheet" href="../assets/switch/css/bootstrapSwitch.min.css">
    <link rel="stylesheet" href="../assets/daterangepicker/css/daterangepicker.min.css">
    <link rel="stylesheet" href="../assets/bootstrap-fileupload/css/bootstrap-fileupload.min.css">
    <link rel="stylesheet" href="../assets/gritter/css/jquery.gritter.min.css">
    <link rel="stylesheet" href="../assets/themer/css/jquery.themer.min.css">
    <script src="../assets/modernizr/js/modernizr-2.6.2.min.js"></script>
<!-- indispensable para cargar municipios-->
    <script type="text/javascript" src="../js/jquery.equalHeight.js"></script>
    <script src="../js/jquery.tablesorter.min.js" type="text/javascript"></script>
    <script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
    <script src="../js/ajax.js" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
	 $('#tabla').dataTable();
});
        
        </script>
</head>
<body>
<div class="row-fluid">

                        <!-- START Form Wizard -->

                      <!-- START Widget Collapse -->

                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header>

                                <h4 class="title">Responder Correo</h4>

                            </header>

                            <section id="collapse1" class="body collapse in">                      
                                <div class="body-inner">
                                   
                            <div class="tabbable" style="margin-bottom: 25px;">

                        

                                <div class="tab-content">

                     <form  action="" class="span12 widget stacked dark form-horizontal bordered" method="post">

                                   
                                     <div class="control-group">
                                        <label class="control-label"></label>
                                      
                                        <a href="../vistas/checkeds_usuarios.php" title="Seleccionar usuarios" target="_blank" onClick="window.open(this.href, this.target, 'width=800,height=800'); return false;"><img src="../imagenes/user.png"> Seleccionar Usuarios</a>
                                         <!-- CLEditor -->
                                         <br>
                                        <label class="control-label">Asunto</label>
                                        <div class="controls">
                                            <input type="text" name="asunto" value="<?php echo 'Fwd: '.$_GET['asunto'];  ?>" class="span10">
                                        </div>
                                   
                                        <input type="hidden" value="<?php echo $_GET['cod'];  ?>" name="de" class="span10">
                                         <ul>
                                                <?php 
                                                
                                                $us = mysql_query("select * from usuarios where id=".$_GET['cod']." ");
                                                $u = mysql_fetch_array($us);
                                                echo 'Responder a: '.$u['nombre'].' '.$u['apellido'];
                                                $sele = mysql_query("select * from usuarios a, correos_para b where a.id=b.id_user and b.id_correo=0 and b.id_de=".$_SESSION['id_user']." ");
                                                $a = 0;
                                                while ($f = mysql_fetch_array($sele)){
                                                    $a +=1;
                                                    echo '<li>'.$f['nombre'].' '.$f['apellido'].' <a href="../vistas/?id=redactar&del='.$f["id_para"].'"><img src="../imagenes/cancelar.png"></a></li>';
                                                }
                                                ?>
                                             
                                                
                                         </ul>
                                        
                                 
                                    <div class="control-group">
                                        <label class="control-label"></label>
                                        <div class="controls">
                                            <textarea class="cleditor" name="mensaje"><?php  echo '<br><br><br>-----------Mensaje Reenviado----------<br>'.$_GET['msg']  ?></textarea>
                                        </div>
                                    </div><!--/ CLEditor -->
                                    
                                         <div class="form-actions">             
                                             <input type="submit" name="send" class="btn btn-primary" value="Enviar">
                                        
                                       <button type="reset" class="btn">Cancelar</button>
                                       
                                    </div><!--/ Form Action -->
                             
                            </div>
                        </form>
                            </div><!--/ Normal Tabs -->

                                </div>

                            </section>

                        </div>

                    </div>

                            </section></div>
<?php
if(isset($_GET['add'])){

    if(isset($_POST["cant"]))
    {
        $n = $_POST["cant"];
        $c = 0;
        for($x=1; $x<=$n; $x=$x+1){
            if(isset($_POST["id$x"])){
                $c += 1;
                include "../modelo/conexion.php";
  
        
            
            $sql = "INSERT INTO `producto_rep_ad` (`id_ref_ad`, `id_p`)";
            $sql.= "VALUES ('".$_POST["id$x"]."', '".$_GET['cod']."')";
            mysql_query($sql, $conexion);

            }
          
            }   
          
                        
 echo "<script language='javascript' type='text/javascript'>";
echo "window.opener.document.location.reload();self.close();";
echo "</script>";

            }}

if(isset($_POST['send'])){
    
     $sql = "INSERT INTO `correos` (`asunto`,`id_de`, `mensaje`, `estado`)";
        $sql.= "VALUES ('".$_POST['asunto']."','".$_SESSION['id_user']."', '".$_POST['mensaje']."', 'Enviado')";
	mysql_query($sql, $conexion);
        
        $sell = mysql_query("select max(id_correo) from correos");
        $m = mysql_fetch_array($sell);
        $max += $m['max(id_correo)'];
        
            $sql3 = "INSERT INTO `correos_para` (`id_user`,`id_de`,`id_correo`)";
            $sql3.= "VALUES ('".$_POST["de"]."','".$_SESSION["id_user"]."', '".$max."')";
            mysql_query($sql3, $conexion);

         
 echo "<script language='javascript' type='text/javascript'>";
echo "window.opener.document.location.reload();self.close();";
echo "</script>";
                
}
?>
     <?php require '../vistas/script.php';  ?>
</body>
</html>
