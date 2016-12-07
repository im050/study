<?php
/**
 * Created by PhpStorm.
 * User: linyulin
 * Date: 16/12/5
 * Time: 下午5:05
 */

include(dirname(dirname(__FILE__)) . '/class/HttpClient.php');

function get_picture($keyword, $page, $size = 30) {
    $urls = array();
    try {
        $http_client = new HttpClient(array('host' => 'image.baidu.com'));
        $path = "/search/acjson";
        $params = array(
            "tn" => "resultjson_com",
            "ipn" => "rj",
            "ct" => "201326592",
            // is:
            "fp" => "result",
            "queryWord" => $keyword,
            "ie" => "utf-8",
            "oe" => "utf-8",
            //  adpicid:
            "st" => "-1",
            /// z:
            "ic" => "0",
            "word" => $keyword,
            //s:
            //se:
            //tab:
            //'width'=>'1280',
            //'height'=>'800',
            "face" => "0",
            "istype" => "2",
            //qc:
            "nc" => "1",
            //fr:
            "cg" => "wallpaper",
            "pn" => ($page - 1) * $size,
            "rn" => $size,
            "gsm" => "1e",
        );
        $http_client->set_cookie_string("BDqhfp=%E5%A3%81%E7%BA%B8%26%260-10-1undefined%26%260%26%261; BDUSS=ks1U0wtU3ByN0prZURTNFdKZ1hod3E1ZnVKeVdvUUhKbUx4Z34tbFN4UkVGT3hXQVFBQUFBJCQAAAAAAAAAAAEAAACRyDogx-u90M7SyKvD-zA1MAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAESHxFZEh8RWR; Hm_lvt_737dbb498415dd39d8abf5bc2404b290=1461560912,1461593815; BAIDUID=3D2B789B483C17940F7AF27BAA87D7CE:FG=1; BIDUPSID=EDF9FC33B324D99126AE7A8B7C1F0EEA; PSTM=1480905255; PSINO=7; H_PS_PSSID=1438_21655_17947_21087_17001_20880_21454_21408_21553_21398; indexPageSugList=%5B%22%E5%A3%81%E7%BA%B8%22%2C%22%E6%A2%A6%E5%B9%BB%E5%A3%81%E7%BA%B8%22%5D; cleanHistoryStatus=0; BDRCVFR[dG2JNJb_ajR]=mk3SLVN4HKm; userFrom=www.baidu.com; BDRCVFR[-pGxjrCMryR]=mk3SLVN4HKm");
        $http_client->set_user_agent("Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.98 Safari/537.36");
        $content = $http_client->get($path, $params);
        $result = json_decode($content);
        $pic = isset($result->data) ? $result->data : null;
        if (!empty($pic)) {
            foreach ($pic as $key => $p) {
                $url = $link = '';
                if (isset($p->thumbURL)) {
                    $url = $p->thumbURL;
                    $link = $url;
                }
                if (isset($p->replaceUrl[0]->ObjURL)) {
                    $link = $p->replaceUrl[0]->ObjURL;
                    if ($url == '')
                        $url = $link;
                }
                if ($url == '' && $link == '') {
                    continue;
                }
                //print_r();
                array_push($urls, $link);
            }
        }
        return $urls;
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}