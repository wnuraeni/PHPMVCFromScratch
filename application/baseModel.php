<?php
abstract class baseModel {
    protected $db;
    
    function __construct() {
        $this->db = new Database();//membuat objek database
        
    }
    abstract function index();
}
?>
