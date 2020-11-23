<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        if(isset($_GET['cod'])){}
        include "../modelo/conexion.php";
        $request=mysql_query("SELECT * FROM modificaciones  where id_cotizacion=".$_GET['cod']." and modulo='".$_GET['modulo']."' order by id_m ");

     
if($request){
//    echo'<hr>';
              $table = '<table class="table table-bordered table-striped table-hover" id="tabla">';
              $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th width="10%">'.'Numero'.'</th>';
              $table = $table.'<th width="50%">'.'Descripcion de Modificacion'.'</th>';             
              $table = $table.'<th width="20%">'.'Fecha de registro'.'</th>';
              
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysql_fetch_array($request))
	{  
            
             $table = $table.'<tr><td  width="10%">'.$row['id_cotizacion'].'</td><td width="50%">'.$row['descripcion'].'</td><td width="10%">'.$row['registro'].'</font></td></tr>';   
     
	}
        
        
	$table = $table.'</table>';
        
	echo $table;
}
        ?>
    </body>
</html>
