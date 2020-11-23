<?php

class TaskModels{


function __construct()
	{
		
	}

function ConsumeApi($action,$request_fields)
{
	ob_start();
	$url=URL_API.$action;	
	$curl_resource = curl_init( $url );
	$datarequest = json_encode($request_fields);
	curl_setopt( $curl_resource, CURLOPT_POSTFIELDS, $datarequest );
	curl_setopt( $curl_resource, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
	curl_setopt( $curl_resource, CURLOPT_RETURNTRANSFER, true );
	$result = curl_exec($curl_resource);
	curl_close($curl_resource);
	
	
	ob_clean();
	ob_end_clean();
	
	return (object)json_decode($result);
}


}










