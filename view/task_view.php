<!DOCTYPE html>
<html>
<head>
<link href="../css/bootstrap/css/bootstrap.css"  rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" />
	<script type="text/javascript" src="../js/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
 
 <script type="text/javascript" src="../js/bootstrap/js/bootstrap.js"></script>

	<style type="text/css">
	    #left { float:left }
	    #right { float:right }
	</style>

	<style type="text/css">
		form{
			width: 50%; margin: 0 auto;
		}

		input[type="text"]{
			padding: 10px; margin-top: 10px; margin-bottom: 10px;
		}

		input[type="button"]{
			padding: 10px;
		}
	</style>
	<title></title>
</head>
<body> 

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="modalconfirm">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Confirmar</h4>
      </div>
	  <div class="modal-body">
         <span id="messageJob"></span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="modal-btn-si">Si</button>
        <button type="button" class="btn btn-primary" id="modal-btn-no">No</button>
      </div>
    </div>
  </div>
</div>
	<form method="post">
 <div class="cols-md-6">
  <div class="alert alert-success hide">
   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong><span class="message"></span>
  </div>
  
  <div class="alert alert-danger hide">
   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Danger!</strong><span class="message"></span>
  </div>
 </div>
 
		<h1>Create Task</h1>
		<div id="main">
          <div id="left">
          	<input type="text" id="order_id" placeholder="Ingrese su Id de orden">
			<input type="text" id="job_description" value="monkey_dance5 delivery" placeholder="Ingrese su descripcion">
			<input type="text" id="job_pickup_phone" value="+50582789913" placeholder="Ingrese su telefono">
			<input type="text" id="job_pickup_name" value="almacen principal" placeholder="Ingrese su nombre">
			<input type="text" id="job_pickup_email" value="karen@gmail.com" placeholder="Ingrese su correo">
			<input type="text" id="job_pickup_adress" value="NORTH EAST 28" placeholder="Ingrese su direccion">
			<input type="text" id="job_pickup_latitude" value="12.1211378" placeholder="Ingrese su latitud">
			<input type="text" id="job_pickup_longitude"  value="-86.2125781" placeholder="Ingrese su longitud">
			<input type="text" id="job_pickup_datetime" value="<?php echo date("Y/m/d h:i:s");?>" placeholder="Ingrese su fecha">
			<input type="text" id="pickup_custom_field_template" value="Template_1" placeholder="Ingrese su plantilla">
			<input type="text" id="pickup_quanty" value="1" placeholder="Ingrese la cantidad">
			<input type="text" id="pickup_price" value="35" placeholder="Ingrese el precio">

          </div>
          <div id="right">
			<input type="text" id="team_id" placeholder="Ingrese su Id de equipo">
			<input type="text" id="auto_assignment" value="0" placeholder="Ingrese su asignacion">
			<input type="text" id="has_pickup" value="1" placeholder="Ingrese su recoleccion">
			<input type="text" id="has_delivery" value="0" placeholder="Ingrese su entrega">
			<input type="text" id="layout_type" value="0" placeholder="Ingrese su tipo de diseño">
			<input type="text" id="tracking_link" value="1" placeholder="Ingrese su Id de rastreo">
			<input type="text" id="timezone" value="300" placeholder="Ingrese su tiempo de zona">
			<input type="text" id="fleet_id" placeholder="Ingrese su Id de flota">
			<input type="text" id="p_ref_images" placeholder="Ingrese su referencia de imagenes">
			<input type="text" id="notify"  value="0" placeholder="Ingrese su notificacion">
			<input type="text" id="tags" placeholder="Ingrese su tags">
			<input type="text" id="geofence" value="0" placeholder="Ingrese su geo referencia">
          </div>
        </div>

		<input class="btn btn-success" id="btnenviar" type="button" value="Enviar" onclick="enviar_datos_ajax();">

		<div class="">
		<h1>List Task</h1>
        	<table id="tblPD" class="table table-striped table-hover">
        		<thead>
        			<th class="text-center">Id de Orden</th>
        			<th class="text-center">Id de usuario</th>
						<th class="text-center">Id de equipo</th>
						<th class="text-center">Id de trabajo</th>
						<th class="text-center">Direccion</th>
						<th class="text-center">Fecha</th>
						<th class="text-center">Estado</th>
						<th class="text-center">Entrega</th>
						<th class="text-center">Tiempo de creacion</th>
						<th class="text-center">Acciones</th>

						<!-- <th class="text-center">Orden</th>
						<th class="text-center">Descripcion</th>
						<th class="text-center">Telefono</th>
						<th class="text-center">Nombre</th>
						<th class="text-center">Correo</th>
						<th class="text-center">Latitud</th>
						<th class="text-center">Longitud</th>
						<th class="text-center">Plantilla</th>
						<th class="text-center">Meta data</th>
						<th class="text-center">Asignacion</th>
						<th class="text-center">Recoleccion</th>
						<th class="text-center">Entrega</th>
						<th class="text-center">Diseño</th>
						<th class="text-center">Rastreo</th>
						<th class="text-center">Zona</th>
						<th class="text-center">Flota</th>
						<th class="text-center">Imagenes</th>
						<th class="text-center">Notificacion</th>
						<th class="text-center">Tags</th>
						<th class="text-center">Geo referencia</th> -->
        		</thead>
        	 
        	</table>
        </div>

		<!-- <div id="mostrardatos">
		</div> -->
	</form>
 
	<script src="../js/script.js"></script>
</body>
</html>