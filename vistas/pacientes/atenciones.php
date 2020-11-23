<div class="row-fluid">
    <section class="body">
        <div class="body-inner">
            <div class="span12 widget dark stacked">
                <header>
                    <h4 class="title">Auditoria de  Atenciones por Mes</h4>
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
                                       <div class="span4">
                                           <input type="text" class="span2" name="ano" value="<?php if(isset($_POST['Buscar'])){echo $_POST['ano']; }else{ echo date("Y");} ?>" required>
                                            <select  name="mes"  class="span3">
                                                <?php if(isset($_POST['Buscar'])){echo '<option value="'.$_POST['mes'].'">'.$_POST['mes'].'</option>'; } ?>
                                                <option value='<?php echo date("m") ?>'><?php echo date("m") ?></option>
                                                <option value='01'>01</option>
                                                <option value='02'>02</option>
                                                <option value='03'>03</option>
                                                <option value='04'>04</option>
                                                <option value='05'>05</option>
                                                <option value='06'>06</option>
                                                <option value='07'>07</option>
                                                <option value='08'>08</option>
                                                <option value='09'>09</option>
                                                <option value='10'>10</option>
                                                <option value='11'>11</option>
                                                <option value='12'>12</option>
                                            </select> 
                                           <input type="submit" class="btn" name="Buscar" value="Buscar">
                                            <?php
                                                if (isset($_POST['Buscar'])){ ?>
                                                <button type="button" class="btn"><a href="../vistas/auditoria_excel_1.php?ano=<?php echo $_POST['ano'].'&mes='.$_POST['mes'] ?>">Exportar</a></button>
                                            <?php } ?>
                                        </div>
                                        
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

if(isset($_POST['Buscar'])){
$fer = $_POST['ano'].'/'.$_POST['mes'];
$request=mysql_query("SELECT *, count(cant) FROM actividad where fecha_reg_ta like '".$fer."%' group by Description order by count(cant) desc");
if($request){
    $table = '<table class="table table-bordered table-striped table-hover" id="">';

              $table = $table.'<thead>';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th>'.'Items'.'</th>';

              $table = $table.'<th>'.'Atencion'.'</th>';
              $table = $table.'<th>'.'Cantidad Atenciones'.'</th>';
               $table = $table.'<th>'.'Cantidad Ordenes'.'</th>';
              
             
              $table = $table.'<th>'.'Fecha de Registro'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
       $cont=0;
	while($row=mysql_fetch_array($request))
	{     
         $sub= mysql_query("SELECT * FROM `actividad` where Description='".$row["Description"]."' and fecha_reg_ta like '".$fer."%' group by orden_servicio");
            
             $ord = mysql_num_rows($sub);
         $cont = $cont + 1 ;
if($_POST['mes']=='01'){$mes = 'ENERO';}
if($_POST['mes']=='02'){$mes = 'FEBRERO';}
if($_POST['mes']=='03'){$mes = 'MARZO';}
if($_POST['mes']=='04'){$mes = 'ABRIL';}
if($_POST['mes']=='05'){$mes = 'MAYO';}
if($_POST['mes']=='06'){$mes = 'JUNIO';}
if($_POST['mes']=='07'){$mes = 'JULIO';}
if($_POST['mes']=='08'){$mes = 'AGOSTO';}
if($_POST['mes']=='09'){$mes = 'SEPTIEMBRE';}
if($_POST['mes']=='10'){$mes = 'OCTUBRE';}
if($_POST['mes']=='11'){$mes = 'NOVIEMBRE';}
if($_POST['mes']=='12'){$mes = 'DICIEMBRE';}

  $table = $table.'<tr><td>'.$cont.'<font></a></td>'
                    . '<td>'.$row["Description"].'</font></td>'
                    . '<td>'.$row["count(cant)"].'</font></td>'
           . '<td>'.$ord.'</font></td>'
                    . '<td>'.$mes.'</font></td>'
                    . '
                   
                       </tr>';   
               
           
               
	}
        
	$table = $table.'</table>';
        
	echo $table;

}       
}else{
    ?> 
                                                    <p><h4>Reporte de Atenciones por mes.<br><hr>!Seleccione el año y el mes para imprimir el reporte¡</h4></p>                                              
                                                    <?php
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
