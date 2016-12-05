<?php
echo "开始";
for($i = 0; $i<10; $i++) {
	$pid = pcntl_fork();
	if ($pid == 0) {
		$redis = new Redis();
		$redis->connect('127.0.0.1', 6379);
		for($j = 1; $j <= 100000; $j++) {
			$num = ($i * 100000 + $j);
			echo "第 " . $i ." 个子进程" . $num . "\r\n";
			$redis->pfadd("list:2", array($num));
		}
		exit("第 " . $i ." 个子进程结束战斗");
	} else if ($pid == -1) {
		exit("创建失败");
	} else {
		echo "父进程$i\r\n";
	}
}
echo "结束";