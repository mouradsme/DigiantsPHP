<?php
    class Settings {
        protected $settings;
        public function __construct() {
                $this->settings = array(
                    "links" => array(
                        "icons" => false,
                        "text" => true
                    )
                );
            return $this;
        }
        public function select($option) {
            $this->option = $option;
            return $this;
        }
        public function set($parameter, $value) {
            $option = $this->option;
            $this->settings[$option][$parameter] = $value;
            return $this;
        }
        public function get($parameter) {
            return $this->settings[$this->option][$parameter];
        }
        public function getSettings() {
            return $this->settings;
        }
    }

    ?>