<?php
require_once "crypt.php";
try
{
	$obj = new crypt("QYGgbSPf5gU9TY");
	echo $obj->DecryptString("875B989D827F001F4AEA71","QYGgbSPf5gU9TY");
}
catch(Exception $ex)
{
	echo $ex->getMessage();
}
?>