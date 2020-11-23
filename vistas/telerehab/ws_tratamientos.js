//alert("Se cargaran todos los datos");
$('#mostrar_tratamiento').load(cargando());
function cargando(){
    var token = $("#tok").val();
	$.ajax({
         url: 'http://104.131.66.240/rehapp-api/public/api/v1/treatments',
         dataType: 'jsonp',
         cache : true,
         crossDomain : true,
         headers: { 'Authorization': token },
          //beforeSend: function(xhr){xhr.setRequestHeader(header);},
         
         success: function(data){
            console.log(data);
            show(data);
          },
          failure: function(data){
            console.log(data);
            
      },
}); 
}
function show(data) {
  //alert('Entra');
  console.log(data.treatments);
  var json = data.treatments;
  var render ="";
  console.log(json.length);
  $.each(json, function (i, dev) {
          render+= showRow(i,dev);
          //console.log(showRow(i,dev));
  });

  $('#mostrar_tratamiento').html(render);
  console.log("load successfully");
  $(document).ready(function() {
    $('#tabla_ajax_trat').DataTable();
} );
}

function showRow(i, dev){
  var row = '<tr>'+
              '<td>'+dev.id+'</td>'+
              '<td>'+dev.title+'</td>'+
              '<td>'+dev.description+'</td>'+
              '<td>'+dev.duration+'</td>'+
              '<td>'+dev.created_at+'</td>'+
              '<td>'+dev.updated_at+'</td>'+
              '<td><a data-toggle="tab" href="#menu1" onclick="editar_tratamiento('+dev.id+');"><img src="../imagenes/modificar.png"> </a>  <a href="javascript:void(0);" onclick="eliminar_ejercicio('+dev.id+');"><img src="../imagenes/eliminar.png"> </a></td>'+
            '</tr>';
  return row;

}
///////////////////// MODULO GUARDAR //////////////////////7
function guardar_eje(){
    var ti = $("#titulo").val();
    var des = $("#descripcion").val();
    var dur = $("#duracion").val();
    var ide = $("#ideje").val();
    if(ide==''){
      var datos = '';
    }else{
          datos = '/'+ide;
    }
    if(ti==''){
        alert("Digite el titulo");
        $("#titulo").focus();
        return false;
    }
    if(des==''){
        alert("Digite la descripcion del tratamiento");
        $("#descripcion").focus();
        return false;
    }
     if(dur==''){
        alert("¡Digite la duracion del tratamiento!");
        $("#duracion").focus();
        return false;
    }
    var token = $("#tok").val();
    	$.ajax({
         type:'POST',
         data:'title='+ti+'&description='+des+'&duration='+dur,
         url: 'http://104.131.66.240/rehapp-api/public/api/v1/treatments'+datos,
         dataType: 'json',
         headers: { 'Authorization': token },
         success: function(data){
            console.log(data);
            alert("Se guardo exitosamente ");
             location.reload();
          },
          failure: function(data){
            console.log(data);
         }
});
}
/////////// CONSULTAR EJERCICIO /////////////////////
function editar_tratamiento(ide){
     //alert(id);
     var token = $("#tok").val();
    	$.ajax({
         type:'POST',
         url: 'http://104.131.66.240/rehapp-api/public/api/v1/treatments/'+ide,
         dataType: 'json',
         headers: { 'Authorization': token },
         success: function(data){
              console.log(data);
              var json = data.treatment;
                    $("#ideje").val(json.id);
                    $("#titulo").val(json.title);
                    $("#descripcion").val(json.description);
                    $("#duracion").val(json.duration);
//              $('#titulo').val(render);
              console.log("load successfully");
             
              
          },
          failure: function(data){
            console.log(data);
         }
});
}
////////////eliminar ejercicio///////////////////////
function eliminar_ejercicio(id){
    var con = confirm("Esta seguro de eliminar este tratamiento "+id);
    if(con){
        var token = $("#tok").val();
         $.ajax({
             type:'DELETE',
             url: 'http://104.131.66.240/rehapp-api/public/api/v1/treatments/'+id,
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
