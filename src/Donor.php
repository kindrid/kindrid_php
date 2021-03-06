<?php

namespace Kindrid;

class Donor {

    public $city    = null;
    public $name    = null;
    public $zip     = null;
    public $tags    = array();
    public $id      = null;
    public $phone   = null;
    public $state   = null;
    public $address = null;
    public $email   = null;

    function __construct($data=null, $con=null) {
        $this->_con = $con;
        if(is_object($data)) {
            foreach($data as $k=>$v) {
                if(property_exists($this, $k)) $this->$k = $v;
            }
        }
    }

    public function __get($key) {
        switch ($key) {
            case 'tags':
                if(!$this->id) return null;
                return $this->_con->tags($this->id);
        }
    }
}