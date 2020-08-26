<?php 
    class App{
        public function __construct(){
            $url = $this->parseUrl();
            $controllerName = "{$url[0]}Controller";
            //echo $controllerName;
            if(!file_exists("controllers/$controllerName.php"))
                return;
            require_once "controllers/$controllerName.php";
            $controller = new $controllerName;
            $methodName = $url[1];
            //echo $methodName;
            if(!method_exists($controller,$methodName))
                return;
            unset($url[0]);unset($url[1]);
            $params = $url ? array_values($url):Array();
            
            //var_dump($params);
            call_user_func_array(Array($controller,$methodName),$params);
            //echo $params[0];
        }
        public function parseUrl(){
            if(isset($_GET["url"])){
                $url=rtrim($_GET["url"],"/");
                $url = explode("/",$url);
                return $url;
            }
        }
    }
?>