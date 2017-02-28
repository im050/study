<?php
namespace lib;
/**
 * Class HttpClient
 * @author memory
 */
class HttpClient
{
    //Curl对象
    protected $_curl = null;
    //超时时间
    protected $_timeout = 30;
    //请求状态
    protected $_status = 0;
    //主机地址
    protected $_host = '';
    //具体URL
    protected $_url = '';
    //端口
    protected $_port = 80;
    //设置Cookie信息
    protected $_cookies = array();
    //Cookie String
    protected $_cookie_string = '';
    //Refer
    protected $_refer = '';
    //设置HTTP头信息
    protected $_header = array();
    //是否显示HTTP头信息
    protected $_response_header = false;
    //请求头信息
    public $header_info = '';
    //用户代理
    public $user_agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)';

    /**
     * HttpClient constructor.
     * @param array $config
     */
    public function __construct($config = array())
    {
        $this->_port = isset($config['port']) ? $config['port'] : 80;
        if (isset($config['host']))
            $this->set_host($config['host']);
    }

    /**
     * 初始化配置信息
     * @param string $url
     * @throws Exception
     */
    public function init($url = '')
    {
        if ($this->_curl == null) {
            $this->_curl = curl_init();
        }
        //是否设置Url
        if ($url != '') {
            $this->_url = $url;
        }
        if ($this->_url == '')
            throw new Exception("HttpClient: 没有指明请求的URL地址");
        $this->setopt(CURLOPT_URL, $this->_url);
        //是否返回头信息
        if ($this->is_response_header()) {
            $this->setopt(CURLOPT_HEADER, true);
        }
        //是否设置Http头

        //是否设置Cookie
        if ($this->parse_cookie()) {
            $this->setopt(CURLOPT_COOKIE, $this->_cookie_string);
        }
        $this->setopt(CURLOPT_TIMEOUT, $this->_timeout);
        $this->setopt(CURLOPT_RETURNTRANSFER, 1);
        if ($this->_header != null) {
            $this->setopt(CURLOPT_HTTPHEADER, $this->_header);
        }
        if (!empty($this->user_agent)) {
            $this->setopt(CURLOPT_USERAGENT, $this->user_agent);
        }
        if ($this->_refer != '') {
            $this->setopt(CURLOPT_REFERER, $this->_refer);
        }
        if (stripos($this->_url, "https://") !== FALSE) {
            $this->setopt(CURLOPT_SSL_VERIFYPEER, false);
            $this->setopt(CURLOPT_SSL_VERIFYHOST, 2);
        }
        $this->setopt(CURLOPT_ENCODING, "gzip");
        $this->setopt(CURLINFO_HEADER_OUT, true);
        $this->setopt(CURLOPT_FOLLOWLOCATION, 1);
    }

    public function set_refer($url)
    {
        $this->_refer = $url;
    }

    public function get_refer() {
        return $this->_refer;
    }

    /**
     * 关闭CURL句柄
     */
    public function close()
    {
        if ($this->_curl != null) {
            curl_close($this->_curl);
            $this->_curl = null;
        }
    }

    /**
     * 获得请求内容
     * @return mixed
     * @throws Exception
     */
    public function get_content()
    {
        if ($this->_curl == null) {
            throw new Exception("初始化curl失败");
        }
        $data = curl_exec($this->_curl);
        if ($data == false) {
            throw new Exception(curl_error($this->_curl));
        }
        $this->_status = curl_getinfo($this->_curl, CURLINFO_HTTP_CODE);
        $this->close();
        return $data;
    }

    /**
     * 设置属性
     * @param $key
     * @param $value
     */
    protected function setopt($key, $value)
    {
        curl_setopt($this->_curl, $key, $value);
    }

    /**
     * POST提交请求
     * @param string $path
     * @param array $data
     * @return array|mixed
     */
    public function post($path = '/', $data = array())
    {
        $this->build_url($path);
        $this->init();
        $this->setopt(CURLOPT_POST, 1);
        $this->setopt(CURLOPT_POSTFIELDS,  http_build_query( $data ));
        $data = $this->get_content();
        return $data;
    }

    public function url_get($url)
    {
        $this->init($url);
        $data = $this->get_content();
        return $data;
    }

    /**
     * 将数组解析为Cookie字符串
     * @return boolean
     */
    public function parse_cookie()
    {
        $data = array();
        foreach ($this->_cookies as $key => $val) {
            $data[] = $key . "=" . $val;
        }
        $array_cookies_string = '';
        if (!empty($data)) {
            $array_cookies_string = implode(";", $data);
        }
        if (empty($this->_cookie_string)) {
            $this->_cookie_string = $array_cookies_string;
        } else {
            $this->_cookie_string .= ";" . $array_cookies_string;
        }
        if (!empty($this->_cookie_string)) {
            return true;
        } else {
            return false;
        }
    }

    public function set_cookie_string($value)
    {
        $this->_cookie_string = $value;
    }

    /**
     * 设置Cookies
     * @param $cookies
     */
    public function set_cookies($cookies)
    {
        $this->_cookies = $cookies;
    }

    public function set_cookie($key, $val)
    {
        $this->_cookies[$key] = $val;
    }

    /**
     * GET提交请求
     * @param $path
     * @param $data
     * @return mixed
     */
    public function get($path = '/', $data = array())
    {
        if (!empty($data)) {
            $query_string = http_build_query($data);
            $path .= "?" . $query_string;
        }
        $this->build_url($path);
        $this->init();
        $data = $this->get_content();
        return $data;
    }

    /**
     * 根据端口号生成URL
     * @param string $path
     */
    public function build_url($path = '/')
    {
        switch ($this->_port) {
            case 443:
                $this->_url = "https://" . $this->_host . $path;
                break;
            case 80:
                $this->_url = "http://" . $this->_host . $path;
                break;
            default:
                $this->_url = "http://" . $this->_host . ":" . $this->_port . $path;
        }
    }

    /**
     * 设置主机地址
     * @param $host
     */
    public function set_host($host)
    {
        $domain = parse_url($host);
        if (isset($domain['host'])) {
            $this->_host = $domain['host'];
        } else {
            $this->_host = $domain['path'];
        }
        if (isset($domain['port'])) {
            $this->_port = $domain['port'];
        }
    }

    /**
     * 设置端口号
     * @param $port
     */
    public function set_port($port)
    {
        $this->_port = $port;
    }

    /**
     * 设置超时时间
     * @param $second
     */
    public function set_timeout($second)
    {
        $this->_timeout = $second;
    }

    /**
     * 获得HTTP状态
     * @return int
     */
    public function get_http_status()
    {
        return $this->_status;
    }

    /**
     * 设置HTTP头
     * @param $header
     */
    public function set_header($header)
    {
        $this->_header = $header;
    }

    /**
     * 设置是否显示Response头信息
     * @param $bool
     */
    public function set_response_header($bool)
    {
        $this->_response_header = $bool;
    }

    /**
     * 判断是否显示Response头信息
     * @return bool
     */
    public function is_response_header()
    {
        return $this->_response_header;
    }

    /**
     * 设置用户代理
     * @param $user_agent
     */
    public function set_user_agent($user_agent)
    {
        $this->user_agent = $user_agent;
    }
}