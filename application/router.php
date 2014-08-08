<?php

class Router {

    function __construct() {
        
    }
    public static function route(Request $request){
        $controller = $request->getController().'Controller';
        $method = $request->getMethod();
        $args = $request->getArgs();
        
        $controllerFile = SITE_PATH.'controllers/'.$controller.'.php';
        
//        echo ' file : '.$controllerFile.'<br>';
//        echo ' controller : '.$controller.'<br>';
//        echo ' args : '.print_r($args).'<br>';
        if(is_readable($controllerFile)){
//            echo 'readable<br>';
            require_once $controllerFile; //include file controller
            $controller = new $controller; //manggil kelas controller
            $method = (is_callable(array($controller,$method))) ? $method : 'index';
//            echo 'method = '.$method.'<br>';
            if(!empty($args)){
//                echo 'args not empty<br>';
                $controller->$method($args);
            }
            else{
//                echo 'args empty <br>';
                $controller->$method();
            }
        }
    }
}
?>
