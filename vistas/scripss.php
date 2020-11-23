<script language='javascript'>
    <?php 
    if(isset($_GET['ord'])){
        $cod = $_GET['ord'];
        $modulo = 'Atenciones';
    }
    if(isset($_GET['cod'])){
        $cod = $_GET['cod'];
        $modulo = 'Archivo General';
    }
    ?>
function registros()
{
catPaises = window.open('../vistas/registros.php?cod=<?php echo $cod.'&modulo='.$modulo;  ?> ', 'contacto', 'width=500,height=600');
}
            function CargarFirmas(oi)
{
       window.open('../vistas/firmas.php?ord='+oi+' ', 'contacto', 'width=700,height=600');
}
var ventana_secundaria 

function abrirVentana1(){  
ventana_secundaria = window.open("../vistas/estado_orden.php?cod=<?php  echo $_GET["codigo"] ?>","miventana","width=600,height=500,menubar=no") 
} 
function abrirVentana11(){  
ventana_secundaria = window.open("../vistas/view_estado.php?cod=<?php  echo $_GET["codigo"] ?>","miventana","width=600,height=500,menubar=no") 
} 
function autorizacion(){  
ventana_secundaria = window.open("../vistas/add_orden.php?cod=<?php  echo $_GET["codigo"] ?>","miventana","width=600,height=500,menubar=no") 
} 
function insumos(){  
    
ventana_secundaria = window.open("../vistas/add_ins.php?cod=id","miventana","width=500,height=200,menubar=no") 
} 
function medicamentos(){  
ventana_secundaria = window.open("../vistas/add_omed.php?cod=<?php  echo $_GET["codigo"] ?>","miventana","width=600,height=500,menubar=no") 
} 
function cerrarVentana(){ 
ventana_secundaria.close() 
} 

    </script>
