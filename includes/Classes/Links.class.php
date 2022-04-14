<?php 
    class Links {
        protected $links = [];
        protected $id;
        public function __construct() { 
            global $links;
            $this->links = $links;
        }
        public function select($id) {
            $this->id = $id;
            return $this;
        }
        public function create( $link ) {
            if (!isset($link[4])) $link[4] = false;
            $Link = [
                "id"    => $link[0],
                "title" => $link[1],
                "icon"  => $link[2],
                "perm"  => $link[3],
                "is_anchor" => $link[4],
                "action" => @$link[5]
            ];
            if ($this->id != null)
                $this->links[$this->id][] = $Link;
            else $this->links[] = $Link;
            return $this;
        }

        public function getLinks() { 
            return $this->links;
        }
    }

?>