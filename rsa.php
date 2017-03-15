<?php
//$public_key = "MIICkTCCAfqgAwIBAgIE/1P75jANBgkqhkiG9w0BAQQFADBcMQ8wDQYDVQQDDAZ5c2VwYXkxDzANBgNVBAsMBnlzZXBheTERMA8GA1UECgwIb3JnYW5pemUxCzAJBgNVBAcMAnN6MQswCQYDVQQGEwJjbjELMAkGA1UECAwCZ2QwHhcNMTcwMjE3MDcxNTU2WhcNNDcwMjEwMDcxNTU2WjBiMRUwEwYDVQQDDAxidXNpbmVzc2dhdGUxDzANBgNVBAsMBnlzZXBheTERMA8GA1UECgwIb3JnYW5pemUxCzAJBgNVBAcMAnN6MQswCQYDVQQGEwJjbjELMAkGA1UECAwCZ2QwgZ8wDQYJKoZIhvcNAQEBBQADgY0AMIGJAoGBAMioHDR2jxiKPj+F35NDYIvjd5AI49sqJi7cbPX/ov3XUJbQZWCk4n+uI7W0e525Y2euKfU8jVTtnS0VFUiCVHMoslybQ8pv1ZFsHjHTl64SNUB65y+5xl41Q/CSoIkLrykcfmi9nrPmXbwc9NOUb4G7Bw9ARLhcP86HpwO3zUPdAgMBAAGjWjBYMB0GA1UdDgQWBBSeG1FgLn0MrUTZLFIAngRSeYn0JjAfBgNVHSMEGDAWgBTNRc1cSoLvynQarb/pETbgWClymDAJBgNVHRMEAjAAMAsGA1UdDwQEAwIEkDANBgkqhkiG9w0BAQQFAAOBgQBRKIGA1W8g7Yi6tMtbP7kz3qrmW0Vxoa3tCcXn6CMZjoZKwtB5FCqR/Va2hR7wC8+NKgdj4lzKOxotTmnc6FW6Qlq1Ijg3IkGyko16Pw5SV2u38l1A9EfFXyMF4xgzuhORIAoY9WaYDHm0c+8JAI//P5fXxkckm97/Q/Qxdp94MA==";

$cer_path = 'businessgate.cer';

$public_key = base64_encode(file_get_contents($cer_path));

echo $public_key;

$json = '{"sign":"Za4\/gk\/UFvFS3p+unGotoDkH93a0QMMImK8nTQn5O9cVPtoNrQobT1dU2mzb0uew2nWFYX3TXrBb73ukWPCDp2ghs9zFcK+6LeyP2thczIr71mQS+HZ5vL+UU0VlnDUQD\/\/slGys+Qbp\/AHyT4ooygY6NmNh\/S+hbitNLL1ldtQ=","total_amount":"10.00","trade_no":"311170303803532426","notify_time":"2017-03-03 23:48:12","account_date":"20170303","sign_type":"RSA","notify_type":"directpay.status.sync","out_trade_no":"170303112949754981","trade_status":"TRADE_SUCCESS"}';

$data = json_decode($json, JSON_OBJECT_AS_ARRAY);
$signStr = "";

ksort($data);
foreach ($data as $key => $val) {
    if ($key == 'sign') {
        continue;
    }
    if (!empty(trim($val))) {
        $signStr .= $key . "=" . $val . "&";
    }
}

$signStr = rtrim($signStr, "&");

echo $signStr;

$certificateCAcerContent = $public_key;
$certificateCApemContent = '-----BEGIN CERTIFICATE-----' . PHP_EOL . chunk_split(($certificateCAcerContent), 64, PHP_EOL) . '-----END CERTIFICATE-----' . PHP_EOL;
// 签名验证
$success = openssl_verify($signStr, base64_decode($data['sign']), openssl_get_publickey($certificateCApemContent), OPENSSL_ALGO_SHA1);