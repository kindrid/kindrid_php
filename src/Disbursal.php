<?php

namespace Kindrid;

class Disbursal {
    public $status       = null;
    public $gross_amount = null;
    public $fees         = null;
    public $date         = null;
    public $net_amount   = null;
    public $id           = null;
    private $_con        = null;

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
            case 'donations':
                if(!$this->id) return null;
                return $this->_con->disbursal_donations($this->id);
        }
    }
}