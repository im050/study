<?php
$date = [
	'November 11, 2016',
	'31 Oct 2016',
	'2016-01-11',
	'07 Nov 2016'
];

usort($date, function($a, $b){
	$a = strtotime($a);
	$b = strtotime($b);
	if ($a == $b) {
		return 0;
	}
	return ($a > $b) ? 1 : -1;
});

print_r($date);