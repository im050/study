<?php
$count = 0;
for($i = 0; $i<10; $i++) {
	$pid = pcntl_fork(); 
	if ($pid == 0) {
		$count ++;
		echo "child $i\r\n";
		exit();
	} else if ($pid == 1) {
		echo ("father process\r\n");
	} else if ($pid == -1) {
		exit("create child process failed.\r\n");
	}
}