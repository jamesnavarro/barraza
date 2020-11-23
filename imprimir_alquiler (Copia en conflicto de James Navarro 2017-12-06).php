<?php

require('fpdf/fpdf.php');
require 'modelo/cx.php';
$paciente= $_GET['imprimir'];
	$con = new DB;
	$pacientes = $con->conectar();	
 $strConsulta3 = "select * from facturas where numero_factura='".$_GET['imprimir']."'";
	$pacientes3 = mysql_query($strConsulta3);
	$fila3 = mysql_fetch_array($pacientes3);
function valorEnLetras($x) 
{ 
if ($x<0) { $signo = "menos ";} 
else      { $signo = "";} 
$x = abs ($x); 
$C1 = $x; 

$G6 = floor($x/(1000000));  // 7 y mas 

$E7 = floor($x/(100000)); 
$G7 = $E7-$G6*10;   // 6 

$E8 = floor($x/1000); 
$G8 = $E8-$E7*100;   // 5 y 4 

$E9 = floor($x/100); 
$G9 = $E9-$E8*10;  //  3 

$E10 = floor($x); 
$G10 = $E10-$E9*100;  // 2 y 1 


$G11 = round(($x-$E10)*100,0);  // Decimales 
////////////////////// 

$H6 = unidades($G6); 

if($G7==1 AND $G8==0) { $H7 = "Cien "; } 
else {    $H7 = decenas($G7); } 

$H8 = unidades($G8); 

if($G9==1 AND $G10==0) { $H9 = "Cien "; } 
else {    $H9 = decenas($G9); } 

$H10 = unidades($G10); 

if($G11 < 10) { $H11 = "0".$G11; } 
else { $H11 = $G11; } 

///////////////////////////// 
    if($G6==0) { $I6=" "; } 
elseif($G6==1) { $I6="Millón "; } 
         else { $I6="Millones "; } 
          
if ($G8==0 AND $G7==0) { $I8=" "; } 
         else { $I8="Mil "; } 
          
$I10 = "Pesos "; 
$I11 = "ML. "; 

$C3 = $signo.$H6.$I6.$H7.$H8.$I8.$H9.$H10.$I10.$I11; 

return $C3; //Retornar el resultado 

} 

