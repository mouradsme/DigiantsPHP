<?php 
    class Routes {
        protected $routes = [];
        protected $Routes = [];
        protected $Main;
        protected $Content;
        protected $Passed;
        protected $Stylesheets = array();
        protected $Scripts = array();
        protected $Default = 'home';
        protected $red;
        public function getDefault() {
            return $this->Default;
        }
        public function getRoutes() {
            return $this->Routes;
        }
        public function __construct($red, $default = 'home') {
            $this->red = $red;
            $this->Default = $default;
            return $this;
        }
        public function add($p, $Main, $content, $css, $function = null) {
            $this->routes[$p] = [$Main, $content, $function, $css];
            $this->Routes[] = $p;
            return $this;
        }
        public function create($v) {
            $red = $this->red;
            if ($red[0] && $v !== $red[1]) {
                $this->create($red[1]);
                return $this;
            }
            if (!in_array($v, $this->Routes)) $v = $this->Default;   
            $route          = $this->routes[$v];
            $this->Main     = $route[0];
            $this->Content  = $route[1]; 
            $this->Stylesheets = $route[3]['css'];
            $this->Scripts = $route[3]['js'];
            $route[2]();
            return;
            
        }
        public function Pass($key, $value) {
            $this->Passed[$key] = $value;
            return $this;
        }
        public function getMain() {
            return $this->Main;
        }
        public function getContent() {
            return $this->Content;
        }
        public function getPassed() {
            return $this->Passed;
        }
        public function getStylesheets() {
            return $this->Stylesheets;
        }
        public function getScripts() {
            return $this->Scripts;
        }
    }

?>