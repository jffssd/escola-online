<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Parse {

        public function array_to_array_int($array)
        {
            $array_int = array();
            foreach($array as $ar) {
                array_push($array_int, intval($ar));
            }
            return $array_int;
        }
}