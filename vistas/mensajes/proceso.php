<?php
session_start();
$con=mysqli_connect("localhost","root","","medinter_crm_medico");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$sql="INSERT INTO mensajes (id_emisor, id_receptor, contenido) VALUES ('".$_SESSION['id_user']."', '".$_POST['usuario']."','".$_POST['cont']."')";

if (!mysqli_query($con,$sql)){
  die('Error: ' . mysqli_error($con));
 }

//respuesta 
$result = mysqli_query($con,"SELECT * FROM mensajes a, usuarios b where a.id_emisor=b.id order by a.id desc");
while($row = mysqli_fetch_array($result))
  {if($row['id_emisor']==$_SESSION['rem'] && $row['id_receptor']==$_SESSION['id_user']){
   echo '<li class="left">
                                                <figure>
                                                    <img src="../img/avatar/avatar.png">
                                                    <figcaption>
                                                        <div class="meta">
                                                            <a href="#">'.$row['nombre'].'</a>
                                                            <small>'.$row['reg'].'</small>
                                                        </div>
                                                        '.$row['contenido'].'
                                                    </figcaption>
                                                    <div class="action">
                                                        <a href="#" class="close">&times;</a>
                                                    </div>
                                                </figure>
                                            </li>';
    }else if($row['id_receptor']==$_SESSION['rem'] &&  $row['id_emisor']==$_SESSION['id_user']){
          echo '<li class="right">
                                                <figure>
                                                    <img src="../img/avatar/avatar.png">
                                                    <figcaption>
                                                        <div class="meta">
                                                            <a href="#">'.$row['nombre'].'</a>
                                                            <small>'.$row['reg'].'</small>
                                                        </div>
                                                        '.$row['contenido'].'
                                                    </figcaption>
                                                    <div class="action">
                                                        <a href="#" class="close">&times;</a>
                                                    </div>
                                                </figure>
                                            </li>';
    }
  }
 
mysqli_close($con);
?> 