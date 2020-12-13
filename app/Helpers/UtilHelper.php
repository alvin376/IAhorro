<?php
namespace App\Helpers;

class Util {

	public static function time_to_minutes($time){
		$time_array = explode(':',$time);
    	$minutes = ($time_array[0]*60)+$time_array[1];

    	return $minutes;
	}
}
