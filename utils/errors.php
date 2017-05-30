<?php
require_once("functions.php");
function our_error($message)
{
	api_response(array("Error:"=> ${message}));
}
?>