<?php

/**
 * Created by PhpStorm.
 * User: linyulin
 * Date: 17/2/6
 * Time: 下午3:44
 */
class DI
{
    protected $_items = array();
    protected static $_instances = array();

    public function addItem($name, callable $callback, $type = 'normal',  $force_reset = false) {
        if (isset($_items[$name]) && !$force_reset) {
            throw new Exception("[DI Warning] : the `$name` has exists!");
        }
        $this->_items[$name]['type'] = $type;
        $this->_items[$name]['callback'] = $callback;
    }

    public function register($name, callable $callback) {
        $this->addItem($name, $callback);
    }

    public function singleton($name, callable $callback) {
        $this->addItem($name, $callback, 'singleton');
    }

    public function get($name) {
        if (!isset(self::$_instances[$name])) {
            $instance = $this->_items[$name]['callback']();
        } else {
            $instance = self::$_instances[$name];
        }
        if ($this->_items[$name]['type'] == 'singleton') {
            self::$_instances[$name] = $instance;
        }
        return $instance;
    }
}