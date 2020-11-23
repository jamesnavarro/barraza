<?php 
include "../modelo/conexion.php";
require '../modelo/consultar_permisos.php';
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));
?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title>sistema Integral</title>
	
	<link rel="stylesheet" href="../css/stilo1.css" type="text/css" media="screen" />
	<link rel="stylesheet" type="text/css" href="../css_menu/menu.css" />
	<script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
	<script src="../js/mostrarmenu.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="../css/tcal.css" />
	<script type="text/javascript" src="../js/tcal.js"></script>
	<script src="../js/jquery.tablesorter.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="../js/jquery.equalHeight.js"></script>
                <script language="javascript">
$(document).ready(function(){
	// Parametros para e combo1
   $("#combo1_1").change(function () {
   		$("#combo1_1 option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("../modelo/combo1_1.php", { elegido: elegido }, function(data){
				$("#combo2").html(data);
				$("#combo3").html("");
			});			
        });
   })
	// Parametros para el combo2
	$("#combo2").change(function () {
   		$("#combo2 option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("combo2.php", { elegido: elegido }, function(data){
				$("#combo3").html(data);
			});			
        });
   })
});
</script>
        
	<script type="text/javascript">
	$(document).ready(function() 
    	{ 
      	  $(".tablesorter").tablesorter(); 
   	 } 
	);
	$(document).ready(function() {

	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});

});
    </script>
    
    <script language="javascript">
$(document).ready(function(){
	// Parametros para e combo1
   $("#combo1").change(function () {
   		$("#combo1 option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("../modelo/combo1.php", { elegido: elegido }, function(data){
				$("#combo2").html(data);
				$("#combo3").html("");
			});			
        });
   })
	// Parametros para el combo2
	$("#combo2").change(function () {
   		$("#combo2 option:selected").each(function () {
			//alert($(this).val());
				elegido=$(this).val();
				$.post("combo2.php", { elegido: elegido }, function(data){
				$("#combo3").html(data);
			});			
        });
   })
});
</script>
<script language='javascript'>
function contacto()
{
catPaises = window.open('../vistas/form_contacto.php', 'contacto', 'width=500,height=600');
}
function seleccionar()
{
catPaises = window.open('../vistas/seleccionar.php', 'contacto', 'width=1000,height=600');
}
function usuario()
{
catPaises = window.open('../seleccion/usuario.php', 'contacto', 'width=1000,height=600');
}
</script>
<script language="javascript" type="text/javascript">
function datos(val1, val2){
    document.getElementById('valor1').value = val1;
    document.getElementById('valor2').value = val2;
}
function user(val6){
    document.getElementById('valor6').value = val6;
    
}
function datos2(val3, val4, val5){
    
    document.getElementById('valor3').value = val3;
    document.getElementById('valor4').value = val4;
    document.getElementById('valor5').value = val5;
   
}
</script>
</head>