function unidades($u) 
{ 
    if ($u==0)  {$ru = " ";} 
elseif ($u==1)  {$ru = "Un ";} 
elseif ($u==2)  {$ru = "Dos ";} 
elseif ($u==3)  {$ru = "Tres ";} 
elseif ($u==4)  {$ru = "Cuatro ";} 
elseif ($u==5)  {$ru = "Cinco ";} 
elseif ($u==6)  {$ru = "Seis ";} 
elseif ($u==7)  {$ru = "Siete ";} 
elseif ($u==8)  {$ru = "Ocho ";} 
elseif ($u==9)  {$ru = "Nueve ";} 
elseif ($u==10) {$ru = "Diez ";} 

elseif ($u==11) {$ru = "Once ";} 
elseif ($u==12) {$ru = "Doce ";} 
elseif ($u==13) {$ru = "Trece ";} 
elseif ($u==14) {$ru = "Catorce ";} 
elseif ($u==15) {$ru = "Quince ";} 
elseif ($u==16) {$ru = "Dieciseis ";} 
elseif ($u==17) {$ru = "Decisiete ";} 
elseif ($u==18) {$ru = "Dieciocho ";} 
elseif ($u==19) {$ru = "Diecinueve ";} 
elseif ($u==20) {$ru = "Veinte ";} 

elseif ($u==21) {$ru = "Veintiun ";} 
elseif ($u==22) {$ru = "Veintidos ";} 
elseif ($u==23) {$ru = "Veintitres ";} 
elseif ($u==24) {$ru = "Veinticuatro ";} 
elseif ($u==25) {$ru = "Veinticinco ";} 
elseif ($u==26) {$ru = "Veintiseis ";} 
elseif ($u==27) {$ru = "Veintisiente ";} 
elseif ($u==28) {$ru = "Veintiocho ";} 
elseif ($u==29) {$ru = "Veintinueve ";} 
elseif ($u==30) {$ru = "Treinta ";} 

elseif ($u==31) {$ru = "Treintayun ";} 
elseif ($u==32) {$ru = "Treintaydos ";} 
elseif ($u==33) {$ru = "Treintaytres ";} 
elseif ($u==34) {$ru = "Treintaycuatro ";} 
elseif ($u==35) {$ru = "Treintaycinco ";} 
elseif ($u==36) {$ru = "Treintayseis ";} 
elseif ($u==37) {$ru = "Treintaysiete ";} 
elseif ($u==38) {$ru = "Treintayocho ";} 
elseif ($u==39) {$ru = "Treintaynueve ";} 
elseif ($u==40) {$ru = "Cuarenta ";} 

elseif ($u==41) {$ru = "Cuarentayun ";} 
elseif ($u==42) {$ru = "Cuarentaydos ";} 
elseif ($u==43) {$ru = "Cuarentaytres ";} 
elseif ($u==44) {$ru = "Cuarentaycuatro ";} 
elseif ($u==45) {$ru = "Cuarentaycinco ";} 
elseif ($u==46) {$ru = "Cuarentayseis ";} 
elseif ($u==47) {$ru = "Cuarentaysiete ";} 
elseif ($u==48) {$ru = "Cuarentayocho ";} 
elseif ($u==49) {$ru = "Cuarentaynueve ";} 
elseif ($u==50) {$ru = "Cincuenta ";} 

elseif ($u==51) {$ru = "Cincuentayun ";} 
elseif ($u==52) {$ru = "Cincuentaydos ";} 
elseif ($u==53) {$ru = "Cincuentaytres ";} 
elseif ($u==54) {$ru = "Cincuentaycuatro ";} 
elseif ($u==55) {$ru = "Cincuentaycinco ";} 
elseif ($u==56) {$ru = "Cincuentayseis ";} 
elseif ($u==57) {$ru = "Cincuentaysiete ";} 
elseif ($u==58) {$ru = "Cincuentayocho ";} 
elseif ($u==59) {$ru = "Cincuentaynueve ";} 
elseif ($u==60) {$ru = "Sesenta ";} 

elseif ($u==61) {$ru = "Sesentayun ";} 
elseif ($u==62) {$ru = "Sesentaydos ";} 
elseif ($u==63) {$ru = "Sesentaytres ";} 
elseif ($u==64) {$ru = "Sesentaycuatro ";} 
elseif ($u==65) {$ru = "Sesentaycinco ";} 
elseif ($u==66) {$ru = "Sesentayseis ";} 
elseif ($u==67) {$ru = "Sesentaysiete ";} 
elseif ($u==68) {$ru = "Sesentayocho ";} 
elseif ($u==69) {$ru = "Sesentaynueve ";} 
elseif ($u==70) {$ru = "Setenta ";} 

elseif ($u==71) {$ru = "Setentayun ";} 
elseif ($u==72) {$ru = "Setentaydos ";} 
elseif ($u==73) {$ru = "Setentaytres ";} 
elseif ($u==74) {$ru = "Setentaycuatro ";} 
elseif ($u==75) {$ru = "Setentaycinco ";} 
elseif ($u==76) {$ru = "Setentayseis ";} 
elseif ($u==77) {$ru = "Setentaysiete ";} 
elseif ($u==78) {$ru = "Setentayocho ";} 
elseif ($u==79) {$ru = "Setentaynueve ";} 
elseif ($u==80) {$ru = "Ochenta ";} 

elseif ($u==81) {$ru = "Ochentayun ";} 
elseif ($u==82) {$ru = "Ochentaydos ";} 
elseif ($u==83) {$ru = "Ochentaytres ";} 
elseif ($u==84) {$ru = "Ochentaycuatro ";} 
elseif ($u==85) {$ru = "Ochentaycinco ";} 
elseif ($u==86) {$ru = "Ochentayseis ";} 
elseif ($u==87) {$ru = "Ochentaysiete ";} 
elseif ($u==88) {$ru = "Ochentayocho ";} 
elseif ($u==89) {$ru = "Ochentaynueve ";} 
elseif ($u==90) {$ru = "Noventa ";} 

elseif ($u==91) {$ru = "Noventayun ";} 
elseif ($u==92) {$ru = "Noventaydos ";} 
elseif ($u==93) {$ru = "Noventaytres ";} 
elseif ($u==94) {$ru = "Noventaycuatro ";} 
elseif ($u==95) {$ru = "Noventaycinco ";} 
elseif ($u==96) {$ru = "Noventayseis ";} 
elseif ($u==97) {$ru = "Noventaysiete ";} 
elseif ($u==98) {$ru = "Noventayocho ";} 
else            {$ru = "Noventaynueve ";} 
return $ru; //Retornar el resultado 
} 

