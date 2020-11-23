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
<script> 
function habilita(){ 
if(document.formulario.hora.disabled == true) { 
document.formulario.hora.disabled = false; 
document.formulario.minuto.disabled = false;
} else { 
document.formulario.hora.disabled = true;
document.formulario.minuto.disabled = true; } 

} 
</script> 
<script> 
function habilita2(){ 
if(document.formulario.hora2.disabled == true) { 
document.formulario.hora2.disabled = false; 
document.formulario.minuto2.disabled = false;
} else { 
document.formulario.hora2.disabled = true;
document.formulario.minuto2.disabled = true; } 

} 
</script> 
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
  

                        
 <font color="red">Aviso: (*)Indica un campo requerido</font>   <fieldset style="width:90%; float:center; margin-right: 3%;">          

    
        <form name="formulario" action="../modelo/insertar_tarea_empresa.php" method="post" enctype="multipart/form-data" >
                <input type="submit" name="enviar" value="Guardar" class="alt_btn" onclick="">
					                           <a href="../vistas/empresa.php?codigo=<?php echo ($id_empresa); ?>"><input type="button" name="cancelar" value="Cancelar"></a>
                                                                  <a href="../vistas/formulario_tareas.php?tarea=<?php echo ($idc); ?>"><input type="button" name="crear" value="Formulario Complecto"></a>
                                                                  <br><br>
                <div><label>Asunto : <font color="red"> *</font></label>
                <input type="text" name="asunto" style="width:350px;height:20px;"/></div><br><br>
                <div><label>Fecha Inicio : <font color="red"> *</font></label>
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
                                                                  
                                                                   
                                                               </select>
                                                               
                                                               (hora/minutos 24H)
                                                      
                                                         </div><br>
                <div> 
                                                           <label>Fecha Vencimiento : <font color="red"> *</font></label>
                                                           <input type="text" name="fechav" class="tcal" style="width:80px;height:20px;"/>
                                                               <select name="hora2"  style="width:40px;height:20px;" size="2">
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
                                                               :<select name="minuto2"  style="width:40px;height:20px;" size="2">
                                                                 <option value="00" SELECTED DEFAULT>00</option>
                                                                  <?php 
                                                                   for ($i=0; $i<=9; $i++) {
                                                                   echo '<option value='..0.$i.'>'..0.$i.'</option>';
                                                                   }
                                                                   for ($i=10; $i<=59; $i++) {
                                                                   echo '<option value='.$i.'>'.$i.'</option>';
                                                                   }
                                                                   ?>
                                                                   
                                                                  
                                                                   
                                                               </select>
                                                               (hora/minutos 24H)
                </div><br>
                                                         
                <div>  <label>Prioridad :</label>
                                                            <select name="prioridad" style="width:130px;height:20px;">
                                                                   <option value="Alta">Alta</option>
                                                                   <option value="Media">Media</option>
                                                                   <option value="Baja">Baja</option>
                                                               </select>
                </div>        <br>
                <div><label>Asignado a : </label>
                                                        <input type="text" name="user" readonly id="valor6" style="width:130px;height:20px;" value="<?php echo $_SESSION['k_username']; ?>"/>
                                                                <a href='javascript: usuario()'><input type="button" name="cancelar" value="Seleccionar"></a></div><br>
                                                         
                                                          <div> <label>Descripcion :</label>
                                                           <textarea name="descripcion" style="width:40%;" rows="6"></textarea></div> <img src="../imagenes/tareas.png" alt="" width="100" height="100"/>
                                                         <p>
                                                           <div><label>Estado :</label>
                                                           <select name="estado" style="width:130px;height:20px;">
                                                                   <option value="No iniciada">No iniciada</option>
                                                                   <option value="En proceso">En proceso</option>
                                                                   <option value="Completada">Completada</option>
                                                                   <option value="Pendiente">Pendiente</option>
                                                                   <option value="Aplazada">Aplazada</option>
                                                               </select>
                                                           </div><br>
                                                           <div>
                                                           <label>Relacionado con :</label>
                                                           <input type="text" name="relacionado" readonly id="valor3" style="width:130px;height:20px;" value="Cuenta"/>
                                                                <input type="text" name="seleccion2" readonly id="valor5" style="width:130px;height:20px;" value="<?php echo $_SESSION['nombre_emp']?>"/>
                                                                <input type="text" name="seleccion" readonly id="valor4" style="width:1px;height:2px;" value="<?php echo $_SESSION['id_emp']?>"/>
                                                                <a href='javascript: seleccionar()'><input type="button" name="cancelar" value="Seleccionar"></a></div><br>
                                                     
                                                    <div><label>nombre contacto : *</label>
                                                          <input type="text" name="contacto_t1" id="valor1" readonly style="width:130px;height:20px;" />
                                                                <input type="text" name="contacto_t" readonly id="valor2" style="width:2px;height:2px;" />
                                                                <a href='javascript: contacto()'><input type="button" name="cancelar" value="Seleccionar"></a></div><br>
                                                       <input type="submit" name="enviar" value="Guardar" class="alt_btn" onclick="">
					                           <a href="../vistas/empresa.php?codigo=<?php echo ($id_empresa); ?>"><input type="button" name="cancelar" value="Cancelar"></a>
                                                                  <a href="../vistas/formulario_tareas.php?tarea=<?php echo ($idc); ?>"><input type="button" name="crear" value="Formulario Complecto"></a>
                                                                         

                                                    </form>
