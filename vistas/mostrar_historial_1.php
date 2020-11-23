<?php 

include "../modelo/conexion.php";
require '../modelo/insertar_consulta.php';
require '../modelo/consultar_permisos.php';
require '../modelo/consultar_paciente.php';
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<title>Idb</title>
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
<section id="main" class="column">
		<div class="clear"></div>
                <form name="insertar_empresa" action="../modelo/insertar_empresa.php" method="post" enctype="multipart/form-data">
		<article class="module width_full">
			<header><h3>Notas de Evolucion</h3></header>
                        
                        
				<div class="module_content"> 
                            <h4 class="inf">Paciente :<?php 
                                        echo $nn;
                                        ?>, C.C. <?PHP ECHO $doc ?>
                                        &nbsp;( Fecha de Consulta: <?php 
                                        echo $Fecha_registro ;
                                        ?>)</h4><br>
                                        <hr>
                                        <?php if(!isset($_GET['ver'])){ ?>
                                            <a href="../vistas/historial_clinico_1.php?editar=<?php echo $_GET['cod'].'&pac='.$_GET['pac']; ?>"> <input type="button" name="enviar" value="Editar" class="alt_btn"></a>
                                        <?php } ?>
                                            <hr><br>
                                        
                                       <fieldset >
                                     <fieldset> 
                                                   <header><h3>Motivo de la consulta</h3></header>
                                                   <table>
                                                       <tr>
                                                           <td><label>Diagnostico: </label></td>
                                                          
                                                        </tr>
                                                       
                                                         <tr>
                                                           <td><?php  echo $enf  ?></td>
                                              
                                                          </tr>
							<tr>
                                                           <td><label>ANAMNESIS: </label></td>
                                                          
                                                        </tr>
                                                       
                                                         <tr>
                                                           <td><?php  echo $motivo  ?></td>
                                              
                                                          </tr>
                                                          
                                                     </table>
                                        
						</fieldset>
                                        </fieldset>
                                       </fieldset>
                                        
                                        
                                        <fieldset >
                                 
                                              <fieldset> 
                                                    <header><h3>EXAMENES FÌSICOS</h3></header>
                                                    
                                                       <table>
                
<!--                                                                 <tr>
                                                                    <td><label>Conciente:</label><?php  echo $conciente?> </td>
                                                                    <td><label>FR :</label><?php  echo $fr?> </td>
                                                                    <td></td>
                                                                </tr>
                                                            
                                                                 <tr>
                                                                   <td><label>Somnoliento:</label><?php  echo $somnoliento?></td>
                                                                     <td><label>PULSO:</label><?php  echo $pULSO?> </td>
                                                                     <td></td>
                                                                  </tr>
                                                                   <tr>
                                                                   <td><label>Signos Vitales:</label> </td>
                                                                   <td></td>
                                                                   <td></td>
                                                                   </tr>
                                                                   <tr>
                                                                   <td><label>TA:</label><?php  echo $ta?></td>
                                                                   <td><label>Axilar :</label> <?php  echo $axilar?></td>
                                                                   <td></td>
                                                                   </tr>
                                                                   
                                                                   <tr>
                                                                  <td><label>FC:</label><?php  echo $fc?></td>
                                                                      <td><label>Peso Actual:</label><?php  echo $actual?></td>
                                                                      <td></td>
                                                                    </tr>-->
                                                           <tr>
                                                           <td><label>Descripciòn: </label></td>
                                                          
                                                        </tr>
                                                       
                                                         <tr>
                                                           <td><?php  echo $fisico  ?></td>
                                              
                                                          </tr>
                                                          </table>  
           </fieldset> </fieldset>
                                        <fieldset >
                                    
                                                      <fieldset> 
                                                    <header><h3>HALLAZGO DIAGNOSTICOS</h3></header>
                                                    
                                                       <table>
                
                                                                 <tr>
                                                                    <td><label>Descripciòn:</label> </td>
                                                                     <td></td>
                                                                      
                                                                      <tr>
                                                           <td><?php  echo $motivo2 ?></td>
                                                           <td></td>
                                                          </tr>
                                                                </tr>
                                                                  </table>  
                                                        
						</fieldset> </fieldset> 
                                       <fieldset >
                                     <fieldset > 
                                                    <header><h3>PLAN TERAPEUTICO</h3></header>
                                                    
                                                       <table>
                
                                                                 <tr>
                                                                    <td><label>Descripciòn:</label> </td>
                                                                
                                                                    
                                                                </tr>
                                                                 <tr>
                                                           <td><?php  echo $motivo3  ?></td>
                                              
                                                          </tr>
                                                             
            </table>  
             </fieldset>
                                        </fieldset>
                                       <hr><br>
</article>
                    </form>
		
		
		
		
		<div class="spacer"></div>
                
           
               
              
	</section>
              

</body>

</html>
