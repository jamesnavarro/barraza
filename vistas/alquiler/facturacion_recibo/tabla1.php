<?php 
include '../vistas/alquiler/facturacion_recibo/consulta.php';
 ?>
<form name="insertar_empresa" action="../modelo/editar_pago.php" method="post" enctype="multipart/form-data">
    <article class="module width_full">
        <hr>
        <a target="_blank" href="../imprimir_recibo.php?imprimir=<?php echo $num_fact ?>"><input type="button" name="bo" value="Imprimir"/> </a>
         <a href="../vistas/?id=recibo_de_caja"><input type="button" value="Cancelar"></a>
        <hr><br>
        <hr><br>
        <?php if(isset($_GET['fact'])){  ?>
        <section id="collapse1" class="body collapse in">
                        <div class="body-inner">
                            <article class="module width_full">
        <table class="table table-bordered table-striped table-hover" id=""> 
            <tr>
                <td><label>Empresa:</label></td>
                <td><?php echo "$nombre_seguro"; ?></td>
                <td><label>Dirección:</label></td>
                <td><?php echo "$direccion_seguro"; ?></td>
            </tr>
            <tr>
                <td><label>Nit:</label></td>
                <td><?php echo "$nit_seguro"; ?></td>
                <td><label>Telefono:</label></td>
                <td><?php echo "$telefono_seguro"; ?></td>
            </tr>
        </table>
                            </article><br><br>
        <table class="table table-bordered table-striped table-hover" id=""> 
            <tr>
                <td><label>Paciente:</label></td>
                <td><?php echo "$nombre_paciente"; ?></td>
                <td><label># Documento:</label></td>
                <td><?php echo "$cedula_paciente"; ?></td>
                <td><label>Orden Externa:</label></td>
                <td><?php echo $ord_ext; ?></td>
            </tr>
            <tr>
                <td><label>Historia Clinica:</label></td>
                <td><?php echo ""; ?></td>
                <td><label>Diagnostico:</label></td>
                <td><?php echo "$enfermedad"; ?></td>
                <td><label>Archivo:</label></td>
                <td><?php echo "$orden_int"; ?></td>
            </tr>
        </table> <br><br>
        <?php }if(isset($_GET['factura'])){ ?>
        <table class="table table-bordered table-striped table-hover" id=""> 
            <tr>
                <td><label>Cliente:</label></td>
                <td><?php echo "$cliente"; ?></td>
                <td><label>C.C ó Nit:</label></td>
                <td><?php echo "$numero_doc"; ?></td>
            </tr>
            <tr>
                <td><label>Telefeno:</label></td>
                <td><?php echo "$telefono"; ?></td>
                <td><label>Direccion:</label></td>
                <td><?php echo "$direccion"; ?></td>
            </tr>
        </table><br><br>
        <?php } ?>
        <table class="table table-bordered table-striped table-hover" id=""> 
            <tr>
                <td><label>Forma de Pago:</label></td>
                <td><?php echo "$forma_pago"; ?> a <?php echo "$me"; ?> Mes(es)</td>
                <td><label></label></td>
                <td></td>
            </tr>
            <tr>
                <td><label>Fecha Vencimiento:</label></td>
                <td><?php echo "$fv"; ?></td>
                <td><label>Pago Pendiente:</label></td>
                <td><?php echo "$p"; if($p=='Si'){echo ' <input type="submit" name="crear" value="Pagar"></a>';} ?></td>
            </tr>
        </table>
                                               </div>
        </section>
    </article>
</form>