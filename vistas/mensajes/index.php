<?php
if(isset($_GET['est'])){
    $sql = "UPDATE `mensajes` SET `visto` = '1' WHERE `id_receptor` = ".$_SESSION["id_user"].";";
    mysql_query($sql, $conexion);
    echo "<script language='javascript' type='text/javascript'>";     
echo "location.href='../vistas/?id=msg&cod=".$_GET['cod']."'";
echo "</script>";
}
?>
<div class="row-fluid">
<script src="mensajes/ajax.js"></script>
<script>

function mostrar()
{
	loadDoc(null,"mensajes/mensajes.php",function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		document.getElementById("historial").innerHTML=xmlhttp.responseText;
		}
	  });
}

setInterval(mostrar,3000);

function agregar()
{
	var u=document.getElementById('nombre').value;
	var c=document.getElementById('contenido').value;

	if(u!="" && c!=""){
		loadDoc("usuario="+u+"&cont="+c,"mensajes/proceso.php",function()
		  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
			document.getElementById("historial").innerHTML=xmlhttp.responseText;
                        document.getElementById('contenido').value=""
			}
		  });
		 
	}else{ alert("No deje campos vacios"); }

}
</script>
</head>

    <div class="span6 widget stacked widget-message teal" >
                  
    <header>
                                <h4 class="title"><span class="icon icone-envelope-alt"></span> Estas Chateando con <?php 
                                $sql1 = "SELECT * FROM usuarios where id=".$_GET['cod']."  ";
                                $fila1 =mysql_fetch_array(mysql_query($sql1));
                                $name = $fila1["nombre"].' '. $fila1["apellido"];
                                echo $name; 
                                $_SESSION['rem']=$_GET['cod']; ?></h4>
                                <!-- START Toolbar -->
                               
                                <!--/ END Toolbar -->
    </header>
          <section class="body"> 
            <div class="body-inner scrollable" id="demo2" style="height:500px;">
                                    <div class="scroll-content">
                                        <!-- START Message List -->
                                        <ul id="historial">
<img src="mensajes/ajax-loader.gif" />

    </ul>
                                        <!--/ END Message List -->
                                    </div>
                                </div>
<div class="footer">
    <div class="form">
        <input type="hidden" id="nombre" value="<?php echo $_GET['cod'] ?>" placeholder="usuario" />
<input type="text"  id="contenido" placeholder="mensaje">
<button  class="btn btn-primary" onclick="agregar()">Enviar</button>
    </section></div></div>


