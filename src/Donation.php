<?php

namespace Kindrid;

class Donation {
    public $status      = null;
    public $designation = null;
    public $number      = null;
    public $amount      = null;
    public $donor_id    = null;
    public $date        = null;
    public $id          = null;
    private $_con       = null;

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
            case 'donor':
                if(!$this->donor_id) return null;
                return $this->_con->donor($this->donor_id);
        }
    }
}