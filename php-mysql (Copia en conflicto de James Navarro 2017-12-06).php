<?php
require('fpdf/fpdf.php');
require 'modelo/cx.php';
//$paciente= $_GET['imprimir'];
	$con = new DB;
	$pacientes = $con->conectar();	
 $strConsulta3 = "select * from facturas where numero_factura='".$_GET['imprimir']."'";
	$pacientes3 = mysql_query($strConsulta3);
	$fila3 = mysql_fetch_array($pacientes3);
class PDF extends FPDF
{
var $widths;
var $aligns;

function SetWidths($w)
{
	//Set the array of column widths
	$this->widths=$w;
}

function SetAligns($a)
{
	//Set the array of column alignments
	$this->aligns=$a;
}

function Row($data)
{
	//Calculate the height of the row
	$nb=0;
	for($i=0;$i<count($data);$i++)
		$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
	$h=5*$nb;
	//Issue a page break first if needed
	$this->CheckPageBreak($h);
	//Draw the cells of the row
	for($i=0;$i<count($data);$i++)
	{
		$w=$this->widths[$i];
		$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
		//Save the current position
		$x=$this->GetX();
		$y=$this->GetY();
		//Draw the border
		
		$this->Rect($x,$y,$w,$h);

		$this->MultiCell($w,5,$data[$i],0,$a,'true');
		//Put the position to the right of the cell
		$this->SetXY($x+$w,$y);
	}
	//Go to the next line
	$this->Ln($h);
}

function CheckPageBreak($h)
{
	//If the height h would cause an overflow, add a new page immediately
	if($this->GetY()+$h>$this->PageBreakTrigger)
		$this->AddPage($this->CurOrientation);
}

function NbLines($w,$txt)
{
	//Computes the number of lines a MultiCell of width w will take
	$cw=&$this->CurrentFont['cw'];
	if($w==0)
		$w=$this->w-$this->rMargin-$this->x;
	$wmax=($w-2*$this->cMargin)*1100/$this->FontSize;
	$s=str_replace("\r",'',$txt);
	$nb=strlen($s);
	if($nb>0 and $s[$nb-1]=="\n")
		$nb--;
	$sep=-1;
	$i=0;
	$j=0;
	$l=0;
	$nl=1;
	while($i<$nb)
	{
		$c=$s[$i];
		if($c=="\n")
		{
			$i++;
			$sep=-1;
			$j=$i;
			$l=0;
			$nl++;
			continue;
		}
		if($c==' ')
			$sep=$i;
		$l+=$cw[$c];
		if($l>$wmax)
		{
			if($sep==-1)
			{
				if($i==$j)
					$i++;
			}
			else
				$i=$sep+1;
			$sep=-1;
			$j=$i;
			$l=0;
			$nl++;
		}
		else
			$i++;
	}
	return $nl;
}

function Header()
{
	// Logo

		$con = new DB;
	$pacientes = $con->conectar();	
 $strConsulta3 = "select * from facturas where numero_factura='".$_GET['imprimir']."'";
	$pacientes3 = mysql_query($strConsulta3);
	$fila3 = mysql_fetch_array($pacientes3);
	
	$strConsulta = "select * from inf_empresa";
	$pacientes = mysql_query($strConsulta);
	$fila = mysql_fetch_array($pacientes);
        if($_GET['imprimir']>5000){
            $rangos = mysql_query("select * from rangos_facturas where id_rango=3");
        }else{
            $rangos = mysql_query("select * from rangos_facturas where id_rango=1");
        }
        $rango = mysql_fetch_array($rangos);
        $resolucion = $rango['resolucion'];
        
        $Fecha=date("Y-m-d");
        $fecha_v = date("Y-m-d", strtotime("$Fecha +1 month"));
        
	$this->Image('imagenes/idb.png',17,10,15,'L');
	$this->SetFont('Arial','B',12);

	$this->Cell(0,10,utf8_decode($fila['nombre']),10,0,'C');
	// Salto de l�nea
	$this->SetFont('Arial','B',8);
        $this->Cell(0,10,'Factura de Venta No. '.$fila3['numero_factura'],10,0,'R');
        $this->SetFont('Arial','B',6);
        
        $this->Cell(-200,20,'Nit: '.$fila['nit_emp'],0,10,'C');
        $this->Cell(0,-20,'Forma de Pago:1 mes de credito',0,10,'R');
        $this->Cell(-200,25,'Telefono: '.$fila['telefono_1'].' '.$fila['telefono_3'],0,10,'C');
        $this->Cell(0,-25,'Fecha de Vencimiento:'.$fecha_v,0,10,'R');
        $this->Cell(-200,30,'Direccion: '.$fila['direccion'],0,10,'C');
        $this->Cell(0,-30,'Fecha: '.$fila3['fecha_registro'],0,10,'R');
        $this->Cell(-200,35,'E-mail: '.$fila['email'],0,3,'C');
        $this->Cell(-200,-30,$resolucion,0,0,'C');
        $this->Cell(0,-25,'Regimen Comun',0,0,'C');
	$this->Ln(0);
}
function Footer()
{
	 
	 $this->Image('footer.png',30,246,160,'C');
	// Posici�n: a 1,5 cm del final
	$this->SetY(-15);
	// Arial italic 8
	$this->SetFont('Arial','I',8);
	// N�mero de p�gina
	// $this->Cell(0,-40,'Hola a todos ',0,10,'C');
	$this->Cell(0,10,'Pagina '.$this->PageNo().'/1',0,0,'C');

}

}
        
	
	

	$pacientess = mysql_query("select * from inf_empresa");
	$fila = mysql_fetch_array($pacientess);
        
        $strConsulta2 = "select * from actividad a, pacientes b, sis_empresa c where a.relacionado='".$_GET['imprimir']."' and a.id_paciente=b.id_paciente and b.id_empresa=c.rips limit 1";
	$pacientes2 = mysql_query($strConsulta2);
	$fila2 = mysql_fetch_array($pacientes2);
        
        $sql21 = "select sum(precio_total) from actividad  where relacionado='".$_GET['imprimir']."'";
        $fila21 =mysql_fetch_array(mysql_query($sql21));
        $c = $fila21["sum(precio_total)"];
        
        $sql21r = "select sum(sub_precio*cant_usada) from insumos_asignados where cant_usada!=0 and facturado='".$_GET['imprimir']."'";
        $fila21r =mysql_fetch_array(mysql_query($sql21r));
        $i = $fila21r["sum(sub_precio*cant_usada)"];
        
        $sql21m = "select sum(sub_precio_m*cantidad_usada) from medicamentos_asig  where facturado='".$_GET['imprimir']."'";
        $fila21m =mysql_fetch_array(mysql_query($sql21m));
        $m = $fila21m["sum(sub_precio_m*cantidad_usada)"];
        
        $ts = $i + $m;
       
        
        
	$pdf=new PDF();
	$pdf->Open();
	$pdf->AddPage();
	$pdf->SetMargins(20,20,20);
	$pdf->Ln(-12);

        $pdf->Cell(0,3,'_______________________________________________________________________________________________________________________________________________',0,1,'C');
	$pdf->SetFont('Arial','',6);
	$pdf->Cell(0,3,'EMPRESA      : '.$fila2['nombre_emp'],0,1);
	$pdf->Cell(0,3,'TELEFONOS  : '.$fila2['tel_oficina_emp'],0,1); 
	$pdf->Cell(0,3,'NIT                  : '.$fila2['nit_emp'].'                                                                                                              Fecha de Atencion del:'.$fila3['fechai'].' al '.$fila3['fechaf'],0,1); 
        $pdf->Cell(0,3,'PACIENTE      : '.utf8_decode($fila2['nombres'].' '.$fila2['nombre2'].' '.$fila2['apellidos'].' '.$fila2['apellido2']).'.     '.$fila2['documento'].':'.$fila2['numero_doc'],0,1);
        $pdf->Cell(0,3,'DIAGNOSTICO:'.$fila2['enfermedad'].' - '.$fila2['descripcion_enf'].'',0,1);
        $pdf->Cell(0,3,'_______________________________________________________________________________________________________________________________________________',0,1,'C');
       
        $pdf->SetFont('Arial','I',4);

	
	
	$pdf->SetWidths(array(10, 20, 12, 60, 30, 10, 15, 15));
	$pdf->SetFont('Arial','I',5);
	$pdf->Cell(0,0,'',0,20);
	$pdf->SetFillColor(230,230,230);
    $pdf->SetTextColor(0);

		for($i=0;$i<1;$i++)
			{
				$pdf->Row(array('ORD I', 'AUTORIZACION', 'COD.', 'DESCRIPCION', 'ANEXOS', 'CANT.', 'P. X UND', 'TOTAL'));
			}
	
	$historial = $con->conectar();
        
        $consultaoe= "select * from actividad where relacionado='".$_GET['imprimir']."' group by orden_servicio";
