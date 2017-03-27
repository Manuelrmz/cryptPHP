<?php
class crypt
{
	private $clsKey = "";
	private $_s = array();
	public function __construct($key)
	{
		$this->setKey($key);
	}
	private function Decrypt($parameter)
	{
		$C = 0;
		$T = 0;
		$i = 0;
		$j = 0;
		$cadena = "";
		$this->createKeyArray();
		for($C; $C < strlen($parameter); $C++)
		{
			$i = ($i + 1) & 255;
			$j = ($j + $this->_s[$i]) & 255;
			$T = $this->_s[$i];
			$this->_s[$i] = $this->_s[$j];
			$this->_s[$j] = $T;
			$T = ($this->_s[$i] + $this->_s[$j]) & 255;
			$cadena = $cadena . chr(ord(substr($parameter,$C,1)) ^ $this->_s[$T]);
		}
		return $cadena;
	}
	private function createKeyArray()
	{
		$KeyLenght = 0;
		$T = 0;
		$i = 0;
		$j = 0;
		if($this->getKey() != "" && strlen(trim($this->getKey())) > 0)
		{
			$KeyLenght = strlen($this->getKey());
			for($i = 0; $i < 256; $i++)
			{
				$this->_s[$i] = $i;
			}
			for($i = 0; $i < 256; $i++)
			{
				$j = ($j + $this->_s[$i] + ord(substr($this->getKey(),($i % $KeyLenght),1)) & 255);
				//echo "J: ".$j." I: ".$i." , Lenght: ".$KeyLenght." , Mod: ".($i % $KeyLenght)."</br>";
				$T = $this->_s[$i];
				$this->_s[$i] = $this->_s[$j];
				$this->_s[$j] = $T;
			}
		}
		else
			throw new Exception("Key didn't found", 1);
	}
	private function ConvToInt($x)
	{	
		$x1 = "";
		$x2 = "";
		$temp = 0;
		$x1 = substr($x,0,1);
		$x2 = substr($x,1,1);
		if(is_numeric ($x1))
			$temp = 16 * $x1;
		else
			$temp = (ord($x1) - 55) * 16;
		if(is_numeric ($x2))
			$temp = $temp + $x2;
		else
			$temp = $temp + (ord($x2) - 55);
		return $temp;
	}
	private function desencriptar($dataValue)
	{
		$temp = "";
		$HexByte = "";
		for($i = 0; $i < strlen($dataValue); $i+=2)
		{
			$HexByte = substr($dataValue,$i,2);
			$temp = $temp . chr($this->ConvToInt($HexByte));
		}
		return $temp;
	}
	public function DecryptString($cadena,$key)
	{
		$this->setKey($key);
		$AuxDec = $this->desencriptar($cadena);
		$decriptString = $this->Decrypt($AuxDec);
		echo $decriptString;
	}
	/*Propertys*/
	public function getKey()
	{
		return $this->clsKey;
	}
	public function setKey($key)
	{
		$this->clsKey = (string)$key;
	}
}
?>