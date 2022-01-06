<?php
    // core app class
    class Core{
        protected $currentController = 'HomeController';
        protected $currentMethod = 'index';
        protected $params = [];

        public function __construct()
        {
            $url = $this->getUrl();

            // look in 'controller' for first value. ucwords will capitalize first letter - Role Pascal
            if(isset($url[0]) && file_exists('../app/controller/' .ucwords($url[0]). 'Controller.php')) {
                // will set a new controller
                $this->currentController = ucwords($url[0]. 'Controller');
                unset($url[0]);
            }

            // require the controller
            require '../app/controller/' .$this->currentController. '.php';
            $this->currentController = new $this->currentController;

            // check for second part of the URL
            if(isset($url[1])){
                if(method_exists($this->currentController, $url[1])){
                    $this->currentMethod = $url[1];
                    unset($url[1]);
                }
            }

            // get parameters
            $this->params = $url ? array_values($url) : [];

            // call a callback with array of params
            call_user_func_array([$this->currentController, $this->currentMethod],
                $this->params);

        }

        public function getUrl()
        {
            if(isset($_GET['url'])){
                $url = rtrim($_GET['url'], '/');
                // allows you to filter variables as string/number
                $url = filter_var($url, FILTER_SANITIZE_URL);
                // breaking it into an array
                $url = explode('/', $url);
                return $url;
            }
        }
    }
?>