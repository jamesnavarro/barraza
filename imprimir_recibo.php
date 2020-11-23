<?php
require('fpdf/fpdf.php');
require 'modelo/cx.php';
//$paciente= $_GET['imprimir'];
	$con = new DB;
	$pacientes = $con->conectar();	
 $strConsulta3 = "select * from recibo_caja where numero_recibo='".$_GET['imprimir']."'";
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
		
 $strConsulta3 = "select * from recibo_caja where numero_recibo=".$_GET['imprimir']."";
	$pacientes3 = mysql_query($strConsulta3);
	$fila3 = mysql_fetch_array($pacientes3);
	
	$strConsulta = "select * from inf_empresa";
	$pacientes = mysql_query($strConsulta);
	$fila = mysql_fetch_array($pacientes);
        if($_GET['imprimir']>5000){
            $rangos = mysql_query("select * from rangos_facturas where id_rango=2");
        }else{
            $rangos = mysql_query("select * from rangos_facturas where id_rango=1");
        }
        $rango = mysql_fetch_array($rangos);
        $resolucion = $rango['resolucion'];
        
        $Fecha=$fila3['fechaf'];
        $fecha_v = date("Y-m-d", strtotime("$Fecha -1 day"));
        
	$this->Image('imagenes/idb.png',17,10,15,'L');
	$this->SetFont('Arial','B',12);

	$this->Cell(0,10,$fila['nombre'],10,0,'C');
	// Salto de l�nea
	$this->SetFont('Arial','B',8);
        $this->Cell(0,10,'Recibo de caja No. '.$fila3['numero_recibo'],10,0,'R');
        $this->SetFont('Arial','B',6);
        
        $this->Cell(-200,20,'Nit: '.$fila['nit_emp'],0,10,'C');
        $this->Cell(0,-20,'Forma de Pago:Inmediato',0,10,'R');
        $this->Cell(-200,25,'Telefono: '.$fila['telefono_1'].' '.$fila['telefono_3'],0,10,'C');
        $this->Cell(0,-25,'Fecha de Vencimiento:'.$fecha_v,0,10,'R');
        $this->Cell(-200,30,'Direccion: '.$fila['direccion'],0,10,'C');
        $this->Cell(0,-30,'Fecha: '.$fila3['fecha_registro'],0,10,'R');
        $this->Cell(-200,35,'E-mail: '.$fila['email'],0,3,'C');
        $this->Cell(-200,-30,'Regimen Comun',0,0,'C');
	$this->Ln(0);
}
function Footer()
{
	 
//	 $this->Image('footer.png',30,246,160,'C');
//	// Posici�n: a 1,5 cm del final
//	$this->SetY(-15);
//	// Arial italic 8
//	$this->SetFont('Arial','I',8);
//	// N�mero de p�gina
//	// $this->Cell(0,-40,'Hola a todos ',0,10,'C');
//	$this->Cell(0,10,'Pagina '.$this->PageNo().'/1',0,0,'C');

}

}
        
	
	$queEmp = "SELECT a.*, b.*, b.cantidad*b.precio_a*b.meses, d.*, (a.meses) as mes, c.* FROM recibo_caja a, equipos_asig b, ordenes c, alquiler d WHERE d.codigo=b.cod_equipo and c.id_paciente=a.id_paciente and b.numero_orden_a=a.orden_int  and c.id=b.rel_atencion and a.numero_recibo=".$_GET['imprimir']."";
