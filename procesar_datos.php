<?php 
//constantes token de api y url 
define("API_TOKEN","55676080f1464a1c4410687f1d4c25401ce1c0f322df7f3e591a00");
define("URL_API","https://api.tookanapp.com/v2/");

if(isset($_POST))
{
	$llaves=array_keys($_POST);
	foreach ($llaves as $val)
	$$val=$_POST[$val];
}

function ConsumeApi($action,$request_fields)
{
	$url=URL_API.$action;	
	$curl_resource = curl_init( $url );
	$datarequest = json_encode($request_fields);
	curl_setopt( $curl_resource, CURLOPT_POSTFIELDS, $datarequest );
	curl_setopt( $curl_resource, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
	curl_setopt( $curl_resource, CURLOPT_RETURNTRANSFER, true );
	$result = curl_exec($curl_resource);
	curl_close($curl_resource);
	return (object)json_decode($result);
}

function view_all_team_only()
{
	//consumiendo--> /view_all_team_only
	$request_fields=array("api_key"=>API_TOKEN);
	$result=ConsumeApi("view_all_team_only",$request_fields);

	return $result->data;
}

function get_job_details()
{
	//consumiendo--> /get_job_details
	$request_fields=array("api_key"=>API_TOKEN, "job_ids"=>array(161957724),"include_task_history"=> 0);
	$result=ConsumeApi("get_job_details",$request_fields);

	return $result->data;
}

function get_all_tasks()
{
	//consumiendo--> /get_all_tasks
	$request_fields=array("api_key"=>API_TOKEN, "job_type"=>"0","start_date"=>"2020-11-16","end_date"=>"2020-11-18","is_pagination"=>"1","requested_page"=>"1");
	$result=ConsumeApi("get_all_tasks",$request_fields);

	return $result->data;
}



function create_task()
{
	
if(isset($_POST))
{
	$llaves=array_keys($_POST);
	foreach ($llaves as $val)
	{

		$$val=$_POST[$val];
	
	}	
}	
//consumiendo--> /create_task
$meta_data[]=array("label"=>"Price","data"=>$price);
$meta_data[]=array("label"=>"Quantity","data"=>$quanty);

$request_fields=array("api_key"=>API_TOKEN, 
  "order_id"=>"$order",
  "job_description"=> "$descripction",
  "job_pickup_phone"=>$pickup_phone,
	"job_pickup_name"=>$pickup_name,
	"job_pickup_email"=>$pickup_email,
	"job_pickup_address"=>$pickup_adress,
	"job_pickup_latitude"=>$pickup_latitude,
	"job_pickup_longitude"=>$longitud,
	"job_pickup_datetime"=>$pickup_datetime,
	"pickup_custom_field_template"=>$custom_field_template,
    "pickup_meta_data"=>json_encode($meta_data),
	"team_id"=>$team_id,
	"auto_assignment"=>$assignment,
	"has_pickup"=>$pickup,
	"has_delivery"=>$delivery,
	"layout_type"=>$layout_type,
  "tracking_link"=> $tracking_link,
  "timezone"=> "$timezone",
  "fleet_id"=> "$fleet_id",
  "p_ref_images"=> array("$p_ref_images"),
  "notify"=> "$notify",
  "tags"=> "$tags",
  "geofence"=> "$geofence");




$result=ConsumeApi("create_task",$request_fields);

return $result->data;
}
 

function assign_task()
{
	//consumiendo--> /assign_task
	$request_fields=array("api_key"=>API_TOKEN, 
		"job_id"=>"161957724",
		"fleet_id"=>"",
		"team_id"=>"",
		"job_status"=>"2"
	);
	//comsumimos assign_task
	$result=ConsumeApi("assign_task",$request_fields);
	//print_r($result);

	return $result->data;
}

function delete_task($job_id)
{
	//consumiendo--> /delete_task
	$request_fields=array("api_key"=>API_TOKEN, 
		"job_id"=>"$job_id"
	);
	//comsumimos delete_task
	$result=ConsumeApi("delete_task",$request_fields);
	//print_r($result);

	return $result;
}

function find_region_from_points()
{
	//consumiendo--> /find_region_from_points
 
	$data_points[]=json_encode(array("latitude"=>"37.4224764","longitude"=>"-122.0842499"));
	$request_fields=array("api_key"=>API_TOKEN, 
		"points"=>$data_points
	);
	//comsumimos find_region_from_points
	$result=ConsumeApi("find_region_from_points",$request_fields);
	//print_r($result);

	return $result;
}

//$result_create_task=create_task();

//$result_assign_task=assign_task();

//$result_find_region_from_points=find_region_from_points();

if($_funcion==1)
{
	$get_create_task=create_task();
	echo json_encode($get_create_task);
}
else if($_funcion==2)
{
	//comsumimos get_job_details
	$job_details=get_job_details();
	echo json_encode($job_details);
}else if($_funcion==3)
{
	//comsumimos get_all_tasks
	$all_tasks=get_all_tasks();
	echo json_encode($all_tasks);
}else if($_funcion==4)
{
	//comsumimos get_all_tasks
	$res_delete_task=delete_task($jobId);
	$all_tasks=get_all_tasks();
	$res['res_delete_task']=$res_delete_task;
	$res['all_tasks']=$all_tasks;
	echo json_encode($res);
}