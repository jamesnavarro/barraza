<style>
    b{
        color: #000;
        font-family: "Times New Roman";
        font-size: 15px;
    }
</style>
<?php
 if(isset($_GET['cod'])){
require '../modelo/consultar_empresa.php';
 }
 ?>
                    <div class="row-fluid">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Informacion de la Empresa</h4>
                            </header>
                            <section class="body">
                                <div class="body-inner">
                                    <div class="row-fluid">
                                        <table class="table table-bordered table-striped table-hover" >
                                            <tr>
                                                <td>
                                                    <strong>Nombre de la Empresa:</strong>
                                                </td>
                                                <td >
                                                    <?php  echo $nombre_emp;  ?>
                                                </td>
                                                <td>
                                                    <strong> Asinado a:</strong>
                                                </td>
                                                <td>
                                                    <?php  echo $usuario;  ?>
                                                </td>    
                                            </tr>
                                            <tr>
                                                <td>
                                                   <strong>Nit :</strong>
                                                </td>
                                                <td >
                                                  <?php  echo $nit;  ?>
                                                </td>
                                                <td>
                                                   <strong>Direccion de Facturacion:</strong>
                                                </td>
                                                <td>
                                                    <?php  echo $dire1;  ?>
                                                </td>
                                                
                                            </tr>
                                             <tr>
                                                <td>
                                                  <strong>Web:</strong>
                                                </td>
                                                <td >
                                                  <?php  echo $web_empe;  ?>
                                                </td>
                                                <td>
                                                   <strong>Direccion de Envio:</strong>
                                                </td>
                                                <td>
                                                    <?php  echo $dire2;  ?>
                                                </td>
                                                
                                            </tr>
                                            <tr>
                                                <td>
                                                   <strong>Simbolo :</strong> 
                                                </td>
                                                <td>
                                                    <?php  echo $simbolo;  ?>
                                                </td>
                                                <td>
                                                    <strong>Telefeno oficina:</strong> 
                                                </td>
                                                <td>
                                                    <?php  echo $te1;  ?>
                                                </td>
                                            </tr>
                                              <tr>
                                                <td>
                                                   <strong>Contacto / Gerente :</strong>
                                                </td>
                                                <td>
                                                    <?php  echo $propietario;  ?>
                                                </td>
                                                <td>
                                                    <strong>Fax:</strong>
                                                </td>
                                                <td>
                                                    <?php  echo $fax1;  ?>
                                                </td>
                                            </tr>
                                              <tr>
                                                <td>
                                                    <strong>Industria :</strong>
                                                </td>
                                                <td>
                                                    <?php  echo $industria;  ?>
                                                </td>
                                                <td>
                                                    <strong>Celular:</strong>
                                                </td>
                                                <td>
                                                    <?php  echo $cel_emp;  ?>
                                                </td>
                                            </tr>
                                              <tr>
                                                <td>
                                                    <strong>Tipo :</strong>
                                                </td>
                                                <td>
                                                    <?php  echo $tipo;  ?>
                                                </td>
                                                <td>
                                                    <strong>Email Principal :</strong>
                                                </td>
                                                <td>
                                                    <?php  echo $emai1;  ?>
                                                </td>
                                            </tr>
                                            
                                             
                                              <tr>
                                                <td>
                                                    <strong></strong>
                                                </td>
                                                <td>
                                                  
                                                </td>
                                                <td>
                                                    <strong>Fecha Registro:</strong>
                                                </td>
                                                <td>
                                                    <?php  echo $registr;  ?>
                                                </td>
                                            </tr>
                                              <tr>
                                                <td>
                                                    <strong>RIPS :</strong>
                                                </td>
                                                <td>
                                                    <?php  echo $rips;  ?>
                                                </td>
                                                <td>
                                                    <strong>Modificado :</strong>
                                           
                                                </td>
                                                <td>
                                                    <?php  echo $registr_mo;  ?>
                                                </td>
                                            </tr>
                                              <tr>
                                                <td>
                                                    <strong>Detalle </strong>:
                                                </td>
                                                <td colspan="3">
                                                    <textarea rows="1" class="spans6" cols="1"><?php  echo $info;  ?></textarea>
                                                </td>
                                                
                                            </tr>
                                        </table>
<!--                                        <div class="span3">
                                            <ul class="arrow">
                                                <li><strong>Nombre de la Empresa:</strong><?php  echo $nombre_emp;  ?></li>
                                                <li><strong>Nit :</strong><?php  echo $nit;  ?></li>
                                                <li><strong>Web:</strong><?php  echo $web_empe;  ?></li>
                                                <li><strong>Simbolo :</strong><?php  echo $simbolo;  ?> </li>
                                                <li><strong>Propietario :</strong><?php  echo $propietario;  ?></li>
                                                <li><strong>Industria :</strong><?php  echo $industria;  ?></li>
                                                 <li><strong>Tipo :</strong><?php  echo $tipo;  ?></li>
                                                 <li><strong>Empleados:</strong><?php  echo $empleados;  ?></li>
                                                 <li><strong>Rating:</strong><?php  echo $puntaje;  ?></li>
                                                 <li><strong>Ingresos :</strong><?php  echo $ingre;  ?></li>
                                                  <li><strong>RIPS :</strong><?php  echo $rips;  ?></li>
                                            </ul>
                                        </div>
                                        <div class="span3">
                                            <ul class="arrow">
                                               
                                                
                                                <li><strong> Asinado a:</strong><?php  echo $usuario;  ?></li>
                                                <li><strong>Direccion de Facturacion:</strong><?php  echo $dire1;  ?></li>
                                                <li><strong>Direccion de Envio:</strong><?php  echo $dire2;  ?></li>
                                                <li><strong>Telefeno oficina:</strong><?php  echo $te1;  ?></li>
                                                <li><strong>Fax:</strong><?php  echo $fax1;  ?></li>
                                                <li><strong>Celular:</strong><?php  echo $cel_emp;  ?></li>
                                                
                                                <li><strong>Email Principal :</strong><?php  echo $emai1;  ?></li>
                                                <li><strong>Email Personal:</strong><?php  echo $emai2;  ?></li>
                                                <li><strong>Email Adicional:</strong><?php  echo $emai3;  ?></li>
                                                <li><strong>Fecha Registro:</strong><?php  echo $registr;  ?></li>
                                                <li><strong>Modificado :</strong><?php  echo $registr_mo;  ?></li>
                                            </ul>
                                        </div>-->
                                        <div class="span3">
                                            <ul class="arrow">
                                                
<!--                                                <li><strong>Detalle </strong>:<?php  echo $info;  ?></li>-->
    <br>                                            
    <?php 
                                                if($editar_emp=='Habilitado'){$up = '<img src="../imagenes/modificar.png">';}else{$up = '';}
                                                if($eliminar_emp=='Habilitado'){$del= '<img src="../imagenes/eliminar.png">';}else{$del = '';}
                                               
?>
                                                <a href="../vistas/?id=empresa&cod=<?php  echo $_GET["cod"];  ?>"><?php  echo $up;  ?></a>
                                                <a href="../vistas/?id=empresas&del=<?php  echo $_GET["cod"];  ?>"><?php  echo $del;  ?></a>
                                            </ul>
                                        </div>
<!--                                        <div class="span3">
                                            <img src="../imagenes/hospital.jpeg">
                                        </div>-->
                                       
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                    <!--/ END List Styling -->
<?php
 if(isset($_GET['cod'])){
require '../vistas/empresa/actividades.php';
//require '../vistas/empresa/soporte.php';
//require '../vistas/empresa/otros.php';
 }
 ?>