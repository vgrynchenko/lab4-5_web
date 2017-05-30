<?php
require_once("/utils/errors.php");
require_once("/utils/functions.php");
function login($user,$pass)
{
	
	if($log = fopen(dirname(__DIR__)."/data/${user}.txt", 'r'))
	{
		while(!feof($log))
		{
			$buffer = fgets($log);// записали строчку из файла в баффер
			$data = preg_split("/[\s]+/", $buffer);// разделили её на подстроки и записали в массив
			if (strcmp($data[1], $pass)=== 0)//в дата(0) хранится имя в дата(1) - пароль. Сравниваем, правильно ли введен пароль(сравниваем пароль в строке и файле) 
			{
				$id = uniqid();//генерация айди 
				if($fp = fopen(dirname(__DIR__)."/sessions/${user}.txt", 'a+'))
				{
					$tx=fgets($fp);
				}
				else $tx="";
				$fp=fopen(dirname(__DIR__)."/sessions/${id}.txt", 'w');
				fwrite($fp, "${user}-${tx}");//запишем в сессию как зовут пользователя 
				fclose($fp);
				api_session($id);
			}
			else 
			{
				our_error("Wrong password!");
			}
		}
	}
	else {our_error("This user doesn't exist!");}
}
function session($sessionid)
{
	if($log = fopen(dirname(__DIR__)."/sessions/${sessionid}.txt", 'r'))
	{
		while(!feof($log))
		{
			$buffer = fgets($log);
			$data = preg_split("/[-\r\n]+/", $buffer);
			api_session($data[1]);
		}	
	}
	else {our_error("This id doesn't exist!");}

}
function session_set($sessionid, $text)//запись в sessionid текст
{
	if($file=fopen(dirname(__DIR__)."/sessions/${sessionid}.txt", 'a+'))
	{
		$buf=fgets($file);
		$user=preg_split("/[\s-]+/", $buf);
		$user[1]="-${text}";
		$buf="${user[0]}-${text}";
		file_put_contents(dirname(__DIR__)."/sessions/${sessionid}.txt", "${user[0]}-${text}");
		fclose($file);
		$fp=fopen(dirname(__DIR__)."/sessions/${user[0]}.txt", 'w');
		fputs($fp, "${text}");
		fclose($fp);
		api_session("Action is successful");
	}
	else {our_error("This id doesn't exist!");}
}
function session_out($sessionid)
{
	if($log=fopen(dirname(__DIR__)."/sessions/${sessionid}.txt", 'r+'))
	{
		fclose($log);
		unlink(dirname(__DIR__)."/sessions/${sessionid}.txt");
		api_session("done");
	}
	else {our_error("This id doesn't exist!");}
}
?>