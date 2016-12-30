<?php
/**
 * Created by PhpStorm.
 * User: linyulin
 * Date: 16/12/15
 * Time: 下午1:37
 */

include('class/HttpClient.php');
$url = "http://img3.imgtn.bdimg.com/it/u=139895738,155593393&fm=214&gp=0.jpg";

$http_client = new HttpClient();

$http_client->set_response_header(true);
$http_client->set_refer('http://www.baidu.com');
$content = $http_client->url_get($url);

print_r($content);

