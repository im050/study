<?php
/**
 * Created by PhpStorm.
 * User: linyulin
 * Date: 17/1/17
 * Time: 下午1:42
 */

namespace lib;


class Story
{
    private $_doc = null;
    private $_storyId = null;
    private $_baseUrl = 'http://www.79wx.com/Html';

    public function __construct($storyId)
    {
        $this->_storyId = "/" . trim($storyId, '/') . "/";
        $this->_doc = new \DOMDocument();
        $this->_doc->strictErrorChecking = false;
        $this->createCacheFolder();
    }

    public function createCacheFolder()
    {
        $fileName = CACHE_PATH . $this->_storyId;
        if (!file_exists($fileName)) {
            if (!mkdir($fileName, 0777)) {
                throw new \Exception('Create cache file failed.');
            }
        }
    }

    public function getArticle($fileName)
    {
        $cacheFileName = CACHE_PATH . $this->_storyId . $fileName;
        if (file_exists($cacheFileName)) {
            $article = unserialize(file_get_contents($cacheFileName));
        } else {
            $article = $this->catchRemoteArticle($fileName);
        }
        return $article;
    }

    public function fileInCacheDirectory($fileName)
    {
        return CACHE_PATH . $this->_storyId . trim($fileName, "/");
    }

    public function getChapters()
    {
        $cacheFileName = $this->fileInCacheDirectory('chapters.shtml');
        if (file_exists($cacheFileName)) {
            $list = unserialize(file_get_contents($cacheFileName));
        } else {
            $list = $this->catchRemoteChapters();
        }
        return $list;
    }

    public function getRemoteFileName($fileName)
    {
        $remoteFileName = $this->_baseUrl . $this->_storyId . trim($fileName, "/");
        return $remoteFileName;
    }

    public function catchRemoteArticle($fileName)
    {
        $remoteFileName = $this->getRemoteFileName($fileName);
        try {
            $html = $this->getRemoteFileContent($remoteFileName);
        } catch (Exception $e) {
            throw new Exception("Catch remote file failed.");
        }
        @$this->_doc->loadHTML($html);
        //找到正文内容节点下的所有子节点
        $nodes = $this->_doc->getElementById('content')->childNodes;
        //解析还原正文内容HTML
        $content = \parseHtml($nodes);
        //找到上一页下一页连接地址
        $divNodes = $this->_doc->getElementsByTagName("div");
        $linkNodes = \getNodesByAttrName($divNodes, 'class', 'footlink');
        $prePageNode = $nextPageNode = null;
        foreach ($linkNodes[0]->childNodes as $node) {
            if ($node->nodeValue == "上一页") {
                $prePageNode = $node;
            } else if ($node->nodeValue == "下一页") {
                $nextPageNode = $node;
            }
        }

        $prePageLink = $this->explainFileName($prePageNode->getAttribute("href"));
        $nextPageLink = $this->explainFileName($nextPageNode->getAttribute("href"));

        $title = \getNodesByAttrName($divNodes, 'class', 'boxtitle');
        $title = $title[0]->nodeValue;
        $article = new \lib\Article();
        $article->title = $title;
        $article->content = $content;
        $article->preFileName = $prePageLink;
        $article->nextFileName = $nextPageLink;
        $this->saveArticle($fileName, $article);
        return $article;
    }

    public function explainFileName($url)
    {
        $files = explode("/", $url);
        $fileName = $files[count($files) - 1];
        return $fileName;
    }

    public function catchRemoteChapters()
    {
        $chaptersUrl = $this->getRemoteFileName('index.shtml');
        $html = @$this->getRemoteFileContent($chaptersUrl);
        @$this->_doc->loadHTML($html);
        $nodes = $this->_doc->getElementsByTagName("dd");
        $chapterNodes = \getNodesByAttrName($nodes, 'class', 'chapter');
        $linkedList = new \SplDoublyLinkedList();
        foreach ($chapterNodes as $key => $node) {
            $a = $node->firstChild;
            $href = $a->getAttribute("href");
            $element['title'] = $a->nodeValue;
            $element['url'] = $href;
            $linkedList->add($key, $element);
        }
        $this->saveChapters($linkedList);
        return $linkedList;
    }

    protected function saveSerialize($fileName, $object)
    {
        return file_put_contents(CACHE_PATH . $this->_storyId . $fileName, serialize($object));
    }

    public function saveArticle($fileName, Article $article)
    {
        return $this->saveSerialize($fileName, $article);
    }

    public function saveChapters(\SplDoublyLinkedList $object)
    {
        return $this->saveSerialize('chapters.shtml', $object);
    }

    public function getRemoteFileContent($url, $method = 'GET', $timeout = 30, $flag = null)
    {
        $method = strtoupper($method);
        $opts = array(
            'http' => array(
                'method' => $method,
                'timeout' => $timeout,
                'header' => array(
                    'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
                    'User-Agent:Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.95 Safari/537.36',
                )
            )
        );
        $context = stream_context_create($opts);
        $data = file_get_contents($url, $flag, $context);
        return $data;
    }
}