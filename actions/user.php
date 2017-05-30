<?php

require_once("/utils/errors.php");
require_once("/internal/available-users.php");
if(empty($_GET)) {our_error("Data is not enough!");}
else
{
	if($_GET["method"]=="login")
	{
		if(!isset($_GET["username"])) {our_error("No username entered!");}
		elseif (!isset($_GET["pass"])) {our_error("Password not entered!");}
		else login($_GET["username"], $_GET["pass"]);
	}
	elseif($_GET["method"]=="logout")
	{
	if(!isset($_GET["sessionid"])) {our_error("Data is not enough!");}
	else session_out($_GET["sessionid"]);
	}
	else {our_error("Unknown method!!!");}
}
?>