</fieldset>

                    
                                                          <?php
                                                          
if(isset($_POST['asunto'])){

$status = "";
$sql = "SELECT MAX(id_tarea) as id FROM sis_tarea";
$fila =mysql_fetch_array(mysql_query($sql));
if($fila["id"]==0){
   $idt = 1000000; 
}else{
$idt = $fila["id"]+1;
}
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('h:i a',time() - 3600*date('I'));

        $_SESSION['idt']=$idt;
	$asunto_t = $_POST["asunto"];
        $fecha1_t = $_POST["fechai"];
        if(isset($_POST["hora"])){
            $hora1_t = $_POST["hora"];
            $min1_t = $_POST["minuto"];
            $meri1_t = $_POST["meridiano"];
        }else{
            $hora1_t = '08';
            $min1_t = '00';
            $meri1_t = 'am';
        }
        $fecha2_t = $_POST["fechav"];
        if(isset($_POST["hora2"])){
            $hora2_t = $_POST["hora2"];
            $min2_t = $_POST["minuto2"];
            $meri2_t = $_POST["meridiano2"];
        }else{
            $hora2_t = '08';
            $min2_t = '00';
            $meri2_t = 'am';
        } 
        $prioridad_t = $_POST["prioridad"];
        $user_t = $_POST["user"];
        $descripcion_t = $_POST["descripcion"];
	$estado_t = $_POST["estado"];
        $relacionado_t = $_POST["relacionado"];
        $seleccionado_t = $_POST["seleccion"];
        $idcontacto_t = $_POST["contacto_t"];
        $fecha_reg_t= date("y-m-d").' '.$hora;
        $fecha_mod_t= date("y-m-d").' '.$hora;
        $idemp_t = $_POST["emp"];
        

	$sql = "INSERT INTO `sis_tarea`(`id_tarea`, `asunto_ta`, `fecha_i_ta`, `hora_i_ta`, `minuto_i_ta`, `meridiano_i_ta`, `fecha_v_ta`, `hora_v_ta`, `minuto_v_ta`, `meridiano_v_ta`, `prioridad_ta`, `user_ta`, `descripcion_ta`, `estado_ta`, `relacionado_ta`, `id_seleccionado_ta`, `id_contacto_ta`, `fecha_reg_ta`, `fecha_mod_ta`, `id_empresa`)";

        $sql.= "VALUES ('".$idt."','".$asunto_t."', '".$fecha1_t."', '".$hora1_t."','".$min1_t."', '".$meri1_t."', '".$fecha2_t."', '".$hora2_t."', '".$min2_t."', '".$meri2_t."', '".$prioridad_t."', '".$user_t."', '".$descripcion_t."', '".$estado_t."', '".$relacionado_t."', '".$seleccionado_t."', '".$idcontacto_t."', '".$fecha_reg_t."', '".$fecha_mod_t."', '".$idemp_t."')";

	mysql_query($sql, $conexion);

	$status = "ok";
        echo "<script language='javascript' type='text/javascript'>";
      
        echo "location.href='../vistas/contacto.php?codigo=".$_SESSION['contacto']."'";
      
        echo "</script>";
        
}   

?>		
		
		
	

</body>

</html>
