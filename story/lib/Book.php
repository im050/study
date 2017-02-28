<?php
/**
 * Created by PhpStorm.
 * User: linyulin
 * Date: 17/1/17
 * Time: 下午5:53
 */

namespace lib;


class Book
{
    public $bookId;
    public $bookName;
    public $bookChapters;
    public $bookAuthor;
    public $bookCategory;

    public function __construct($bookId) {
        $this->bookId = $bookId;
    }

}