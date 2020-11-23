<?php
include "../modelo/conexion.php";
    $con= "SELECT * from cont_codigos_contables where cod_cod_cont = '".$_POST["elegido2"]."'";
    $res=  mysql_query($con);
    
  
       $f=  mysql_fetch_array($res);
            $nombre = $f['nom_cod_cont'];
            $fiscal = $f['desc_fiscal'];
            $niif = $f['desc_niif'];
             $naturaleza = $f['naturaleza'];
              $tipo_trm = $f['tipo_trm'];
               $ane_tercero = $f['ane_tercero'];
                $ane_costo = $f['ane_costo'];
                 $ane_retencion = $f['ane_retencion'];
                  $cod_presupuesto = $f['codigo_presupesto'];  
                  $cod_tri_cod_cont = $f['cod_tri_cod_cont'];
                 $estado = $f['estado_cod_cont'];
        ?>
            <label></label><div class="controls"> </div>
            <label class="control-label">Descripcion CONTABLE</label>
            <div class="controls">
                <input type="text" autocomplete="off" name="nombre" value="<?php echo $nombre;  ?>" class="span4" placeholder="" required>
            </div>
               <label></label><div class="controls"> </div>
            <label class="control-label">Descripcion FISCAL</label>
            <div class="controls">
                <input type="text" autocomplete="off" name="fiscal" value="<?php echo $fiscal;  ?>" class="span4" placeholder="" required>
            </div>
              <label></label><div class="controls"> </div>
            <label class="control-label">Descripcion NIIF</label>
            <div class="controls">
                <input type="text" autocomplete="off" name="niif" value="<?php echo $niif;  ?>" class="span4" placeholder="" required>
            </div>
            <label></label><div class="controls"> </div>  
                                            <label class="control-label">Naturaleza</label>
                                            <div class="controls">
                                                <select name="naturaleza">
                                                    <?php
                                                        
                                                            if($naturaleza == 1){ ?>
                                                                <option value="<?php echo $naturaleza; ?>">1-Debito</option>
                                                                <option value="2">2-Credito</option>
                                                                <option value="3">3-Anexo Tercero</option>
                                                            <?php }else if($naturaleza == 2){ ?>
                                                                <option value="<?php echo $naturaleza; ?>">2-Credito</option>
                                                                <option value="1">1-Debito</option>
                                                                <option value="3">3-Anexo Tercero</option>
                                                            <?php }else{ ?>
                                                                <option value="<?php echo $naturaleza; ?>">3-Todos</option>
                                                                <option value="1">1-Debito</option>
                                                                <option value="2">2-Credito</option>
                                                            <?php }
                                                     
                                                    ?>
                                                   
                                                </select>
                                            </div> 
                                            
                                            <label></label><div class="controls"> </div>  
                                            <label class="control-label">Tipo T.R.M</label>
                                            <div class="controls">
                                                <select name="tipotrm">
                                                    <?php
                                                        if(isset($_GET['up'])){
                                                            if($tipo_trm == 0){ ?>
                                                                <option value="<?php echo $tipo_trm; ?>">0-Ninguna</option>
                                                                <option value="2">2-Credito</option>
                                                                <option value="3">3-Todos</option>
                                                            <?php }else if($tipo_trm == 2){ ?>
                                                                <option value="<?php echo $tipo_trm; ?>">2-Credito</option>
                                                                <option value="1">1-Debito</option>
                                                                <option value="3">3-Todos</option>
                                                            <?php }else{ ?>
                                                                <option value="<?php echo $tipo_trm; ?>">3-Ninguno</option>
                                                                <option value="1">1-Debito</option>
                                                                <option value="2">2-Credito</option>
                                                            <?php }
                                                        }else{ ?>
                                                               
                                                                <option value="1">0-Ninguna</option>
                                                               
                                                        <?php }
                                                    ?>
                                                </select>
                                            </div> 
                                            <!-- Consecutivo -->
                                            <label></label><div class="controls"> </div>  
                                            <label class="control-label">Codigo Tributario</label>
                                            <div class="controls">
                                                <input type="text" autocomplete="off" name="cod_tributario" value="<?php echo $cod_tri_cod_cont;  ?>" class="span4" placeholder="" required>
                                            </div>
                                            <label></label><div class="controls"> </div>    
                                            <label class="control-label">Codigo Presupuesto</label>
                                            <div class="controls">
                                                <input type="text" autocomplete="off" name="cod_presupuesto" value="<?php echo $cod_presupuesto;  ?>" class="span4" placeholder="" required>
                                            </div>
                                            <label></label><div class="controls"> </div>  
                                             <!-- Observacion -->
                                            <div class="controls">
                                                <table>
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" <?php if($ane_tercero > 0){echo 'checked';} ?> value="1" name="aneter">1- Anexos de Tercero
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" <?php if($ane_costo > 0){echo 'checked';} ?> value="2" name="anecos">2- Anexos de Costo
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" <?php if($ane_retencion > 0){echo 'checked';} ?> value="3" name="aneret">3- Anexos de Retencion
                                                        </td>
                                                        <td>
                                                            <input type="checkbox" <?php if($estado > 0){echo 'checked';} ?> value="4" name="estado">4-Cuenta Inactiva
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                             <label></label><div class="controls"> </div>  
                                             <?php
                                                  if (isset($_GET['up'])) {
                                                    ?>
                                                   
                                                   <label></label>
                                                   <legend>Estado</legend>
                                                  <div class="controls"> 
                                                      <input type="radio" name="estado" <?php if(isset($_GET['up'])){ if($estado_cont =='1'){echo 'checked';} }  ?> value="1">
                                                      <label>Desactivar</label>
                                                      <input type="radio" name="estado" <?php if(isset($_GET['up'])){ if($estado_cont =='0'){echo 'checked';} }  ?> value="0">
                                                      <label>Activar</label>
                                                      
                                                  </div>
                                                    
                                                   
                                                  <?php
                                                }

                                               ?>
                                            
                                           
                                    <!-- Form Action -->
                                    <div class="form-actions">
                                        <?php 
                                            if(!isset($nombre)){ ?>
                                        <button type="submit" name="Guardar" class="btn btn-primary">Guardar</button>
                                            <?php }else{ ?>
                                         <button type="submit" name="Editar" class="btn btn-primary">Editar</button>
                                            <?php } ?>
                                                <a href="../vistas/?id=codigos"><button type="button" class="btn">Cancelar</button></a>
                                    </div><!--/ Form Action -->



