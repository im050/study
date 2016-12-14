<?php
//$sem_id = ftok(__FILE__, 't');
//$sem_key = shmop_open($sem_id, 'c', 0755, 32);
//shmop_write($sem_key, str_pad(0, 32, 0, STR_PAD_LEFT), 0);
//$count = 0;
//for($i = 0; $i<50; $i++) {
//	$pid = pcntl_fork();
//	if ($pid == 0) {
//		$count = (int)shmop_read($sem_key, 0, 32);
//		shmop_write($sem_key, str_pad($count + 1, 32, 0, STR_PAD_LEFT), 0);
//		echo "进程" . $i . " count: " . $count . "\r\n";
//		usleep(1000000);
//		exit();
//	} else if ($pid == 1) {
//		exit("byebye");
//	} else if ($pid == -1) {
//		exit("create child process failed.\r\n");
//	}
//}
$j = 0;
$parent_pid = getmypid();
echo "++++ [parent:$parent_pid][start]" . PHP_EOL;
for($i = 0; $i < 3; $i++) {
	$pid = pcntl_fork();
	if ($pid == 0) {
		$son_pid = getmypid();
		echo "---- [son:$son_pid][parent:$parent_pid][i:$i][j:{$j}]" . PHP_EOL;
		//exit;
	} else if ($pid) {
		$parent_pid = getmypid();
		$j++;
		sleep(1);
		pcntl_wait($status, WNOHANG);
		echo "++++ [parent:$parent_pid][son:$pid][i:$i][j:$j][status:$status]" . PHP_EOL;
	} else if ($pid == -1) {
		exit("fork failed." . PHP_EOL);
	}
}