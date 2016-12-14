<?php

/**
 * Class BaiduImages
 * 百度图片API
 */
class BaiduImages
{

    public $picture_per_page = 10;
    public $keywords = '';
    public $page = 1;
    public $width = '';
    public $height = '';
    public $params = array();
    public $http_client = null;
    protected $_result = null;
    const SEARCH_PATH = "/search/acjson";

    public function __construct()
    {
        $config = array(
            'host' => 'image.baidu.com'
        );
        //创建HTTP_CLIENT对象
        $this->http_client = new HttpClient($config);
        //设置REFER
        $this->http_client->set_refer('http://www.baidu.com');
        //设置USER_AGENT
        $this->http_client->set_user_agent("Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.98 Safari/537.36");
    }

    public function get()
    {
        $params = $this->make_params();
        $content = $this->http_client->get(self::SEARCH_PATH, $params);
        $this->_result = json_decode($content);
        return $this;
    }

    public function search($keywords)
    {
        $this->keywords = $keywords;
        return $this;
    }

    public function get_result()
    {
        return $this->_result;
    }

    public function search_by_page($keywords, $page = 1, $size = 30)
    {
        return $this->set('picture_per_page', $size)
            ->set('page', $page)
            ->search($keywords)
            ->get();
    }

    public function explain_urls()
    {
        $pic = isset($this->_result->data) ? $this->_result->data : null;
        if (!empty($pic)) {
            $urls = array();
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
                array_push($urls, $link);
            }
            return $urls;
        } else {
            return false;
        }
    }

    public function make_params()
    {
        $params = array(
            "tn" => "resultjson_com",
            "ipn" => "rj",
            "ct" => "201326592",
            "fp" => "result",
            "queryWord" => $this->keywords,
            "ie" => "utf-8",
            "oe" => "utf-8",
            "st" => "-1",
            "ic" => "0",
            "word" => $this->keywords,
            "face" => "0",
            "istype" => "2",
            "nc" => "1",
            "cg" => "wallpaper",
            "pn" => ($this->page - 1) * $this->picture_per_page,
            "rn" => $this->picture_per_page,
            "gsm" => "1e",
        );
        return array_merge($this->params, $params);
    }

    public function set($param, $value)
    {
        if (isset($this->$param)) {
            $this->$param = $value;
            return $this;
        } else {
            throw new Exception("[BaiduImages] Not found the variable of class that you want to modify.");
        }
    }

}