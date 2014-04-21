<?php

namespace Kindrid;

class Kindrid {
    const VERSION = '0.1.0';
    // const BASE_URI = "https://kindrid.com/api/v1";
    const BASE_URI = "http://172.17.8.1/api/v1";
    public $api_key = null;
    public $api_secret = null;

    public function __constuct($api_key, $api_secret) {
        $this->api_key = $api_key;
        $this->api_secret = $api_secret;
    }

    public function donations($limit=null, $skip=null) {
        $response = \Httpful\Request::get(Kindrid::BASE_URI.'/donations')
        ->authenticateWith($this->api_key, $this->api_secret)
        ->send();
        echo $response->body->result;
        return $response;
    }

    public function donation($id=null) {

    }

    public function donors($limit=null, $skip=null) {
        
    }
}