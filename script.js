 
   var _funcion, jqTblPD = $("#tblPD"),tabla={};

$(document).ready(function () {
		
	var dataSource = [  
        { id_usuario: '001', id_equipo: '745',id_trabajo:"8676", direccion:"esquina1", fecha: "12/12/2020", estado:"ACTIVO", entrega:"listo", tiempo_de_creacion:"1",acciones:'<a id="borrar" class="btn btn-danger mb-2 borrar">Borrar</a>'},  
        { id_usuario: '002', id_equipo: '746',id_trabajo:"8677", direccion:"esquina1", fecha: "13/12/2020", estado:"ACTIVO", entrega:"pendiente", tiempo_de_creacion:"2",acciones:'<a id="borrar" class="btn btn-danger mb-2 borrar">Borrar</a>'}  
     ]; 
		tabla=jqTblPD.DataTable( {
	        data : dataSource,
	        columns : [
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
	        ]
	    });
				
				
$("#tblPD tbody").on("click","#borrar", function () {
	
	var row = $(this);

if (row.parent().parent().hasClass("DTFC_Cloned")) {
 
} else {
	
var rowIndex = row.index() + 1;
var tr = $(this).closest("tr");
		var rowindex = tr.index();
		datos= tabla.row(rowindex).data();	
console.log(datos);		
}});				


var modalConfirm = function(callback){
  
  $(".borrar").on("click", function(){
    $("#modalconfirm").modal('show');
  });

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
	  $(".alert-success .message").html('&nbsp;Borrado confirmado ');
	  $(".alert-success").removeClass("hide");
	  $("html, body").animate({ scrollTop: 0 }, "slow");
//$(".alert-danger").removeCLASS("hide");
     console.log("confirmado el borrado");
  }else{
    console.log("negado el borrado");
  }
});

function call_procesar(){
	var url="procesar_datos.php";

	$.ajax({
		type:"post",
		url:url,
		data:{_funcion:"3"},
		success:function(datos){
			//$("#mostrardatos").html(datos);

			data = JSON.parse(datos);
	        console.log('data0', data.length);
		}
	});
}

	call_procesar();
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
	var t=$('#timezone').val();
	var fi=$('#fleet_id').val();
	var pri=$('#p_ref_images').val();
	var n=$('#notify').val()
	var t=$('#tags').val();
	var g=$('#geofence').val();

	var url="procesar_datos.php";

	$.ajax({
		type:"post",
		url:url,
		data:{order:oi, descripction:jd, pickup_phone:jpp, pickup_name:jpn, pickup_email:jpe, pickup_adress:jpa, 
				pickup_latitude:jpl, longitud:l, pickup_datetime:jpd, custom_field_template:pcft, price:pmt_price,quanty:pmt_quanty,
				team_id:ti, assignment:aa, pickup:hp, delivery:hd, layout_type:lt, tracking_link:tl, timezone:t,
				fleet_id:fi, p_ref_images:pri, notify:n, tags:t, geofence:g, _funcion:"1"},
		success:function(datos){
			//$("#mostrardatos").html(datos);
               console.log('data', datos);
			data = JSON.parse(datos);
	        //console.log('data', data.length);
			if(data.job_id>0)
			{
			 $(".alert-success .message").html('&nbsp;Task creada ');
		   $(".alert-success").removeClass("hide");
		    }
		    else
			{
				$(".alert-danger .message").html('&nbsp;Task no creada ');	
				$(".alert-success").addClass("hide");
			}
			$("html, body").animate({ scrollTop: 0 }, "slow");
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