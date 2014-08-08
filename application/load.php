<?php
class Load {

    function __construct() {
        
    }
    public function model($name){
        $model = $name.'Model';
        $file = SITE_PATH.'models/'.$model.'.php';
        if(is_readable($file)){
            require_once $file;
            if(class_exists($model)){
            $registry = Registry::getInstance();
            $registry->$name = new $model();//bikin objek modelnya
            }
        }
    }
    public function view($name, $vars=null){
        $file = SITE_PATH.'views/'.$name.'.php';
        if(is_readable($file)){
            if(isset($vars)){
                extract($vars); //memecah index data jadi variable
                }
            require $file;
            return true;
            
        }throw new Exception('View problem');
    }

}
?>
