<?php
/**
 * Created by PhpStorm.
 * User: linyulin
 * Date: 17/1/17
 * Time: 下午2:42
 */

namespace lib;


class Response
{

    private $_template_vars = [];

    public function __construct()
    {
        $_GET['story_id'] = isset($_GET['story_id']) ? $_GET['story_id'] : '26502';
        $_GET['view'] = isset($_GET['view']) ? $_GET['view'] : '';
        $title = 'MemoryStory';
        $this->assign("title", $title);
    }
    public function index() {
        $story = new \lib\Story($_GET['story_id']);
        $list = $story->getChapters();
        $this->assign('list', $list);
        $this->display('index');
    }

    public function view() {
        $story = new \lib\Story($_GET['story_id']);
        $article = $story->getArticle($_GET['view']);
        $this->assign('article', $article);
        $this->display('article');
    }

    public function assign($key, &$var) {
        $this->_template_vars[$key] = $var;
    }

    public function display($template_name) {
        extract($this->_template_vars);
        require ROOT_PATH . '/template/' . $template_name . '.php';
    }

}