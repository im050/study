<?php
function get_record() {
	$poor = range(1, 36);
	shuffle($poor);
	$result = array_slice($poor, 0, 7);
	return $result;
}

$max_count = 10;

$results = [];

for($i = 0; $i<$max_count; $i++) {
	$lottery = get_record();
	sort($lottery);
	foreach($lottery  as $key => $val) {
		echo $val . " ";
	}
	echo "<br/>";
}

//print_r($results);
?>