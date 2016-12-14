<?php
/**
 * Created by PhpStorm.
 * User: linyulin
 * Date: 16/12/14
 * Time: 上午10:31
 */
/**
 * 这里有个奇怪的问题
 * 看下面注释的地方
 */

$parent_redis = new Redis();
$parent_redis->connect('127.0.0.1');
$parent_redis->set('key', 1);
//$parent_redis->close(); // 如果这句被注释,会出现 Broken pipe
for ($i = 1; $i <= 1; $i++) {
    $pid = pcntl_fork();
    if ($pid == 0) {
        $son_redis = new Redis();
        $son_redis->connect('127.0.0.1');
        $son_redis->set('key', $i);
        $son_redis->close();
        exit;
    } else if ($pid) {
        pcntl_wait($status);
    }
}

