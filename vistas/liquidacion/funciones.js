//----------------------------------- Modulo de Clientes---------------------------
$(function() {

        $("#cant").change(function(){
            calcular();
           
        });
        $("#und").change(function(){
            var can = $("#cant").val();
            var can2 = $("#cant_ori").val();
            var und = $("#und").val();
            tot = can * und;
            $("#total").val(tot);
        });
          $("#pagar").click(function(){
            calcular();
            save();
            $("#pagar").attr("disabled", true);
           
        });
              $("#dep").change(function () {
   		$("#dep option:selected").each(function () {
			//alert($(this).val());
				elegidoc=$(this).val();
				$.post("../../combos/ciudades_2.php", { elegidoc: elegidoc }, function(data){
				$("#mun").html(data);
				
			});			
        });
   });
});
function pasar(){
    window.opener.MostrarLiq(1);
}

//mostrar tablas
function atenciones(ord, pend,liq)
{
    var fi = $("#fi").val();
    var ff = $("#ff").val();

      window.open('../vistas/liquidacion/atenciones.php?ord='+ord+'&fi='+fi+'&ff='+ff+'&pen='+pend+'&liq='+liq, 'contacto', 'width=1100,height=600');
}
function exportar()
{
        var ano = $('#ano').val();
    var mes = $('#mes').val();

    var fi = ano+'-'+mes+'-01';
    var ff = ano+'-'+mes+'-31';
    if(fi==='' || ff===''){
        alert("debe seleccionar el rango de fecha, para exportarlo a excel");
        $("#fi").focus();
        return false;
    }
      window.open('../vistas/liquidacion/exportar.php?fi='+fi+'&ff='+ff, 'contacto', 'width=500,height=100');
}
function evolucion(ord)
{
catPaises = window.open('../resumen/evolucion.php?cod='+ord, 'contacto', 'width=800,height=600');
}
function MostrarLiq(page){
    var fi = $('#fi').val();
    var ff = $('#ff').val();
    var user = $('#user').val();
    var ord = $('#orden').val();
		$.ajax({
				type: 'GET',
				data: 'page='+page+'&fi='+fi+'&ff='+ff+'&ord='+ord+'&user='+user,
				url: '../vistas/liquidacion/mostrar_tabla.php',
                                beforeSend : function(){
                                    $('#load').html('<img src="../images/guardando.gif"> Procesando...');
                                },
				success: function(data){
                   
						$('#liq').html(data);
                                                $('#load').html('');
						
				}
			});
		return false;
} 
function MostrarLista(page){
    var ano = $('#ano').val();
    var mes = $('#mes').val();
    var pro = $('#pro').val();
    var ord = $('#ord').val();
    var fi = ano+'-'+mes+'-01';
    var ff = ano+'-'+mes+'-31';
		$.ajax({
				type: 'GET',
				data: 'page='+page+'&fi='+fi+'&pro='+pro+'&ord='+ord+'&mes='+mes+'&ff='+ff,
				url: '../vistas/liquidacion/lista_liquidaciones.php',
                                beforeSend : function(){
                                    $('#load').html('<img src="../images/guardando.gif"> Procesando...');
                                },
				success: function(data){
                   
						$('#lista').html(data);
                                                $('#load').html('<button type="button" onclick="exportar();"> Exportar a Excel</button>');
						
				}
			});
		return false;
}
function calcular(){
                var can = $("#cant").val();
                var can2 = $("#cant_ori").val();
                var und = $("#und").val();
                var total = $("#total").val();
                var liq = $("#liq").val();
            if(parseInt(can)>parseInt(can2)){
                alert('La cantidad digitada supera las cantidades totales');
                $(this).focus();
                return false;
            }
            if(can===can2){
                $("#obs").val('Se liquido todo');
                $("#liq").val('Total').attr("disabled",true);
                ct = can2 - can;
                $("#pend").val(ct);
            }else{
                $("#liq").val('Parcial').attr("disabled",true);
                tot = can * und;
                $("#total").val(tot);
                ct = can2 - can;
                $("#obs").val('Quedan pendiente '+ct);
                 $("#pend").val(ct);
                 
            }
}
function save(){
       
       conf = confirm("Desea liquidar esta atencion?");
       if(conf){
        var ord = $("#orden").val();
        var pro = $("#pro").val();
        var ate = $("#atencion").val();
        var can = $("#cant").val();
        var pen = $("#pend").val();
        var und = $("#und").val();
        var liq = $("#liq").val();
        var obs = $("#obs").val();
        var fi = $("#fi").val();
        var ff = $("#ff").val();
        $.ajax({
                type: 'GET',
                data: 'ord='+ord+'&pro='+pro+'&ate='+ate+'&can='+can+'&pen='+pen+'&und='+und+'&liq='+liq+'&obs='+obs+'&und='+und+'&fi='+fi+'&ff='+ff+'&sw=0',
                url: 'acciones.php',
                beforeSend : function(){
                    $('#load').html('<img src="../../images/guardando.gif"> Procesando...');
                },
                success: function(data){

                                alert("Se ha liquidado esta atencion "+data);
                                $('#load').html('');
                                pasar();

                }
        });
    }else{
        return false;
    }
        
}