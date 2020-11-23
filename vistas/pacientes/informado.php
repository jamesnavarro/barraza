
<html>
	<head>
		<meta charset="utf-8">
		<title>Consentimiento Informado</title>
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

span[contenteditable] { display: inline-block; }

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

html { font: 15px/1 'Open Sans', sans-serif; overflow: auto; padding: 0.9in; }
html { background: #999; cursor: default; }

body { box-sizing: border-box; height: 11in; margin: 0 auto; overflow: hidden; padding: 0.5in; width: 8.5in; }
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
.cuerpo{
    text-align: justify;
    texto-justify: inter-palabra;
}
		</style>
		
	</head>
        <body>
	<?php
	include('../../modelo/conexion.php');
   session_start();
   

       $result = mysql_query("select * from actividad a, pacientes b where a.id_paciente='".$_GET['id']."' and a.id_paciente=b.id_paciente order by a.Id desc limit 1 ");
       $r = mysql_fetch_array($result); 
       $id = $r[0];
       $usuario = $r['user'];
        $dep = mysql_query("select * from usuarios where usuario='".$usuario."' ");
        $d = mysql_fetch_array($dep);
        
        $depa = mysql_query("select * from departamentos where cod_dep='".$r['departamento']."' and cod_mun='".$r['municipio']."' ");
        $de = mysql_fetch_array($depa);
        
    


									
	?>
             <center><img alt="" src="../../imagenes/idb.png" width="200px"></center>
		<header>
                   
                         <h4><center>CONSENTIMIENTO INFORMADO Y AUTORIZACION PARA PROCEDIMIENTOS</center></h4>
			<address>
                            
                            <p><b></b> </p>
				
			</address>
                     
                        
		</header>
             <article class="cuerpo">
                    <p>
                        Ciudad: <?php echo $de['nombre_dep']; ?> Departamento: <?php echo $de['nombre_mun']; ?> Fecha: <?php echo $r['fecha_firma']; ?><br>
                        Yo <?php echo $r['nombres'].' '.$r['nombre2'].' '.$r['apellidos'].' '.$r['apellido2']; ?>, Con Cedula de Ciudadanía
No <?php echo $r['numero_doc']; ?>, en calidad de <?php echo $r['quienfirmo']; ?>, certifico que conozco mi
diagnóstico de <?php echo $r['enfermedad'].' '.$r['desc_enfermedad'] ; ?> y en pleno derecho
y normal uso de mis facultades mentales, por medio del presente documento
manifiesto que he decidido voluntaria y libremente autorizar a la empresa
INTERNACION DOMICILIARIA BARRAZA LTDA. Para que asigne a quien corresponda a
la realización los siguientes procedimientos y atenciones:
<?php echo $r['observaciones']; ?> 
Se me ha explicado la naturaleza del procedimiento que se practicara y se me ha dado
la oportunidad de realizar preguntas que he juzgado convenientes para resolver mis
dudas las cuales fueron contestadas adecuadamente por el personal de INTERNACION
DOMICILIARIA BARRAZA LTDA.<br>
Autorizo que en caso de ser necesario por criterio personal de IDB mi condición de
salud, pueda ser trasladada a una Institución Prestadora de Servicios de Salud, de
cualquier nivel de atención.
Acepto y autorizo además que durante el tiempo que dura el tratamiento domiciliario,
la historia clínica, medicamentos, insumos y equipos necesarios queden bajo la
custodia del personal de INTERNACION DOMICILIARIA BARRANZA LTDA que realiza el
procedimiento.<br>
Teniendo en cuenta lo anterior doy mi consentimiento informado, libre y voluntario
para que el personal de INTERNACION DOMICILIARIA BARRANZA LTDA. me realice los
procedimientos médicos y tratamientos, certifico que me fueron informado los
posibles riegos y efectos secundarios del tratamiento. Aceptando que yo asumo todos
los riesgos, reacciones, complicaciones y resultados insatisfactorios que puedan
derivarse de la misma y de los procedimientos relacionados con ella, los cuales
reconozco que puedan presentarse a pesar de que tomen las precauciones usuales
para evitarlos. Ya que he sido informado Me comprometo a cumplir fielmente con las
recomendaciones, instrucciones y controles después de la atención domiciliaria.
Yo otorgo mi consentimiento para la toma de fotografías de mi persona, para fines de
estudio y seguimiento terapéutico.<br>
<img src="<?php echo $r['firmainfo']; ?>" style="width:100px">&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;   &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;<img src="../../img_barraza/<?php echo $d['ruta']; ?>" style="width:100px"><br>
______________________________&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;   &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;______________________________<br>
Firma del Paciente o Representante&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;   &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;Nombre del Profesional  <br>
<?php echo $r['documento']; ?> <?php echo $r['numero_doc']; ?>    &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;   &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;  &nbsp;<?php echo $d['nombre'].' '.$d['apellido']; ?>

                    </p>
	
		</article>

	</body>
</html>
<?php
ob_end_flush();
?>