<?php
/**
 * 命令行下,接受参数的几种方式
 */

print_r($argv);

$params = getopt('a:b:');

print_r($params);

fwrite(STDOUT,'keywords');
echo 'keywords：'.fgets(STDIN);