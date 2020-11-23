<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Rango de Factura</title>
<style>
table {
  border-collapse: collapse;
  font-size:10px;
}

table, td, th {
  border: 1px solid black;
}
</style>
    </head>
    <body>
        <form action="../vistas/rango.php?views=ok" method="post"  style="background: #212889">
        <div style="float: left">
        <table>
            <tr>
                <td><label>Factura Inicial</label></td>
                <td><input type="number" name="inicial" placeholder="# Inicial" autofocus></td>
            </tr>
             <tr>
                <td><label>Factura Final</label></td>
                <td><input type="number" name="final" placeholder="# Final"></td>
            </tr>
             <tr>
                 <td><input type="submit" value="Generar" name="generar"></td>
                <td></td>
            </tr>
        </table>
        </div>
        <div style="float: right">
            <img src="../images/logo-siigo.png">
        </div>

        </form>
        <br><br><br><br><br>
        <?php
        if(isset($_GET['views'])){
            include "../modelo/conexion.php";
            echo '<a href="../vistas/rango_excel_siigo.php?views=ok&download&inicial='.$_POST['inicial'].'&final='.$_POST['final'].'">Descargar en Excel</a>';
            echo '<div  style="background: #E0E4E6">';   
            if(isset($_GET['download'])){
                header('Content-type: application/vnd.ms-excel;charset=utf-8');
                header("Content-Disposition: attachment; filename=FormatoSiigo.xls");
                header("Pragma: no-cache");
                header("Expires: 0");
            
            }
/** Incluir la libreria PHPExcel */
echo '<table >';
echo '<tr>';
echo '<td>Tipo de comprobante</td>';
echo '<td>Consecutivo</td>';
echo '<td>Identificación tercero</td>';
echo '<td>Sucursal</td>';
echo '<td>Código centro/subcentro de costos</td>';
echo '<td>Fecha de elaboración  </td>';
echo '<td>Sigla Moneda</td>';
echo '<td>Tasa de cambio</td>';
echo '<td>Nombre contacto</td>';
echo '<td>Email Contacto</td>';
echo '<td>Orden de Compra</td>';
echo '<td>Orden de entrega</td>';
echo '<td>Fecha Orden</td>';
echo '<td>Código producto</td>';
echo '<td>Descripción producto</td>';
echo '<td>Identificación vendedor</td>';
echo '<td>Código de Bodega</td>';
echo '<td>Cantidad producto</td>';
echo '<td>Valor unitario</td>';
echo '<td>Valor Descuento</td>';
echo '<td>Base AIU</td>';
echo '<td>Código impuesto cargo</td>';
echo '<td>Código impuesto cargo dos</td>';
echo '<td>Código impuesto retención</td>';
echo '<td>Código ReteICA</td>';
echo '<td>Código ReteIVA</td>';
echo '<td>Código forma de pago</td>';
echo '<td>Valor Forma de Pago</td>';
echo '<td>Fecha Vencimiento</td>';
echo '<td>Observaciones</td>';
echo '</tr>';

$query_principal = mysql_query("select * from facturas where numero_factura  between '".$_POST['inicial']."' and '".$_POST['final']."' and estado=''  order by numero_factura asc ");
while ($fila = mysql_fetch_array($query_principal)) {
       $factura = $fila['numero_factura'];
       $arch=$fila['orden_int'];
       $id_paciente = $fila['id_paciente'];
       
       
       $query_empresa = mysql_query("select nit_emp,email1_emp from sis_empresa where rips='".$fila['id_empresa']."' ");
       $emp = mysql_fetch_array($query_empresa);
       $email = $emp['email1_emp'];
        if($id_paciente==0){
            $query = mysql_query("select *,count(cant_ins), sum(cuota_pagada) as cuota from actividad a where relacionado = '".$factura."'  and factura=''  GROUP BY cod_aten,precio_total  ");
        } else{
            $query = mysql_query("select * from actividad a where relacionado = '".$factura."'  and factura=''  group by orden_servicio  ");
        }
        
        $total = 0;
        $fecha_vencimiento ='';
        $copagos = 0;
        while ($row = mysql_fetch_array($query)) {
            
            $actual = strtotime($fila['fecha_registro']);
            $fecha_vencimiento = date("Y-m-d", strtotime("+1 month", $actual));
  
            if($row['codsiigo']==''){
                $cod = $row['cod_aten'];
            }else{
                 $cod = $row['codsiigo'];
            }
            if($id_paciente==0){
                $cantidad = $row['count(cant_ins)'];
                $cuota_pagada = $row['cuota'];
             } else{
                $cantidad = $row['cant'];
                $cuota_pagada = $row['cuota_pagada'];
             }
               $total += $cantidad*$row['precio_total'];
                $copagos += $cuota_pagada;
                echo '<tr>';
                echo '<td>2</td>';//Tipo de comprobante
                echo '<td>'.$factura.'</td>';//Consecutivo
                echo '<td>'.$emp['nit_emp'].'</td>';//Identificación tercero
                echo '<td></td>';
                echo '<td></td>';
                echo '<td>'.$fila['fecha_registro'].'</td>';//Fecha de elaboración 
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td>'.$email.'</td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td>'.$cod.'</td>';//Código producto
                echo '<td>'.$row['Description'].'</td>';//Descripción producto
                echo '<td>900231731</td>';//Identificación vendedor
                echo '<td></td>';
                echo '<td>'.number_format($cantidad,2,',','').'</td>';//Cantidad producto
                echo '<td>'.number_format($row['precio_total'],6,',','').'</td>';//Valor unitario
                echo '<td>'.number_format($cuota_pagada,6,',','').'</td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';//Código forma de pago
                echo '<td></td>';//Valor Forma de Pago
                echo '<td></td>';//Fecha Vencimiento
                echo '<td></td>';//Observaciones
                echo '</tr>';
        }
        
        //------------info de insumos-----------------  
        $requesti=mysql_query('select * from insumos_asignados a, insumos b where  a.cant_usada!=0 and a.cod_insumo=b.codigo and a.facturado="'.$factura.'"  ');
        while ($row = mysql_fetch_array($requesti)) {
            
            $actual = strtotime($fila['fecha_registro']);
            $fecha_vencimiento = date("Y-m-d", strtotime("+1 month", $actual));
  
             if($row['codsiigo']==''){
                $cod = $row['cod_insumo'];
            }else{
                 $cod = $row['codsiigo'];
            }
               $total += $row['cant_usada']*$row['sub_precio'];
                echo '<tr>';
                echo '<td>2</td>';//Tipo de comprobante
                echo '<td>'.$factura.'</td>';//Consecutivo
                echo '<td>'.$emp['nit_emp'].'</td>';//Identificación tercero
                echo '<td></td>';
                echo '<td></td>';
                echo '<td>'.$fila['fecha_registro'].'</td>';//Fecha de elaboración 
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td>'.$email.'</td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td>'.$cod.'</td>';//Código producto
                echo '<td>'.$row['nombre_insumo'].'</td>';//Descripción producto
                echo '<td>900231731</td>';//Identificación vendedor
                echo '<td></td>';
                echo '<td>'.number_format($row['cant_usada'],2,',','').'</td>';//Cantidad producto
                echo '<td>'.number_format($row['sub_precio'],6,',','').'</td>';//Valor unitario
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';//Código forma de pago
                echo '<td></td>';//Valor Forma de Pago
                echo '<td></td>';//Fecha Vencimiento
                echo '<td></td>';//Observaciones
                echo '</tr>';
        }    
         //------------info de medicamentos-----------------  
        $requestmed=mysql_query('select nombre_medicamento,cod_med,cantidad_usada,sub_precio_m,codsiigo from medicamentos_asig a, medicamentos b where a.cod_med=b.codigo_int and a.facturado="'.$factura.'"');
        while ($row = mysql_fetch_array($requestmed)) {
            
            $actual = strtotime($fila['fecha_registro']);
            $fecha_vencimiento = date("Y-m-d", strtotime("+1 month", $actual));
  
            if($row['codsiigo']==''){
                $cod = $row['cod_med'];
            }else{
                 $cod = $row['codsiigo'];
            }
               $total += $row['cantidad_usada']*$row['sub_precio_m'];
                echo '<tr>';
                echo '<td>2</td>';//Tipo de comprobante
                echo '<td>'.$factura.'</td>';//Consecutivo
                echo '<td>'.$emp['nit_emp'].'</td>';//Identificación tercero
                echo '<td></td>';
                echo '<td></td>';
                echo '<td>'.$fila['fecha_registro'].'</td>';//Fecha de elaboración 
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td>'.$email.'</td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td>'.$cod.'</td>';//Código producto
                echo '<td>'.$row['nombre_medicamento'].'</td>';//Descripción producto
                echo '<td>900231731</td>';//Identificación vendedor
                echo '<td></td>';
                echo '<td>'.number_format($row['cantidad_usada'],2,',','').'</td>';//Cantidad producto
                echo '<td>'.number_format($row['sub_precio_m'],6,',','').'</td>';//Valor unitario
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';//Código forma de pago
                echo '<td></td>';//Valor Forma de Pago
                echo '<td></td>';//Fecha Vencimiento
                echo '<td></td>';//Observaciones
                echo '</tr>';
        }   
        
        //------------info de laboratorio-----------------  
        $requestl=mysql_query('select a.cod_lab,a.nombre_lab,cantidad,precio_lab from laboratorio_asig a, laboratorio b where a.cod_lab=b.cod_lab and a.facturado="'.$factura.'"');
        while ($row = mysql_fetch_array($requestl)) {
            
            $actual = strtotime($fila['fecha_registro']);
            $fecha_vencimiento = date("Y-m-d", strtotime("+1 month", $actual));
  
          
               $total += $row['precio_lab']*$row['cantidad'];
                echo '<tr>';
                echo '<td>2</td>';//Tipo de comprobante
                echo '<td>'.$factura.'</td>';//Consecutivo
                echo '<td>'.$emp['nit_emp'].'</td>';//Identificación tercero
                echo '<td></td>';
                echo '<td></td>';
                echo '<td>'.$fila['fecha_registro'].'</td>';//Fecha de elaboración 
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td>'.$email.'</td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td>'.$row['cod_lab'].'</td>';//Código producto
                echo '<td>'.$row['nombre_lab'].'</td>';//Descripción producto
                echo '<td>900231731</td>';//Identificación vendedor
                echo '<td></td>';
                echo '<td>'.number_format($row['cantidad'],2,',','').'</td>';//Cantidad producto
                echo '<td>'.number_format($row['precio_lab'],6,',','').'</td>';//Valor unitario
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';//Código forma de pago
                echo '<td></td>';//Valor Forma de Pago
                echo '<td></td>';//Fecha Vencimiento
                echo '<td></td>';//Observaciones
                echo '</tr>';
        } 
        
        
        //------------info de alquileres-----------------
        $request2=mysql_query('select * from equipos_asig a, alquiler b where a.cod_equipo=b.codigo and a.facturado="'.$factura.'"');
        while($row_alq=mysql_fetch_array($request2))
	{
            $actual = strtotime($fila['fecha_registro']);
            $fecha_vencimiento = date("Y-m-d", strtotime("+1 month", $actual));
            $total += $row_alq['cantidad']*$row_alq['precio_a'];
            if($row_alq['codsiigo']==''){
                $cod = $row_alq['cod_equipo'];
            }else{
                 $cod = $row_alq['codsiigo'];
            }
                echo '<tr>';
                echo '<td>2</td>';//Tipo de comprobante
                echo '<td>'.$factura.'</td>';//Consecutivo
                echo '<td>'.$emp['nit_emp'].'</td>';//Identificación tercero
                echo '<td></td>';
                echo '<td></td>';
                echo '<td>'.$fila['fecha_registro'].'</td>';//Fecha de elaboración 
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td>'.$email.'</td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td>'.$cod.'</td>';//Código producto
                echo '<td>'.$row_alq['nombre'].'</td>';//Descripción producto
                echo '<td>900231731</td>';//Identificación vendedor
                echo '<td></td>';
                echo '<td>'.number_format($row_alq['cantidad'],2,',','').'</td>';//Cantidad producto
                echo '<td>'.number_format($row_alq['precio_a'],6,',','').'</td>';//Valor unitario
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';//Código forma de pago
                echo '<td></td>';//Valor Forma de Pago
                echo '<td></td>';//Fecha Vencimiento
                echo '<td></td>';//Observaciones
                echo '</tr>';
        }
        
        //-----------info ventas-------------------------
        $request3=mysql_query('select * from equipos_ventas a, productos b where a.cod_equipo=b.codigo and a.numero_orden_a="'.$arch.'"');
        while($row_ven=mysql_fetch_array($request3))
	{
            $actual = strtotime($fila['fecha_registro']);
            $fecha_vencimiento = date("Y-m-d", strtotime("+1 month", $actual));
            $total += $row_ven['cantidad']*$row_ven['precio_a'];
            if($row_ven['codsiigo']==''){
                $cod = $row_ven['cod_equipo'];
            }else{
                 $cod = $row_ven['codsiigo'];
            }
            
                echo '<tr>';
                echo '<td>2</td>';//Tipo de comprobante
                echo '<td>'.$factura.'</td>';//Consecutivo
                echo '<td>'.$emp['nit_emp'].'</td>';//Identificación tercero
                echo '<td></td>';
                echo '<td></td>';
                echo '<td>'.$fila['fecha_registro'].'</td>';//Fecha de elaboración 
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td>'.$email.'</td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td>'.$cod.'</td>';//Código producto
                echo '<td>'.$row_ven['nombre'].'</td>';//Descripción producto
                echo '<td>900231731</td>';//Identificación vendedor
                echo '<td></td>';
                echo '<td>'.number_format($row_ven['cantidad'],2,',','').'</td>';//Cantidad producto
                echo '<td>'.number_format($row_ven['precio_a'],6,',','').'</td>';//Valor unitario
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';//Código forma de pago
                echo '<td></td>';//Valor Forma de Pago
                echo '<td></td>';//Fecha Vencimiento
                echo '<td></td>';//Observaciones
                echo '</tr>';
        }
        // -----------contrapartida----------------------
        echo '<tr>';
                echo '<td>2</td>';//Tipo de comprobante
                echo '<td>'.$factura.'</td>';//Consecutivo
                echo '<td>'.$emp['nit_emp'].'</td>';//Identificación tercero
                echo '<td></td>';
                echo '<td></td>';
                echo '<td>'.$fila['fecha_registro'].'</td>';//Fecha de elaboración 
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td>'.$email.'</td>';
                                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';//Descripción producto
                echo '<td>900231731</td>';//Identificación vendedor
                echo '<td></td>';
                echo '<td></td>';//Cantidad producto
                echo '<td>'.number_format($total,6,',','').'</td>';//Valor unitario
                echo '<td>'.number_format($copagos,6,',','').'</td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td>2</td>';//Código forma de pago
                echo '<td>'.number_format(($total-$copagos),2,',','').'</td>';//Valor Forma de Pago
                echo '<td>'.$fecha_vencimiento.'</td>';//Fecha Vencimiento
                echo '<td></td>';//Observaciones
                echo '</tr>';

}

echo '</table>';

echo '</div>';
        }
        ?>
    </body>
</html>
