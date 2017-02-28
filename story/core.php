<?php
define('WEB_ROOT', '/demo/story');
define('CSS_PATH', WEB_ROOT . '/public/css');
define('JS_PATH', WEB_ROOT . '/public/js');
define('ROOT_PATH', __DIR__);
define('CACHE_PATH', ROOT_PATH . '/cache');

include('lib/Story.php');
include('lib/Article.php');
include('lib/Response.php');
include('lib/HttpClient.php');
include('functions.php');