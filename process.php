<?php
$sem_id = ftok(__FILE__, 't');
$sem_key = shmop_open($sem_id, 'c', 0755, 32);
shmop_write($sem_key, str_pad(0, 32, 0, STR_PAD_LEFT), 0);
$count = 0;
for($i = 0; $i<50; $i++) {
	$pid = pcntl_fork(); 
	if ($pid == 0) {
		$count = (int)shmop_read($sem_key, 0, 32);
		shmop_write($sem_key, str_pad($count + 1, 32, 0, STR_PAD_LEFT), 0);
		echo "进程" . $i . " count: " . $count . "\r\n";
		usleep(1000000);
		exit();
	} else if ($pid == 1) {
		exit("byebye");
	} else if ($pid == -1) {
		exit("create child process failed.\r\n");
	}
}