<?php
include('../../modelo/conexion.php');
// sw = 
// 0 Insertar
// 1 Actualizar
// 2 Mostrar
// 3 Eliminar
switch ($_GET['sw']) {
        case 0:
                    $nit = $_GET['nit'];
                    $nom = $_GET['nom'];
                    $dir = $_GET['dir'];
                    $dep = $_GET['dep'];
                    $mun = $_GET['mun'];
                    $tel = $_GET['tel'];
                    $con = $_GET['con'];
                    $tco = $_GET['tco'];
                    $em1 = $_GET['em1'];
                    $em2 = $_GET['em2'];
                    $obs = $_GET['obs'];
                    $ban = $_GET['ban'];
                    $num = $_GET['num'];

                    $comprobar = mysql_num_rows(mysql_query("SELECT * FROM proveedors WHERE nitcc = '".$nit."'"));
                    if($comprobar == 0){
                    $ok = mysql_query("INSERT INTO proveedors "
                            . "(`tipo`, `nitcc`,`nombre`,"
                            . " `direccion`,"
                            . " `telefono`,"
                            . " `contacto`,"
                            . " `tel_contacto`,"
                            . " `email1`,"
                            . " `email2`,"
                            . " `observaciones`,"
                            . " `depa`,`muni`,`banco`,`numero_cuenta`)"
                            . "VALUES('Proveedor','$nit','$nom','$dir','$tel','$con','$tco','$em1','$em2','$obs','$dep','$mun','$ban','$num') ") or die(mysql_error());
                    echo $ok;
                    
                    }else{
                        echo 'existe';
                    }
            break;
        case 1:
                    $nit = $_GET['nit'];
                    $nom = $_GET['nom'];
                    $dir = $_GET['dir'];
                    $dep = $_GET['dep'];
                    $mun = $_GET['mun'];
                    $tel = $_GET['tel'];
                    $con = $_GET['con'];
                    $tco = $_GET['tco'];
                    $em1 = $_GET['em1'];
                    $em2 = $_GET['em2'];
                    $obs = $_GET['obs'];
                    $ban = $_GET['ban'];
                    $num = $_GET['num'];
                    $ok = mysql_query("update proveedors set nombre='".$nom."' ,"
                            . "direccion='".$dir."',"
                            . "depa='".$dep."',"
                            . "muni='".$mun."',"
                            . "telefono='".$tel."',"
                            . "contacto='".$con."',"
                            . "tel_contacto='".$tco."',"
                            . "banco='".$ban."',"
                            . "numero_cuenta='".$num."',"
                            . "email1='".$em1."',"
                            . "email2='".$em2."',observaciones='".$obs."' where nitcc='".$nit."' ");
                    mysql_error();
                    echo $ok+1;
           break;
        case 2:
                   include 'mostrar_tabla.php';
           break;
        case 3:
                    $cod = $_GET['codigo'];
                    $resultado = mysql_query("DELETE FROM proveedors WHERE nitcc ='".$cod."' ");
                    echo $resultado;
        break;
       case 4:
                    $mov = $_GET['mov'];
                    $resultado = mysql_query("insert into operaciones (descripcion) values ('".$mov."')") or die(mysql_error());
                    echo $resultado;
        break;
       case 5:
                    $mov = $_GET['mov'];$id = $_GET['idm'];
                    $resultado = mysql_query("update operaciones set descripcion='".$mov."' where id_operaciones=".$id." ") or die(mysql_error());
                    echo $resultado+1;
        break;
}

?>