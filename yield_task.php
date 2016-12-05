<?php
function task($task_id, $times = 1) {
	for($i = 0; $i<$times; $i++) {
		$ret = (yield "task {$task_id}");
		echo "Count:{$times}，Now:".($i+1).", Mission Context:" . $ret;
		echo "<br/>";
	}
}

$a = task("hello", 5);
$a->current();
$a->send("next times");
$a->send("next times two");
while(1) {
	if ($a->valid()) {
		$a->send("next times others");
	} else {
		break;
	}
}