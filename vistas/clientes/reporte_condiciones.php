<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Reporte condicion de vivienda</title>
                    <link href="../../css/bootstrap.min.css" rel="stylesheet">
<link href="../../css/estilo.css" rel="stylesheet">
<script src="../../js/jquery.js"></script>
<script src="../../js/funcion_global.js"></script>
<script src="funciones.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<style>
    body{
        background-color: white;
    }
</style>
    </head>
    <body>
        <?php
         include('../../modelo/conexion.php');
         $ced = $_GET['ced'];
          $result = mysql_query("select * from pacientes_condiciones where cedula='$ced' ");
    $r = mysql_fetch_row($result);
    $p = array();
    $p[0] = $r[0];
    $p[1] = $r[1];
    $p[2] = $r[2];
    $p[3] = $r[3];
    $p[4] = $r[4];
    $p[5] = $r[5];
    $p[6] = $r[6];
    $p[7] = $r[7];
    $p[8] = $r[8];
    $p[9] = $r[9];
    $p[10] = $r[10];
    $p[11] = $r[11];
    $p[12] = $r[12];
    $p[13] = $r[13];
    $p[14] = $r[14];
    $p[15] = $r[15];
    $p[16] = $r[16];
    $p[17] = $r[17];
    $p[18] = $r[18];
    $p[19] = $r[19];
    $p[20] = $r[20];
    $p[21] = $r[21];
    $p[22] = $r[22];
    $p[23] = $r[23];
    $p[24] = $r[24];
    $p[25] = $r[25];
    $query = mysql_query("SELECT * FROM pacientes a, sis_empresa b WHERE a.id_empresa=b.rips AND numero_doc='$ced'");
    $f = mysql_fetch_array($query);
    
        ?>
       
        <div>
            <table  border="0" style="width: 100%">
                <tbody>
                    <tr>
                  <td colspan="3" >
    
                 <center>REQUISITOS MINIMOS DE LA VIVIENDA </center>
        
          
                  </td>
              </tr>
                          <tr style="width:130%; height:40%;">
                              <td>PACIENTE: </td>
                              <td><?php echo $f['nombres'].' '.$f['nombre2'].' '.$f['apellidos'].' '.$f['apellido2'] ?></td>
                              
                              <td rowspan="6">Autorización No. <?php echo $p[0]; ?><br><img src="../../imagenes/idb.png"></td>
                          </tr>
                          <tr style="width:130%; height:40%;">
                              <td>CEDULA: </td>
                              <td><?php echo $f['numero_doc']; ?></td>
                              
                          </tr>
                          <tr>
                              <td>EDAD: </td>
                              <td><?php echo $f['edad']; ?></td>
                              
                          </tr>
                          <tr>
                              <td>DIRECCION: </td>
                              <td><?php echo $f['direccion1']; ?></td>
                              
                          </tr>
                          <tr>
                              <td>DIAGNOSTICO: </td>
                              <td><?php echo $f['descripcion_enf']; ?></td>
                              
                          </tr>
                          <tr>
                              <td>ASEGURADORA: </td>
                              <td><?php echo $f['nombre_emp']; ?></td>
                              
                          </tr>
                          </tbody>
                      </table>
           <table border="1" style="width: 100%">
          <thead>
              
              <tr>
                  <th>REQUISITOS</th>
                  <th>CUMPLE / NO CUMPLE</th>

                  <th>OBSERVACIONES</th>
              </tr>
          </thead>
          <tbody>
              <tr>
                  <td>CONFORT</td>
                          <td style="text-align:center">
                              <?php echo $p[3] ?>
                          </td>
                          <td><?php echo $p[4] ?></td>

              </tr>
              <tr>
                  <td>ENERGIA ELECTRICA</td>
                  <td style="text-align:center">
                              <?php echo $p[5] ?>
                          </td>
                          <td><?php echo $p[6] ?></td>
              </tr>
              <tr>
                  <td>LINEA TELEFONICA</td>
                  <td style="text-align:center">
                              <?php echo $p[7] ?>
                          </td>
                          <td><?php echo $p[8] ?></td>
              </tr>
              <tr>
                  <td>ACUEDUCTO</td>
                <td style="text-align:center">
                              <?php echo $p[9] ?>
                          </td>
                          <td><?php echo $p[10] ?></td>
              </tr>
              <tr>
                  <td>ALCANTARILLADO</td>
                  <td style="text-align:center">
                              <?php echo $p[11] ?>
                          </td>
                          <td><?php echo $p[12] ?></td>
              </tr>
              <tr>
                  <td>NEVERA</td>
                  <td style="text-align:center">
                              <?php echo $p[13] ?>
                          </td>
                          <td><?php echo $p[14] ?></td>
              </tr>
              <tr>
                  <td>BAÑO</td>
                  <td style="text-align:center">
                              <?php echo $p[15] ?>
                          </td>
                          <td><?php echo $p[16] ?></td>
              </tr>
              <tr>
                  <td>CUIDADOR</td>
                  <td style="text-align:center">
                              <?php echo $p[17] ?>
                          </td>
                          <td><?php echo $p[18] ?></td>
              </tr>
              <tr>
                  <td>ACCESIBILIDAD</td>
                  <td style="text-align:center">
                              <?php echo $p[19] ?>
                          </td>
                          <td><?php echo $p[20] ?></td>
              </tr>
              <tr>
                  <td>ALMACENAMIENTO DE RESIDUOS</td>
                  <td style="text-align:center">
                              <?php echo $p[21] ?>
                          </td>
                          <td><?php echo $p[22] ?></td>
              </tr>
              <tr>
                  <td>SEGURIDAD EN ENTORNO</td>
                  <td style="text-align:center">
                              <?php echo $p[23] ?>
                          </td>
                          <td><?php echo $p[24] ?></td>
              </tr>
              <tr>
                  <td>FUNCIONARIO QUE VERIFICA</td>
                  <td colspan="2">
                                  <?php
                                  $result3 = mysql_query("select concat(nombre,' ',apellido) from usuarios where usuario='".$p[2]."' ");
                                  while($r = mysql_fetch_array($result3)){
                                      echo $r[0];   
                                  }
                                   
                                  ?>
                              </td>
              </tr>
          </tbody>
      </table>
            <?php  echo 'Fecha de Registro:'.$p[25];  ?>
            </div>
    </body>
</html>
