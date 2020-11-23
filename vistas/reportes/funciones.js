    var  a1 = 0;
    var  a2 = 0;
    var  a3 = 0;
     var a4 = 0;
    var  a5 = 0;
    var  a6 = 0;
    var  a7 = 0;
    var  a8 = 0;
     var a9 = 0;
     var a10 =0;
    var  a11 = 0;
    var  a12 = 0;
    
    var  aa1 = 0;
    var  aa2 = 0;
    var  aa3 = 0;
     var aa4 = 0;
    var  aa5 = 0;
    var  aa6 = 0;
    var  aa7 = 0;
    var  aa8 = 0;
     var aa9 = 0;
     var aa10 =0;
    var  aa11 = 0;
    var  aa12 = 0;

function pacientes_empresas(){
    var emp = $("#empresa").val();
    var ano = $("#ano").val();

    
    $.ajax({
				type: 'GET',
				data: 'emp='+emp+'&ano='+ano+'&sw=0',
				url: 'acciones.php',
				success: function(f){
                                    var p = eval(f);
				    $('#mostrar_reporte1').html(p[0]);
                                    console.log(p);
				    a1 = p[1];
                                    a2 = p[2];
                                    a3 = p[3];
                                    a4 = p[4];
                                    a5 = p[5];
                                    a6 = p[6];
                                    a7 = p[7];
                                    a8 = p[8];
                                    a9 = p[9];
                                    a10 = p[10];
                                    a11 = p[11];
                                    a12 = p[12];
                                    $('#myChart').remove();
                                     $('#dibujo').append('<canvas id="myChart"></canvas>');
                                   barra();
                                    

				}
			});
                        $.ajax({
				type: 'GET',
				data: 'emp='+emp+'&ano='+ano+'&sw=1',
				url: 'acciones.php',
				success: function(g){
                                    var p = eval(g);
                                    console.log(p);
				    $('#mostrar_reporte2').html(p[0]);
                                    aa1 = p[1];
                                    aa2 = p[2];
                                    aa3 = p[3];
                                    aa4 = p[4];
                                    aa5 = p[5];
                                    aa6 = p[6];
                                    aa7 = p[7];
                                    aa8 = p[8];
                                    aa9 = p[9];
                                    aa10 = p[10];
                                    aa11 = p[11];
                                    aa12 = p[12];
                                    $('#myChart2').remove();
                                     $('#dibujo2').append('<canvas id="myChart2"></canvas>');
                                   barra2();
				}
			});
//                        $.ajax({
//				type: 'GET',
//				data: 'emp='+emp+'&ano='+ano+'&sw=2',
//				url: 'acciones.php',
//				success: function(data){
//                                    var p = eval(data);
//                                    console.log(p);
//				    //$('#mostrar_reporte3').html(data);
//                                    $('#myChart3').remove();
//                                     $('#dibujo3').append('<canvas id="myChart3"></canvas>');
//                                    empresas(p[2],p[1],p[0]);
//				}
//			});
    
}

function barra(){
     var ctx = document.getElementById('myChart').getContext('2d');
     var chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['','Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        datasets: [{
            label: 'Ingresos',
            backgroundColor: '#42a5f5',
            borderColor: 'gray',
            data: [0,a1, a2, a3, a4, a5, a6, a7,a8,a9,a10,a11,a12]
        }		
		]},
    options: {responsive: true}
});
}
function barra2(){
    var ctx1 = document.getElementById('myChart2').getContext('2d');
    var chart = new Chart(ctx1, {
    type: 'bar',
    data: {
        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        datasets: [{
            label: 'Atenciones',
            backgroundColor: '#E46292',
            borderColor: 'gray',
            data: [aa1, aa2, aa3, aa4, aa5, aa6, aa7,aa8,aa9,aa10,aa11,aa12]
        }		
		]},
    options: {}
});
}
function BuscarDias(){
    var emp = $("#empresa").val();
    var ano = $("#ano").val();
    var mes = $("#mes").val();
    var usu = $("#usuario").val();
    if(emp===''){ 
        alert("Seleccione la empresa");
        return false;
    }
    //alert(usu);
    
    
            $.ajax({
                type: 'GET',
                data: 'emp='+emp+'&ano='+ano+'&mes='+mes+'&usu='+usu+'&sw=3',
                url: 'acciones.php',
                success: function(data){
                   
                    $('#mostrar_reporte1').html(data);
                   
                }
        });
}

