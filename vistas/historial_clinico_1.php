<?php 
include "../modelo/conexion.php";
require '../modelo/consultar_permisos.php';
require '../modelo/consulta_ordenes.php';
require '../modelo/consultar_paciente.php';
require '../modelo/insertar_consulta.php';
if(isset($_GET['cod'])){
 $consulta= "select a.*, b.* from actividad a, pacientes b where a.orden_servicio='".$_GET['cod']."' and a.id_paciente=b.id_paciente GROUP BY orden_externa";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
$name=$fila['nombres'].' '.$fila['apellidos'];  
 $id=$fila['id_paciente'];
}

$consult= "select * from motivo_consulta WHERE  id_orden=".$_GET["cod"]."";
$resul=  mysql_query($consult);
while($fila=  mysql_fetch_array($resul)){
$motivo2 = $fila['hallazgos'];
$id_orden = $fila['id_orden'];
}}
if(isset($_GET['editar'])){
     $consulta= "select a.*, b.* from actividad a, pacientes b where a.orden_servicio='".$_GET['editar']."' and a.id_paciente=b.id_paciente GROUP BY orden_externa";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
$name=$fila['nombres'].' '.$fila['apellidos'];  
 $id=$fila['id_paciente'];
}

$consult= "select * from motivo_consulta WHERE  id_orden=".$_GET["editar"]."";
$resul=  mysql_query($consult);
while($fila=  mysql_fetch_array($resul)){
$motivo2 = $fila['hallazgos'];
$id_orden = $fila['id_orden'];
}
}
?>
<!doctype html>
<html lang="en">

<head>
    
    
	<meta charset="utf-8"/>
	<title>Sistema Integral</title>
	
	<link rel="stylesheet" href="../css/stilo1.css" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" href="../css_menu/menu.css" />
	<script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
	<script src="../js/mostrarmenu.js" type="text/javascript"></script>
	<script src="../js/jquery.tablesorter.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="../js/jquery.equalHeight.js"></script>
        <link rel="stylesheet" type="text/css" href="../resources/screen.css" />
       <link rel="stylesheet" type="text/css" href="../resources/style.css" />
       <script type="text/javascript" src="../js/tcal.js"></script>
       <link rel="stylesheet" type="text/css" href="../css/tcal.css" />
       
       <script type="text/javascript">
function activar(num) {
  document.forms[0].Especifique1.disabled = (num==0) ? false : true;
   
}

function activar1(num) {
  document.forms[0].Especifique.disabled = (num==0) ? false : true;
   
}
function activar2(num) {
  document.forms[0].Cuales1.disabled = (num==0) ? false : true;
  document.forms[0].Cuales2.disabled = (num==0) ? false : true;
  document.forms[0].Cuales3.disabled = (num==0) ? false : true;
}

 function activar3(num) {
  document.forms[0].Cuales4.disabled = (num==0) ? false : true;
  document.forms[0].Cuales5.disabled = (num==0) ? false : true;
  document.forms[0].Cuales6.disabled = (num==0) ? false : true;
}
function activar4(num) {
  document.forms[0].Cuales7.disabled = (num==0) ? false : true;
  document.forms[0].Cuales8.disabled = (num==0) ? false : true;
  document.forms[0].Cuales9.disabled = (num==0) ? false : true;
}
</script>

   
      <script language="JavaScript">
<!--

function enable_text(status)
{
status=!status;	
document.insertar_historial.Especifique1.disabled = status;
}
//-->
</script>
<style>
body {
    background-color: #D3EDF0;
}

article {
    background-color: #F5F6F6;
}

p {
    background-color: rgb(255,0,255);
}
</style>

</head>