$resultoe=  mysql_query($consultaoe);

while($filaoe=  mysql_fetch_array($resultoe)){
   
$orden=$filaoe['orden_servicio'];
	$strConsulta = "select a.orden_servicio, a.orden_externa, a.cod_aten, a.Description, a.anexo, count(a.cant_ins), a.precio_total, count(a.cant_ins)*a.precio_total from actividad a where a.estado='Completada' and a.orden_servicio='".$orden."'  group by cod_aten
                union select a.rel_atencion, a.autorizacion, a.cod_insumo,b.nombre_insumo, a.inf_adicional, a.cant_usada, a.sub_precio, a.cant_usada*a.sub_precio from insumos_asignados a, insumos b where a.cant_usada!=0 and a.cod_insumo=b.codigo and a.rel_atencion='".$orden."'
        union select a.rel_atencion, a.autorizacion, b.codigo, b.nombre_medicamento, a.info, a.cantidad_usada, a.sub_precio_m, a.cantidad_usada*a.sub_precio_m from medicamentos_asig a, medicamentos b where b.codigo_int=a.cod_med and a.rel_atencion='".$orden."'
           union select a.rel_atencion, a.autorizacion, a.cod_lab, b.nombre_lab, a.inf, a.cantidad, a.precio_lab, a.cantidad*a.precio_lab from laboratorio_asig a, laboratorio b where a.cod_lab=b.cod_lab and a.rel_atencion='".$orden."'
            union  select a.rel_atencion, a.autorizacion, b.codigo_interno, b.nombre, a.info, a.cantidad, a.precio_v, a.cantidad*a.precio_v from productos_vendidos a, productos b where b.codigo_interno=a.cod_pro and a.rel_atencion='".$orden."'";
	
	$historial = mysql_query($strConsulta);
	$numfilas = mysql_num_rows($historial);
	
	for ($i=0; $i<$numfilas; $i++)
		{
			$fila = mysql_fetch_array($historial);
			$pdf->SetFont('Arial','I',0);
			
			
		        $pdf->SetFillColor(255,255,255);
    			$pdf->SetTextColor(0);
                        
				$pdf->Row(array($fila['orden_servicio'], $fila['orden_externa'], $fila['cod_aten'], substr($fila['Description'], 0, 65), $fila['anexo'], $fila['count(a.cant_ins)'], number_format($fila['precio_total']), number_format($fila['count(a.cant_ins)*a.precio_total'])));
			
		}
}
$pdf->Cell(0,3,'Nota :  '.$fila3['informacion'],0,1);
$at = $fila3['total'] - $ts;
$pdf->Ln(-3);
$pdf->SetFont('Arial','',6);
$pdf->Cell(0,3,'_______________________________________________________________________________________________________________________________________________',0,1,'C');
      
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(0,3,'Copagos :  '.number_format($fila3['copagos']).'                  Servicios : '.number_format($at).'                Materiales y Medicamentos :'.number_format($ts),0,1);
        $pdf->Ln(0);
        $pdf->Cell(0,3,'Son :  '.$fila3['letras'],0,1);
        $pdf->Ln(0);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(0,3,'Total Neto a Pagar $ '.number_format($fila3['total']-$fila3['copagos']),0,1,'R');
$pdf->Output();
?>