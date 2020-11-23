<?php
if($_POST['t']=='1'){

$a =  'Cod. Insumo<input type="hidden"  id="sw" disabled value="0"/>';
$b = '1'; ?>
 <?php }else{ 
$a = 'Cod. Medicamento<input type="hidden"  id="sw" disabled value="2"/>';
$b = '2';
}
if($_POST['m']=='0'){
    $c = '<input type="text"  id="inv" disabled value="Si" style="width:40px"/>';
}else{
    $c = '<input type="text"  id="inv" disabled value="No" style="width:40px"/>';
}
$p = array();
$p[0] = $a ; 
$p[1] = $b ; 
$p[2] = $c ;
echo json_encode($p);
exit();
?>

