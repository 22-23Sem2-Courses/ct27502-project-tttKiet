<?php
    class App {
        protected $controller = 'HomeController';
        protected $action = 'index';
        protected $params = [];

        function __construct(){
 
            $arr = $this -> UrlProcess();
     
            // Controller
            if( file_exists("../mvc/controllers/". $arr[0] ."Controller.php") ){
                $arr[0] = $arr[0] . 'Controller';
                $this -> controller = $arr[0];
                unset($arr[0]);
            }
            require_once "../mvc/controllers/" . $this -> controller . ".php";
            $this -> controller = new $this -> controller;
    
            // Action
            if(isset($arr[1])){
                $arr[1] = $this -> convertStringToAction($arr[1]);
                if( method_exists( $this -> controller , $arr[1]) ){
                    $this -> action = (string)$arr[1];
                }
                unset($arr[1]);
            }
    
            // Params
            $this -> params = $arr ? array_values($arr) : [];
            if(!empty($_POST)) {
                $pa = [];
                foreach($_POST as $key => $value) {
                    $pa[$key] = $value;
                }
                
                call_user_func_array([$this -> controller, $this -> action], [$pa] );
            
            } else {
                call_user_func_array([$this -> controller, $this -> action], $this -> params );
            }
    
        }

        function UrlProcess(){
            if( isset($_GET["url"]) ){ 
                return explode("/", filter_var(trim($_GET["url"], "/")));
            } 
                else return ['Home', 'index'];

        }

        function convertStringToAction($string) {
            // view-token => viewToken
            $stringslice = explode("-", $string);
            $newString = implode("", array_map('ucfirst', $stringslice));
            $newString = lcfirst($newString);

            return $newString; 
        }
    }
?>