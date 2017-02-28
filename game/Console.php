<?php

/**
 * Class Console
 * 控制台流程控制
 * @author: memory
 */
class Console
{

    private $_workers = [];
    private $_data = [];
    private $_current_worker_name = '';
    private $_temp_var = [];

    protected static $_instance = null;

    public function __construct()
    {
        //todo nothing...
    }

    public static function getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function getInput($title, &$var, $obj_type = null)
    {
        fwrite(STDOUT, $title . PHP_EOL);
        $var = fgets(STDIN);
        if (is_callable($obj_type)) {
            $var = $obj_type($var);
        }
    }

    public function println($content)
    {
        echo $content . PHP_EOL;
    }

    public function worker($worker_name, Closure $concrete)
    {
        $this->_workers[$worker_name] = $concrete;
    }

    public function changeWorker($worker_name)
    {
        $this->_current_worker_name = $worker_name;
        return $this;
    }

    public function assign($variable_name, $variable_value)
    {
        $this->_temp_var[$variable_name] = $variable_value;
    }

    public function getVariable($variable_name)
    {
        return isset($this->_temp_var[$variable_name]) ? $this->_temp_var[$variable_name] : null;
    }

    public function render($params)
    {
        $this->_data = $params;
        return $this;
    }

    public function run()
    {
        return $this->_workers[$this->_current_worker_name]($this, $this->_data);
    }

    public function start($worker_name)
    {
        return $this->changeWorker($worker_name)->run();
    }

}