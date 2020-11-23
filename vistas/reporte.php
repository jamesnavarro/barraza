
<html>
	<head>
		<meta charset="utf-8">
		<title>Reporte de Atenciones</title>
		<link rel="stylesheet" href="style.css">
		<link rel="license" href="https://www.opensource.org/licenses/mit-license/">
		<script src="script.js"></script>
		<style>
		/* reset */

*
{
	border: 0;
	box-sizing: content-box;
	color: inherit;
	font-family: inherit;
	font-size: inherit;
	font-style: inherit;
	font-weight: inherit;
	line-height: inherit;
	list-style: none;
	margin: 0;
	padding: 0;
	text-decoration: none;
	vertical-align: top;
}

/* content editable */

*[contenteditable] { border-radius: 0.25em; min-width: 1em; outline: 0; }

*[contenteditable] { cursor: pointer; }

*[contenteditable]:hover, *[contenteditable]:focus, td:hover *[contenteditable], td:focus *[contenteditable], img.hover { background: #DEF; box-shadow: 0 0 1em 0.5em #DEF; }


/* heading */

h1 { font: bold 100% sans-serif; letter-spacing: 0.5em; text-align: center; text-transform: uppercase; }

/* table */

table { font-size: 45%; table-layout: fixed; width: 100%; }
table { border-collapse: collapse; border-spacing: 0px; }
th, td { border-width: 1px; padding: 0.5em; position: relative; text-align: left; }
th, td { border-radius: 0.25em; border-style: solid; }
th { background: #EEE; border-color: #000;font-size: 8px; }
td { border-color: #000;font-size: 8px;color:#000 }

/* page */

html { font: 12px/1 'Open Sans', sans-serif; overflow: auto; }


body { box-sizing: border-box; margin: 0 auto; overflow: hidden; padding: 0.5in; width: 8.5in; }
body { background: #FFF; border-radius: 1px; box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5); }

/* header */


header:after { clear: both; content: ""; display: table; }

header h1 { background: #D4D8DA; border-radius: 0.25em; color: #000; margin: 0 0 1em; padding: 0.5em 0; }
header address { float: left; font-size: 70%; font-style: normal; line-height: 1; margin: 0 1em 1em 0; }
header address p { margin: 0 0 0.25em; }
header span, header img { display: block; float: right; }
header span { margin: 0 0 1em 1em; max-height: 15%; max-width: 60%; position: relative; }
header img { max-height: 100%; max-width: 100%; }
header input { cursor: pointer; -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"; height: 100%; left: 0; opacity: 0; position: absolute; top: 0; width: 100%; }

/* article */

article, article address, table.meta, table.inventory { margin: 0 0 3em; }
article:after { clear: both; content: ""; display: table; }
article h1 { clip: rect(0 0 0 0); position: absolute; }

article address { float: left; font-size: 80%; font-weight: bold; }

/* table meta & balance */

table.meta, table.balance { float: right; width: 36%; }
table.meta:after, table.balance:after { clear: both; content: ""; display: table; }

/* table meta */

table.meta th { width: 40%; }
table.meta td { width: 60%; }

/* table items */

table.inventory { clear: both; width: 100%; }
table.inventory th { font-weight: bold; text-align: center; }

table.inventory td:nth-child(1) { width: 26%; }
table.inventory td:nth-child(2) { width: 38%; }
table.inventory td:nth-child(3) { text-align: right; width: 12%; }
table.inventory td:nth-child(4) { text-align: right; width: 12%; }
table.inventory td:nth-child(5) { text-align: right; width: 12%; }

/* table balance */

table.balance th, table.balance td { width: 50%; }
table.balance td { text-align: right; }


/* aside */

aside h1 { border: none; border-width: 0 0 1px; margin: 0 0 1em; }
aside h1 { border-color: #999; border-bottom-style: solid; }

/* javascript */

.add, .cut
{
	border-width: 1px;
	display: block;
	font-size: .8rem;
	padding: 0.25em 0.5em;	
	float: left;
	text-align: center;
	width: 0.6em;
}

.add, .cut
{
	background: #9AF;
	box-shadow: 0 1px 2px rgba(0,0,0,0.2);
	background-image: -moz-linear-gradient(#00ADEE 5%, #0078A5 100%);
	background-image: -webkit-linear-gradient(#00ADEE 5%, #0078A5 100%);
	border-radius: 0.5em;
	border-color: #0076A3;
	color: #FFF;
	cursor: pointer;
	font-weight: bold;
	text-shadow: 0 -1px 2px rgba(0,0,0,0.333);
}

.add { margin: -2.5em 0 0; }

.add:hover { background: #00ADEE; }

.cut { opacity: 0; position: absolute; top: 0; left: -1.5em; }
.cut { -webkit-transition: opacity 100ms ease-in; }

tr:hover .cut { opacity: 1; }

@media print {
	* { -webkit-print-color-adjust: exact; }
	html { background: none; padding: 0; }
	body { box-shadow: none; margin: 0; }
	span:empty { display: none; }
	.add, .cut { display: none; }
}

@page { margin: 0; }
		</style>
		
	</head>
        <body onload="window.print();">
	<?php
	include('../modelo/conexion.php');
   session_start();
   

       $result = mysql_query("select * from actividad a, pacientes b, sis_empresa c where a.orden_servicio='".$_GET['imprimir']."' and a.id_paciente=b.id_paciente and b.id_empresa=c.rips group by a.orden_servicio");
       $r = mysql_fetch_array($result); 
       $id = $r[0];
       $usuario = $r['user'];
        $dep = mysql_query("select * from usuarios where usuario='".$usuario."' ");
        $d = mysql_fetch_array($dep);


									
	?>
		<header>
			 <h1>INTERNACION DOMICILIARIA BARRAZA</h1>
                         <h4><center>ATENCIONES PRESTADAS</center></h4>
			<address>
                            
                            <p><b>PACIENTE: </b><?php echo $r['nombres'].' '.$r['nombre2'].' '.$r['apellidos'].' '.$r['apellido2']; ?></p>
				<p><?php echo $r['documento'] ?>:<?php echo $r['numero_doc'] ?> </p>
                                <p>AFILIADO A:<?php echo $r['nombre_emp'] ?> </p>
				<p>AUTORIZACION: <?php echo $r['orden_externa'] ?>  </p>
                                <p>ATENCION: <?php echo $r['cod_aten'].' '.$r['Description'].' x '.$r['cant'] ?>  </p>
				
			</address>
                        <span><img alt="" src="../imagenes/idb.png" width="100px">
                           </span>
                        
		</header>
		<article>
                    <table style="border-color: #FFF; border-collapse: collapse;">
                              <tr>
                                  <td colspan="2">
			<table class="inventory">
				<thead>
					<tr>
						<th style="width:40px"><span >No. Visita</span></th>
						<th><span >Resumen de valoracion y Tratamiento</span></th>
                                          
					</tr>
				</thead>
				<tbody>
					<?php
                                   $sql = mysql_query("select *,CONCAT('Fecha de Registro: ',fecha_mod_ta,'\nValoracion :',Valoracion,' Tratamiento :', inf_adicional) as resumen from actividad where estado='Completada' and orden_servicio='".$_GET['imprimir']."' order by Id");
                                   $firma = '';
				while($mostrar = mysql_fetch_array($sql)){
					$firma = $mostrar['firmadigital'];
					echo '<tr><td>'.$mostrar['cant_ins'].'</td>
                                                   <td><p>Valoracion: '.$mostrar['Valoracion'].'</p>'
                                                . '<p>Tratamiento: '.$mostrar['inf_adicional'].'</p>'
                                                . '<p>Fecha de Registro: '.$mostrar['fecha_mod_ta'].'</p></td>';
                                   }

                                    ?>
                                    	</tbody>
			</table>
                                      </td>
                          </tr>
                        <tr>
                            <td>
                                <?php 
                                echo '<img src="../img_barraza/'.$d['ruta'].'" style="width:100px">';
                                ?>
                            </td>
                            <td>
                                <?php 
                                if($firma!=''){
                                echo '<img src="'.$firma.'" style="width:100px">';
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php 
                  
                                 echo '<p>_________________________________________</p>';
                                echo '<p>Firma del responsable</p>';
                                echo '<p>'.$d['nombre'].' '.$d['apellido'].'</p>';
                                echo '<p>'.$d['cargo'].'</p>';
                                ?>
                            </td>
                            <td>
                                <?php 
                             
                                 echo '<p>_________________________________________</p>';
                                echo '<p>Firma del Usuario y/o Acudiente</p>';
                                echo '<p>'.$r['nombres'].' '.$r['apellidos'].'</p>';
                                echo '<p>'.$d['documento'].'</p>';
                                ?>
                            </td>
                        </tr>
                    </table>
                                 
                          
	
		</article>

	</body>
</html>
<?php
ob_end_flush();
?>