//alert("Se cargaran todos los datos");
$('#mostrar_preguntas').load(cargando());
function cargando(){
       var token = $("#tok").val();
	$.ajax({
         url: 'http://104.131.66.240/rehapp-api/public/api/v1/questions',
         crossDomain: true,         dataType: 'jsonp',
         headers: { 'Authorization': token },
          //beforeSend: function(xhr){xhr.setRequestHeader(header);},
         
         success: function(data){
            console.log(data);
            //var texto = json_decode(data);
            // foreach(texto as textos){
            //     alert(textos);
            // }
            show(data);
          },
          failure: function(data){
            console.log(data);
            
      }
}); 
}
function show(data) {
  //alert('Entra');
  console.log(data.session);
  var json = data.questions;
  var render ="";
  console.log(json.length);
  $.each(json, function (i, dev) {
          //if(dev.treatment_id==1){
          render+= showRow(i,dev);
          //}
          console.log(showRow(i,dev));
  });

  $('#mostrar_preguntas').html(render);
  console.log("load successfully");
  $(document).ready(function() {
    $('#tabla_ajax_pr').DataTable();
} );
}

function showRow(i, dev){
  var row = '<tr>'+
              '<td>'+dev.id+'</td>'+
              '<td>'+dev.question+'</td>'+
              '<td>'+dev.created_at+'</td>'+
              '<td style="text-align:center"><input type="checkbox" name="item" id="'+dev.id+'" value="'+dev.id+'"></td>'+
              '<td><a data-toggle="tab" href="#menu1" onclick="editar_sesion('+dev.id+');"><img src="../imagenes/modificar.png"> </a>  <a href="javascript:void(0);" onclick="eliminar_pregunta('+dev.id+');"><img src="../imagenes/eliminar.png"> </a></td>'+
            '</tr>';
  return row;

}
///////////////////// MODULO GUARDAR //////////////////////7
function guardar_pre(){

    var des = $("#descripcion").val();
    var ide = $("#ideje").val();
    if(ide==''){
      var datos = '';
      var input = 'POST';
    }else{
          datos = '/'+ide;
          var input = 'PUT';
    }
    if(des==''){
        alert("Digite la descripcion de la pregunta");
        $("#descripcion").focus();
        return false;
    }
    var token = $("#tok").val();
    	$.ajax({
         type:input,
         data:'question='+des,
         url: 'http://104.131.66.240/rehapp-api/public/api/v1/questions'+datos,
         crossDomain: true,         dataType: 'jsonp',
         headers: { 'Authorization': token },
         success: function(data){
            console.log(data);
            alert("Se guardo exitosamente ");
            cargando();
          },
          failure: function(data){
            console.log(data);
         }
});
}
/////////// CONSULTAR EJERCICIO /////////////////////
function editar_sesion(ide){
     //alert(id);
     var token = $("#tok").val();
    	$.ajax({
         type:'GET',
         url: 'http://104.131.66.240/rehapp-api/public/api/v1/questions/'+ide,
         crossDomain: true,         dataType: 'jsonp',
         headers: { 'Authorization': token },
         success: function(data){
              console.log(data);
              var json = data.question;
                    $("#ideje").val(json.id);
                    $("#descripcion").val(json.question);
//              $('#titulo').val(render);
              console.log("load successfully");
             
              
          },
          failure: function(data){
            console.log(data);
         }
});
}
////////////eliminar ejercicio///////////////////////
function eliminar_pregunta(id){
    var token = $("#tok").val();
    var con = confirm("Esta seguro de eliminar esta pregunta "+id);
    if(con){
         $.ajax({
             type:'DELETE',
             url: 'http://104.131.66.240/rehapp-api/public/api/v1/questions/'+id,
             crossDomain: true,         dataType: 'jsonp',
             headers: { 'Authorization': token },
             success: function(data){
                console.log(data);
                alert("Se elimino con exitosamente ");
                cargando();
              },
              failure: function(data){
                console.log(data);
             }
           });
    }
    
}
function add_sesiones_preguntas(ids,idp){
    var token = $("#tok").val();
      var conf =  confirm("Desea Agregar estas preguntas a la sesion?");
    if(conf){
			$("input[name=item]:checked").each(function(){
				var id = $(this).attr("id");

                                    	$.ajax({
                                             type:'POST',
                                             data:'question_id='+id+'&patient_id='+idp,
                                             url: 'http://104.131.66.240/rehapp-api/public/api/v1/sessions/'+ids+'/assign-question',
                                             crossDomain: true,         dataType: 'jsonp',
                                             headers: { 'Authorization': token },
                                             success: function(data){
                                                console.log(data);
                                                alert("Se guardo exitosamente ");
                                                 //location.reload();
                                              },
                                              failure: function(data){
                                                console.log(data);
                                             }
                                    });      
			});
                    }
                
		return false;
}
function add_ejercicios_preguntas(ids,idp){
    var token = $("#tok").val();
      var conf =  confirm("Desea Agregar estas preguntas a los ejercicios?");
    if(conf){
			$("input[name=item]:checked").each(function(){
				var id = $(this).attr("id");

                                    	$.ajax({
                                             type:'POST',
                                             data:'question_id='+id+'&patient_id='+idp,
                                             url: 'http://104.131.66.240/rehapp-api/public/api/v1/exercises/'+ids+'/assign-question',
                                             crossDomain: true,         dataType: 'jsonp',
                                             headers: { 'Authorization': token },
                                             success: function(data){
                                                console.log(data);
                                                alert("Se guardo exitosamente ");
                                                 //location.reload();
                                              },
                                              failure: function(data){
                                                console.log(data);
                                             }
                                    });      
			});
                    }
                
		return false;
}