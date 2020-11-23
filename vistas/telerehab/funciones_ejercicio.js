//alert("Se cargaran todos los datos");
$(function() {
    $("#tipo").change(function(){
        var med=$("#tipo").val();
        if(med==='video'){
            $("#tipox").html("<input type='text' id='video' class='span12' placeholder='Pegar url youtube'> ");
        }else{
            $("#tipox").html("<input type='file' id='video'  class='span12'> ");
        }
    });
});
$('#mostrar').load(cargando());
function cargando(){
       var token = $("#tok").val();
	$.ajax({
         url: 'http://104.131.66.240/rehapp-api/public/api/v1/exercises',
         crossDomain: true,         dataType: 'jsonp',
         headers: { 'Authorization': token },
          //beforeSend: function(xhr){xhr.setRequestHeader(header);},
         
         success: function(data){
            console.log(data);
            show(data);
          },
          failure: function(data){
            console.log(data);
            
      }
}); 
}
function show(data) {
  //alert('Entra');
  console.log(data.exercises);
  var json = data.exercises;
  var render ="";
  console.log(json.length);
  $.each(json, function (i, dev) {
          render+= showRow(i,dev);
          console.log(showRow(i,dev));
  });

  $('#mostrar').html(render);
  console.log("load successfully");
  $(document).ready(function() {
    $('#tabla_ajax_ex').DataTable();
} );
}

