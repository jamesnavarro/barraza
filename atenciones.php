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
	
	$strConsulta = "select * from inf_empresa";
	$pacientes = mysql_query($strConsulta);
	$fila = mysql_fetch_array($pacientes);

        
	$this->Image('imagenes/idb.png',17,10,15,'L');
	$this->SetFont('Arial','B',12);

	$this->Cell(0,10,$fila['nombre'],10,0,'C');
	// Salto de l�nea
	$this->SetFont('Arial','B',8);
        $this->Cell(0,10,'Factura de Venta No. ',10,0,'R');
        $this->SetFont('Arial','B',6);
        
        $this->Cell(-200,20,'Nit: ',0,10,'C');
        $this->Cell(0,-20,'Forma de Pago:1 mes de credito',0,10,'R');
        $this->Cell(-200,25,'Telefono: ',0,10,'C');
        $this->Cell(0,-25,'Fecha de Vencimiento:',0,10,'R');
        $this->Cell(-200,30,'Direccion: ',0,10,'C');
        $this->Cell(0,-30,'Fecha: ',0,10,'R');
        $this->Cell(-200,35,'E-mail: ',0,3,'C');


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

       
        
        
	$pdf=new PDF();
	$pdf->AddPage();
	$pdf->SetMargins(20,20,20);
	$pdf->Ln(-12);

        $pdf->Cell(0,3,'_______________________________________________________________________________________________________________________________________________',0,1,'C');
	$pdf->SetFont('Arial','',6);
	$pdf->Cell(0,3,'EMPRESA      : ',0,1);
	$pdf->Cell(0,3,'TELEFONOS  : ',0,1); 
	$pdf->Cell(0,3,'NIT                  :                                                                                                               Fecha de Atencion del:',0,1); 
        $pdf->Cell(0,3,'PACIENTE      :     C.C:',0,1);
        $pdf->Cell(0,3,'DIAGNOSTICO:',0,1);
        $pdf->Cell(0,3,'_______________________________________________________________________________________________________________________________________________',0,1,'C');
       
        $pdf->SetFont('Arial','I',4);
        $pdf->Cell(20,5,'',0,5,'C');

	$pdf->SetWidths(array(10, 20, 12, 60, 30, 10, 15, 15));
	$pdf->SetFont('Arial','I',4);
	$pdf->Cell(0,0,'',0,20);
	$pdf->SetFillColor(230,230,230);
    $pdf->SetTextColor(0);

		for($i=0;$i<1;$i++)
			{
			$pdf->Row(array('ORD I', 'AUTORIZACION', 'COD.', 'DESCRIPCION', 'ANEXOS', 'CANT.', 'P. X UND', 'TOTAL'));
			}
	
	for ($i=0; $i<15; $i++)
		{
			$pdf->SetFont('Arial','I',0);
			
			
		        $pdf->SetFillColor(255,255,255);
    			$pdf->SetTextColor(0);
			$pdf->Row(array($i, 'aaaaaaaa', 'bbbbbbb','cccccccc', 'dddddddd','ffff', 'qwwqwe', '10000'));
			
		}

$pdf->Cell(0,3,'Nota :  ',0,1);

$pdf->Ln(0);
$pdf->Cell(0,3,'_______________________________________________________________________________________________________________________________________________',0,1,'C');
      
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(0,3,'Copagos :                    Servicios :                Materiales y Medicamentos :');
        $pdf->Ln(0);
        $pdf->Cell(0,3,'Son :  ',0,1);
        $pdf->Ln(0);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(0,3,'Total Neto a Pagar $ ',0,1,'R');
$pdf->Output();
?>