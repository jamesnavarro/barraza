<?php
include('../../modelo/conexion.php');
// sw = 
// 0 Insertar
// 1 Actualizar
// 2 Mostrar
// 3 Eliminar
switch ($_GET['sw']) {
        case 0:

                    $cod = $_GET['cod'];
                    $bod = $_GET['bod'];
                    $obs = $_GET['obs'];
                    $est = $_GET['est'];

                    
                    $comprobar = mysql_num_rows(mysql_query("SELECT * FROM bodegas WHERE codigo_bod = '".$cod."'"));
                    if($comprobar == 0){
                    $ok = mysql_query("INSERT INTO bodegas "
                            . "(`codigo_bod`,"
                            . " `bodega`,"

                            . " `estado_bod`,"
                            . " `Observacion`)"
                            . "VALUES('$cod', "
                            . "'$bod','$est','$obs') ") or die(mysql_error());
                    echo $ok;
                    
                    }else{
                            echo 'existe';
                    }
            break;
        case 1:

                    $cod = $_GET['cod'];
                    $bod = $_GET['bod'];
                    $obs = $_GET['obs'];
                    $est = $_GET['est'];

                    $ok = mysql_query("update bodegas set "
                            . "bodega='".$bod."',"
                            . "estado_bod='".$est."',"
                            . "Observacion='".$obs."'  where codigo_bod='".$cod."' ");
                    mysql_error();
                    echo $ok+1;
           break;
        case 2:
                   include 'mostrar_tabla.php';
           break;
        case 3:
                    $cod = $_GET['codigo'];
                    $resultado = mysql_query("DELETE FROM bodegas WHERE codigo_bod ='".$cod."' ");
                    echo $resultado;
        break;
        case 4:
                    $cod = $_GET['id'];
                    $resultado = mysql_query("DELETE FROM grupos_caja WHERE id_gg ='".$cod."' ");
                    echo $resultado;
        break;
        case 5:
                    $cod = $_GET['id'];
                    $resultado = mysql_query("update grupos_caja set est_cu='".$_GET['est']."' WHERE id_gg ='".$cod."' ");
                    echo $resultado;
        break;
}

?>