<?php
include('class/HttpClient.php');

$content = '';

try {
    $http_client = new HttpClient(array('host' => 'www.im050.com'));
    $content = $http_client->get();

    preg_match_all("/href=\"(.*?)\"[\s+\S+]/", $content, $matches);
    print_r($matches);
} catch(Exception $e) {
    echo $e->getMessage();
}
