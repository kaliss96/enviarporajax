 
   var _funcion, jqTblPD = $("#tblPD"),tabla={},opt_table={},jqIdjob,idWatcher;

 		function LoadTable(dataSource)
		{
	tabla.clear();
    tabla.rows.add(dataSource);
    tabla.draw();

		var modalConfirm = function(callback){
 

  $("#modal-btn-si").on("click", function(){
    callback(true);
    $("#modalconfirm").modal('hide');
  });
  
  $("#modal-btn-no").on("click", function(){
    callback(false);
    $("#modalconfirm").modal('hide');
  });
};

modalConfirm(function(confirm){
  if(confirm){
	  call_borrar(jqIdjob);
	
//$(".alert-danger").removeCLASS("hide");
     console.log("confirmado el borrado");
  }else{
    console.log("negado el borrado");
  }
});	
		
$("#tblPD tbody").on("click",".borrar", function () {

	var tr = $(this).closest('tr');
	var row = tabla.row( tr );
	datos=row.data();
	console.log("datos",datos);
	jqIdjob=datos.id_trabajo;	

	$("#modalconfirm").find("#messageJob").html("Seguro deseas eliminar la tarea "+jqIdjob);
	$("#modalconfirm").modal('show');
});


		
		}

function call_procesar(){
	var url="http://localhost/enviarporajax/TaskControllers/get_all_tasks";

	$.ajax({
		type:"post",
		url:url,
		data:{},
		success:function(datos){
			//$("#mostrardatos").html(datos);

			data = JSON.parse(datos);
			var dataSource=[];
			$.each(data, function( index, value ) {
  console.log( index , ": " , value );
         if(value.order_id>0)
		dataSource.push({id_order:value.order_id,id_usuario:value.user_id,id_equipo:value.team_id,id_trabajo:value.job_id,direccion:value.job_pickup_address,fecha:value.job_pickup_datetime,estado:value.job_status,entrega:value.job_delivery_datetime,tiempo_de_creacion:value.creation_datetime});
});
	 
	
    LoadTable(dataSource);
	       // console.log('data0', data.length);
		}
	});
}

function call_borrar(Id){
	var url="http://localhost/enviarporajax/TaskControllers/delete_task";

	$.ajax({
		type:"post",
		url:url,
		data:{jobId:Id},
		success:function(datos){
			//$("#mostrardatos").html(datos);
			
			data = JSON.parse(datos);
			$(".alert-success .message").html('&nbsp;'+data.res_delete_task.message);
			$(".alert-success").removeClass("hide");
			$("html, body").animate({ scrollTop: 0 }, "slow");
			var dataSource=[];
			$.each(data.all_tasks, function( index, value ) {
  console.log( index , ": " , value );
         if(value.order_id>0)
		dataSource.push({id_order:value.order_id,id_usuario:value.user_id,id_equipo:value.team_id,id_trabajo:value.job_id,direccion:value.job_address,fecha:value.job_pickup_datetime,estado:value.job_status,entrega:value.job_delivery_datetime,tiempo_de_creacion:value.creation_datetime});
});
	 
	
    LoadTable(dataSource);
	        console.log('data0', data.length);
		}
	});
}

