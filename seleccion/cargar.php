<meta charset="utf-8"/>
<script language="javascript" type="text/javascript">
function pasar2(){
    window.opener.datos2(document.getElementById('datos3').value, document.getElementById('datos4').value, document.getElementById('datos5').value);
    window.close();
}
</script>
<body onload="javascript:pasar2();">
<?php if(isset($_GET['select'])){
                     include "../modelo/conexion.php";
                     include_once '../vistas/Connection.php';
                     $request=Connection::runQuery("select * from sis_empresa WHERE id_empresa=".$_GET['select']);
                     while($row=mysql_fetch_array($request))
	{     
          
              $nnn = $row["nombre_emp"];
              $ii = $row["id_empresa"];
           ?>
         <form name="formu">

<input type="text" name="datos3" id="datos5" readonly value="<?php echo $nnn ?>" />
<input type="text" name="datos4" id="datos4" readonly value="<?php echo $ii ?>" />
<input type="text" name="datos5" id="datos3" readonly value="<?php echo 'Cuenta' ?>" />
</form>
<a href="#" title="pasar valor" onload="javascript:pasar2();"><input type="button" name="cerrar" value="Cargar"></a>  
      
	<?php }} ?>

<?php if(isset($_GET['inc'])){
                     include "../modelo/conexion.php";
                     include_once '../vistas/Connection.php';
                     $request=Connection::runQuery("select * from sis_incidencias WHERE id_incidencia=".$_GET['inc']);
                     while($row=mysql_fetch_array($request))
	{     
          
              $nnn = $row["asunto_inc"];
              $ii = $row["id_incidencia"];
           ?>
         <form name="formu">

<input type="text" name="datos3" id="datos5" readonly value="<?php echo $nnn ?>" />
<input type="text" name="datos4" id="datos4" readonly value="<?php echo $ii ?>" />
<input type="text" name="datos5" id="datos3" readonly value="<?php echo 'Incidencia' ?>" />
</form>
<a href="#" title="pasar valor" onload="javascript:pasar2();"><input type="button" name="cerrar" value="Cargar"></a>  
      
	<?php }} ?>

<?php if(isset($_GET['caso'])){
                     include "../modelo/conexion.php";
                     include_once '../vistas/Connection.php';
                     $request=Connection::runQuery("select * from sis_casos WHERE id_caso=".$_GET['caso']);
                     while($row=mysql_fetch_array($request))
	{     
          
              $nnn = $row["asunto_caso"];
              $ii = $row["id_caso"];
           ?>
         <form name="formu">

<input type="text" name="datos3" id="datos5" readonly value="<?php echo $nnn ?>" />
<input type="text" name="datos4" id="datos4" readonly value="<?php echo $ii ?>" />
<input type="text" name="datos5" id="datos3" readonly value="<?php echo 'Caso' ?>" />
</form>
<a href="#" title="pasar valor" onload="javascript:pasar2();"><input type="button" name="cerrar" value="Cargar"></a>  
      
	<?php }} ?>

<?php if(isset($_GET['contacto'])){
                     include "../modelo/conexion.php";
                     include_once '../vistas/Connection.php';
                     $request=Connection::runQuery("select * from usuarios WHERE id=".$_GET['contacto']);
                     while($row=mysql_fetch_array($request))
	{     
          
              $nnn = $row["nombre"].' '.$row["apellido"];
              $ii = $row["id"];
           ?>
         <form name="formu">

<input type="text" name="datos3" id="datos5" readonly value="<?php echo $nnn ?>" />
<input type="text" name="datos4" id="datos4" readonly value="<?php echo $ii ?>" />
<input type="text" name="datos5" id="datos3" readonly value="<?php echo 'Contacto' ?>" />
</form>
<a href="#" title="pasar valor" onload="javascript:pasar2();"><input type="button" name="cerrar" value="Cargar"></a>  
      
	<?php }} ?>

<?php if(isset($_GET['cont_pot'])){
                     include "../modelo/conexion.php";
                     include_once '../vistas/Connection.php';
                     $request=Connection::runQuery("select * from sis_contacto_potencial WHERE id_contacto_pot=".$_GET['cont_pot']);
                     while($row=mysql_fetch_array($request))
	{     
          
              $nnn = $row["nombre_pot"].' '.$row["apellido_pot"];
              $ii = $row["id_contacto_pot"];
           ?>
         <form name="formu">

<input type="text" name="datos3" id="datos5" readonly value="<?php echo $nnn ?>" />
<input type="text" name="datos4" id="datos4" readonly value="<?php echo $ii ?>" />
<input type="text" name="datos5" id="datos3" readonly value="<?php echo 'Contacto Potencial' ?>" />
</form>
<a href="#" title="pasar valor" onload="javascript:pasar2();"><input type="button" name="cerrar" value="Cargar"></a>  
      
	<?php }} ?>

<?php if(isset($_GET['oport'])){
                     include "../modelo/conexion.php";
                     include_once '../vistas/Connection.php';
                     $request=Connection::runQuery("select * from sis_oportunidades WHERE id_oportunidad=".$_GET['oport']);
                     while($row=mysql_fetch_array($request))
	{     
          
              $nnn = $row["nombre_opo"];
              $ii = $row["id_oportunidad"];
           ?>
         <form name="formu">

<input type="text" name="datos3" id="datos5" readonly value="<?php echo $nnn ?>" />
<input type="text" name="datos4" id="datos4" readonly value="<?php echo $ii ?>" />
<input type="text" name="datos5" id="datos3" readonly value="<?php echo 'Oportunidad' ?>" />
</form>
<a href="#" title="pasar valor" onload="javascript:pasar2();"><input type="button" name="cerrar" value="Cargar"></a>  
      
	<?php }} ?>

<?php if(isset($_GET['pro'])){
                     include "../modelo/conexion.php";
                     include_once '../vistas/Connection.php';
                     $request=Connection::runQuery("select * from sis_proyecto WHERE id_proyecto=".$_GET['pro']);
                     while($row=mysql_fetch_array($request))
	{     
          
              $nnn = $row["nombre_pro"];
              $ii = $row["id_proyecto"];
           ?>
         <form name="formu">

<input type="text" name="datos3" id="datos5" readonly value="<?php echo $nnn ?>" />
<input type="text" name="datos4" id="datos4" readonly value="<?php echo $ii ?>" />
<input type="text" name="datos5" id="datos3" readonly value="<?php echo 'Proyecto' ?>" />
</form>
<a href="#" title="pasar valor" onload="javascript:pasar2();"><input type="button" name="cerrar" value="Cargar"></a>  
      
	<?php }} ?>

<?php if(isset($_GET['tarea'])){
                     include "../modelo/conexion.php";
                     include_once '../vistas/Connection.php';
                     $request=Connection::runQuery("select * from actividad WHERE Id=".$_GET['tarea']);
                     while($row=mysql_fetch_array($request))
	{     
          
              $nnn = $row["Subject"];
              $ii = $row["Id"];
           ?>
         <form name="formu">

<input type="text" name="datos3" id="datos5" readonly value="<?php echo $nnn ?>" />
<input type="text" name="datos4" id="datos4" readonly value="<?php echo $ii ?>" />
<input type="text" name="datos5" id="datos3" readonly value="<?php echo 'Tarea' ?>" />
</form>
<a href="#" title="pasar valor" onload="javascript:pasar2();"><input type="button" name="cerrar" value="Cargar"></a>  
      
	<?php }} ?>
</body>