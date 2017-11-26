<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('clear_teks'))
{
	function clear_teks($teks)
	{
		$c = array (' ');
    	$d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+');
		$s = strtolower(str_replace($d,"",$teks));
		$teks = strtolower(str_replace($c, '-', $s));
		return $teks;
	}
}
