<?php
abstract class baseController {
    protected $registry;
    protected $load;
    
    function __construct() {
        $this->registry = Registry::getInstance();
        $this->load = new Load();//membuat objek load otomatis
    }
    abstract function index();

}
?>
