<?php 
    class Utility { 
        function getTable($start, $end, $objPHPExcel) {
            $foundInCells = array();
            $Bill = array();
            $Start = false;
            $End = false;
            foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {

                foreach ($worksheet->getRowIterator() as $row) {
                    $cellIterator = $row->getCellIterator();
                    $cellIterator->setIterateOnlyExistingCells(true);
                    $cells = [];
                    foreach ($cellIterator as $cell) {
                        if ($cell->getValue() == $start ) $Start = true;
                        if ($cell->getValue() == $end ) $End = true;
                        $cells[] = "@".$cell->getCoordinate()."@".$cell->getValue(); 
                    }
                    if ($Start) 
                        $Bill[] = $cells;
                    if ($End)
                        break;
                }
                if ($End)
                    break;
            }
            $rBill = [];
            for ($i = 1; $i < sizeof($Bill)-1; $i++) {
                if (!empty(preg_replace("/@([A-Z][0-9]*)@/i", "", $Bill[$i][1])))
                {
                    preg_match("/@([A-Z][0-9]*)@/i", $Bill[$i][4], $m);
                $coord = $m[1];
                    $rBill[] = array(
                        "name" => preg_replace("/@([A-Z][0-9]*)@/i", "", $Bill[$i][1]),
                        "qty" => preg_replace("/@([A-Z][0-9]*)@/i", "", $Bill[$i][3]),
                        "price" => preg_replace("/@([A-Z][0-9]*)@/i", "", $Bill[$i][4]),
                        "coord" => $coord
                    );
                }
            }
            return $rBill;
        }
        function _validate($valid, $invalid, $val, $filter, $min = null, $max = null) {
            return ($this->validate($val, $filter, $min, $max)?$valid:$invalid);
        }
        function validate($val, $filter, $min = null, $max = null) {
            $val = trim ($val);
            if ($filter == "phone_s") {
                $phoneUtil = \libphonenumber\PhoneNumberUtil::getInstance();
                try {
                    $NumberProto = $phoneUtil->parse($val);
                    return $phoneUtil->isValidNumber($NumberProto);

                } catch (\libphonenumber\NumberParseException $e) {
                    return false;
                }
            } else {
            $patterns = array(
                "email" => "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i",
                "phone" => "/^(\+[213]|00213|213|0)?(4|5|6|7)[0-9]*$/",
                "date" => "/^(0?[1-9]|[1-2][0-9]|3[0-1])\/(0?[1-9]|1[0-2])\/[0-9]{4}$/",
                "number" => "/^[0-9]*$/",
                "name" => "/^[a-z\-\s]*$/i"
            );

            if (!empty($val)) {
              $valLength = strlen($val);
              if ($min !== null)
                if ($valLength < $min)
                    return false;
                if ($max !== null)
                 if ($valLength > $max)
                 return false;

                if (!preg_match($patterns[$filter], $val)) 
                return false;
                
            } else {
              return false;
            }
            return true;
            }
            return false;
          }
        public function preprocessArray($Array) {
            $array = array();
            foreach($Array as $key => $value) {
                $Key = preg_replace("/[^a-zA-Z0-9_]/", "", $key);
                $array[$Key] = $value;
            }
            return $array;
        }
        public function reformatDate($date, $del = '/' ) {
            $date = preg_split("#\s#", $date);
            $o = @$date[1]?@" ".$date[1]:"";
            $date = preg_split("#\-#", $date[0]);
            return join($del, [$date[2], $date[1], $date[0]]). $o; 
        }
        public function getLang($str) {
            global $Lang; 
            $str = preg_split("#\.#", $str);
            $expression = "";
            foreach ($str as $k => $v) {
                $expression .= "['$v']";
            }
            $expression = '$Lang' . $expression . ";";
            eval('$result = '.$expression);
            return $result;
        }
        public function uploadFile($filename, $valid_extensions = [], $prefix = '', $location = "uploads/") {
            $location = ( $location ) ?  $location : "uploads/";
            $Location = $location;
            $location = $location . $filename;
            $fileType = pathinfo($location,PATHINFO_EXTENSION);
            $fileType = strtolower($fileType);
            $response = null;
            $Generate = new Generate();
            $imageId = $Generate->prefix($prefix)->generate(20);
            if(in_array(strtolower($fileType), $valid_extensions)) {
                $newLocation = $Location .  $imageId . "." . $fileType;
               if(move_uploaded_file($_FILES['file']['tmp_name'], $newLocation)){
                  $response = $newLocation;
               }
            }
            return $response;
        } 
        public function deleteFile($file) {
            unset($file);
            return $this;
        }
    }

?>