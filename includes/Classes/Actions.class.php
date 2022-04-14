<?php 

class Actions {
    protected $actions = [];
    protected $Actions = [];
    public function __construct() {
        return $this;
    }
    public function add($a, $function = null, $vals = []) {
        $this->actions[$a] = [$function, $vals];
        $this->Actions[] = $a;
        return $this;
    }
    public function create($v) {
      
        if (in_array($v, $this->Actions)) {
            $action = $this->actions[$v];
            $Result = $action[0](...$action[1]);
        }
        echo json_encode(array("status" => $Result['status'], "message" => $Result['message']));
    }
}

?>