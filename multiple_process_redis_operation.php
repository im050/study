<?php
/**
 * 多进程下Redis锁使用
 * @author: memory
 */
for($i = 0; $i < 20; $i++) {
    $pid = pcntl_fork();
    if ($pid == 0) {
        $redis = new Redis();
        $redis->connect('127.0.0.1');
        $key = "lock";
        $ttl = 30;
        $random = getmypid();
        while(1) {
            $ok = $redis->set($key, $random, array('nx', 'ex' => $ttl));
            if ($ok) {
                $page = intval($redis->get('page'));
                $redis->set('page', $page + 1);
                echo $page . PHP_EOL;
                if ($redis->get($key) == $random) {
                    $redis->del($key);
                }
            } else {
                echo "pid:{$i} 等待中..." . PHP_EOL;
                sleep(3);
                continue;
            }

        }
        $redis->close();
        exit(0);
    } else if ($pid) {
        pcntl_wait($status, WNOHANG);
    } else {
        exit('fork failed');
    }
}