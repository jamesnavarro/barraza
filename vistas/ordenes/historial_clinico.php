<?php 
include "../modelo/conexion.php";
require '../modelo/consultar_permisos.php';
 require '../modelo/insertar_historial.php';
require '../modelo/consultar_paciente.php';
$sql1 = "SELECT MAX(numero_factura) as id FROM facturas where estado=''";
        $fila1 =mysql_fetch_array(mysql_query($sql1));
        $factura = $fila1["id"]+1;
?>
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

<?php     if(isset($_GET["cod"])){
$consulta= "select * from ordenes WHERE  id=".$_GET["cod"]."";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
     $id_paciente=$fila['id_paciente'];
} 

 $_SESSION["MAN"]=$id_paciente;}
 if(isset($_GET["codigo"])){
$consulta= "select * from ordenes WHERE  id=".$_GET["codigo"]."";
$result=  mysql_query($consulta);
while($fila=  mysql_fetch_array($result)){
     $id_paciente=$fila['id_paciente'];
 } }
?>
<div class="controls">
<form class="span12 widget shadowed dark form-horizontal bordered"  action="<?php if(isset($_GET['codigo'])){ echo '../modelo/insertar_historial.php?paciente='.$_GET['codigo'].''; }else{ echo '../modelo/editar_historial.php?paciente='.$_GET['orde'].'';} ?>" method="post" enctype="multipart/form-data">

	
    
			<header><h4 class="title">HISTORIA FAMILIAR </h4></header>
                        
           
                        
                            <input type="submit" name="enviar" value="Guardar" class="alt_btn"> <?php if(isset($_GET['orde'])){ ?> 
                            <a href="../vistas/?id=ver_paciente&cod=<?php if(isset($_GET['orde'])){echo $idpa;}else{echo $idpa; } ?>"> <input type="button" name="enviar" value="Cancelar" class="alt_btn"></a>
                            <?php  }else{ ?>
                            <a href="../vistas/?id=reg_orden&cod=<?php if(isset($_GET['codigo'])){echo $_GET['codigo'];}else{echo $_GET['codigo']; } ?>"> <input type="button" name="enviar" value="Cancelar" class="alt_btn"></a><?php }?>
                         <br>
                           <br>
                                    
                                     <table class="table table-bordered table-striped table-hover">  
                                         <tr>
                                                                    <td><label>Historial #:</label></td>
                                                                    <td><input type="text" name="paciente" readonly value="<?php if(isset($id_paciente)){echo $id_paciente;}if(isset($_GET['orde'])){echo $idpa;} ?>"></td>
                                                                    <td></td><td></td>
                                                               <tr>
                                                                    <td><label>Cancer:<?php  ?></label></td>
                                                                    <td>
                                                                        <label class="radio inline styled">
                                                                          <input name="Cancer" type="radio" value="Si" <?php if(isset($_GET['orde'])){if($cancer1=='Si'){ echo 'checked'; }} ?>>Si
                                                                          </label>
                                                                          <label class="radio inline styled">
                                                                          <input name="Cancer" type="radio" value="No" <?php if(isset($_GET['orde'])){if($cancer1=='No'){ echo 'checked'; }} ?>> No
                                                                          </label> 
                                                                       </td>
                                                               
                                                                    <td><label>Diabetes:</label></td>
                                                                    <td>
                                                                         <label class="radio inline styled">
                                                                          <input name="Diabetes" type="radio" value="Si" <?php if(isset($_GET['orde'])){if($diabetes1=='Si'){ echo 'checked'; }} ?>>Si
                                                                          </label>
                                                                          <label class="radio inline styled">
                                                                          <input name="Diabetes" type="radio" value="No" <?php if(isset($_GET['orde'])){if($diabetes1=='No'){ echo 'checked'; }} ?>> No
                                                                          </label> 
                                                                       </td>
                                                  
                                                                    
                                                                    <tr>
                                                                    <td><label>Ataques De Corazon:</label></td>
                                                                    <td>
                                                                        <label class="radio inline styled">
                                                                          <input name="Ataques" type="radio" value="Si" <?php if(isset($_GET['orde'])){if($ataques1=='Si'){ echo 'checked'; }} ?>>Si
                                                                          </label>
                                                                          <label class="radio inline styled">
                                                                          <input name="Ataques" type="radio" value="No" <?php if(isset($_GET['orde'])){if($ataques1=='No'){ echo 'checked'; }} ?>> No
                                                                          </label> 
                                                   </td>
                                                               
                                                                    <td><label>Hipertension:</label></td>
                                                                    <td>
                                                                        <label class="radio inline styled">
                                                                          <input name="Hipertencion" type="radio" value="Si" <?php if(isset($_GET['orde'])){if($hipertencion=='Si'){ echo 'checked'; }} ?>>Si
                                                                          </label>
                                                                          <label class="radio inline styled">
                                                                          <input name="Hipertencion" type="radio" value="No" <?php if(isset($_GET['orde'])){if($hipertencion=='No'){ echo 'checked'; }} ?>> No
                                                                          </label> 
                                                                       </td>
                                                                    
                                                                    <tr>
                                                                    <td><label>Emfermedades Renales:</label></td>
                                                                    <td>
                                                                        <label class="radio inline styled">
                                                                          <input name="Emfermedades" type="radio" value="Si" <?php if(isset($_GET['orde'])){if($emfermedades=='Si'){ echo 'checked'; }} ?>>Si
                                                                          </label>
                                                                          <label class="radio inline styled">
                                                                          <input name="Emfermedades" type="radio" value="No" <?php if(isset($_GET['orde'])){if($emfermedades=='No'){ echo 'checked'; }} ?>> No
                                                                          </label> 
                                                                        </td>
                                                               
                                                                    <td><label>Tuberculosis:</label></td>
                                                                    <td>
                                                                        <label class="radio inline styled">
                                                                          <input name="Tuberculosis" type="radio" value="Si" <?php if(isset($_GET['orde'])){if($tuberculosis1=='Si'){ echo 'checked'; }} ?>>Si
                                                                          </label>
                                                                          <label class="radio inline styled">
                                                                          <input name="Tuberculosis" type="radio" value="No" <?php if(isset($_GET['orde'])){if($tuberculosis1=='No'){ echo 'checked'; }} ?>> No
                                                                          </label> 
                                                                      </td>
                                                                    
                                                                     
                                                                </tr>
                                                                 <tr>
                                                                    <td><label>Otras:</label></td>
                                                                    <td>
                                                                        <label class="radio inline styled">
                                                                          <input id="checkBox" onclick="enableDisable(this.checked, 'textBox')"name="Otras" type="radio" value="Si" <?php if(isset($_GET['orde'])){if($otras1=='Si'){ echo 'checked'; }} ?>>Si
                                                                          </label>
                                                                          <label class="radio inline styled">
                                                                          <input name="Otras" type="radio" value="No" <?php if(isset($_GET['orde'])){if($otras1=='No'){ echo 'checked'; }} ?>> No
                                                                          </label> 
                                                                     </td>
                                                               
                                                                    <td><label>Especifique:</label></td>
                                                                    <td>  <input id="textBox" type="text" name="Especifique" <?php if(isset($_GET['orde'])){if($otras1=='Si'){echo 'enabled';}} ?> value="<?php if(isset($_GET['orde'])){echo $especifique1;} ?>">  
                                                                     
                                                                </tr>
                                                               </table>
                                    </article>
       
			<header><h4 class="title">Antecedentes Personales</h4></header>
                        
                        
                          
                                      <table class="table table-bordered table-striped table-hover">   
                                          <tr>
                                                   <td><label>Alcohol:</label></td>
                                                                    <td>
                                                                         <label class="radio inline styled">
                                                                          <input name="Alcohol" type="radio" value="Si" <?php if(isset($_GET['orde'])){if($alcohol=='Si'){ echo 'checked'; }} ?>>Si
                                                                          </label>
                                                                          <label class="radio inline styled">
                                                                          <input name="Alcohol" type="radio" value="No" <?php if(isset($_GET['orde'])){if($alcohol=='No'){ echo 'checked'; }} ?>> No
                                                                          </label> 
                                                                      </td>   
                                                                 <td><label>Cancer: </label></td>
                                                                    <td>
                                                                         <label class="radio inline styled">
                                                                          <input name="Cancer1" type="radio" value="Si" <?php if(isset($_GET['orde'])){if($cancer=='Si'){ echo 'checked'; }} ?>>Si
                                                                          </label>
                                                                          <label class="radio inline styled">
                                                                          <input name="Cancer1" type="radio" value="No" <?php if(isset($_GET['orde'])){if($cancer=='No'){ echo 'checked'; }} ?>> No
                                                                          </label> 
                                                                      </td> 
                                                                       <td><label>Hipertensiòn: </label></td>
                                                                    <td>
                                                                         <label class="radio inline styled">
                                                                          <input name="Hipertencion1" type="radio" value="Si" <?php if(isset($_GET['orde'])){if($hiper=='Si'){ echo 'checked'; }} ?>>Si
                                                                          </label>
                                                                          <label class="radio inline styled">
                                                                          <input name="Hipertencion1" type="radio" value="No" <?php if(isset($_GET['orde'])){if($hiper=='No'){ echo 'checked'; }} ?>> No
                                                                          </label> 
                                                                      </td>   
                                                                      </tr>
                                                             <tr><td><label>Tabaco:</label></td>
                                                                    <td>
                                                                        <label class="radio inline styled">
                                                                          <input name="Tabaco" type="radio" value="Si" <?php if(isset($_GET['orde'])){if($tabaco=='Si'){ echo 'checked'; }} ?>>Si
                                                                          </label>
                                                                          <label class="radio inline styled">
                                                                          <input name="Tabaco" type="radio" value="No" <?php if(isset($_GET['orde'])){if($tabaco=='No'){ echo 'checked'; }} ?>> No
                                                                          </label> 
                                                                       </td>
                                                                       <td><label>Diabetes:</label></td>
                                                                    <td>
                                                                         <label class="radio inline styled">
                                                                          <input name="Diabetes1" type="radio" value="Si" <?php if(isset($_GET['orde'])){if($diabetes=='Si'){ echo 'checked'; }} ?>>Si
                                                                          </label>
                                                                          <label class="radio inline styled">
                                                                          <input name="Diabetes1" type="radio" value="No" <?php if(isset($_GET['orde'])){if($diabetes=='No'){ echo 'checked'; }} ?>> No
                                                                          </label> 
                                                                      </td> 
                                                        <td><label>Emfermedades Renales:</label></td>
                                                                    <td>
                                                                         <label class="radio inline styled">
                                                                          <input name="Emfermedades1" type="radio" value="Si" <?php if(isset($_GET['orde'])){if($emfermedades1=='Si'){ echo 'checked'; }} ?>>Si
                                                                          </label>
                                                                          <label class="radio inline styled">
                                                                          <input name="Emfermedades1" type="radio" value="No" <?php if(isset($_GET['orde'])){if($emfermedades1=='No'){ echo 'checked'; }} ?>> No
                                                                          </label> 
                                                                      </td>   
                                                                   </tr>
                                                                   <tr>
                                                                       <td><label>Drogas:</label></td>
                                                                    <td>
                                                                        <label class="radio inline styled">
                                                                          <input name="Drogas" type="radio" value="Si" <?php if(isset($_GET['orde'])){if($drogas=='Si'){ echo 'checked'; }} ?>>Si
                                                                          </label>
                                                                          <label class="radio inline styled">
                                                                          <input name="Drogas" type="radio" value="No" <?php if(isset($_GET['orde'])){if($drogas=='No'){ echo 'checked'; }} ?>> No
                                                                          </label> 
                                                                        </td>
                                                                        <td><label>Ataques De Corazòn:</label></td>
                                                                    <td>
                                                                         <label class="radio inline styled">
                                                                          <input name="Ataques1" type="radio" value="Si" <?php if(isset($_GET['orde'])){if($ataques=='Si'){ echo 'checked'; }} ?>>Si
                                                                          </label>
                                                                          <label class="radio inline styled">
                                                                          <input name="Ataques1" type="radio" value="No" <?php if(isset($_GET['orde'])){if($ataques=='No'){ echo 'checked'; }} ?>> No
                                                                          </label> 
                                                                      </td> 
                                                                       <td><label>Tuberculosis:</label></td>
                                                                    <td>
                                                                         <label class="radio inline styled">
                                                                          <input name="Tuberculosis1" type="radio" value="Si" <?php if(isset($_GET['orde'])){if($tuberculosis=='Si'){ echo 'checked'; }} ?>>Si
                                                                          </label>
                                                                          <label class="radio inline styled">
                                                                          <input name="Tuberculosis1" type="radio" value="No" <?php if(isset($_GET['orde'])){if($tuberculosis=='No'){ echo 'checked'; }} ?>> No
                                                                          </label> 
                                                                      </td>   
                                                           </tr>
                                      </table>
                                    <table class="table table-bordered table-striped table-hover">   
                                                                
                                                                 <tr>
                                                                    <td><label>Otras:</label></td>
                                                                    <td>
                                                                        <label class="radio inline styled">
                                                                          <input name="Otras1" type="radio" value="Si" <?php if(isset($_GET['orde'])){if($otras=='Si'){ echo 'checked'; }} ?>>Si
                                                                          </label>
                                                                          <label class="radio inline styled">
                                                                          <input name="Otras1" type="radio" value="No" <?php if(isset($_GET['orde'])){if($otras=='No'){ echo 'checked'; }} ?>> No
                                                                          </label> 
                                                                        </td>
                                                               
                                                                    <td><label>Especifique:</label></td>
                                                                    <td>  <input type="text" name="Especifique1" <?php if(isset($_GET['orde'])){if($otras=='Si'){echo 'enabled';}} ?> value="<?php if(isset($_GET['orde'])){echo $especifique;} ?>">  
                                                                  </tr> </table>
                                  
                                     <table class="table table-bordered table-striped table-hover">  <tr> 
                                             <td>MEDICAMENTOS: Enumere la dòsis o el nùmero de pìldoras por dìa</td>
                                             <td><textarea style="width:350%;" rows="2" name="Medicamentos"><?php if(isset($_GET['orde'])){echo $medicamentos;} ?></textarea> </td>
                                             
                                             </tr>
                                    
                                     <tr>
                                          <td><label>Alergia a Drogas:</label></td>
                                            <td>
                                                <label class="radio inline styled">
                                                                          <input name="Alergias" type="radio" value="Si" <?php if(isset($_GET['orde'])){if($alergias=='Si'){ echo 'checked'; }} ?>>Si
                                                                          </label>
                                                                          <label class="radio inline styled">
                                                                          <input name="Alergias" type="radio" value="No" <?php if(isset($_GET['orde'])){if($alergias=='No'){ echo 'checked'; }} ?>> No
                                                                          </label> 
                                            </td>
                                                                    
                                            <td><label>Cuales?:</label></td>
                                            <td>  <input type="text" name="Cuales1" <?php if(isset($_GET['orde'])){if($alergias=='Si'){echo 'enabled';}else{echo 'disabled';}} ?> value="<?php if(isset($_GET['orde'])){echo $cuales1;} ?>" > , <input type="text" name="Cuales2" <?php if(isset($_GET['orde'])){if($alergias=='Si'){echo 'enabled';}else{echo 'disabled';}}  ?> value="<?php if(isset($_GET['orde'])){echo $cuales2;} ?>"> ,<input type="text" name="Cuales3" <?php if(isset($_GET['orde'])){if($alergias=='Si'){echo 'enabled';}else{echo 'disabled';}} ?> value="<?php if(isset($_GET['orde'])){echo $cuales3;} ?>"> , 
                                                                    
                                      </tr> </table>
                      
			<header><h4 class="title">EXAMENES COMPLEMENTARIOS</h4></header>
                        
                        
				
                          
                                       <table class="table table-bordered table-striped table-hover">  <tr>
                                                                    <td><label>Laboratorios</label></td>
                                                                    <td><div>si <input type="radio" name="Laboratorios" value="Si" onclick="activar3(0)" <?php if(isset($_GET['orde'])){if($laboratorios=='Si'){ echo 'checked'; }} ?>> </div><div>no <input type="radio" name="Laboratorios"  value="No"  onclick="activar3(1)" <?php if(isset($_GET['orde'])){if($laboratorios=='No'){ echo 'checked'; }}else{echo 'checked';}  ?>></div> </td>
                                                               
                                                                     <td><label>Cuales?</label></td>
                                                                    <td>  <input type="text" name="Cuales4" <?php if(isset($_GET['orde'])){if($laboratorios=='Si'){echo 'enabled';}else{echo 'disabled';}} ?> value="<?php if(isset($_GET['orde'])){echo $cuales4;} ?>"> ,<input type="text" name="Cuales5"  <?php if(isset($_GET['orde'])){if($laboratorios=='Si'){echo 'enabled';}else{echo 'disabled';}} ?> value="<?php if(isset($_GET['orde'])){echo $cuales5;} ?>">,<input type="text" name="Cuales6"  <?php if(isset($_GET['orde'])){if($laboratorios=='Si'){echo 'enabled';}else{echo 'disabled';}} ?> value="<?php if(isset($_GET['orde'])){echo $cuales6;} ?>"> </td>
                                                                    
                                                                     
                                                                    <td></td>  <td></td>
                                                                     
                                                                </tr>
                                                                
                                                                <tr>
                                                                    <td><label>Otros Estudios</label></td>
                                                                    <td><div>si <input type="radio" name="Otros" value="Si" onclick="activar4(0)" <?php if(isset($_GET['orde'])){if($otros=='Si'){ echo 'checked'; }} ?>> </div><div>no <input type="radio" name="Otros"  value="No"  onclick="activar4(1)" <?php if(isset($_GET['orde'])){if($otros=='No'){ echo 'checked'; }}else{echo 'checked';}  ?>></div></td>
                                                               
                                                                     <td><label>Cuales?</label></td>
                                                                    <td>  <input type="text" name="Cuales7"  <?php if(isset($_GET['orde'])){if($otros=='Si'){echo 'enabled';}else{echo 'disabled';}} ?> value="<?php if(isset($_GET['orde'])){echo $cuales7;} ?>"> ,<input type="text" name="Cuales8"  <?php if(isset($_GET['orde'])){if($otros=='Si'){echo 'enabled';}else{echo 'disabled';}} ?> value="<?php if(isset($_GET['orde'])){echo $cuales8;} ?>">,<input type="text" name="Cuales9"  <?php if(isset($_GET['orde'])){if($otros=='Si'){echo 'enabled';}else{echo 'disabled';}} ?> value="<?php if(isset($_GET['orde'])){echo $cuales9;} ?>"> </td>
                                                                     <td></td>  <td></td>
                                                                     
                                                                </tr> </table>
                                    


   
 </form>
</div>
            

