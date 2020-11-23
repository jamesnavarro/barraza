<?php
$request=mysql_query("SELECT * FROM usuarios a, control_ip b where a.id=b.ip order by online desc ");    
if($request){
//    echo'<hr>';
             echo '<table>';

             echo '<thead >';
             echo '<tr BGCOLOR="#C3D9FF">';
                        
            
             echo '<th width="50%">'.'Usuario'.'</th>';
             echo '<th  width="10%">'.'Online'.'</th>';
             echo '</tr>';
             echo '</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysql_fetch_array($request))
	{       
           if($row["online"]==1){
               $led ='<img src="../imagenes/led.gif">';
           }else{
               $led ='<img src="../imagenes/led.gif">';
           }  ?>
           <tr><td width="50%"><a href="<?php echo '../vistas/?id=msg&cod='.$row["id"].'&est' ?>"  target="_blank" onClick="window.open(this.href, this.target, 'width=400,height=600'); return false;" ><?php echo substr($row["nombre"].' '.$row["apellido"],0,19) ?><font></a></td><td class="hidden-phone"><?php echo $led ?></font></td></tr>   
          <?php
	}
        
        
	echo '</table>';
   

        
     
}
?>
     

