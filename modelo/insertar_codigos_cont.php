<?php
session_start();
require("conexion.php");
            $codigo= $_POST["codigo"];
            $nombre= strtoupper($_POST["nombre"]);
            $fiscal= strtoupper($_POST["fiscal"]);
            $niif= strtoupper($_POST["niif"]);
            $naturaleza= $_POST["naturaleza"];
            $tipotrm= strtoupper($_POST["tipotrm"]);
            if(isset($_POST['aneter'])){$aneter= $_POST["aneter"];}else{$aneter = 0;} 
            if(isset($_POST['anecos'])){$anecos= $_POST["anecos"];}else{$anecos = 0;}
            if(isset($_POST['aneret'])){$aneret= $_POST["aneret"]; }else{ $aneret = 0;}
             if(isset($_POST['estado'])){$estado = $_POST['estado'];}else{$estado = 0;}
            $cod_tributario= $_POST["cod_tributario"];
            $cod_presupuesto= $_POST["cod_presupuesto"];
       

        if(isset($_POST['Editar'])){

                $sql = "UPDATE `cont_codigos_contables` SET "
                        . "`nom_cod_cont`='".$nombre."',"
                        . "`cod_tri_cod_cont`='".$cod_tributario."',"
                        . "`desc_fiscal`='".$fiscal."',"
                        . "`desc_niif`='".$niif."',"
                        . "`naturaleza`='".$naturaleza."',"
                        . "`tipo_trm`='".$tipotrm."',"
                        . "`ane_tercero`='".$aneter."',"
                        . "`ane_costo`='".$anecos."',"
                        . "`ane_retencion`='".$aneret."',"
                        . "`codigo_presupesto`='".$cod_presupuesto."',"
                        . "`estado_cod_cont`='".$estado."' "
                        . "WHERE `cod_cod_cont` = ".$codigo.";";
                 mysql_query($sql, $conexion) or die (mysql_error());

             echo '<script lanquage="javascript">alert("Se ha Editado Satisfactoriamente la informacion");location.href="../vistas/?id=codigos"</script>'; 

        }else{
            
            $query = "select cod_cod_cont from cont_codigos_contables where cod_cod_cont = '$codigo'";
            $res = mysql_query($query);
            
            $datos = mysql_fetch_array($res);
            $codigo_cont = $datos['cod_cod_cont'];
            
            if ($codigo_cont == $codigo){
                echo '<script lanquage="javascript">alert("No Puede Duplicar El Codigo");location.href="../vistas/?id=codigos"</script>'; 
            }else{
                $sql = "INSERT INTO cont_codigos_contables (cod_cod_cont,nom_cod_cont,cod_tri_cod_cont,desc_fiscal,desc_niif,naturaleza,tipo_trm,ane_tercero,ane_costo,ane_retencion,codigo_presupesto)";
            $sql.= "VALUES ('".$codigo."','".$nombre."','".$cod_tributario."','".$fiscal."','".$niif."','".$naturaleza."','".$tipotrm."','".$aneter."','".$anecos."','".$aneret."','".$cod_presupuesto."') ";
            mysql_query($sql) or die (mysql_error());

            echo '<script lanquage="javascript">alert("Se ha Guardado Satisfactoriamente");location.href="../vistas/?id=codigos"</script>'; 

            }

            
            }






