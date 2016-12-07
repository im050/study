<?php
$systemid = ftok(__FILE__, 't'); // System ID for the shared memory segment
$mode = "c"; // Access mode
$permissions = 0755; // Permissions for the shared memory segment
$size = 32; // Size, in bytes, of the segment

$shmid = shmop_open($systemid, $mode, $permissions, $size);

if ($shmid === false) {
    exit("开辟共享内存失败");
}

$write = shmop_write($shmid, 0, 0);

if ($write === false) {
    exit("写入内存失败");
}

for($i = 0; $i < 100; $i++) {
    $current = (int) shmop_read($shmid, 0, 32);
    echo $current . "\r\n";
    shmop_write($shmid, $current+1, 0);
}
