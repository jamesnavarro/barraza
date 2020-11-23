<?php 
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
    $consulta2= "select * from inf_empresa";
$result3=  mysql_query($consulta2);
while($fila=  mysql_fetch_array($result3)){
$id_emp=  $fila['id_emp']; 
$nombre=$fila['nombre'];
$web_empe=$fila['web_emp'];
$siglas=$fila['siglas'];
$prop=$fila['gerente'];
$ni=$fila['nit_emp'];
$facti=$fila['factura_inicial'];
$factf=$fila['factura_final'];
$te1=$fila['telefono_1'];
$fax1=$fila['telefono_2'];
$cel_emp=$fila['telefono_3'];
$depa=$fila['dapartamento'];
$munici=$fila['municipio'];
$dire1=$fila['direccion'];
$emai1=$fila['email'];
$info=$fila['inf'];}
if(isset($_GET['up'])){
$consulta= mysql_query("select * from rangos_facturas where id_rango=".$_GET['up']." ");
$res = mysql_fetch_array($consulta);
$resolucion = $res['resolucion'];
}
?>


<!--<<!--          ------------------------------------------------------------------------------------------------------------------------------------------- ->-->

<div class="row-fluid">
    <section class="body">
        <div class="body-inner">
            <div class="span12 widget dark stacked">
                <header>
                    <h4 class="title">Datos de la empresa</h4>
                    <ul class="toolbar pull-left">
                        <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>
                    </ul>
                </header>
                <section id="collapse1" class="body collapse in">
                    <div class="body-inner">
                        <font color="red">Aviso los (*) Indican campo Obligatorio.</font>
                        <div class="tabbable" style="margin-bottom: 25px;">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab8">
                                    <div class="control-group">
                                   
                                        <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php echo "../modelo/editar_mi_empresa.php?editar=".$id_emp.""; ?>" method="post" id="form_validate_html" enctype="multipart/form-data">
                                            <div class="row-fluid">
                                                <section class="body" >
                                                    <div class="body-inner">
                                                          <h4 class="inf">Información de la Empresa</h4>
                                 
							<label>Nombre: *</label>
							<input type="text" value="<?php echo $nombre; ?>" style="width:92%;" name="nombre_emp">
                                                        <label>Web:</label>
                                                        <input type="text" value="<?php echo $web_empe; ?>" style="width:92%;" name="web">
                                                         <label>Siglas:</label>
       							 <input type="text" value="<?php echo $siglas; ?>" style="width:92%;" name="simbolo">
                                                         <label>Gerente:</label>
       							 <input type="text" value="<?php echo $prop; ?>" style="width:92%;" name="propietario"><div class="clear"></div>
                                                         <label>Nit:</label>
       							 <input type="text" value="<?php echo $ni; ?>" style="width:92%;" name="nit">
                                                         <label>Telefono oficina:</label>
       							 <input type="text" style="width:92%;" name="telefono_emp" value="<?php echo $te1; ?>">
                                                         <label>Fax Oficina:</label>
       							 <input type="text" style="width:92%;" name="fax_emp" value="<?php echo $fax1; ?>">
                                                         <label>Celular:</label>
       							 <input type="text" style="width:92%;" name="celular_emp" value="<?php echo $cel_emp; ?>">
                                                         <label>Rango de Facturacion:</label>
       							 <input type="text" style="width:20%;" name="fact1" value="<?php echo $facti; ?>">
                                                         
       							 <input type="text" style="width:20%;" name="fact2" value="<?php echo $factf; ?>">
                                                        
                                                          <h4 class="direccion">Direccion</h4>
						           <label>Departamento :</label>
                                                         <select name="departamento_emp" id="combo1" style="width:25%;">	
                                                         
                                                           <?php if(isset($depa)){
                                                            include "modelo/conexion.php";
                                                            $consulta= "select * from departamentos WHERE cod_dep=".$depa." group by cod_dep";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1=$fila['cod_dep'];
                                                            $valor2=$fila['nombre_dep'];
                                                         

                                                            echo"<option value='".$valor1."'>".$valor2."</option>";
                                                            
                                                            }}
                                                            ?>
                                                           
                                                          <option value="">Seleccione uno..</option>
                                                          <?php
                                                            include "modelo/conexion.php";
                                                            $consulta= "select * from departamentos group by nombre_dep";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1=$fila['cod_dep'];
                                                            $valor2=$fila['nombre_dep'];
                                                         

                                                            echo"<option value='".$valor1."'>".$valor2."</option>";
                                                            
                                                            }
                                                            ?>
                                                            
                                                            
                                                        </select>
                                                        <label>Municipio :</label>
                                                        <select name="municipio_emp" id="combo2" style="width:25%;">
                                                             <?php if(isset($munici)){
                                                            include "modelo/conexion.php";
                                                            $consulta= "select * from departamentos WHERE cod_mun=".$munici." and cod_dep=".$depa."";                     
                                                            $result=  mysql_query($consulta);
                                                            while($fila=  mysql_fetch_array($result)){
                                                            $valor1=$fila['cod_mun'];
                                                            $valor2=$fila['nombre_mun'];
                                                         

                                                            echo"<option value='".$valor1."'>".$valor2."</option>";
                                                            
                                                            }}
                                                            ?>
                                                            <option value="">Seleccione uno</option>
                                                        </select><br><br>
							<label>Direccion</label>
							<textarea style="width:90%;" rows="3" name="direccion_emp" value=""><?php echo $dire1; ?></textarea>
                                           
                                    <h4 class="email">Dirección(es) de Email</h4>
				
                                                         <label>Email Empresarial: *</label>
       							 <input type="text" style="width:92%;" name="email_emp1" value="<?php echo $emai1; ?>">
                                                         
                                                        
						
                               
                                        <label>Informacion Adicional</label>
                                        <textarea style="width:90%;" rows="8" name="inf_emp"><?php echo $info; ?></textarea>
                          
                                     <hr><br>
                        <input type="submit" name="enviar" value="Guardar" class="alt_btn">
					<a href="../vistas/mostrar_empresas.php"><input type="button" value="Cancelar"></a>
                                                       
                                                        <div class="form-actions">
                                                           
                                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                                            <a href="../vistas/?id=areas"><button type="button" class="btn">Cancelar</button></a>
                                                        </div>
                                                    </div>
                                                </section>
                                            </div>
                                        </form>
                                        <form class="span12 widget shadowed dark form-horizontal bordered" name="insertar_empresa" action="<?php if (isset($_GET['up'])){echo "../modelo/insertar_mi_empresa_1.php?editar=".$id_emp."&co=".$_GET['up']."";}else{echo '../modelo/insertar_mi_empresa_1.php?editar='.$id_emp.'';} ?>" method="post" enctype="multipart/form-data">
		<div class="clear"></div>
                <div class="module_content"> 
                     
                                        <label>Resolucion</label>
                                        <textarea style="width:90%;" rows="8" name="resolucion"><?php if (isset($_GET['up'])){echo $resolucion;} ?></textarea>
                      <input type="submit" name="enviar" value="Guardar" class="alt_btn">
                     </div>
                     </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                     <div class="module_content">
                    <?php
                    
                    $request=  mysql_query('select * from rangos_facturas');

if($request){
//    echo'<hr>';
    $table = '<table class="table table-bordered table-striped table-hover" id="">';

              $table = $table.'<thead>';
              $table = $table.'<tr>';
              $table = $table.'<th>'.'Registro'.'</th>';
              $table = $table.'<th>'.'Resolucion'.'</th>';
              $table = $table.'<th>'.'Editar'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
           $table = $table.'</tr>';
$table = $table.'</thead>';
 
      
	while($row=mysql_fetch_array($request))
	{     
         
        
           $table = $table.'<tr><td>'.$row["registro"].'</a></td>
               <td>'.$row["resolucion"].'</td><td><a href="../vistas/?id=mi_empresa&up='.$row["id_rango"].'">Editar</a></td></tr>';
	}
        $table = $table.'</table>';
        echo $table;
        
}
            
                    ?>
                </div> 
                </section>
            </div>
        </div>
    </section>
</div>
 

