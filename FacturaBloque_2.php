<?php
require('fpdf/fpdf.php');
require 'modelo/cx.php';
//$paciente= $_GET['imprimir'];
	$con = new DB;
	$pacientes = $con->conectar();	
 $strConsulta3 = "select * from facturas a, sis_empresa b where a.id_empresa=b.rips and numero_factura='".$_GET['imprimir']."'  ";
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
        if($_GET['imprimir']<5000){
            $rangos = mysql_query("select * from rangos_facturas where id_rango=1");
        }
        if($_GET['imprimir']>=5000 && $_GET['imprimir']<8330){
            $rangos = mysql_query("select * from rangos_facturas where id_rango=2");
        }
        if($_GET['imprimir']>=8330 && $_GET['imprimir']<13900){
            $rangos = mysql_query("select * from rangos_facturas where id_rango=3");
        }
        if($_GET['imprimir']>=13900){
            $rangos = mysql_query("select * from rangos_facturas where id_rango=4");
        }
        $rango = mysql_fetch_array($rangos);
        $resolucion = $rango['resolucion'];
        
        $Fecha=date("Y-m-d");
        $fecha_v = date("Y-m-d", strtotime("$Fecha +1 month"));
        
	$this->Image('imagenes/idb.png',18,10,38,'L');
	$this->SetFont('Arial','B',12);

	$this->Cell(0,10,utf8_decode($fila['nombre']),10,0,'C');

	$this->SetFont('Arial','B',8);
       
            $this->Cell(0,10,'Factura de Venta No. '.$fila3['numero_factura'],10,0,'R');
            $copa = '1 mes de credito';

        
        $this->SetFont('Arial','B',6);
        
        $this->Cell(-200,20,'Nit: '.$fila['nit_emp'],0,10,'C');
        $this->Cell(0,-20,'Forma de Pago:'.$copa,0,10,'R');
        $this->Cell(-200,25,'Telefono: '.$fila['telefono_1'].' '.$fila['telefono_3'],0,10,'C');
        $this->Cell(0,-25,'Fecha de Vencimiento:'.$fecha_v,0,10,'R');
        $this->Cell(-200,30,'Direccion: '.$fila['direccion'],0,10,'C');
        $this->Cell(0,-30,'Fecha: '.$fila3['fecha_registro'],0,10,'R');
        $this->Cell(-200,35,'E-mail: '.$fila['email'],0,3,'C');
        //if($_GET['t']=='FAC'){
            $this->Cell(-200,-30,$resolucion,0,0,'C');
            $this->Cell(0,-25,'Regimen Comun',0,0,'C');
//         }else{
//             $this->Cell(-200,-30,'',0,0,'C');
//             $this->Cell(0,-25,'',0,0,'C');
//         }
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
	// $this->Cell(0,-40,'Hola a todos ',0,10,'C'); 1746
	$this->Cell(0,10,'Pagina '.$this->PageNo().'/1',0,0,'C');

}

}
        
	
	

	$pacientess = mysql_query("select * from inf_empresa");
	$fila = mysql_fetch_array($pacientess);
        

        
        $sql21 = "select (sum(precio_total)*id_seleccionado) from actividad  where relacionado='".$_GET['imprimir']."' GROUP BY orden_servicio";
        $fila21 =mysql_fetch_array(mysql_query($sql21));
        $c = $fila21[0];
 
        $ts = 0;
 
	$pdf=new PDF();
	$pdf->Open();
	$pdf->AddPage();
	$pdf->SetMargins(20,20,20);
	$pdf->Ln(-12);

        $pdf->Cell(0,3,'_______________________________________________________________________________________________________________________________________________',0,1,'C');
	$pdf->SetFont('Arial','',6);
	$pdf->Cell(0,3,'EMPRESA      : '.$fila3['nombre_emp'],0,1);
        $pdf->Cell(0,3,'NIT                  : '.$fila3['nit_emp'].'                                                                                                           ',0,1); 
	$pdf->Cell(0,3,'TELEFONOS  : '.$fila3['tel_oficina_emp'].utf8_decode($fila2['direccionr_emp']),0,1); 
	
        $pdf->Cell(0,3,'FACTURA AGRUPADA POR CODIGO DE ATENCION                                           REGIMEN:'.$fila3['regimen'],0,1);
        $pdf->Cell(0,3,'',0,1);
        $pdf->Cell(0,3,'_______________________________________________________________________________________________________________________________________________',0,1,'C');
       
        $pdf->SetFont('Arial','I',4);

	
	
	$pdf->SetWidths(array(10, 17, 60, 30, 10, 15, 15, 15));
	$pdf->SetFont('Arial','I',5);
	$pdf->Cell(0,0,'',0,20);
	$pdf->SetFillColor(230,230,230);
    $pdf->SetTextColor(0);

		for($i=0;$i<1;$i++)
			{
				$pdf->Row(array('ITEM', 'COD.', 'DESCRIPCION', 'ANEXOS', 'CANT.', 'P. X UND','COPAGO', 'TOTAL'));
			}
	
	$historial = $con->conectar();
        
        $consultaoe= "select *,count(cant_ins), sum(cuota_pagada) as cuota from actividad where relacionado='".$_GET['imprimir']."' GROUP BY cod_aten ";
$resultoe=  mysql_query($consultaoe);
$total=0;$copago=0;
$contador=0;
while($fila=  mysql_fetch_array($resultoe)){
    $total +=($fila['count(cant_ins)']*$fila['precio_total']);
    $orden=$fila['orden_servicio'];
    $pdf->SetFont('Arial','I',0);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0);
    $copago += $fila['cuota'];
    $contador++;
    $pdf->Row(array($contador, $fila['cod_aten'], substr(utf8_decode($fila['Description']), 0, 65), $fila['anexo'], $fila['count(cant_ins)'], number_format($fila['precio_total']), number_format($fila['cuota']),number_format(($fila['count(cant_ins)']*$fila['precio_total'])-$fila['cuota'])));

	
}
$pdf->Cell(0,3,'Nota :  '.$fila3['informacion'],0,1);
$at = $total - $ts;
$pdf->Ln(-3);
$pdf->SetFont('Arial','',6);
$pdf->Cell(0,3,'_______________________________________________________________________________________________________________________________________________',0,1,'C');
      
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(0,3,'Subtotal :  '.number_format($total).'                  Servicios : '.number_format($at).'                Copagos :'.number_format($copago),0,1);
        $pdf->Ln(0);
        $pdf->Cell(0,3,'Son :  '.$fila3['letras'],0,1);
        $pdf->Ln(0);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(0,3,'Total Neto a Pagar $ '.number_format($total-$copago),0,1,'R');
$pdf->Output();
?>