<body>
    
                        
                        <fieldset style="width:90%; float:center; margin-right: 3%;"><font color="red">Aviso: (*)Indica un campo requerido</font>
            <form name="insertar" action="../modelo/insertar_llamada_1.php" method="post" enctype="multipart/form-data">
             <input type="submit" name="enviar" value="Guardar" class="alt_btn" onclick="">
					                           <a href="../vistas/contacto.php?codigo=<?php echo ($idc); ?>"><input type="button" name="cancelar" value="Cancelar"></a>
                                                                  <a href="../vistas/formulario_llamada.php?llamada=<?php echo ($idc); ?>"><input type="button" name="Programar llamada" value="Formulario Complecto" onclick=""></a>
                                                                  <br><br>
                <div><label>Asunto : *</label>
                                                           <input type="text" name="asunto" style="width:350px;height:20px;"/></div><br><br>
                                                     
                                                           <div><label>Fecha Inicio :</label>
                                                           <input type="text" name="fechai" class="tcal" style="width:80px;height:20px;"/>
                                                              <select name="hora"  style="width:40px;height:20px;" size="2">
                                                                   <option value="00">00</option>
                                                                   <option value="01">01</option>
                                                                   <option value="02">02</option>
                                                                   <option value="03">03</option>
                                                                   <option value="04">04</option>
                                                                   <option value="05">05</option>
                                                                   <option value="06">06</option>
                                                                   <option value="07">07</option>
                                                                   <option value="08" SELECTED DEFAULT>08</option>
                                                                   <option value="09">09</option>
                                                                   <option value="10">10</option>
                                                                   <option value="11">11</option>
                                                                   <option value="12">12</option>
                                                                   <option value="13">13</option>
                                                                   <option value="14">14</option>
                                                                   <option value="15">15</option>
                                                                   <option value="16">16</option>
                                                                   <option value="17">17</option>
                                                                   <option value="18">18</option>
                                                                   <option value="19">19</option>
                                                                   <option value="20">20</option>
                                                                   <option value="21">21</option>
                                                                   <option value="22">22</option>
                                                                   <option value="23">23</option>
                                                                   
                                                               </select>
                                                               :<select name="minuto"  style="width:40px;height:20px;" size="2">
                                                                   <option value="00" SELECTED DEFAULT>00</option>
                                                                   <?php 
                                                                   for ($i=1; $i<=9; $i++) {
                                                                   echo '<option value='..0.$i.'>'..0.$i.'</option>';
                                                                   }
                                                                   for ($i=10; $i<=59; $i++) {
                                                                   echo '<option value='.$i.'>'.$i.'</option>';
                                                                   }
                                                                   ?>
                                                                  
                                                                   
                                                               </select> </div><br>
                                                           <div><label>duracion :</label><select name="hora2"  style="width:40px;height:20px;" size="2">
                                                                   <option value="00" SELECTED DEFAULT>00</option>
                                                                   <?php 
                                                                   for ($i=1; $i<=9; $i++) {
                                                                   echo '<option value='..0.$i.'>'..0.$i.'</option>';
                                                                   }
                                                                   for ($i=10; $i<=23; $i++) {
                                                                       
                                                                   echo '<option value='.$i.'>'.$i.'</option>';
                                                                   }
                                                                   ?>
                                                                  
                                                                   
                                                               </select>
                                                               <select name="minuto2"  style="width:40px;height:20px;" size="2">
                                                                   
                                                                   <?php 
                                                                   for ($i=1; $i<=9; $i++) {
                                                                   echo '<option value='..0.$i.'>'..0.$i.'</option>';
                                                                   }
                                                                   for ($i=10; $i<=59; $i++) {
                                                                       if($i==15){echo '<option value='.$i.' SELECTED DEFAULT>'.$i.'</option>';}
                                                                   echo '<option value='.$i.'>'.$i.'</option>';
                                                                   }
                                                                   ?>
                                                                  
                                                                   
                                                               </select>(hora/minutos)</div>
                                                               
                                                               
                                                               <br>
                                                        
                                                               <div><label>Aviso : </label>
                                                           <input type="checkbox" name="aviso" value="on"></div><br>
                                                               <div><label>Asignado a : </label>
                                                           <input type="text" name="user" readonly id="valor6" style="width:130px;height:20px;" value="<?php echo $_SESSION['k_username']; ?>"/>
                                                                <a href='javascript: usuario()'><input type="button" name="cancelar" value="Seleccionar"></a></div><br>
                                                           <div><label>Descripcion :</label></td>
                                                          <textarea name="descripcion" style="width:40%;" rows="6"></textarea></div> <img src="../imagenes/llamada.png" alt="" width="100" height="100"/>
                                                        
                                                          <div> <label>Estado :</label>
                                                            <select name="estado" style="width:130px;height:20px;">
                                                                   <option value="Entrante">Entrante</option>
                                                                   <option value="Saliente">Saliente</option>
                                                                   
                                                               </select>
                                                            <select name="estado_2" style="width:130px;height:20px;">
                                                                   <option value="Planificada">Planificada</option>
                                                                   <option value="Realizada">Realizada</option>
                                                                   <option value="No Realizada">No Realizada</option>
                                                                   
                                                               </select></div><br>
                                                       
                                                          
                                                         
                                                         
                                                          <div><label>Relacionado con :</label>
                                                          <input type="text" name="relacionado" readonly id="valor3" style="width:130px;height:20px;" value="<?php if(isset($idemp)){echo 'Cuenta';}?>"/>
                                                                <input type="text" name="seleccion2" readonly id="valor5" style="width:130px;height:20px;" value="<?php if(isset($idemp)){ 
                                                        $con= "SELECT * FROM `sis_empresa` WHERE `id_empresa`=".$idemp;
                                                        $res=  mysql_query($con);
                                                        while($f=  mysql_fetch_array($res)){
                                                     
                                                        $nom_ec=$f['nombre_emp']; echo $nom_ec;}} ?>"/>
                                                                <input type="text" name="seleccion" readonly id="valor4" style="width:1px;height:2px;" value="<?php if(isset($idemp)){echo $idemp;}?>"/>
                                                                <a href='javascript: seleccionar()'><input type="button" name="cancelar" value="Seleccionar"></a></div><br>
                                                    <div><label>nombre contacto : *</label>
                                                           <input type="text" name="contacto_t1" id="valor1" readonly style="width:130px;height:20px;" value="<?php echo $_SESSION['nombre']; ?>"/>
                                                                <input type="text" name="contacto_t" readonly id="valor2" style="width:2px;height:2px;" value="<?php echo $idc ?>"/></div><br>
                                                                <br><br>
                                                                     <input type="submit" name="enviar" value="Guardar" class="alt_btn" onclick="">
					                           <a href="../vistas/contacto.php?codigo=<?php echo ($idc); ?>"><input type="button" name="cancelar" value="Cancelar"></a>
                                                                  <a href="../vistas/formulario_llamada.php?llamada=<?php echo ($idc); ?>"><input type="button" name="Programar llamada" value="Formulario Complecto" onclick=""></a>
                                                            
                                                             
                                                          
                                                   </form>
		    </fieldset>
                    
		
		
	
</body>

</html>