$fila =mysql_fetch_array(mysql_query($queEmp));
$consulta = mysql_query($queEmp);
echo mysql_error();

    $to = $fila["b.cantidad*b.precio_a*b.meses"];
    $orden_ser=$fila['numero_orden_a'];
    $mes=$fila['meses'];
    $names=$fila['inf'];
    $factura=$fila['numero_recibo'];
    $archivo=$fila['orden_int'];
    $inf=$fila['informacion'];
    $letras=$fila['letras'];
    $forma_pago=$fila['forma_pago'];
    $meses=$fila['mes'];
    $fv=$fila['fecha_ven'];
     $oe=$fila['orden_ext'];
     $total2=$fila['total'];
     $fi=$fila['fecha_registro'];
     $ff=$fila['fecha_final'];
     $copagos=$fila['copagos'];


	$pacientess = mysql_query("select * from inf_empresa");
	$filae = mysql_fetch_array($pacientess);
        
        $strConsulta2 = "select a.*, b.*, c.* from equipos_asig a, pacientes b, sis_empresa c, ordenes d where d.id=a.numero_orden_a and d.id='".$archivo."' and d.id_paciente=b.id_paciente and b.id_empresa=c.rips";
	$pacientes2 = mysql_query($strConsulta2);
	$fila2 = mysql_fetch_array($pacientes2);

        
	$pdf=new PDF();
	$pdf->Open();
	$pdf->AddPage();
	$pdf->SetMargins(20,20,20);
	$pdf->Ln(-8);

        $pdf->Cell(0,3,'_______________________________________________________________________________________________________________________________________________',0,1,'C');
	$pdf->SetFont('Arial','',6);
	$pdf->Cell(0,3,'EMPRESA      : '.$fila2['nombre_emp'],0,1);
	$pdf->Cell(0,3,'TELEFONOS  : '.$fila2['tel_oficina_emp'],0,1); 
	$pdf->Cell(0,3,'NIT                  : '.$fila2['nit_emp'].'                                                                                                              Fecha de Atencion del:'.$fila3['fechai'].' al '.$fila3['fechaf'],0,1); 
        $pdf->Cell(0,3,'PACIENTE      : '.$fila2['nombres'].' '.$fila2['nombre2'].' '.$fila2['apellidos'].' '.$fila2['apellido2'].'.    C.C:'.$fila2['numero_doc'],0,1);
        $pdf->Cell(0,3,'DIAGNOSTICO:'.$fila2['enfermedad'].' - '.$fila2['descripcion_enf'].'',0,1);
        $pdf->Cell(0,3,'_______________________________________________________________________________________________________________________________________________',0,1,'C');
       
        $pdf->SetFont('Arial','I',4);
        $pdf->Cell(20,5,'',0,5,'C');
	
	
	$pdf->SetWidths(array(10, 20, 12, 60, 30, 10, 15, 15));
	$pdf->SetFont('Arial','I',6);
	$pdf->Cell(0,0,'',0,20);
	$pdf->SetFillColor(230,230,230);
    $pdf->SetTextColor(0);

		for($i=0;$i<1;$i++)
			{
				$pdf->Row(array('ORD I', 'AUTORIZACION', 'COD.', 'DESCRIPCION', 'ANEXOS', 'CANT.', 'P. X UND', 'TOTAL'));
			}
	
	$historial = $con->conectar();
        
        $consultaoe=  "SELECT a.*, b.*, b.cantidad*b.precio_a*b.meses, d.*, (a.meses) as mes, c.* FROM recibo_caja a, equipos_asig b, ordenes c, alquiler d WHERE d.codigo=b.cod_equipo and c.id_paciente=a.id_paciente and b.numero_orden_a=a.orden_int  and c.id=b.rel_atencion and a.numero_recibo=".$_GET['imprimir']."";

	$historial = mysql_query($consultaoe);
	$numfilas = mysql_num_rows($historial);
	
	for ($i=0; $i<$numfilas; $i++)
		{
			$fila = mysql_fetch_array($historial);
			$pdf->SetFont('Arial','I',0);
			
			
		        $pdf->SetFillColor(255,255,255);
    			$pdf->SetTextColor(0);
				$pdf->Row(array($fila['numero_orden_a'], $fila['numero_orden_a'], $fila['cod_equipo'], $fila['nombre'], $fila['anexo'], $fila['cantidad'], number_format($fila['precio_a']), number_format($fila['b.cantidad*b.precio_a*b.meses'])));
			
		}
$pdf->Cell(0,3,'Nota :  '.$fila3['informacion'],0,1);
$at = $fila3['total'] ;
$pdf->Ln(0);
$pdf->Cell(0,3,'_______________________________________________________________________________________________________________________________________________',0,1,'C');
      
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(0,3,'Pago Realizado :  '.number_format($fila3['copagos']).'                  Servicios : '.number_format($fila3['total']).'                Materiales y Medicamentos :'.number_format(0),0,1);
        $pdf->Ln(0);
        $pdf->Cell(0,3,'Son :  '.$fila3['letras'],0,1);
        $pdf->Ln(0);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(0,3,'Total Neto a Pagar $ '.number_format($fila3['total']),0,1,'R');
                $pdf->Ln(1);
        $pdf->Cell(0,3,'Saldo Pendiente $ '.number_format($fila3['total']-$fila3['copagos']),0,1,'R');
                $pdf->Ln(8);
         $pdf->SetFont('Arial','',10);
        $pdf->Cell(0,4,'__________________________                                                                 ____________________________',0,1,'L');
        $pdf->Cell(0,4,'Recibi Conforme                                                                                          Elaborado por',0,1,'L'); 
         $pdf->Cell(0,4,'Identificacion:',0,1,'L');
         $pdf->Cell(0,4,'- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -- - - - - - - - - - - - - - - - - - - - - - -- - - - - - - - - - - - - -   ',0,1,'L');

$pdf->Output();

?>