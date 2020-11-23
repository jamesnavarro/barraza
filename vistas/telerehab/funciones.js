//alert("Se cargaran todos los datos");
$('#mostrar_sesion').load(cargando());
function cargando(){
       var token = $("#tok").val();
	$.ajax({
         url: 'http://104.131.66.240/rehapp-api/public/api/v1/sessions',
         dataType: 'json',
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
  var json = data.session;
  var render ="";
  console.log(json.length);
  $.each(json, function (i, dev) {
          //if(dev.treatment_id==1){
          render+= showRow(i,dev);
          //}
          console.log(showRow(i,dev));
  });

  $('#mostrar_sesion').html(render);
  console.log("load successfully");
  $(document).ready(function() {
    $('#tabla_ajax_se').DataTable();
} );
}

function showRow(i, dev){
  var row = '<tr>'+
              '<td>'+dev.id+'</td>'+
              '<td>'+dev.title+'</td>'+
              '<td>'+dev.description+'</td>'+
              '<td>'+dev.created_at+'</td>'+
              '<td>'+dev.treatment_id+'</td>'+
              '<td style="text-align:center"><input type="checkbox" name="item" id="'+dev.id+'" value="'+dev.id+'"></td>'+
              '<td><a data-toggle="tab" href="#menu1" onclick="editar_sesion('+dev.id+');"><img src="../imagenes/modificar.png"> </a>  <a href="javascript:void(0);" onclick="eliminar_ejercicio('+dev.id+');"><img src="../imagenes/eliminar.png"> </a></td>'+
            '</tr>';
  return row;

}
///////////////////// MODULO GUARDAR //////////////////////7
function guardar_eje(ord){
    var ti = $("#titulo").val();
    var des = $("#descripcion").val();
    var ide = $("#ideje").val();
    if(ide==''){
      var datos = '';
      var post = 'POST';
    }else{
          datos = '/'+ide;
          var post = 'PUT';
    }
    if(ti==''){
        alert("Digite el titulo");
        $("#descripcion").focus();
        return false;
    }
    if(des==''){
        alert("Digite la descripcion de la sesion");
        $("#titulo").focus();
        return false;
    }
    var token = $("#tok").val();
    	$.ajax({
         type:post,
         data:'title='+ti+'&description='+des,
         url: 'http://104.131.66.240/rehapp-api/public/api/v1/sessions'+datos,
         dataType: 'json',
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
         type:'PUT',
         url: 'http://104.131.66.240/rehapp-api/public/api/v1/sessions/'+ide,
         dataType: 'json',
         headers: { 'Authorization': token },
         success: function(data){
              console.log(data);
              var json = data.session;
                    $("#ideje").val(json.id);
                    $("#titulo").val(json.title);
                    $("#descripcion").val(json.description);
//              $('#titulo').val(render);
              console.log("load successfully");
             cargando();
              
          },
          failure: function(data){
            console.log(data);
         }
});
}
////////////eliminar ejercicio///////////////////////
function eliminar_ejercicio(id){
    var token = $("#tok").val();
    var con = confirm("Esta seguro de eliminar esta sesion "+id);
    if(con){
         $.ajax({
             type:'DELETE',
             url: 'http://104.131.66.240/rehapp-api/public/api/v1/sessions'+id,
             dataType: 'json',
             headers: { 'Authorization': token },
             success: function(data){
                console.log(data);
                alert("Se elimino con exitosamente ");
                location.reload();
                 $("#titulo").val('');
              },
              failure: function(data){
                console.log(data);
             }
           });
    }
    
}
function add_sesiones(idt,idp,pro){
    var token = $("#tok").val();
      var conf =  confirm("Desea Agregar estas sesiones al tratamiento?");
    if(conf){
			$("input[name=item]:checked").each(function(){
				var id = $(this).attr("id");

                                    	$.ajax({
                                             type:'POST',
                                             data:'sessionId='+id+'&patientId='+idp+'&professionalId='+pro,
                                             url: 'http://104.131.66.240/rehapp-api/public/api/v1/treatments/'+idt+'/assign_session',
                                             dataType: 'json',
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