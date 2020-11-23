<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Formato covid-19 idb</title>
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
    <body onload="window.print()">
        <?php
         include('../../modelo/conexion.php');
         $ced = $_GET['ced'];
          $result = mysql_query("select * from encuestas where id_encuesta='$ced' ");
    $r = mysql_fetch_row($result);

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
    $p[26] = $r[26];

    $query = mysql_query("SELECT * FROM pacientes a, sis_empresa b WHERE a.id_empresa=b.rips AND numero_doc='".$r[1]."'");
    $f = mysql_fetch_array($query);
    
        ?>
       
        <div>
            <table  border="0" style="width: 100%">
                <tbody>
                    <tr>
                  <td colspan="3" >
    
                 <center>ENCUESTA COVID 19</center>
        
          
                  </td>
              </tr>
                          <tr style="width:130%; height:40%;">
                              <td>PACIENTE: </td>
                              <td><?php echo $f['nombres'].' '.$f['nombre2'].' '.$f['apellidos'].' '.$f['apellido2'] ?></td>
                              
                              <td rowspan="6"><br><img src="../../imagenes/idb.png" width="190px"></td>
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
                  <th colspan="2">¿Ha estado en alguno de estos países en los últimos 14 días? </th>

              </tr>
          </thead>
          <tbody>

              <tr>
                  <td>CHINA</td>
                          <td>
                              <?php echo $p[2] ?>
                          </td>
              </tr>
              <tr>
                  <td>ITALIA</td>
                          <td>
                              <?php echo $p[3] ?>
                          </td>
              </tr>
              <tr>
                  <td>JAPON</td>
                          <td>
                              <?php echo $p[4] ?>
                          </td>
              </tr>
              <tr>
                  <td>IRAN </td>
                          <td>
                              <?php echo $p[5] ?>
                          </td>
              </tr>
              <tr>
                  <td>VENEZUELA</td>
                          <td>
                              <?php echo $p[6] ?>
                          </td>
              </tr>
              <tr>
                  <td>PERU</td>
                          <td>
                              <?php echo $p[7] ?>
                          </td>
              </tr>
              <tr>
                  <td>COREA DEL SUR</td>
                          <td>
                             <?php echo $p[8] ?>
                          </td>
              </tr>
              <tr>
                  <td>ALEMANIA</td>
                          <td>
                              <?php echo $p[9] ?>
                          </td>
              </tr>
              <tr>
                  <td>ESTADOS UNIDOS</td>
                          <td>
                              <?php echo $p[10] ?>
                          </td>
              </tr>
              <tr>
                  <td>ESPAÑA</td>
                          <td>
                              <?php echo $p[11] ?>
                          </td>
              </tr>
              <tr>
                  <td>ECUADOR</td>
                          <td>
                              <?php echo $p[12] ?>
                          </td>
              </tr>
              <tr>
                  <td>PANAMA</td>
                          <td>
                              <?php echo $p[13] ?>
                          </td>
              </tr>
              <tr>
                  <th colspan="2"> ¿Ha tenido usted alguno de estos síntomas en los últimos 14 días?</th>

              </tr>
              <tr>
                  <td>MALESTAR GENERAL</td>
                          <td>
                              <?php echo $p[14] ?>
                          </td>
              </tr>
              <tr>
                  <td>DOLOR DE GARGANTA</td>
                          <td>
                              <?php echo $p[15] ?>
                          </td>
              </tr>
              <tr>
                  <td>DIFICULTAD PARA RESPIRAR</td>
                          <td>
                              <?php echo $p[16] ?>
                          </td>
              </tr>
              <tr>
                  <td>FIEBRE</td>
                          <td>
                              <?php echo $p[17] ?>
                          </td>
              </tr>
              <tr>
                  <td>TOS</td><td>
                          <?php echo $p[18] ?>
                          </td>
              </tr>
              <tr>
                  <td>MALESTAR ESTOMACAL</td>
                          <td>
                              <?php echo $p[22] ?>
                          </td>
              </tr>
              <tr>
                  <td>DIARREA</td>
                          <td>
                             <?php echo $p[23] ?>
                          </td>
              </tr>
              <tr>
                  <td>FATIGA</td>
                          <td>
                              <?php echo $p[24] ?>
                          </td>
              </tr>
              <tr>
                  <td>PERDIDA DEL OLFATO</td>
                          <td>
                              <?php echo $p[25] ?>
                          </td>
              </tr>
              <tr>
                  <td>PERDIDA DEL GUSTO</td>
                          <td>
                              <?php echo $p[26] ?>
                          </td>
              </tr>
              <tr>
                  <th colspan="2"> ¿En los últimos 14 días ha estado en contacto con personas que tuvieran alguno de los anteriores síntomas? </th>

              </tr>
              <tr>
                  <td></td>
                          <td>
                              <?php echo $p[19] ?>
                          </td>
              </tr>
          </tbody>
      </table>
            <?php  echo 'Fecha de Registro:'.$p[21];  ?>
            </div>
    </body>
</html>
