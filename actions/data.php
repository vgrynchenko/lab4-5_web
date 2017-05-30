<?php
require_once("/utils/errors.php");
require_once("/internal/available-users.php");
if(empty($_GET)) {api_response_error("Data is not enough!");}

else
{
	if($_GET["method"]=="get")
	{
		if(!isset($_GET["sessionid"])) {our_error("Data is not enough!");}
		else session($_GET["sessionid"]);
	}
	elseif($_GET["method"]=="set")
	{
		if(!isset($_GET["sessionid"])) {our_error("Data is not enough!");}
		elseif(!isset($_GET["text"])) {our_error("Data is not enough!");}
		else session_set($_GET["sessionid"], $_GET["text"]);
	}
	else {our_error("Unknown method!!!");}
}
?>