<?php
class Request {
    private $controller;
    private $method;
    private $args;
    
    function __construct() {
    $parts = $_SERVER['REQUEST_URI'];
    $parts = explode('/', $parts);
    $parts = array_filter($parts);
    array_shift($parts);
    $this->controller = ($c = array_shift($parts)) ? $c : 'mahasiswa';
    $this->method = ($c = array_shift($parts)) ? $c : 'index';
    $this->args = (isset($parts[0]))? $parts : array();
//    echo 'construct request<br>';
//    print_r($this->args);
    }
    
    function getController(){
        return $this->controller;
    }
    function getMethod(){
        return $this->method;
    }
    function getArgs(){
        return $this->args;
    }

}
?>
