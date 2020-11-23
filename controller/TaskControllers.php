<?php
require_once("model/TaskModels.php");


class TaskControllers{

	function __construct()
	{
    	$this->taskmodels=new TaskModels(); 
	}

	function index()
	{
         require_once("view/task_view.php");
	}
	
function view_all_team_only()
{
	//consumiendo--> /view_all_team_only
	$request_fields=array("api_key"=>API_TOKEN);
	$result=$this->taskmodels->ConsumeApi("view_all_team_only",$request_fields);

	return $result->data;
}

function get_job_details()
{
	//consumiendo--> /get_job_details
	$request_fields=array("api_key"=>API_TOKEN, "job_ids"=>array(161957724),"include_task_history"=> 0);
	$result=$this->taskmodels->ConsumeApi("get_job_details",$request_fields);

	return $result->data;
}

function get_all_tasks()
{
	//consumiendo--> /get_all_tasks
	$request_fields=array("api_key"=>API_TOKEN, "job_type"=>"0","start_date"=>"2020-11-01","end_date"=>"2020-11-30","is_pagination"=>"1","requested_page"=>"1");
	$result=$this->taskmodels->ConsumeApi("get_all_tasks",$request_fields);

	echo json_encode($result->data);
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




$result=$this->taskmodels->ConsumeApi("create_task",$request_fields);

echo json_encode($result->data);
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
	$result=$this->taskmodels->ConsumeApi("assign_task",$request_fields);
	//print_r($result);

	return $result->data;
}

function delete_task()
{
	if(isset($_POST))
{
	$llaves=array_keys($_POST);
	foreach ($llaves as $val)
	{

		$$val=$_POST[$val];
	
	}	
}
	//consumiendo--> /delete_task
	$request_fields=array("api_key"=>API_TOKEN, 
		"job_id"=>"$jobId"
	);

	//comsumimos delete_task
	$result=$this->taskmodels->ConsumeApi("delete_task",$request_fields);
	//print_r($result);

    $request_fields=array("api_key"=>API_TOKEN, "job_type"=>"0","start_date"=>"2020-11-01","end_date"=>"2020-11-30","is_pagination"=>"1","requested_page"=>"1");
	$result_tasks=$this->taskmodels->ConsumeApi("get_all_tasks",$request_fields);
 
	$res['res_delete_task']=$result;
	$res['all_tasks']=$result_tasks->data;  
	echo json_encode($res);
}

function find_region_from_points()
{
	//consumiendo--> /find_region_from_points
 
	$data_points[]=json_encode(array("latitude"=>"37.4224764","longitude"=>"-122.0842499"));
	$request_fields=array("api_key"=>API_TOKEN, 
		"points"=>$data_points
	);
	//comsumimos find_region_from_points
	$result=$this->taskmodels->ConsumeApi("find_region_from_points",$request_fields);
	//print_r($result);

	return $result;
}

//$result_create_task=create_task();

//$result_assign_task=assign_task();

//$result_find_region_from_points=find_region_from_points();
















	
function dispatch($_funcion)
{
/* 

	if($_funcion==1)
	{
		$get_create_task=$this->taskmodels->create_task();
		echo json_encode($get_create_task);
	}
	else if($_funcion==2)
	{
		//comsumimos get_job_details
		$job_details=$this->taskmodels->get_job_details();
		echo json_encode($job_details);
	}else if($_funcion==3)
	{
		//comsumimos get_all_tasks
		$all_tasks=$this->taskmodels->get_all_tasks();
		echo json_encode($all_tasks);
	}else if($_funcion==4)
	{
		//comsumimos get_all_tasks
		$res_delete_task=$this->taskmodels->delete_task($jobId);
		$all_tasks=$this->taskmodels->get_all_tasks();
		$res['res_delete_task']=$res_delete_task;
		$res['all_tasks']=$all_tasks;
		echo json_encode($res);
	}
	require_once("view/task_view.php"); */
	}
}