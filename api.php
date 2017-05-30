<?php
require_once("/utils/errors.php");
if(empty($_GET))
{
	our_error("You must enter smth");
}

	if($_GET["action"]=="user")
	{
		require_once("/actions/user.php");
	}
	elseif ($_GET["action"]=="data")
	{
		require_once("/actions/data.php");
	}
	else
		our_error("Wrong action");
?>