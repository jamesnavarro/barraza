<!DOCTYPE html>
<?php
include "../modelo/conexion.php";
?>
<html>
       <head>
        <meta charset="UTF-8">
        <title>Carcar Firmas</title>
            <script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
            <script src="../js/jquery.js" type="text/javascript"></script>
            <script>
                $(document).ready(function(){
                    $("#subir").click(function(){
                           $("#imgs").html('<img src="../imagenes/spinner.gif">');
                            oi = $("#oi").val();
                            $.post("../modulos/actualizar_firmas.php", { oi: oi }, function(data){
		            $("#cargar").html(data);

                           });
                     });
                });
                </script>
    </head>
    <body>
           <fieldset>
            <legend>Vericador de Firmas</legend>
             <div id="cargar">
               
            <?php
            $query = mysql_query('select * from actividad where orden_servicio='.$_GET['ord'].' and firms=1 group by orden_servicio ');
            $n = mysql_num_rows($query);
            if($n==0){
            ?>
            
                 <input type="text" id="oi" readonly value="<?php echo $_GET['ord'] ?>"> <button type="button" id="subir">Actualizar Firma en la nube</button>
            <?php }else{
              echo '<b style="color:red;">Para esta orden interna ya se subio la firma.</b>';} ?>
               <br><span id="imgs"></span>
             </div>
        </fieldset>
    </body>
</html>
