<?php
function api_response($value)
{
	echo json_encode($value);
	exit();
}
function api_response_login($message)
{
	api_response(array("SessionId"=> ${message}, "Error"=> "null"));
}
function api_session($message)
{	
	api_response(array("Result"=> ${message}, "Error"=> "null"));
}
?>