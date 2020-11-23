<?php
//constantes token de api y url 
define("API_TOKEN","55676080f1464a1c4410687f1d4c25401ce1c0f322df7f3e591a00");
define("URL_API","https://api.tookanapp.com/v2/");
require_once("libraries/Uri.php");
 date_default_timezone_set('Europe/London');
 
if(isset($_POST))
{
	$llaves=array_keys($_POST);
	foreach ($llaves as $val)
	$$val=$_POST[$val];
}

$uri=_parse_request_uri();
$segmentos=_set_uri_string($uri);
require("controller/".$segmentos[1].".php");
$_controlador=strtolower($segmentos[1]);
$$_controlador=new $segmentos[1]();
 

$method=(isset($segmentos[2])?$segmentos[2]:"index");

$taskcontrollers->{$method}();

