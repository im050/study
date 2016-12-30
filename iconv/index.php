<?php
/**
 * Created by PhpStorm.
 * User: linyulin
 * Date: 16/12/21
 * Time: 下午4:23
 */


include("../class/HttpClient.php");
//

$http_client = new HttpClient(array('host'=>'www.mybet.com'));

$data = array('amount'=>'0.10',
    'channelOrderno'=>'8021800730812161220030429942',
    'channelTraceno'=>'',
    'merchName'=>'雨林网络科技有限公司',
    'merchno'=>'678520148160003',
    'orderno'=>'900003997703',
    'payType'=>'2',
    'signature'=>'A746905D29C63D9083505CE805F4F19B',
    'status'=>'1',
    'traceno'=>'161220075216677344',
    'transDate'=>'2016-12-20',
    'transTime'=>'19:10:40'
);

$path = '/index.php/pay/jafpay_qrcode_callback';

$content = $http_client->post($path, $data);

echo $content;
