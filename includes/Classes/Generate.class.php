<?php 

class Generate {
    protected $prefix = '';
    protected $characters = '';
    public function __construct() {
        $this->characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return $this;
    }
    public function prefix($prefix) {
        $this->prefix = $prefix;
        return $this;
    }
    public function characters($characters) {
        $this->characters = $characters;
    }
    public function generate($length) {
        $chars = $this->characters; 
        $str = '';
        for ($i=0; $i<$length; $i++)
            $str .= $chars[rand(0, strlen($chars)-1)];
        return $this->prefix . $str;
    }

}
?>