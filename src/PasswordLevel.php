<?php

namespace Agossou\PasswordLevel;

abstract class AbstractPasswordLevel {
	abstract public static function checkLevel($password = "");
}

abstract class AbstractSecurePassword {
	abstract static function generate();
}

trait Characters {
	private static $uppercases = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	private static $lowercases = "abcdefghijklmnopqrstuvwxyz";
	private static $numbers = "0123456789";
	private static $symbols = "~`!@#$%^&*()_-+={[}]|\:;\"'<,>.?/";
}

interface ILengths {
	public const STD_LEN = 10;
}

class PasswordLevel extends AbstractPasswordLevel {
	public static function checkLevel($password = ""){
		$level = (int)!(strlen($password) < 8);
	
		if (!$level) return $level; // level 1
	
		$uppercase	= preg_match('@[A-Z]@', $password);
		$lowercase	= preg_match('@[a-z]@', $password);
		$number		= preg_match('@[0-9]@', $password);
		$symbol		= preg_match('@[^\w]@', $password);
	
		$level += (int)($uppercase && ($lowercase || $number)); // level 2
		$level += (int)($lowercase && ($uppercase || $number)); // level 2 or 3
		$level += (int)($number && $uppercase && $lowercase); // level 4 or 5
		$level += (int)($level > 1 && $symbol); // level 3, 4, 5 or 6
	
		$level += (int)!!(strlen($password) > 8); // level 2, 3, 4, 5 or 6
		return $level;
	}
	
}

class SecurePassword extends AbstractSecurePassword implements ILengths {
	use Characters;
	
	const UPPC = "UPPC";
	const LOWC = "LOWC";
	const NUMB = "NUMB";
	const SYMB = "SYMB";

	public static function generate(){
		$length = self::STD_LEN;
		$alphalen = strlen(self::UPPC);
		$nlen = strlen(self::NUMB);
		$symlen = strlen(self::SYMB);

		$char = self::UPPC;

		$passwd = "";
		for($i = 0;$i<$length;$i++){
			switch($char){
				case self::UPPC: 
					$position = rand(0,$alphalen-1);
					$passwd .= self::$uppercases[$position];
					$char = self::LOWC;
					break;
				case self::LOWC: 
					$position = rand(0,$alphalen-1);
					$passwd .= self::$lowercases[$position];
					$char = self::NUMB;
					break;
				case self::NUMB: 
					$position = rand(0,$nlen-1);
					$passwd .= self::$numbers[$position];
					$char = self::SYMB;
					break;
				case self::SYMB: 
					$position = rand(0,$symlen-1);
					$passwd .= self::$symbols[$position];
					$char = self::UPPC;
					break;
			}
		}

		return str_shuffle($passwd);
	}
}