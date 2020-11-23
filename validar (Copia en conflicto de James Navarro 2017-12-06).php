<?php
session_start();
include "modelo/conexion.php";
date_default_timezone_set("America/Bogota" ) ; 
        $hora = date('h:i a',time() - 3600*date('I'));
function quitar($mensaje)
{
	$nopermitidos = array("'",'\\','<','>',"\"");
	$mensaje = str_replace($nopermitidos, "", $mensaje);
	return $mensaje;
}
if(trim($_POST["username"]) != "" && trim($_POST["password"]) != "")
{
	
	$usuario = strtolower(htmlentities($_POST["username"], ENT_QUOTES));
	$password = md5($_POST["password"]);
	$result = mysql_query('SELECT * FROM usuarios WHERE usuario=\''.$usuario.'\' and estado_empleado="Activo"');
	if($row = mysql_fetch_array($result)){
		if($row["password"] == $password){
			$_SESSION["k_username"] = $row['usuario'];
                        $_SESSION["id_user"] = $row['id'];
                        $_SESSION["foto"] = $row['foto'];
                        $_SESSION["area"] = $row['area'];
                        $_SESSION["cargo"] = $row['cargo'];
                        $_SESSION["admin"] = $row['administrador'];
                        //$_SESSION['token']='Bearer '.$_POST["tok"].'';
                        $_SESSION['token']='Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJleHAiOjE0OTM2NTI2NTksInN1YiI6NSwiaXNzIjoiaHR0cDpcL1wvMTA0LjEzMS42Ni4yNDBcL3JlaGFwcC1hcGlcL3B1YmxpY1wvbG9naW4iLCJpYXQiOjE0OTEwNjA2NTksIm5iZiI6MTQ5MTA2MDY1OSwianRpIjoiYWYwYzQ4Mjg4MzJiNTY3YmZiZjcxNjQwNDgzMjQ3OGIifQ.A8GlaFbhXoJwkq8aZjxmagXxh720aZOHYrEvZlvppYE';
			 $_SESSION["nombre"] = $row['nombre'].' '.$row['apellido'];
                          $sql = "UPDATE `usuarios` SET `online` = '1', ingreso='".date("Y-m-d").' '.$hora."'  WHERE `id` = ".$row['id'].";";
                             mysql_query($sql, $conexion);
                             $requests=mysql_query("SELECT count(*) FROM correos a, correos_para b, usuarios c where b.visto=0 and c.id=a.id_de and a.id_correo=b.id_correo and b.id_user=".$_SESSION['id_user']." and b.visto!=2 order by a.id_correo desc ");
                             $re = mysql_fetch_array($requests);
                             
                             $requestsu=mysql_query("SELECT count(*), orden_servicio  FROM actividad  WHERE urgente='Si' AND user='".$_SESSION['k_username']."' GROUP BY orden_servicio ");
                             $ur = mysql_fetch_array($requestsu);
                             $requestsu1=mysql_query("SELECT count(*), orden_servicio  FROM actividad  WHERE id_contacto='' AND user='".$_SESSION['k_username']."' GROUP BY orden_servicio ");
                             $ate = mysql_fetch_array($requestsu1);
                             
                         if(isset($_SESSION['k_username'])){
                            
			             if($_SESSION["area"]=='OFICINA'){
                               if($re['count(*)']==0){
                                    header("location:vistas/?id=inicio");
                               }else{
                                 echo '<script lanquage="javascript">alert("Usted Tiene '.$re['count(*)'].' Mensajes Nuevos");location.href="vistas/?id=inicio"</script>';
                               }
                           }ELSE{
                               
                            if(date("Y-m-d") > $row['acceso']){
                                if($ate['count(*)']>0){
                                     echo '<script lanquage="javascript">alert("Usted tiene Atenciones nuevas sin llenar , orden: '.$ate['orden_servicio'].' ");location.href="vistas/?id=ordenes&no-iniciada"</script>';
                                }
                                if($ur['count(*)']>0){
                                     echo '<script lanquage="javascript">alert("Usted tiene Atenciones que son urgente , orden: '.$ur['orden_servicio'].' ");location.href="vistas/?id=ordenes&no-iniciada"</script>';
                                }else{
                                if($re['count(*)']==0){
                                    header("location:vistas/?id=ordenes&no-iniciada");
                                }else{
                                    echo '<script lanquage="javascript">alert("Usted Tiene '.$re['count(*)'].' Mensajes Nuevos");location.href="vistas/?id=ordenes&no-iniciada"</script>';
                                }}
                            }else{
                                     echo '<script lanquage="javascript">alert("Se ha denegado el acceso, usted no ha entrado al sistema en mas de 3 dias, comuniquese con la oficina principal.");location.href="index.php"</script>';
                            }
                                
                           }
                            
                       
                        }else {
                            echo 'usted no se ha logueado';
//                        header("location:index.php");
                            echo '<a href="index.php">Iniciar sesion</a></p>';
                        }
		}else{
			echo '<script lanquage="javascript">alert("El usuario o la contrase\u00f1as son incorrectos");location.href="index.php"</script>';
		}
	}else{
		header("location:index.php");
	}
	mysql_free_result($result);
}else{
	echo '<script lanquage="javascript">alert("Por favor digite el usuario y la contrase\u00f1a");location.href="index.php"</script>';
}
mysql_close();
?>