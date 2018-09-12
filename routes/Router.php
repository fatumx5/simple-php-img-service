<?php



namespace routes;

/**
 * Simple router class
 *
 * @author Фатум
 */
class Router {
    //put your code here
    protected static $routes = [];
    protected static $route = [];
    
    /**
     * 
     * @param string $regexp 
     * @param map $route
     */
    public static function add($regexp, $route = []){
        self::$routes[$regexp] = $route;
    }
    
    /**
     * Method to check matches current route in having routes rules
     * @param  string $url request path
     * @return boolean
     */
    public static function matchRoute($url){
         foreach (self::$routes as $pattern => $route){
             if(preg_match ("#$pattern#i", $url, $matches)){
                foreach ($matches as $k => $v){
                    if(is_string($k)){
                        $route[$k]=$v;
                    }
                }
                if(!isset($route['action'])){
                    $route['action']='index';
                }
                self::$route = $route;
                
                return true;
             }             
        }
        return false;
    }
    
    /**
     * Method to run request handler
     * @param  string $url request path
     * @param map  $serviceContainer Associates service's name to service's obj
     */
    public static function dispatch($url, $serviceContainer){
        if(self::matchRoute($url)){
            $controller = 'controllers\\'.self::upperCamelCase(self::$route['controller']); 
            
            if (class_exists($controller)){
                $cObj = new $controller;
                $action = self::lowerCamelCase(self::$route['action']).'Action';
                if(method_exists($cObj, $action)){
                    $cObj->$action($serviceContainer);
                }
            } else {
                http_response_code(404);
                echo ' 404 страница не найдена';
            }
        }
    }
    /**
     * Method to get correct handler's class-name.
     * kebab-case to CamelCase
     * @param string $name Name in kebab-case format
     * @return string
     */
    protected static function upperCamelCase ($name){
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
        
    }
    /**
     * Method to get correct handler's method-name.
     * kebab-case to camelCase
     * @param string $name Name in kebab-case format
     * @return string 
     */
    protected static function lowerCamelCase ($name){
        return lcfirst(str_replace(' ', '', ucwords(str_replace('-', ' ', $name))));
        
    }
}
