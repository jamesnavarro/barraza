<?php 
session_start();
include "../modelo/conexion.php";
require '../modelo/consultar_permisos.php';
include_once 'Connection.php';
 require '../modelo/insertar_historial.php';
require '../modelo/consulta_contacto_potencial.php';
$sql1 = "SELECT MAX(numero_factura) as id FROM facturas where estado=''";
        $fila1 =mysql_fetch_array(mysql_query($sql1));
        $factura = $fila1["id"]+1;
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


</head>

<?php     if(isset($_GET["codigo"])){
$consulta= "select * from ordenes WHERE  id=".$_GET["codigo"]."";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
     $id_paciente=$fila['id_paciente'];
} 
 $_SESSION["MAN"]=$id_paciente;}
?>

<body onload="doScroll()" onunload="window.name=document.body.scrollTop">
 <?php  include '../vistas/menu.php'; ?>
    <form  action="<?php if(isset($_GET['codigo'])){ echo '../modelo/insertar_historial.php?paciente='.$_GET['codigo'].''; }else{ echo '../modelo/editar_historial.php?paciente='.$_GET['orde'].'';} ?>" method="post" enctype="multipart/form-data">

	<section id="main" class="column">
	<div class="clear"></div>
                <article class="module width_full">
			<header><h3>HISTORIA FAMILIAR </h3></header>
                        <div class="module_content"> 
                            <input type="submit" name="enviar" value="Guardar" class="alt_btn"> <?php if(isset($_GET['orde'])){ ?> 
                            <a href="../vistas/contacto_potencial.php?codigo=<?php if(isset($_GET['orde'])){echo $idpa;}else{echo $idpa; } ?>"> <input type="button" name="enviar" value="Cancelar" class="alt_btn"></a>
                            <?php  }else{ ?>
                            <a href="../vistas/reg_orden.php?codigo=<?php if(isset($_GET['codigo'])){echo $_GET['codigo'];}else{echo $_GET['codigo']; } ?>"> <input type="button" name="enviar" value="Cancelar" class="alt_btn"></a><?php }?>
                         <br>
                           <br>
                                     <table> 
                                         <tr>
                                                                    <td><label>Historial #:</label></td>
                                                                    <td><input type="text" name="paciente" readonly value="<?php if(isset($id_paciente)){echo $id_paciente;}if(isset($_GET['orde'])){echo $idpa;} ?>"></td>
                                                               <tr>
                                                                    <td><label>Cancer:<?php  ?></label></td>
                                                                    <td>si <input type="radio" name="Cancer" value="Si" <?php if(isset($_GET['orde'])){if($cancer1=='Si'){ echo 'checked'; }} ?>> no <input type="radio" name="Cancer" value="No" <?php if(isset($_GET['orde'])){if($cancer1=='No'){ echo 'checked'; }}else{echo 'checked';} ?>></td>
                                                               
                                                                    <td><label>Diabetes:</label></td>
                                                                    <td>si <input type="radio" name="Diabetes" value="Si" <?php if(isset($_GET['orde'])){if($diabetes1=='Si'){ echo 'checked'; }} ?>> no <input type="radio" name="Diabetes"  value="No" <?php if(isset($_GET['orde'])){if($diabetes1=='No'){ echo 'checked'; }}else{echo 'checked';}  ?>></td>
                                                                    
                                                                    <tr>
                                                                    <td><label>Ataques De Corazon:</label></td>
                                                                    <td>si <input type="radio" name="Ataques" value="Si" <?php if(isset($_GET['orde'])){if($ataques1=='Si'){ echo 'checked'; }} ?>> no <input type="radio" name="Ataques"  value="No" <?php if(isset($_GET['orde'])){if($ataques1=='No'){ echo 'checked'; }}else{echo 'checked';}  ?>></td>
                                                               
                                                                    <td><label>Hipertension:</label></td>
                                                                    <td>si <input type="radio" name="Hipertencion" value="Si" <?php if(isset($_GET['orde'])){if($hipertencion=='Si'){ echo 'checked'; }} ?>> no <input type="radio" name="Hipertencion"  value="No" <?php if(isset($_GET['orde'])){if($hipertencion=='No'){ echo 'checked'; }}else{echo 'checked';}  ?>></td>
                                                                    
                                                                    <tr>
                                                                    <td><label>Emfermedades Renales:</label></td>
                                                                    <td>si <input type="radio" name="Emfermedades" value="Si" <?php if(isset($_GET['orde'])){if($emfermedades=='Si'){ echo 'checked'; }} ?>> no <input type="radio" name="Emfermedades"  value="No" <?php if(isset($_GET['orde'])){if($emfermedades=='No'){ echo 'checked'; }}else{echo 'checked';}  ?>></td>
                                                               
                                                                    <td><label>Tuberculosis:</label></td>
                                                                    <td>si <input type="radio" name="Tuberculosis" value="Si" <?php if(isset($_GET['orde'])){if($tuberculosis1=='Si'){ echo 'checked'; }} ?>> no <input type="radio" name="Tuberculosis"  value="No" <?php if(isset($_GET['orde'])){if($tuberculosis1=='No'){ echo 'checked'; }}else{echo 'checked';}  ?>></td>
                                                                    
                                                                     
                                                                </tr>
                                                                 <tr>
                                                                    <td><label>Otras:</label></td>
                                                                    <td>si <input type="radio" name="Otras" value="Si" onclick="activar1(0)" <?php if(isset($_GET['orde'])){if($otras1=='Si'){ echo 'checked'; }} ?>/> no <input type="radio" name="Otras"  value="No"  onclick="activar1(1)" <?php if(isset($_GET['orde'])){if($otras1=='No'){ echo 'checked'; }}else{echo 'checked';}  ?>/> </td>
                                                               
                                                                    <td><label>Especifique:</label></td>
                                                                    <td>  <input type="text" name="Especifique" <?php if(isset($_GET['orde'])){if($otras1=='Si'){echo 'enabled';}else{echo 'disabled';}}else{echo 'disabled';} ?> value="<?php if(isset($_GET['orde'])){echo $especifique1;} ?>">  
                                                                     
                                                                </tr>
                                                               </table>
                                    </article>
                <article class="module width_full">
			<header><h3>Antecedentes Personales</h3></header>
                        
                        
				<div class="module_content"> 
                          
                                       <table> <tr>
                                                   <td><label>Alcohol:</label></td>
                                                                    <td>si <input type="radio" name="Alcohol" value="Si" <?php if(isset($_GET['orde'])){if($alcohol=='Si'){ echo 'checked'; }} ?>/> no <input type="radio" name="Alcohol" value="No" <?php if(isset($_GET['orde'])){if($alcohol=='No'){ echo 'checked'; }}else{echo 'checked';}  ?>/> </td>   
                                                                    <td></td>
                                                                      </tr>
                                                             <tr><td><label>Tabaco:</label></td>
                                                                    <td>si <input type="radio" name="Tabaco" value="Si" <?php if(isset($_GET['orde'])){if($tabaco=='Si'){ echo 'checked'; }} ?>/> no <input type="radio" name="Tabaco"  value="No" <?php if(isset($_GET['orde'])){if($tabaco=='No'){ echo 'checked'; }}else{echo 'checked';}  ?>/> </td>
                                                            <td></td>
                                                                    <td></td> </tr><tr><td><label>Drogas:</label></td>
                                                                    <td>si <input type="radio" name="Drogas" value="Si" <?php if(isset($_GET['orde'])){if($drogas=='Si'){ echo 'checked'; }} ?>/> no <input type="radio" name="Drogas"  value="No" <?php if(isset($_GET['orde'])){if($drogas=='No'){ echo 'checked'; }}else{echo 'checked';}  ?>/> </td>
                                                           <td></td> </tr>
                                            </table>
                                      <table> <tr>
                                                                    <td><label>Cancer:</label></td>
                                                                    <td>si <input type="radio" name="Cancer1" value="Si" <?php if(isset($_GET['orde'])){if($cancer=='Si'){ echo 'checked'; }} ?>> no <input type="radio" name="Cancer1"  value="No" <?php if(isset($_GET['orde'])){if($cancer=='No'){ echo 'checked'; }}else{echo 'checked';}  ?>></td>
                                                               
                                                                    <td><label>Diabetes:</label></td>
                                                                    <td>si <input type="radio" name="Diabetes1" value="Si" <?php if(isset($_GET['orde'])){if($diabetes=='Si'){ echo 'checked'; }} ?>> no <input type="radio" name="Diabetes1"  value="No" <?php if(isset($_GET['orde'])){if($diabetes=='No'){ echo 'checked'; }}else{echo 'checked';}  ?>></td>
                                                                    
                                                                    <tr>
                                                                    <td><label>Ataques De Corazòn:</label></td>
                                                                    <td>si <input type="radio" name="Ataques1" value="Si" <?php if(isset($_GET['orde'])){if($ataques=='Si'){ echo 'checked'; }} ?>> no <input type="radio" name="Ataques1"  value="No" <?php if(isset($_GET['orde'])){if($ataques=='No'){ echo 'checked'; }}else{echo 'checked';}  ?>></td>
                                                               
                                                                    <td><label>Hipertensiòn:</label></td>
                                                                    <td>si <input type="radio" name="Hipertencion1" value="Si" <?php if(isset($_GET['orde'])){if($hiper=='Si'){ echo 'checked'; }} ?>> no <input type="radio" name="Hipertencion1"  value="No" <?php if(isset($_GET['orde'])){if($hiper=='No'){ echo 'checked'; }}else{echo 'checked';}  ?>></td>
                                                                    
                                                                    <tr>
                                                                    <td><label>Emfermedades Renales:</label></td>
                                                                    <td>si <input type="radio" name="Emfermedades1" value="Si" <?php if(isset($_GET['orde'])){if($emfermedades1=='Si'){ echo 'checked'; }} ?>> no <input type="radio" name="Emfermedades1"  value="No" <?php if(isset($_GET['orde'])){if($emfermedades1=='No'){ echo 'checked'; }}else{echo 'checked';}  ?>></td>
                                                               
                                                                    <td><label>Tuberculosis:</label></td>
                                                                    <td>si <input type="radio" name="Tuberculosis1" value="Si" <?php if(isset($_GET['orde'])){if($tuberculosis=='Si'){ echo 'checked'; }} ?>> no <input type="radio" name="Tuberculosis1"  value="No" <?php if(isset($_GET['orde'])){if($tuberculosis=='No'){ echo 'checked'; }}else{echo 'checked';}  ?>></td>
                                                                    
                                                                     
                                                                </tr>
                                                                 <tr>
                                                                    <td><label>Otras:</label></td>
                                                                    <td>si <input type="radio" name="Otras1" value="Si" onclick="activar(0)" <?php if(isset($_GET['orde'])){if($otras=='Si'){ echo 'checked'; }} ?>/> no <input type="radio" name="Otras1"  value="No"  onclick="activar(1)" <?php if(isset($_GET['orde'])){if($otras=='No'){ echo 'checked'; }}else{echo 'checked';}  ?>/></td>
                                                               
                                                                    <td><label>Especifique:</label></td>
                                                                    <td>  <input type="text" name="Especifique1" <?php if(isset($_GET['orde'])){if($otras=='Si'){echo 'enabled';}else{echo 'disabled';}}else{echo 'disabled';} ?> value="<?php if(isset($_GET['orde'])){echo $especifique;} ?>">  
                                                                  </tr> </table>
                                     <div class="clear"></div>
                                     <table><tr> 
                                             <td>MEDICAMENTOS: Enumere la dòsis o el nùmero de pìldoras por dìa</td>
                                             <td><textarea style="width:350%;" rows="2" name="Medicamentos"><?php if(isset($_GET['orde'])){echo $medicamentos;} ?></textarea> </td>
                                             
                                             </tr>
                                    
                                     <tr>
                                          <td><label>Alergia a Drogas:</label></td>
                                            <td>si <input type="radio" name="Alergias" value="Si" onclick="activar2(0)" <?php if(isset($_GET['orde'])){if($alergias=='Si'){ echo 'checked'; }} ?>> no <input type="radio" name="Alergias"  value="No"  onclick="activar2(1)" <?php if(isset($_GET['orde'])){if($alergias=='No'){ echo 'checked'; }}else{echo 'checked';}  ?>/></td>
                                                                    
                                            <td><label>Cuales?:</label></td>
                                            <td>  <input type="text" name="Cuales1" <?php if(isset($_GET['orde'])){if($alergias=='Si'){echo 'enabled';}else{echo 'disabled';}}else{echo 'disabled';} ?> value="<?php if(isset($_GET['orde'])){echo $cuales1;} ?>" > , <input type="text" name="Cuales2" <?php if(isset($_GET['orde'])){if($alergias=='Si'){echo 'enabled';}else{echo 'disabled';}}else{echo 'disabled';}  ?> value="<?php if(isset($_GET['orde'])){echo $cuales2;} ?>"> ,<input type="text" name="Cuales3" <?php if(isset($_GET['orde'])){if($alergias=='Si'){echo 'enabled';}else{echo 'disabled';}}else{echo 'disabled';} ?> value="<?php if(isset($_GET['orde'])){echo $cuales3;} ?>"> , 
                                                                    
                                      </tr> </table>
                                    </article>

                
                 <article class="module width_full">
			<header><h3>EXAMENES COMPLEMENTARIOS</h3></header>
                        
                        
				<div class="module_content"> 
                          
                                       <table> <tr>
                                                                    <td><label>Laboratorios</label></td>
                                                                    <td>si <input type="radio" name="Laboratorios" value="Si" onclick="activar3(0)" <?php if(isset($_GET['orde'])){if($laboratorios=='Si'){ echo 'checked'; }} ?>> no <input type="radio" name="Laboratorios"  value="No"  onclick="activar3(1)" <?php if(isset($_GET['orde'])){if($laboratorios=='No'){ echo 'checked'; }}else{echo 'checked';}  ?>> </td>
                                                               
                                                                     <td><label>Cuales?</label></td>
                                                                    <td>  <input type="text" name="Cuales4" <?php if(isset($_GET['orde'])){if($laboratorios=='Si'){echo 'enabled';}else{echo 'disabled';}}else{echo 'disabled';} ?> value="<?php if(isset($_GET['orde'])){echo $cuales4;} ?>"> ,<input type="text" name="Cuales5"  <?php if(isset($_GET['orde'])){if($laboratorios=='Si'){echo 'enabled';}else{echo 'disabled';}}else{echo 'disabled';} ?> value="<?php if(isset($_GET['orde'])){echo $cuales5;} ?>">,<input type="text" name="Cuales6"  <?php if(isset($_GET['orde'])){if($laboratorios=='Si'){echo 'enabled';}else{echo 'disabled';}}else{echo 'disabled';} ?> value="<?php if(isset($_GET['orde'])){echo $cuales6;} ?>"> </td>
                                                                    
                                                                     
                                                                    <td></td>  <td></td>
                                                                     
                                                                </tr>
                                                                
                                                                <tr>
                                                                    <td><label>Otros Estudios</label></td>
                                                                    <td>si <input type="radio" name="Otros" value="Si" onclick="activar4(0)" <?php if(isset($_GET['orde'])){if($otros=='Si'){ echo 'checked'; }} ?>> no <input type="radio" name="Otros"  value="No"  onclick="activar4(1)" <?php if(isset($_GET['orde'])){if($otros=='No'){ echo 'checked'; }}else{echo 'checked';}  ?>></td>
                                                               
                                                                     <td><label>Cuales?</label></td>
                                                                    <td>  <input type="text" name="Cuales7"  <?php if(isset($_GET['orde'])){if($otros=='Si'){echo 'enabled';}else{echo 'disabled';}}else{echo 'disabled';} ?> value="<?php if(isset($_GET['orde'])){echo $cuales7;} ?>"> ,<input type="text" name="Cuales8"  <?php if(isset($_GET['orde'])){if($otros=='Si'){echo 'enabled';}else{echo 'disabled';}}else{echo 'disabled';} ?> value="<?php if(isset($_GET['orde'])){echo $cuales8;} ?>">,<input type="text" name="Cuales9"  <?php if(isset($_GET['orde'])){if($otros=='Si'){echo 'enabled';}else{echo 'disabled';}}else{echo 'disabled';} ?> value="<?php if(isset($_GET['orde'])){echo $cuales9;} ?>"> </td>
                                                                     <td></td>  <td></td>
                                                                     
                                                                </tr> </table>
                                    
</article>
<div class="spacer"></div>
   
	</section>  </form>
               <?php include '../footer.php'; ?>

</body>

</html>
