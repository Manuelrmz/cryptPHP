<?php
require_once "crypt.php";
try
{
	$key = "QYGgbSPf5gU9TY";
	$originalString = "hola mundo";
	$obj = new crypt($key);
	echo 'Key: '.$key.'</br>';
	echo 'Value: '.$originalString.'</br>';
	$encrypted =  $obj->CryptString($originalString,"QYGgbSPf5gU9TY");
	echo 'Encripted Value: '.$encrypted.'</br>';
	echo 'Key: '.$key.'</br>';
	echo 'Value: '.$encrypted.'</br>';
	echo 'Decripted Value: ';
	echo $obj->DecryptString($encrypted,$key).'</br>';
}
catch(Exception $ex)
{
	echo $ex->getMessage();
}
?>