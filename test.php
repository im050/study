<?php
/**
 * Created by PhpStorm.
 * User: linyulin
 * Date: 17/1/12
 * Time: 下午1:28
 */

// gc_disable();

// $x = 8 - 6.4;  // which is equal to 1.6
// $y = 1.6;
// var_dump($x == $y); // is not true


// var_dump($_ENV);

function get_boxes() {
	$i = 0;
	$box = 0;
	$count = 0;
	while($box < 27) {
		$i++;
		if ($i % 3 == 0) {
			$count += $i;
			$box ++;
			$i = 0;
		}
		
	}
	return $count;
}

print_r(get_boxes());

