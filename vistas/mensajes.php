<html> 
<head> 
<title></title> 
 <script language="JavaScript">
                       function Abrir_ventana(pagina) { 
                       var opciones="toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, width=400, height=600, top=0, left=0"; window.open(pagina,"",opciones); }
</script>
</head> 
              <?php
              $consultam= "SELECT * FROM mensajes where visto=0 and id_receptor='".$_SESSION['id_user']."'  ";                     
$resultm=  mysql_query($consultam);
while($fila=  mysql_fetch_array($resultm)){

                        echo '<div id="div3" class="gritter-data hidden" data-time="9000">';
                        ?>
                          
<body onload="Abrir_ventana('<?php echo '../vistas/?id=msg&cod='.$fila['id_emisor'].'&est' ?>');"> 
                       <?php
                        
                      
}

                        ?>

</body> 
</html>
