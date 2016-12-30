<?php
/**
 * Created by PhpStorm.
 * User: linyulin
 * Date: 16/12/14
 * Time: 下午5:14
 */
include(dirname(dirname(__FILE__)) . '/class/HttpClient.php');

$host = 'w.qq.com';

$http_client = new HttpClient(array('host' => $host, 'port'=>80));
//$http_client->set_cookie_string("eas_sid=x1d4U5B71621M39635I4q6F1v4; pac_uid=1_52619941; tvfe_boss_uuid=03f6de289b6b7716; _ga=GA1.2.1411900882.1477540075; gaduid=5837ac72a3863; pgv_pvi=8821686272; ptui_loginuin=52619941; RK=oANeigSWMm; o_cookie=52619941; pgv_pvid=701140402; ptcz=a7112f394c69e2df2d6ed4db632b1c487905bf11d669e5a5673e6900e0ff4a96; pt2gguin=o0052619941; pgv_si=s152316928; MM_WX_NOTIFY_STATE=1; MM_WX_SOUND_STATE=1; mm_lang=zh_CN; webwxuvid=87440cd6111c780f82747d9e0df1114ad778e90f39db041ba2b0be51576672ee609282de3cabf44e3762f2aeb8e8b961; webwx_auth_ticket=CIsBEJKuvYcLGoABVFSTqVr2TU9cvqyTlJ0sFR3PfUg36AePjCy8zfZQMv+QhvdvhafLIJ/GZmeGLSfiPiOg1cyUcLHdNJrmi4YxiHzISAne7oKckmjYkQXVljnACGT0zsMTGxtbUyQqIDtk76xzytJ9r6Q545nzFXZDfic2s/YNPtZJjB8iENNCIik=; wxloadtime=1481706542_expired; wxpluginkey=1481705168; wxuin=88348875; wxsid=pMT/NULr8+CmZcdI; webwx_data_ticket=gSd38AAcOwYj7WNjqNwQ458Y");
//$http_client->set_user_agent('Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.98 Safari/537.36');
$header = array(
    'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
    'Accept-Language: zh-CN,zh;q=0.8,en;q=0.6',
    'Accept-Encoding: gzip, deflate, sdch, br',
    'Cookie:eas_sid=x1d4U5B71621M39635I4q6F1v4; pac_uid=1_52619941; tvfe_boss_uuid=03f6de289b6b7716; _ga=GA1.2.1411900882.1477540075; gaduid=5837ac72a3863; pgv_pvi=8821686272; ptui_loginuin=52619941; RK=oANeigSWMm; ptcz=a7112f394c69e2df2d6ed4db632b1c487905bf11d669e5a5673e6900e0ff4a96; pt2gguin=o0052619941; pgv_si=s152316928; webwxuvid=87440cd6111c780f82747d9e0df1114ad778e90f39db041ba2b0be51576672ee609282de3cabf44e3762f2aeb8e8b961; webwx_auth_ticket=CIsBEJKuvYcLGoABVFSTqVr2TU9cvqyTlJ0sFR3PfUg36AePjCy8zfZQMv+QhvdvhafLIJ/GZmeGLSfiPiOg1cyUcLHdNJrmi4YxiHzISAne7oKckmjYkQXVljnACGT0zsMTGxtbUyQqIDtk76xzytJ9r6Q545nzFXZDfic2s/YNPtZJjB8iENNCIik=; wxuin=88348875; ptisp=ctc; pgv_info=ssid=s2181947574; pgv_pvid=701140402; o_cookie=52619941; verifysession=h02-oox-ZKOMTu3ClE1LqKZtCkc0dXyceovXBYTQJEi2D7rGv_Tqx23AxO3YtoIBCGJVz_dwGbGind6ac3Bb74M1Xb5QGyBHQh2; mm_lang=zh_CN; MM_WX_NOTIFY_STATE=1; MM_WX_SOUND_STATE=1',
    'Host: w.qq.com',
    //"DNT: 1",
    'Referer:https://www.baidu.com/link?url=FvSfKXeUZpgeMchgcnxskkOFo-rtBbWpMYZP6VYX7s_&wd=&eqid=acf0b2ab00025a06000000065851fef2',
    // 'Cookie: wxuin=2330616138; webwxuvid=cab5317930f5335a8994ade9a8160d9a0c1e843e1bd24ff03ab254c91d4ea3a8ec31a98c8d9adb6087cf6e9043d53c58; pgv_pvi=3286183936; pgv_pvid=8255006950; pgv_info=ssid=s2371423939; pgv_si=s1581726720; wxsid=hBgpWPQeDRDVm3Rc; wxloadtime=1444359620_expired; mm_lang=zh_CN; webwx_data_ticket=AQaRtHUZKZBvZZR2FeXCn5pg; MM_WX_NOTIFY_STATE=1; MM_WX_SOUND_STATE=1; wxpluginkey=1444352949',
    'Connection: keep-alive',
    'Upgrade-Insecure-Requests: 1',
    'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.98 Safari/537.36',
);
$http_client->set_refer("https://www.baidu.com/s?wd=%E5%BE%AE%E4%BF%A1%E7%BD%91%E9%A1%B5%E7%89%88&rsv_spt=1&rsv_iqid=0xb080af9d00024499&issp=1&f=8&rsv_bp=1&rsv_idx=2&ie=utf-8&rqlang=cn&tn=baiduhome_pg&rsv_enter=1&oq=curl%E7%A9%BA%E7%99%BD&rsv_t=715efDZI0lJ%2B1tsmUpf%2BjHQd7bENHRr3vQYzkCWbKVfB9i1%2FzD6zku7rueAkW%2FGhuU1h&inputT=2801&rsv_sug3=29&rsv_sug1=22&rsv_sug7=100&rsv_pq=e3eb04a20002b2a1&rsv_sug2=0&rsv_sug4=2890");
$http_client->set_header($header);
//print_r($http_client->request_header);

$content = $http_client->get();


print_r($content);