function showRow(i, dev){
  var row = '<tr>'+
              '<td>'+dev.id+'</td>'+
              '<td>'+dev.title+'</td>'+
              '<td>'+dev.description+'</td>'+
              '<td>'+dev.created_at+'</td>'+
//              '<td style="text-align:center"><button onclick="preguntas('+dev.id+')"> <img src="../imagenes/nota.png"></button></td>'+
              '<td style="text-align:center"><button onclick="videos('+dev.id+')"> <img src="../images/video.png"></button></td>'+
              '<td style="text-align:center"><input type="checkbox" name="item" id="'+dev.id+'" value="'+dev.id+'"></td>'+
              '<td><a data-toggle="tab" href="#menu1" onclick="editar_ejercicio('+dev.id+');"><button><img src="../imagenes/modificar.png"></button> </a> <td> <a href="javascript:void(0);" onclick="eliminar_ejercicio('+dev.id+');"><button><img src="../imagenes/eliminar.png"></button> </a></td>'+
            '</tr>';
  return row;

}
///////////////////// MODULO GUARDAR //////////////////////7
function guardar_eje(){
    var ti = $("#titulo").val();
    var des = $("#descripcion").val();
    var ide = $("#ideje").val();
    var ids = $("#idses").val();
    var video = $("#video").val();
    var file = $("#file").val();
    if(ide==''){
      var datos = '';
    }else{
          datos = '/'+ide;
    }
    if(ti==''){
        alert("Digite el titulo");
        $("#descripcion").focus();
        return false;
    }
    var token = $("#tok").val();
    if(des==''){
        alert("Digite la descripcion del ejercicio");
        $("#titulo").focus();
        return false;
    }
    	$.ajax({
         type:'POST',
         data:'title='+ti+'&description='+des+'&video[]='+video+'&file[]='+file,
         url: 'http://104.131.66.240/rehapp-api/public/api/v1/exercises'+datos,
         crossDomain: true,         dataType: 'jsonp',
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
function mas_video(){
    var ti = $("#tit").val();
    var des = $("#des").val();
    var ide = $("#id_eje").val();
    var video = $("#videox").val();
    var tipo = $("#tipo").val();
    if(tipo=='video'){
        var ruta = 'video[]';
    }else{
        var ruta = 'file[]';
    }
    if(ti==''){
        alert("Digite el titulo");
        $("#descripcion").focus();
        return false;
    }
    var token = $("#tok").val();
    if(des==''){
        alert("Digite la descripcion del ejercicio");
        $("#titulo").focus();
        return false;
    }
    	$.ajax({
         type:'POST',
         data:'title='+ti+'&description='+des+'&'+ruta+video,
         url: 'http://104.131.66.240/rehapp-api/public/api/v1/exercises/'+ide,
         crossDomain: true,         dataType: 'jsonp',
         headers: { 'Authorization': token },
         success: function(data){
            console.log(data);
            alert("Se guardo exitosamente ");
              mostrar_videos(ide);
          },
          failure: function(data){
            console.log(data);
         }
});
}

function editar_ejercicio(ide){
     //alert(id);
     var token = $("#tok").val();
    	$.ajax({
         type:'GET',
         url: 'http://104.131.66.240/rehapp-api/public/api/v1/exercises/'+ide,
         crossDomain: true,         dataType: 'jsonp',
         headers: { 'Authorization': token },
         success: function(data){
              console.log(data);
              var json = data.exercise;
                    $("#ideje").val(json.id);
                    $("#titulo").val(json.title);
                    $("#descripcion").val(json.description);
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
    var token = $("#tok").val();
    var con = confirm("Esta seguro de eliminar este ejercicio "+id);
    if(con){
         $.ajax({
             type:'DELETE',
             url: 'http://104.131.66.240/rehapp-api/public/api/v1/exercises/'+id,
             crossDomain: true,         dataType: 'jsonp',
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
function eliminar_media(id){
    var token = $("#tok").val();
    var ide = $("#id_eje").val();
    var con = confirm("Esta seguro de eliminar este registro "+id);
    if(con){
         $.ajax({
             type:'POST',
             data:'exercise_id='+ide,
             url: 'http://104.131.66.240/rehapp-api/public/api/v1/mediafiles/'+id+'/remove',
             crossDomain: true,         dataType: 'jsonp',
             headers: { 'Authorization': token },
             success: function(data){
                console.log(data);
                alert("Se elimino con exitosamente ");
                mostrar_videos(ide);
                 $("#titulo").val('');
              },
              failure: function(data){
                console.log(data);
             }
           });
    }
    
}
function add_ejercicios(ids,idpa,pro){
    var token = $("#tok").val();
      var conf =  confirm("Desea Agregar estos ejercicios a la sesion?");
    if(conf){
			$("input[name=item]:checked").each(function(){
				var id = $(this).attr("id");
                                    	$.ajax({
                                             type:'POST',
                                             data:'exercise_id='+id+'&patient_id='+idpa+'&professional_id='+pro,
                                             url: 'http://104.131.66.240/rehapp-api/public/api/v1/sessions/'+ids+'/assign-exercise',
                                             crossDomain: true,         dataType: 'jsonp',
                                             headers: { 'Authorization': token },
                                             success: function(data){
                                                console.log(data);
                                                alert("Se guardo exitosamente "+id);
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
function videos(ide){
       $('#modalVideo').modal({
			show:true,
			backdrop:'static'
		});
       $("#id_eje").val(ide);
        var token = $("#tok").val();
           	$.ajax({
         type:'GET',
         url: 'http://104.131.66.240/rehapp-api/public/api/v1/exercises/'+ide,
         crossDomain: true,         dataType: 'jsonp',
         headers: { 'Authorization': token },
         success: function(data){
              console.log(data);
              var json = data.exercise;
                   
                    $("#tit").val(json.title);
                    $("#des").val(json.description);
//              $('#titulo').val(render);
                     mostrar_videos(ide);
              console.log("load successfully");
             
              
          },
          failure: function(data){
            console.log(data);
         }
});
      
}
function add_video(){
    var ide = $("#id_eje").val();
    var med = $("#medio").val();
    var url = $("#url").val();
     var token = $("#tok").val();
    if(med===''){
        alert("Seleccione el tipo de medio");
        $("#medio").focus();
        return false;
    }
    if(url===''){
        alert("Agregue la url o el archivo");
        $("#url").focus();
        return false;
    }
    $.ajax({
                                             type:'POST',
                                             data:'exercise_id='+id,
                                             url: 'http://104.131.66.240/rehapp-api/public/api/v1/sessions/'+ids+'/assign-exercise',
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
}
function mostrar_videos(ide){
           var token = $("#tok").val();
	$.ajax({
         url: 'http://104.131.66.240/rehapp-api/public/api/v1/exercises/'+ide,
         crossDomain: true,         dataType: 'jsonp',
         headers: { 'Authorization': token },
         success: function(data){
            console.log(data);
            showLV(data);
          },
          failure: function(data){
            console.log(data); 
      }
}); 
}
function showLV(data) {
  //alert('Entra');
  console.log(data.mediafiles);
  var json = data.exercise.mediafiles;
  var render ="";
  console.log(json.length);
  $.each(json, function (i, dev) {
          render+= showRowLV(i,dev);
          console.log(showRowLV(i,dev));
  });

  $('#mostrar_videos').html(render);
  console.log("load successfully");
}

function showRowLV(i, dev){
  if(dev.type==='VIDEO'){
      var url = '<a href="'+dev.url_file+'" target="_blank">Ver Video</a>';
  }else{
      url = '<img src="'+dev.url_file+'" style="width:30px">';
  }
  var row = '<tr>'+
              '<td>'+dev.type+'</td>'+
              '<td>'+url+'</td>'+
              '<td><td> <a href="javascript:void(0);" onclick="eliminar_media('+dev.id+');"><button><img src="../imagenes/eliminar.png"></button> </a></td>'+
            '</tr>';
  return row;

}
function preguntas(ide){
       $('#modalPreguntas').modal({
			show:true,
			backdrop:'static'
		});
       $("#id_ejep").val(ide);  
       mostrar_preguntas(ide);
}