function decenas($d) 
{ 
    if ($d==0)  {$rd = "";} 
elseif ($d==1)  {$rd = "Ciento ";} 
elseif ($d==2)  {$rd = "Doscientos ";} 
elseif ($d==3)  {$rd = "Trescientos ";} 
elseif ($d==4)  {$rd = "Cuatrocientos ";} 
elseif ($d==5)  {$rd = "Quinientos ";} 
elseif ($d==6)  {$rd = "Seiscientos ";} 
elseif ($d==7)  {$rd = "Setecientos ";} 
elseif ($d==8)  {$rd = "Ochocientos ";} 
else            {$rd = "Novecientos ";} 
return $rd; //Retornar el resultado 
}
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
 $strConsulta3 = "select * from facturas where numero_factura='".$_GET['imprimir']."'";
	$pacientes3 = mysql_query($strConsulta3);
	$fila3 = mysql_fetch_array($pacientes3);
	$this->Image('imagenes/idb.png',17,10,15,'L');
	$this->SetFont('Arial','B',12);
       
	// Movernos a la derecha
	
	// T�tulo
	$this->Cell(30,10,'                                     INTERNACION DOMICILIARIA BARRAZA LTDA',0,0);
	// Salto de l�nea
	$this->SetFont('Arial','B',8);
        $this->Cell(155,10,'Factura de Venta No. '.$fila3['numero_factura'],0,0,'R');
	$this->Ln(0);
}
function Footer()
{
	  $this->Image('footer.png',20,235,177,'C');
	// Posici�n: a 1,5 cm del final
	$this->SetY(-15);
	// Arial italic 8
	$this->SetFont('Arial','I',8);
	// N�mero de p�gina
	$this->Cell(0,10,'Page '.$this->PageNo().'/1',0,0,'C');

}

}


        $strConsulta4 = "SELECT a.*, (a.fecha_registro) as frg, b.*, b.cantidad*b.precio_a*b.meses, d.*, (a.meses) as mes, c.* FROM facturas a, equipos_asig b, ordenes c, alquiler d WHERE d.codigo=b.cod_equipo and a.orden_ext=c.orden and  c.id_paciente=a.id_paciente and b.autorizacion=c.orden and a.numero_factura=".$_GET['imprimir']." group by cod_equipo";
	$pacientes4 = mysql_query($strConsulta4);
	$fila4 = mysql_fetch_array($pacientes4);
	
	$strConsulta = "select * from inf_empresa";
	$pacientesx = mysql_query($strConsulta);
	$fila = mysql_fetch_array($pacientesx);
        
        $strConsulta2 = "select a.*, b.*, c.* from equipos_asig a, pacientes b, sis_empresa c, ordenes d where d.id=a.numero_orden_a and d.id='".$fila3['orden_int']."' and d.id_paciente=b.id_paciente and b.id_empresa=c.rips";
	$pacientes2 = mysql_query($strConsulta2);
	$fila2 = mysql_fetch_array($pacientes2);
        
         if($_GET['imprimir']>5000){
            $rangos = mysql_query("select * from rangos_facturas where id_rango=3");
        }else{
            $rangos = mysql_query("select * from rangos_facturas where id_rango=1");
        }
        $rango = mysql_fetch_array($rangos);
        $resolucion = $rango['resolucion'];
       
        $Fecha=date("Y-m-d");
        $fecha_v = date("Y-m-d", strtotime("$Fecha +1 month"));
        
	$pdf=new PDF();
	$pdf->Open();
	$pdf->AddPage();
	$pdf->SetMargins(20,20,20);
	$pdf->Ln(8);

        $pdf->SetFont('Arial','',6);
	$pdf->Cell(0,3,'                                                                                                                               Nit: '.$fila['nit_emp'].'                                                                                      Forma de Pago : 1 mes de credito',0,1);
	$pdf->Cell(0,3,'                                                                                                                Telefono: '.$fila['telefono_1'].' '.$fila['telefono_3'].'                                                                              Fecha de Vencimiento:'.$fecha_v,0,1); 
	$pdf->Cell(0,3,'                                                                                                                 Direccion: '.$fila['direccion'].'                                                                   Fecha:'.$fila3['fecha_registro'],0,1); 
        $pdf->Cell(0,3,'E-mail: '.$fila['email'],0,1,'C');
        $pdf->Cell(0,3,$resolucion,0,1,'C');
        $pdf->Cell(0,3,'Regimen Comun',0,1,'C');
        $pdf->Cell(0,3,'_______________________________________________________________________________________________________________________________________________',0,1,'C');
	$pdf->SetFont('Arial','',6);
	$pdf->Cell(0,3,'EMPRESA      : '.$fila2['nombre_emp'],0,1);
	$pdf->Cell(0,3,'TELEFONOS  : '.$fila2['tel_oficina_emp'],0,1); 
	$pdf->Cell(0,3,'NIT                  : '.$fila2['nit_emp'].'                                                                                                              Fecha de Atencion del:'.$fila3['fechai'].' al '.$fila3['fechaf'],0,1); 
        $pdf->Cell(0,3,'PACIENTE      : '.$fila2['nombres'].' '.$fila2['nombre2'].' '.$fila2['apellidos'].' '.$fila2['apellido2'].'.    C.C:'.$fila2['numero_doc'],0,1);
        $pdf->Cell(0,3,'DIAGNOSTICO:'.$fila2['enfermedad'].' - '.$fila2['descripcion_enf'].'',0,1);
        $pdf->Cell(0,3,'_______________________________________________________________________________________________________________________________________________',0,1,'C');
        $pdf->Ln(2);
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(0,3,'',0,1,'C');
	$pdf->Ln(5);
	
	$pdf->SetWidths(array(10, 20, 10, 60, 30, 10, 15, 15));
	$pdf->SetFont('Arial','B',6);
	$pdf->SetFillColor(230,230,230);
    $pdf->SetTextColor(0);

		for($i=0;$i<1;$i++)
			{
				$pdf->Row(array('O.I', 'AUTORIZACION', 'COD.', 'DESCRIPCION', 'ANEXOS', 'CANT.', 'P X UND', 'TOTAL'));
			}
	
	$historial = $con->conectar();

	$strConsulta = "select a.*, b.* from equipos_asig a, alquiler b where a.cod_equipo=b.codigo and a.facturado='".$_GET['imprimir']."'";
	
	$historial3 = mysql_query($strConsulta);
	$numfilas = mysql_num_rows($historial3);
	
	for ($i=0; $i<$numfilas; $i++)
		{
			$filad = mysql_fetch_array($historial3);
			$pdf->SetFont('Arial','',0);
			
			if($i%2 == 1)
			{
				$pdf->SetFillColor(255,255,254);
    			$pdf->SetTextColor(0);
				$pdf->Row(array($filad['numero_orden_a'], $filad['autorizacion'], $filad['cod_equipo'], $filad['nombre'], $filad['anexo'], $filad['cantidad'], number_format($filad['precio_a']), number_format($filad['precio_a']*$filad['cantidad']*$filad['meses'])));
			}
			else
			{
		        $pdf->SetFillColor(255,255,254);
    			$pdf->SetTextColor(0);
				$pdf->Row(array($filad['numero_orden_a'], $filad['autorizacion'], $filad['cod_equipo'], $filad['nombre'], $filad['anexo'], $filad['cantidad'], number_format($filad['precio_a']), number_format($filad['precio_a']*$filad['cantidad']*$filad['meses'])));
			}
		}
$pdf->Cell(0,3,'Nota :  '.$fila3['informacion'],0,1);
$pdf->Ln(0);
$pdf->Cell(0,3,'_______________________________________________________________________________________________________________________________________________',0,1,'C');
      $cambio = valorEnLetras($fila3['total']-$fila3['copagos']); 
        $pdf->SetFont('Arial','',8);
        $pdf->Cell(0,3,'Copagos :  '.number_format($fila3['copagos']).'                  Servicios : '.number_format($fila3['total']).'                Materiales y Medicamentos :'.number_format(0),0,1);
        $pdf->Ln(2);
        $pdf->Cell(0,3,'Son :  '.$cambio,0,1);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(0,3,'Total Neto a Pagar $ '.number_format($fila3['total']-$fila3['copagos']),0,1,'R');
$pdf->Output();
?>