<body onload="doScroll()" onunload="window.name=document.body.scrollTop">

    <form  action="<?php if(isset($_GET['editar'])){ echo '../modelo/editar_consulta.php?edit='.$id_orden.'&pac='.$_GET['pac'].''; }else{echo '../modelo/insertar_consulta.php?paciente='.$id.'&pac='.$_GET['pac'].' ';} ?>" method="post" enctype="multipart/form-data">
	<section id="main" class="column">
	
		
		
		
		
		<div class="clear"></div>
                
		<article class="module width_full">
                    <header><h3>ANAMNESIS</h3></header>
                    <fieldset>
                   
                    <div class="module_content"> 
                        <label>Orden #:</label><input type="text" name="ord" style="width:40px;" readonly value="<?php  if (isset($_GET['cod'])){echo $_GET['cod'];}else {echo $orde; } ?>"><br><br>
                          <input type="submit" name="enviar" value="Guardar" class="alt_btn">  <a href="../vistas/?id=mostrar_historial_1&cod=<?php echo $_GET['editar']; ?>"> <input type="button" name="enviar" value="Cancelar" class="alt_btn"></a>
                         <br>
                           <br>
                     <table>
                        
                            
           
                          <tr><td>ANAMNESIS:</td></tr>
                         
                         <tr> 
                             <td><textarea style="width:700px;" rows="8" name="Motivo"><?php if(isset($motivo)){echo $motivo; } ?></textarea> </td>
                                 <td></td>
                                 </tr>
                     </table>
                        </fieldset>
                     
                                   </article>                            
                    
                   
                 <article class="module width_full">
                     
			<header><h3>EXAMEN FÌSICO</h3></header>
                        
                         <fieldset>
                             
                           
                                       <table> <tr>
                                                                    <td><label>Conciente y Orientado:</label></td>
                                                                    <td>si <input type="radio" name="Conciente" value="Si" <?php if(isset($conciente)){if($conciente=='Si'){ echo 'checked'; }} ?>> no <input type="radio" name="Conciente" <?php if(isset($conciente)){if($conciente=='No'){ echo 'checked'; }}else{echo'checked';} ?> value="No"></td>
                                                               
                                                                    <td><label>Somnoliento:</label></td>
                                                                    <td>si <input type="radio" name="Somnoliento" value="Si"  <?php if(isset($somnoliento)){if($somnoliento=='Si'){ echo 'checked'; }} ?>> no <input type="radio" name="Somnoliento" <?php if(isset($somnoliento)){if($somnoliento=='No'){ echo 'checked'; }}else{echo'checked';} ?> value="No"></td>
                                                                    
                                                                      
                                                </tr>
                                       <tr>
                                             
                                            <td><label>Signos Vitales:</label></td> <td>
                                            <td></td>  <td></td>
                                       </tr>
                                               
                                       <tr>
                                                  <td><label>FC:</label></td>
                                                  <td> <input type="text" name="FC" value="<?php if(isset($fc)){ echo $fc;} ?>">  </td>
                                                         <td><label>TA:</label></td>
                                                  <td> <input type="text" name="TA"  value="<?php if(isset($ta)){echo $ta; } ?>"> </td>
                                                                    
                                      </tr>    
                                         
                                                            
                                      <tr>
                                             
                                            
                                
                                                  <td><label>FR:</label></td>
                                                  <td> <input type="text" name="FR" value="<?php if(isset($fr)){echo $fr;} ?>">  </td>
                                                      <td><label>PULSO:</label></td>
                                                  <td> <input type="text" name="PULSO"  value="<?php if(isset($pULSO)){echo $pULSO;} ?>">  </td>
                                                                    
                                      </tr>      
                                     
                                      <tr>
                                             
                                            
                                
                                                  <td><label>TºAxilar:</label></td>
                                                  <td> <input type="text" name="Axilar"  value="<?php if(isset($axilar)){echo $axilar;} ?>"> </td>
                                                      <td><label>PESO ACTUAL:</label></td>
                                                  <td> <input type="text" name="Actual" value="<?php if(isset($actual)){echo $actual;} ?>">  </td>
                                                                    
                                      </tr> 
                                      
                                              
                                      
                                                               
                                                               </table>
                                    
                                    
                                    <table>
                                        <tr><td>Descripciòn:</td></tr>
                                        <tr>
                                           
                                          <td><textarea style="width:700px;" rows="8" name="fisico"><?php if(isset($fisico)){echo $fisico;} ?></textarea> </td>
                                      </tr>
                                    </table>
                             </fieldset>
                                       
                                       
                                       
                       
		</article>
                
                
                <article class="module width_full">
                   
                    
                    <header><h3>HALLAZGOS DIAGNOSTICO</h3></header>
                     <fieldset>
                    <div class="module_content"> 
                     <table>
                         <tr><td>Descripciòn:</td></tr>
                         
                         <tr> 
                                     <td><textarea style="width:700px;" rows="8" name="Motivo2"><?php if(isset($motivo2)){echo $motivo2;} ?></textarea> </td>
                                 <td></td>
                                 </tr>
                     </table>
                        </fieldset>
                     
                                   </article>  
                
                <article class="module width_full">

                    
                    <header><h3>PLAN DE MANEJO</h3></header>
                     <fieldset>
                    <div class="module_content"> 
                     <table>
                         <tr><td>Descripciòn:</td></tr>
                         
                         <tr> 
                                     <td><textarea style="width:700px;" rows="8" name="Motivo3"><?php if(isset($motivo3)){echo $motivo3;} ?></textarea> </td>
                                 <td></td>
                                 </tr>
                     </table>
                        <input type="submit" name="enviar" value="Guardar" class="alt_btn"> <a href="../vistas/?id=mostrar_historial_1&codigo=<?php echo $_GET['editar']; ?>"> <input type="button" name="enviar" value="Cancelar" class="alt_btn"></a>
                                       
                        </fieldset>
                     
                                   </article>               
                  
		
		
		<div class="spacer"></div>
                
        
		
            
               
              
	</section>  </form>
              

</body>

</html>
