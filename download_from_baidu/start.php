<?php
include "functions.php";
$keywords = '壁纸';
$size = 30;
$baidu_images = null;
$baidu_images = new BaiduImages();
$ttl = 10;

$worker_num = 10;
$task_num = 10;

fwrite(STDOUT, '请输入要搜索的关键字:');
$keywords = str_replace("\r\n", "", fgets(STDIN));

$redis = new Redis();
$redis->connect('127.0.0.1');
$redis->set('page', 1);
$redis->close();
try {
    for ($i = 0; $i < $worker_num; $i++) {
        $pid = pcntl_fork();
        if ($pid == -1) {
            die('could not fork');
        } else if ($pid) {
            pcntl_wait($status, WNOHANG); //等待子进程中断，防止子进程成为僵尸进程,非阻塞。
        } else {
            $key = "mission_lock";
            $random = getmypid();
            $redis = new Redis();
            $redis->connect('127.0.0.1');
            echo "pid:{$i} 任务开始" . PHP_EOL;
            while (1) {
                $ok = $redis->set($key, $random, array('nx', 'ex' => $ttl));
                if ($ok) {
                    $page = intval($redis->get('page'));
                    $redis->set('page', $page + 1);
                    if ($redis->get($key) == $random) {
                        $redis->del($key);
                    }
                } else {
                    echo "pid:{$i} 获取锁失败,等待中..." . PHP_EOL;
                    sleep(3);
                    continue;
                }
                $urls = $baidu_images->search_by_page($keywords, $page, $size)->explain_urls();
                $j = 0;
                if ($urls != null) {
                    foreach ($urls as $key => $val) {
                        $j++;
                        $redis->lPush('picture_list', $val);
                    }
                } else {
                    break;
                }
            }
            $redis->close();
            exit(0);
        }
    }

    $folder_name = str_replace(" ", "_", $keywords);
    if (!file_exists(__DIR__ . '/' . $folder_name)) {
        mkdir($folder_name);
    }

    //消费进程
    for ($i = 0; $i < $task_num; $i++) {
        $pid = pcntl_fork();
        if ($pid == 0) {
            $times = 0;
            $redis = new Redis();
            $redis->connect('127.0.0.1');
            while (1) {
                $url = $redis->lPop('picture_list');
                if ($url === false) {
                    $times++;
                    echo "已经没有数据,正在等待中...($times)" . PHP_EOL;
                    sleep(3);
                    if ($times < 10) {
                        continue;
                    } else {
                        echo "Task[$i]:任务完成" . PHP_EOL;
                        break;
                    }
                }
                try {
                    $http_client = new HttpClient();
                    $http_client->set_refer("http://www.baidu.com");
                    $img = $http_client->url_get($url);
                    $file_name = md5($url) . ".jpg";
                    file_put_contents($folder_name . "/" . $file_name, $img);
                } catch (Exception $e) {
                    continue;
                }
            }
            $redis->close();
            exit();
        }
    }
} catch (RedisException $e) {
    exit($e->getMessage());
}