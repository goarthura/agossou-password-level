<?php

namespace Agossou\PasswordLevel;

function passwordLevel($password = ""){
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

	$level += (int)!(strlen($password) > 8); // level 2, 3, 4, 5 or 6
	return $level;
}
