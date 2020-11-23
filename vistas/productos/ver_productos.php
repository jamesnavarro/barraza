<?php
 if(isset($_GET['cod'])){
require '../modelo/consultar_productos.php';
 }
 ?>
                    <div class="row-fluid">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Detalle del Producto</h4>
                            </header>
                            <section class="body">
                                <div class="body-inner">
                                    <div class="row-fluid">
                                        <div class="span4">
                                            <ul class="arrow">
                                                <li><b>Descripcion del Producto:</b><?php  echo $producto;  ?></li>
                                                <li><b>Codigo:</b> <?php if(isset($_GET['cod'])){ echo $codigo ;}  ?></li>
                                               
                                                <li><b>Referencia:</b><?php  echo $referencia;  ?> </li>
                                               
                                            </ul>
                                        </div>
                                        <div class="span4">
                                            <ul class="arrow">
                                                
                                                <li><b>Linea:</b><?php  echo $linea;  ?></li>
                                                <li><b>Fecha de Registro:</b><?php  echo $registro;  ?></li>
                                                 <li><b> Costo Base $:</b><?php  echo number_format($precio);  ?></li>
                                                </ul>
                                        </div>
                                       <div class="span4">
                                            <ul class="arrow">
                                                <a href="../vistas/?id=producto&cod=<?php  echo $_GET["cod"];  ?>"><img src="../imagenes/modificar.png"></a>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                    <!--/ END List Styling -->
   <?php
 if(isset($_GET['cod'])){
     require '../vistas/productos/actividades.php';
require '../vistas/productos/soporte.php';
 }
 ?>