$(document).ready(function () {
 
 
	 var opt_table={
	        data : [],
	        columns : [
	            { title : "Id Orden", data : "id_order", class : 'text-center'},
	            { title : "Id Usuario", data : "id_usuario", class : 'text-center'},
	            { title : "Id Equipo", data : "id_equipo", class : 'text-center'},
	            { title : "Id Trabajo", data : "id_trabajo", class : 'text-center'},
	            { title : "Direccion", data : "direccion", class : 'text-center' },
	            { title : "Fecha", data : "fecha", class : 'text-center' },
	            { title : "Estado", data : "estado", class : 'text-center' },
	            { title : "Entrega", data : "entrega", class : 'text-center' },
	            { title : "Tiempo de creacion", data : "tiempo_de_creacion", class : 'text-center' },
	            { title : "Acciones", data : "acciones", class : 'text-center' }
	           /*  { title : "Nombre", data : "action", class : 'text-center' },
	            { title : "Correo", data : "action", class : 'text-center' },
	            { title : "Latitud", data : "action", class : 'text-center' },
	            { title : "Longitud", data : "action", class : 'text-center' },
	            { title : "Fecha", data : "action", class : 'text-center' },
	            { title : "Plantilla", data : "action", class : 'text-center' },
	            { title : "Meta data", data : "action", class : 'text-center' },
	            { title : "Id de equipo", data : "action", class : 'text-center' },
	            { title : "Asignacion", data : "action", class : 'text-center' },
	            { title : "Recoleccion", data : "action", class : 'text-center' },
	            { title : "Entrega", data : "action", class : 'text-center' },
	            { title : "Diseño", data : "action", class : 'text-center' },
	            { title : "Rastreo", data : "action", class : 'text-center' },
	            { title : "Zona", data : "action", class : 'text-center' },
	            { title : "Flota", data : "action", class : 'text-center' },
	            { title : "Imagenes", data : "action", class : 'text-center' },
	            { title : "Notificacion", data : "action", class : 'text-center' },
	            { title : "Tags", data : "action", class : 'text-center' },
	            { title : "Geo referencia", data : "action", class : 'text-center' } */
	        ],
			"columnDefs":
[
{
"data": null,
"defaultContent": '<a id="borrar" class="btn btn-danger mb-2 borrar">Borrar</a>',
"targets": -1
}
]
	    };
		tabla=jqTblPD.DataTable( opt_table);
				
				
			


	call_procesar();

  $('#btnenviar').on('click', function() {
    var $this = $(this);
  $('#btnenviar').html('saving').focus();
 
});


function onErrorDeUbicacion (err){
		console.log("Error obteniendo ubicación: ", err);
	}
const opcionesDeSolicitud = {
		enableHighAccuracy: true, // Alta precisión
		maximumAge: 0, // No queremos caché
		timeout: 10000 // Esperar solo 5 segundos
	};
function onUbicacionConcedida(ubicacion){
	//console.log(ubicacion);
		 $('#job_pickup_latitude').val(ubicacion.coords.latitude);
		 $('#job_pickup_longitude').val(ubicacion.coords.longitude);
		//loguear(`${ubicacion.timestamp}: ${coordenadas.latitude},${coordenadas.longitude}`);
		//enviarAServidor(ubicacion);
	}
if (idWatcher) {
	navigator.geolocation.clearWatch(idWatcher);
}
idWatcher = navigator.geolocation.watchPosition(onUbicacionConcedida, onErrorDeUbicacion, opcionesDeSolicitud);
//console.log("idwatcher",idWatcher);

 
});


function enviar_datos_ajax(){
	var oi=$('#order_id').val();
	var jd=$('#job_description').val();
	var jpp=$('#job_pickup_phone').val();
	var jpn=$('#job_pickup_name').val();
	var jpe=$('#job_pickup_email').val();
	var jpa=$('#job_pickup_adress').val();
	var jpl=$('#job_pickup_latitude').val();
	var l=$('#job_pickup_longitude').val();
	var jpd=$('#job_pickup_datetime').val();
	var pcft=$('#pickup_custom_field_template').val();
	var pmt_price=$('#pickup_price').val();
	var pmt_quanty=$('#pickup_quanty').val();
	var pmt=$('#pickup_meta_data').val();
	var ti=$('#team_id').val();
	var aa=$('#auto_assignment').val();
	var hp=$('#has_pickup').val();
	var hd=$('#has_delivery').val();
	var lt=$('#layout_type').val();
	var tl=$('#tracking_link').val();
	var tz=$('#timezone').val();
	var fi=$('#fleet_id').val();
	var pri=$('#p_ref_images').val();
	var n=$('#notify').val()
	var t=$('#tags').val();
	var g=$('#geofence').val();

	var url="http://localhost/enviarporajax/TaskControllers/create_task";
       if(oi>0){
	$.ajax({
		type:"post",
		url:url,
		data:{order:oi, descripction:jd, pickup_phone:jpp, pickup_name:jpn, pickup_email:jpe, pickup_adress:jpa, 
				pickup_latitude:jpl, longitud:l, pickup_datetime:jpd, custom_field_template:pcft, price:pmt_price,quanty:pmt_quanty,
				team_id:ti, assignment:aa, pickup:hp, delivery:hd, layout_type:lt, tracking_link:tl, timezone:tz,
				fleet_id:fi, p_ref_images:pri, notify:n, tags:t, geofence:g, _funcion:"1"},
		success:function(datos){
			//$("#mostrardatos").html(datos);
               console.log('data', datos);
			data = JSON.parse(datos);
	        //console.log('data', data.length);
			if(data.job_id>0)
			{
			 $(".alert-success .message").html('&nbsp;Task creada '+data.job_id);
		   $(".alert-success").removeClass("hide");
		   call_procesar();
		    }
		    else
			{
			$(".alert-danger .message").html('&nbsp;Task no creada ');	
			$(".alert-success").addClass("hide");
		     
			}
			$("html, body").animate({ scrollTop: 0 }, "slow");
			$('.btn').button('reset');
           if(data.length != 0){
	      console.log('test entro');

           	
           
           }else{
           		console.log('test no entro');
           		 
           		$("#tblPDBody").html('');
           		$("#tblPDBody").append('<tr><td colspan="24">No existen registros.</td></tr>');
           }
		}
	});
	   }
	   else
	   {
		   $(".alert-danger .message").html('&nbsp;order requerida ');	
			$(".alert-danger").removeClass("hide");
			$(".alert-success").addClass("hide");
			$('.btn').button('reset');
			$("html, body").animate({ scrollTop: 0 }, "slow");
		   
	   }

}