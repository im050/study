<?php

set_time_limit(0);

include "functions.php";

$keyword = "feet fetish";

$page = 0;

function start(){
    global $keyword;
    global $page;
    $urls = [];
    $failed_count = 0;
    while(true) {
        $list = get_picture($keyword, $page++);
        if ($list == null) {
            $failed_count++;
        } else {
            $failed_count = 0;
            $urls = array_merge($urls, $list);
        }
        if ($failed_count >= 5) {
            break;
        }
    }
    return $urls;
}

$list = start();

print_r($list);