<?php 
session_start();
if(isset($_SESSION['k_username'])){
include "../modelo/conexion.php";
require '../modelo/consultar_permisos.php';
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
if(isset($_GET['orden'])){
$sql1 = "SELECT *, max(curacion_no) as no FROM curaciones where id_visita=".$_GET['codigo']."";
$fila1 =mysql_fetch_array(mysql_query($sql1));
$no = $fila1["no"]+1;
}else{
$sql1 = "SELECT *, max(curacion_no) as no FROM curaciones where id_visita=".$_GET['codigo']."";
$fila1 =mysql_fetch_array(mysql_query($sql1));
$no = $fila1["no"]+1;
}
if(isset($_GET['orden'])){
$sql2 = "SELECT * FROM actividad where Id=".$_GET['codigo']."";
$fila2 =mysql_fetch_array(mysql_query($sql2));
$num_visita = $fila2["cant_ins"];}
?>
<!doctype html>
<html lang="en">
    <head>
	<meta charset="utf-8"/>
	<title>Curaciones</title>
	 <link rel="stylesheet" href="../css/stilo1.css" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" href="../css_menu/menu.css" />
        <link href="../vistas/doc.ico" type="image/x-icon" rel="shortcut icon" />
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap-responsive.min.css">
	<script type="text/javascript" src="../js/jquery.equalHeight.js"></script>
        <script src="../js/jquery.tablesorter.min.js" type="text/javascript"></script>
        <script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
        <script src="../js/ajax.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="../resources/screen.css" />
        <link rel="stylesheet" type="text/css" href="../resources/style.css" />
    </head>
        <style>
            .CSSTableGenerator {
                    margin:0px;padding:0px;
                    width:100%;
                    border:1px solid #000000;

                    -moz-border-radius-bottomleft:11px;
                    -webkit-border-bottom-left-radius:11px;
                    border-bottom-left-radius:11px;

                    -moz-border-radius-bottomright:11px;
                    -webkit-border-bottom-right-radius:11px;
                    border-bottom-right-radius:11px;

                    -moz-border-radius-topright:11px;
                    -webkit-border-top-right-radius:11px;
                    border-top-right-radius:11px;

                    -moz-border-radius-topleft:11px;
                    -webkit-border-top-left-radius:11px;
                    border-top-left-radius:11px;
            }.CSSTableGenerator table{
                border-collapse: collapse;
                    border-spacing: 0;
                    width:100%;
                    height:100%;
                    margin:0px;padding:0px;
            }.CSSTableGenerator tr:last-child td:last-child {
                    -moz-border-radius-bottomright:11px;
                    -webkit-border-bottom-right-radius:11px;
                    border-bottom-right-radius:11px;
            }
            .CSSTableGenerator table tr:first-child td:first-child {
                    -moz-border-radius-topleft:11px;
                    -webkit-border-top-left-radius:11px;
                    border-top-left-radius:11px;
            }
            .CSSTableGenerator table tr:first-child td:last-child {
                    -moz-border-radius-topright:11px;
                    -webkit-border-top-right-radius:11px;
                    border-top-right-radius:11px;
            }.CSSTableGenerator tr:last-child td:first-child{
                    -moz-border-radius-bottomleft:11px;
                    -webkit-border-bottom-left-radius:11px;
                    border-bottom-left-radius:11px;
            }.CSSTableGenerator tr:hover td{

            }
            .CSSTableGenerator tr:nth-child(odd){ background-color:#aad4ff; }
            .CSSTableGenerator tr:nth-child(even)    { background-color:#ffffff; }.CSSTableGenerator td{
                    vertical-align:middle;


                    border:1px solid #000000;
                    border-width:0px 1px 1px 0px;
                    text-align:center;
                    padding:4px;
                    font-size:10px;
                    font-family:Arial;
                    font-weight:normal;
                    color:#000000;
            }.CSSTableGenerator tr:last-child td{
                    border-width:0px 1px 0px 0px;
            }.CSSTableGenerator tr td:last-child{
                    border-width:0px 0px 1px 0px;
            }.CSSTableGenerator tr:last-child td:last-child{
                    border-width:0px 0px 0px 0px;
            }
            .CSSTableGenerator tr:first-child td{
                            background:-o-linear-gradient(bottom, #005fbf 5%, #005fbf 100%);	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #005fbf), color-stop(1, #005fbf) );
                    background:-moz-linear-gradient( center top, #005fbf 5%, #005fbf 100% );
                    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#005fbf", endColorstr="#005fbf");	background: -o-linear-gradient(top,#005fbf,005fbf);

                    background-color:#005fbf;
                    border:0px solid #000000;
                    text-align:center;
                    border-width:0px 0px 1px 1px;
                    font-size:12px;
                    font-family:Arial;
                    font-weight:bold;
                    color:#ffffff;
            }
            .CSSTableGenerator tr:first-child:hover td{
                    background:-o-linear-gradient(bottom, #005fbf 5%, #005fbf 100%);	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #005fbf), color-stop(1, #005fbf) );
                    background:-moz-linear-gradient( center top, #005fbf 5%, #005fbf 100% );
                    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#005fbf", endColorstr="#005fbf");	background: -o-linear-gradient(top,#005fbf,005fbf);

                    background-color:#005fbf;
            }
            .CSSTableGenerator tr:first-child td:first-child{
                    border-width:0px 0px 1px 0px;
            }
            .CSSTableGenerator tr:first-child td:last-child{
                    border-width:0px 0px 1px 1px;
            }
        </style>
    <body>
        <section id="main" class="column">
            <div class="clear">
                
            </div>
                <fieldset>
                    <header><h3 align="center"><b>SEGUIMIENTO DE HERIDAS</b></h3></header>
                    <?php if(isset($_GET['ver']) || isset($_GET['orden'])){   ?>       
                    <form name="insertar" action="" method="post" enctype="multipart/form-data">
                        <br>
                        <table class="CSSTableGenerator"  >
                            <tr>
                                <td></td>
                                <td><label><b>EVALUACION Y MANEJO DE LAS LESIONES DE PIEL</b></label></td>
                                <td><label><b>CURACIÓN No</b></label></td>
                                <td><input type="text" name="curacion_no" value="<?php echo $no ?>" style="width:70px;background-color:white;">
                                <b>Visita No</b><input type="text" name="visita" value="<?php echo $num_visita ?>" style="width:30px;background-color:white;"></td>
                            </tr>
                        </table>
                        <br>
                        <table class="CSSTableGenerator" >
                            <tr><td></td><td></td><td></td><td></td><td></td></tr>
                            <tr>
                                <td></td>
                                <td><label>Relacionado con visita #</label></td>    
                                <td><input type="text" name="visita" readonly value="<?php echo $_GET['codigo'] ?>" style="width:70px;background-color:white;"></td>
                                <td><label>Localizaciòn Anatomica</label></td> 
                                <td><input type="text" name="localizacion"  style="width:180px;background-color:white;"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><label>Estadio</label></td>
                                <td>
                                    <select name="estadio" style="width:50%;">
                                        <option value="Ninguna">Seleccione uno..</option>
                                        <option value="I">I</option>
                                        <option value="II">II</option>
                                        <option value="III">III</option>
                                        <option value="IV">IV</option>
                                        <option value="Inespecifica">Inespecifica</option>
                                    </select>
                                </td>
                                <td><label>Cant. Del Exusado</label></td> 
                                <td>
                                    <select name="cant_exusado" style="width:50%;">
                                        <option value="Ninguna">Seleccione uno..</option>
                                        <option value="Ausente">Ausente</option>
                                        <option value="Baja">Baja</option>
                                        <option value="Moderada">Moderada</option>
                                        <option value="Abundante">Abundante</option>
                                    </select>
                                </td>   
                            </tr>
                            <tr>
                                <td></td>
                                <td><label>Clarificaciòn</label></td> 
                                <td>
                                    <select name="clarificacion" style="width:50%;">
                                        <option value="Ninguna">Seleccione uno..</option>
                                        <option value="Quirurgica">Quirúrgica</option>
                                        <option value="Traumatica">Traumática</option>
                                        <option value="Presión">Presión</option>
                                        <option value="Vascular">Vascular</option>
                                    </select>
                                </td>
                                <td><label>Piel Circundante</label></td> 
                                <td>
                                    <select name="piel_circundante" style="width:50%;">
                                        <option value="Ninguna">Seleccione uno..</option>
                                        <option value="Integra">Integra</option>
                                        <option value="Engrosada">Engrosada</option>
                                        <option value="Macerada">Macerada</option>
                                        <option value="Invaginada">Invaginada</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><label>Dimensión</label></td> 
                                <td><input name="dimencion1" class="span2" placeholder="Largo"  style="width:50px;">X
                                    <input name="dimencion2" class="span2" placeholder="Ancho" style="width:50px;">X
                                    <input name="dimencion3" class="span2" placeholder="Prof" style="width:50px;">
                                    
                                </td>
                                <td><label>Piel Color</label></td>  
                                <td>
                                    <select name="piel_color" style="width:50%;">
                                        <option value="Ninguna">Seleccione uno..</option>
                                        <option value="Oscura">Oscura</option>
                                        <option value="Palida">Pálida</option>
                                        <option value="Rosada">Rosada</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><label>Base De la Herida</label></td>    
                                <td>
                                    <select name="base_herida" style="width:50%;">
                                        <option value="Ninguna">Seleccione uno..</option>
                                        <option value="Tunel">Túnel</option>
                                        <option value="Cavitada">Cavitada</option>
                                        <option value="Fistula">Fistula</option>
                                        <option value="Plana">Plana</option>
                                    </select>
                                </td>
                                <td><label>Signos De Infección</label></td> 
                                <td>
                                    <select name="infeccion" style="width:50%;">
                                        <option value="Ninguna">Seleccione uno..</option>
                                        <option value="PUS">PUS</option>
                                        <option value="PUSTULA">PUSTULA</option>
                                        <option value="SECRECION">SECRECION</option>
                                        <option value="INFLAMACION">INFLAMACION</option>
                                  
                                    </select>
                                    
                                </td>
                            </tr>                    
                            <tr>
                                <td></td>
                                <td><label>Característica Tejido</label></td>
                                <td>
                                    <select name="tejido" style="width:50%;">
                                        <option value="Ninguna">Seleccione uno..</option>
                                        <option value="Epitelial">Epitelial</option>
                                        <option value="Granulación">Granulación</option>
                                        <option value="Esfacelo">"Esfacelo</option>
                                        <option value="Necròtico">Necròtico</option>
                                    </select>
                                </td>
                                <td><label>Olor</label></td>    
                                <td>
                                    <select name="olor" style="width:50%;">
                                        <option value="Ninguna">Seleccione uno..</option>
                                        <option value="Ausente">Ausente</option>
                                        <option value="Fetido">Fetido</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><label>Exusado</label></td>   
                                <td>
                                    <select name="exusado" style="width:50%;">
                                        <option value="Ninguna">Seleccione uno..</option>
                                        <option value="Seroso">Seroso</option>
                                        <option value="Sanguinolento">Sanguinolento</option>
                                        <option value="Purulento">Purulento</option>
                                        <option value="Ninguna">Ninguna</option>
                                    </select>
                                </td>
                                <td><label>Dolor (Escala 1-10)</label></td>      
                                <td>
                                    <select name="dolor" style="width:50%;">
                                        <option value="Ninguna">Seleccione uno..</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                    </select>
                            </td>
                        </tr>
                        <tr>
<!--                            <select name="infeccion" style="width:50%;">
                                        <option value="Ninguna">Seleccione uno..</option>
                                        <option value="Induracion">Induración</option>
                                        <option value="Calor">Calor</option>
                                        <option value="Eritema">Eritema</option>
                                        <option value="Edema">Edema</option>
                                        <option value="Dolor">Dolor</option>
                                    </select>-->
                            <td></td>
                            <td><label>Caracteristica de Piel</label></td>
                            <td>(<input type="checkbox" name="c1" value="Induracion">Induracion)
                            (<input type="checkbox" name="c2" value="Calor">Calor)
                            (<input type="checkbox" name="c3" value="Eritema">Eritema)
                            (<input type="checkbox" name="c4" value="Edema">Edema)
                            (<input type="checkbox" name="c5" value="Dolor">Dolor)</td>
                            
                            <td><input type="button" name="enviar" value="CANCELAR" style='width:50%; height:25px' class="alt_btn" onclick="window.close()"></td>
                            <td><input type="submit" name="enviar" value="GUARDAR" style='width:50%; height:25px' class="alt_btn" onclick=""></td>
                        </tr>
                    </table>
                </form>
                <?php  } ?>
                <hr>
                <?php 
                if(isset($_GET['orden'])){
//                $request=mysql_query("SELECT * FROM curaciones where orden_interna='".$_GET['orden']."'");
                      $request=mysql_query("SELECT * FROM curaciones where id_visita='".$_GET['codigo']."'");  
                }else{
                $request=mysql_query("SELECT * FROM curaciones where id_visita='".$_GET['codigo']."'");  
                }               
                if($request){
                $table = '<table class="CSSTableGenerator">';
               
                $table = $table.'<tr>';
                $table = $table.'<td>'.'Atencion'.'</td>';
                $table = $table.'<td>'.'Curación'.'</td>';
                $table = $table.'<td>'.'Localización'.'</td>';
                $table = $table.'<td>'.'Estadio'.'</td>';
                $table = $table.'<td>'.'Clarificación'.'</td>';
                $table = $table.'<td>'.'Dimensión'.'</td>';
                $table = $table.'<td>'.'Base de la Herida'.'</td>';
                $table = $table.'<td>'.'Caracteristica Tejido'.'</td>';
                $table = $table.'<td>'.'Exusado'.'</td>';
                $table = $table.'<td>'.'Cantidad Exusado'.'</td>';
                $table = $table.'<td>'.'Piel Circundante'.'</td>';
                $table = $table.'<td>'.'Caracteristica'.'</td>';
                $table = $table.'<td>'.'Piel Color'.'</td>';
                $table = $table.'<td>'.'Signos de Infeccion'.'</td>';
                $table = $table.'<td>'.'Olor'.'</td>';
                $table = $table.'<td>'.'Dolor'.'</td>';
                $table = $table.'<td>'.'Eliminar'.'</td>';
                $table = $table.'</tr>';
  
                //Por cada resultado pintamos una linea
                while($row=mysql_fetch_array($request))
                {       
                if(isset($_GET['orden'])){    
                $c='<a href="../resumen/curacion_heridas.php?eliminar='.$row["id_curacion"].'&codigo='.$_GET["codigo"].'&orden='.$_GET["orden"].'"><img src="../imagenes/eliminar.png" alt="ver" height="20px" width="20px"></a>';
                }
                if($row["c1"]==''){$c1='';}else{$c1=$row["c1"].', ';}
                if($row["c2"]==''){$c2='';}else{$c2=$row["c2"].', ';}
                if($row["c3"]==''){$c3='';}else{$c3=$row["c3"].', ';}
                if($row["c4"]==''){$c4='';}else{$c4=$row["c4"].', ';}
                if($row["c5"]==''){$c5='';}else{$c5=$row["c5"].' ';}
                $table = $table.'<tr><td>'.$row["visita_numero"].'</td><td>'.$row["curacion_no"].'</td>
                <td>'.$row["localizacion"].'</td>
                <td>'.$row["estadio"].'</td>
                <td>'.$row["clarificacion"].'</td>
                <td>'.$row["dimencion"].'</td>
                <td>'.$row["base_herida"].'</td>
                <td>'.$row["tejido"].'</td>
                <td>'.$row["exusado"].'</td>
                <td>'.$row["cant_exusado"].'</td>
                <td>'.$row["piel_circundante"].'</td>
                <td>'.$c1.''.$c2.''.$c3.''.$c4.''.$c5.'</td>
                <td>'.$row["piel_color"].'</td>
                <td>'.$row["infeccion"].'</td>
                <td>'.$row["olor"].'</td>
                <td>'.$row["dolor"].'</td>
                <td>'.$c.'</td></tr>';   
                }
                $table = $table.'</table>';
                echo $table;
                }
                if (isset($_POST["curacion_no"])){
                if($_POST['localizacion']==''){
                echo '<script lanquage="javascript">alert("Por favor digite la localización de la herida");location.href="../vistas/curacion_heridas.php?codigo="'.$_GET['codigo'].'"&orden="'.$_GET['orden'].'""</script>';
                }else{
                $id_visita= $_GET["codigo"];
                $orden= $_GET["orden"];
                $visita = $_POST["visita"];
                $curacion_no = $_POST["curacion_no"];
                $localizacion = $_POST["localizacion"];
                $estadio = $_POST["estadio"];
                $clarificacion = $_POST["clarificacion"];
                $dimencion = $_POST["dimencion1"].'x'.$_POST["dimencion2"].'x'.$_POST["dimencion3"];
                $base_herida = $_POST['base_herida'];
                $tejido = $_POST['tejido'];
                $exusado = $_POST['exusado'];
                $cant_exusado = $_POST['cant_exusado'];
                $piel_circundante = $_POST['piel_circundante'];
                $piel_color = $_POST['piel_color'];
                $infeccion = $_POST['infeccion'];
                $olor = $_POST['olor'];
                $dolor = $_POST['dolor'];
                if(isset($_POST['c1'])){ $c1 = $_POST['c1'];}else{ $c1 = '';}
                 if(isset($_POST['c2'])){ $c2 = $_POST['c2'];}else{ $c2 = '';}
                  if(isset($_POST['c3'])){ $c3 = $_POST['c3'];}else{ $c3 = '';}
                   if(isset($_POST['c4'])){ $c4 = $_POST['c4'];}else{ $c4 = '';}
                    if(isset($_POST['c5'])){ $c5 = $_POST['c5'];}else{ $c5 = '';}
                $sql = "INSERT INTO `curaciones` (`id_visita`, `visita_numero`, `curacion_no`, `localizacion`, `estadio`, `clarificacion`, `dimencion`, `c1`, `c2`, `c3`, `c4`, `c5`, `base_herida`, `tejido`, `exusado`, `cant_exusado`,`piel_circundante`, `piel_color`, `infeccion`, `olor`, `dolor`, `orden_interna`)";
                $sql.= "VALUES ('".$id_visita."','".$visita."', '".$curacion_no."','".$localizacion."', '".$estadio."', '".$clarificacion."', '".$dimencion."', '".$c1."', '".$c2."', '".$c3."', '".$c4."', '".$c5."','".$base_herida."','".$tejido."', '".$exusado."', '".$cant_exusado."', '".$piel_circundante."', '".$piel_color."', '".$infeccion."', '".$olor."', '".$dolor."', '".$orden."')";
                mysql_query($sql)or die(mysql_error());
                $status = "ok";
                echo "<script language='javascript' type='text/javascript'>";
                echo "location.href='../resumen/curacion_heridas.php?codigo=".$_GET['codigo']."&orden=".$_GET['orden']."'";
                echo "</script>";
                }
                }
                if(isset($_GET['eliminar']))
                {
                $Codigo=$_GET['eliminar'];
                $C=$_GET['codigo'];
                $O=$_GET['orden'];
                $sql = "DELETE FROM curaciones WHERE id_curacion='$Codigo'";
                mysql_query($sql);
                echo "<script language='javascript' type='text/javascript'>";
                echo "location.href='../resumen/curacion_heridas.php?codigo=".$_GET['codigo']."&orden=".$_GET['orden']."'";
                echo "</script>";
                }
                if(isset($_GET['orden'])){ 
                ?>
                <a target="_blank" href="../resumen_curaciones.php?imprimir=<?php echo $_GET['orden'] ?>"> <img src="../imagenes/imp.png" alt="ver" height="30px" width="30px"> </a><?php } ?>         
		</fieldset>
                <div class="spacer"></div>
        </section>
    </body>
</html>
<?php   }else {header("location:../index.php");}  ?>