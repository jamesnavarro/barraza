 <div class="row-fluid">
                        <!-- START Form WYSIWYG Editor -->
                        <form  action="" class="span12 widget stacked dark form-horizontal bordered" method="post">
                            <header>
                                <h4 class="title">Correo Interno IDB</h4>
                            </header>
                            <section class="body">
                                <div class="body-inner">
                                   
                                     <div class="control-group">
                                        <label class="control-label"></label>
                                        <div class="controls">
                                        <a href="../vistas/checkeds_usuarios.php" title="Seleccionar usuarios" target="_blank" onClick="window.open(this.href, this.target, 'width=800,height=800'); return false;"><img src="../imagenes/user.png"> Seleccionar Usuarios</a>
                                         <!-- CLEditor -->
                                    <div class="control-group">
                                        <label class="control-label">Asunto</label>
                                        <div class="controls">
                                            <input type="text" name="asunto" class="span10">
                                        </div>
                                    </div><!--/ CLEditor -->
                                        <div class="control-group">
                                         <ul>
                                                <?php 
                                                $sele = mysql_query("select * from usuarios a, correos_para b where a.id=b.id_user and b.id_correo=0 and b.id_de=".$_SESSION['id_user']." ");
                                                $a = 0;
                                                while ($f = mysql_fetch_array($sele)){
                                                    $a +=1;
                                                    echo '<li>'.$f['nombre'].' '.$f['apellido'].' <a href="../vistas/?id=redactar&del='.$f["id_para"].'"><img src="../imagenes/cancelar.png"></a></li>';
                                                }
                                                ?>
                                             
                                                
                                         </ul>
                                        
                                  
                                        </div>
                                    </div><!--/ CLEditor -->
                                    <div class="control-group">
                                        <label class="control-label"></label>
                                        <div class="controls">
                                            <textarea class="cleditor" name="mensaje"></textarea>
                                        </div>
                                    </div><!--/ CLEditor -->
                                    <?php if($a!=0){      ?>
                                         <div class="form-actions">             
                                             <input type="submit" name="send" class="btn btn-primary" value="Enviar">
                                        
                                       <button type="reset" class="btn">Cancelar</button>
                                       <?php } ?>
                                    </div><!--/ Form Action -->
                                </div>
                            </section>
                        </form>
                        <!--/ END Time Picker -->
                    </div>

<?php
  if(isset($_GET['del'])){
$sql = "DELETE FROM correos_para WHERE id_para=".$_GET['del']."";
mysql_query($sql, $conexion);
echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=redactar'";
echo "</script>";
}
if(isset($_POST['send'])){
    
     $sql = "INSERT INTO `correos` (`asunto`,`id_de`, `mensaje`, `estado`)";
        $sql.= "VALUES ('".$_POST['asunto']."','".$_SESSION['id_user']."', '".$_POST['mensaje']."', 'Enviado')";
	mysql_query($sql, $conexion);
        
        $sell = mysql_query("select max(id_correo) from correos");
        $m = mysql_fetch_array($sell);
        $max += $m['max(id_correo)'];
        
        
         $sql2 = "UPDATE `correos_para` SET `id_correo` = '".$max."'  WHERE `id_de`=".$_SESSION['id_user']." and id_correo=0  ;";            
         mysql_query($sql2, $conexion);
         
         echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/?id=recibidos'";
echo "</script>";
                
}