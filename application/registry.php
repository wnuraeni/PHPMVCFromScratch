<?php
class Registry {
    private static $instance;
    private $storage;
    
    function __construct() {
        
    }
    public static function getInstance(){
        if(!self::$instance instanceof self){
            self::$instance = new Registry();
        }
        return self::$instance;
    }
    public function __set($name, $value) {
        $this->storage[$name] = $value;
    }
    public function __get($name) {
        if(isset($this->storage[$name])){
        return $this->storage[$name];
        }
        else{
            return false;
        }
    }
}
?>
