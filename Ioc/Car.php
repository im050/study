<?php

/**
 * Created by PhpStorm.
 * User: linyulin
 * Date: 17/2/6
 * Time: 下午4:33
 */
class Car
{

    protected $wheel = null;

    public function __construct(Wheel $wheel)
    {
        $this->wheel = $wheel;
    }

    public function run() {
        if (empty($this->wheel)) {
            echo "Your car without wheels!";
        } else {
            echo "Running!";
        }
    }
}