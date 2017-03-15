<?php
//
//
//include('class/HttpClient.php');
//
//$http = new HttpClient(array(
//    'host'=>'localhost'
//));
//
//$http->set_header(array(
//    'Content-Type: text/plain'
//));
//
//$content = $http->post("/demo/response.php", array('a'=>'c'));
//
//print_r($content);

foreach(($dump = array(1, 2, 3)) as &$val) {
    echo ++$val;
}

print_r($dump);
//
//
//$a = http_post('http://localhost/demo/response.php', 'abcdefg=abcdefg');
//
//print_r($a);
//
//function http_post($url,$post_data)
//{
//    $curl = curl_init();
//    curl_setopt($curl, CURLOPT_URL, $url);
//    curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)');
//    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: text/plain; charset=utf8'));
//    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//    curl_setopt($curl, CURLOPT_POST, 1);
//    curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
//    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
//    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);//设为0表示不检查证书 //设为1表示检查证书中是否有CN(common name)字段 //设为2表示在1的基础上校验当前的域名是否与CN匹配
//    $data = curl_exec($curl);
//    curl_close($curl);
//    return $data;
//
//}