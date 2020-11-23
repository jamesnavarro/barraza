<?php

require('fpdf/fpdf.php');
require 'modelo/cx.php';
$paciente= $_GET['imprimir'];
	$con = new DB;
	$pacientes = $con->conectar();	
 $strConsulta3 = "select *,a.informacion from recibo_caja a, pacientes b where a.id_paciente=b.id_paciente and a.id_recibo='".$_GET['imprimir']."' ";
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
	$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
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
 $strConsulta3 = "select * from recibo_caja where numero_recibo='".$_GET['imprimir']."'";
	$pacientes3 = mysql_query($strConsulta3);
	$fila3 = mysql_fetch_array($pacientes3);
	$this->Image('imagenes/idb.png',19,13,35,'L');
	$this->SetFont('Arial','B',12);
       
	// Movernos a la derecha
	
	// T�tulo
	$this->Cell(30,10,'                                                             IPSALUD DEL CARIBE SAS',0,0);
	// Salto de l�nea
	$this->SetFont('Arial','B',12);
        $this->Cell(155,10,'Recibo de Caja No. '.$_GET['imprimir'],0,0,'R');
	$this->Ln(0);
}
function Footer()
{
//	  $this->Image('footer.png',20,235,177,'C');
//	// Posici�n: a 1,5 cm del final
//	$this->SetY(-15);
//	// Arial italic 8
//	$this->SetFont('Arial','I',8);
//	// N�mero de p�gina
//	$this->Cell(0,10,'Page '.$this->PageNo().'/1',0,0,'C');

}

}
if(isset($_GET['imprimir'])){
$consulta3= "select * from recibo_caja where numero_recibo='".$_GET['imprimir']."'";
$result3=  mysql_query($consulta3);
while($fila=  mysql_fetch_array($result3)){
$id_factura=$fila['id_recibo'];
$paciente=$fila['id_paciente'];
$num_fact=$fila['numero_recibo'];
$forma_pago=$fila['forma_pago'];
$me=$fila['meses'];
$fv=$fila['fecha_ven'];
$inf=$fila['informacion'];
$fr=$fila['fecha_registro'];
$p=$fila['pago_pendiente'];
$arch=$fila['orden_int'];
$ord_ext=$fila['orden_ext'];
$valor=$fila['total'];
$copagos=$fila['copagos'];
}}
$query = mysql_query("select * from sis_empresa where rips= '".$fila3['id_empresa']."' ");
$emp = mysql_fetch_array($query);

$strConsulta = "select * from inf_empresa";
	$pacientes = mysql_query($strConsulta);
	$fila = mysql_fetch_array($pacientes);

        $Fecha=$fila3['fechaf'];
        $fecha_v = date("Y-m-d", strtotime("$Fecha -1 day"));
        
	$pdf=new PDF();
	$pdf->Open();
	$pdf->AddPage();
	$pdf->SetMargins(20,20,20);
	$pdf->Ln(8);

        $pdf->SetFont('Arial','',6);
	$pdf->Cell(0,3,'                                                                                                                               Nit: '.$fila['nit_emp'].'                                                                                      Forma de Pago : '.$fila3['forma_pago'],0,1);
	$pdf->Cell(0,3,'                                                                                                                Telefono: '.$fila['telefono_1'].' '.$fila['telefono_3'].'                                                                              Fecha de Vencimiento:'.$fecha_v,0,1); 
	$pdf->Cell(0,3,'                                                                                                                 Direccion: '.$fila['direccion'].'                                                                                         Fecha de Registro:'.$fila3['fecha_registro'],0,1); 
        $pdf->Cell(0,3,'E-mail: '.$fila['email'],0,1,'C');
        $pdf->Cell(0,3,'Regimen Comun',0,1,'C');
        $pdf->Cell(0,3,'_______________________________________________________________________________________________________________________________________________',0,1,'C');
	$pdf->SetFont('Arial','',6);
         $pdf->Cell(0,3,'PACIENTE      : '.$fila3['nombres'].' '.$fila3['nombre2'].' '.$fila3['apellidos'].' '.$fila3['apellido2'].'.    C.C:'.$fila3['numero_doc'],0,1);
       
	$pdf->Cell(0,3,'EMPRESA      : '.$emp['nombre_emp'],0,1);
        $pdf->Cell(0,3,'NIT                  : '.$emp['nit_emp'].'                                                                                                             ',0,1); 
        
	$pdf->Cell(0,3,'ORDEN           : '.$fila3['orden_int'],0,1); 

        $pdf->Cell(0,3,'_______________________________________________________________________________________________________________________________________________',0,1,'C');
        $pdf->Ln(2);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(0,3,'',0,1,'C');
	$pdf->Ln(5);
	
	$pdf->SetWidths(array(14, 100,17, 10, 15, 15));
	$pdf->SetFont('Arial','B',6);
	$pdf->SetFillColor(230,230,230);
    $pdf->SetTextColor(0);

		for($i=0;$i<1;$i++)
			{
				$pdf->Row(array('COD', 'DESCRIPCION', 'DOCUMENTO', 'CANT.', 'P X UND', 'TOTAL'));
			}
	
	$historial = $con->conectar();

	$strConsulta = "select * from recibo_items where id_recibo='".$_GET['imprimir']."' ";
	$historial = mysql_query($strConsulta);

	$total = 0;
        $i = 0;
	while ($fila = mysql_fetch_array($historial))
		{ $i++;
			
			$pdf->SetFont('Arial','',0);
			
			if($i%2 == 1)
			{
				$pdf->SetFillColor(255,255,254);
    			$pdf->SetTextColor(0);
				$pdf->Row(array($fila['codigo'], $fila['descripcion'], $fila['documento'], $fila['cantidad'], number_format($fila['valor']), number_format($fila['total'])));
			}
			else
			{
		        $pdf->SetFillColor(255,255,254);
    			$pdf->SetTextColor(0);
				$pdf->Row(array($fila['codigo'], $fila['descripcion'], $fila['documento'], $fila['cantidad'], number_format($fila['valor']), number_format($fila['total'])));}
                        $total += $fila['total'];
		}
$pdf->Cell(0,3,'Nota :  '.$fila3['informacion'],0,1);
$pdf->Ln(0);
$pdf->Cell(0,3,'_______________________________________________________________________________________________________________________________________________',0,1,'C');
      
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(0,3,'Pagos Realizado :  '.number_format($fila3['copagos']).'                  Cambio : '.number_format($fila3['saldo']).'                Servicios:'.number_format($total),0,1);
        $pdf->Ln(2);
        $pdf->Cell(0,3,'');
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(0,3,'Total Neto a Pagar $ '.number_format($total),0,1,'R');
        //$pdf->Cell(0,5,'Saldo Pendiente $ '.number_format($fila3['saldo']),0,2,'R');
                $pdf->Ln(8);
         $pdf->SetFont('Arial','',10);
        $pdf->Cell(0,4,'__________________________                                                                 ____________________________',0,1,'L');
        $pdf->Cell(0,4,'Recibi Conforme                                                                                          Elaborado por',0,1,'L'); 
         $pdf->Cell(0,4,'Identificacion:                                                                                               '.$fila3['usuario'],0,1,'L');
         $pdf->Cell(0,4,'- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -- - - - - - - - - - - - - - - - - - - - - - -- - - - - - - - - - - - - -   ',0,1,'L');

$pdf->Output();
?>