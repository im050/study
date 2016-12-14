<?php
/**
 * 查找中位数
 * @from: www.baidu.com
 */
error_reporting('E_ALL |~ E_ALL');
define("MASK", 0x1f);
$source = array(1, 74, 4, 256, 1024, 110, 111, 112, 123, 112, 100);
$array = array();
$count = 0;
foreach($source as $num) { 
	set($num); // add to bit map
}
$count = intval($count >> 1) + 1; // cal middle number
for($i = 0;;$i++) {
 	// travel the bit map and find the middle number 
	$num = $array[$i];
	if(!$num) {
		continue;
	}
	$sum = 0;
	while($num) {
		if($num & 0x1) {
			if(!--$count) {
				echo ($i << 5) + $sum;
				exit; 
			}
		}
		$num >>= 1;
		$sum++;
	}
} 
/* * set number to bit map */ 
function set($i) {
	global $array;
	global $count;
	$temp = (1 << ($i & MASK));
	$array[$i >> 5] |= $temp;
	if($temp) { 
		$count++; 
	}
}

// k = 5
// k = 0b0101
// a = 0010 0110
// a >> 5 & 1
// a = 0000 0010
// 0000 0010
// 0000 0001
// 0000 0000
