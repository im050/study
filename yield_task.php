<?php
//function task($task_id, $times = 1) {
//	for($i = 0; $i<$times; $i++) {
//		$ret = (yield "task {$task_id}");
//		echo "Count:{$times}，Now:".($i+1).", Mission Context:" . $ret;
//		echo "\r\n";
//	}
//}
//
//$a = task("hello", 100);
//$a->current();
//$a->send("next times");
//$a->send("next times two");
//while(1) {
//	if ($a->valid()) {
//		$a->send("next times others");
//	} else {
//		break;
//	}
//}

function test() {
	(yield foo());
}

function foo() {
	static $i = 0 ;
	$i++;
	sleep(1);
	echo $i;
	return $i;
}

$test = test();
$test->send(1);
$test->send(2);
$test->send(2);
$test->send(2);
$test->send(2);