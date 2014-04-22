<?php

namespace Kindrid;

class Kindrid {
    const VERSION = '0.1.0';
    // const BASE_URI = "https://kindrid.com/api/v1";
    const BASE_URI = "http://172.17.8.1:8087/api/v1";
    public $api_key = null;
    public $api_secret = null;

    public function __construct($api_key, $api_secret) {
        $this->api_key = $api_key;
        $this->api_secret = $api_secret;
    }

    public function donations($limit=null, $skip=null) {
        $args = array();
        if($limit !== null) $args['limit'] = $limit;
        if($skip !== null) $args['skip'] = $skip;
        $uri = $this->_build_query('/donations', $args);
        $response = \Httpful\Request::get($uri)
        ->authenticateWith($this->api_key, $this->api_secret)
        ->send();
        $out = array();
        $tmp = $this->_handle_response($response);
        foreach($tmp as $a) {
            $d = new \Kindrid\Donation($a, $this);
            $out[] = $d;
        }
        return $out;
    }

    public function donation($id=null) {
        $uri = $this->_build_query('/donations/'.urlencode($id));
        $response = \Httpful\Request::get($uri)
        ->authenticateWith($this->api_key, $this->api_secret)
        ->send();
        $out = array();
        $tmp = $this->_handle_response($response);
        if(count($tmp)) {
            return new \Kindrid\Donation($tmp[0], $this);
        }
        throw new \Exception("Donation not found");
    }

    public function donors($limit=null, $skip=null) {
        $args = array();
        if($limit !== null) $args['limit'] = $limit;
        if($skip !== null) $args['skip'] = $skip;
        $uri = $this->_build_query('/donors', $args);
        $response = \Httpful\Request::get($uri)
        ->authenticateWith($this->api_key, $this->api_secret)
        ->send();
        $out = array();
        $tmp = $this->_handle_response($response);
        foreach($tmp as $a) {
            $d = new \Kindrid\Donor($a, $this);
            $out[] = $d;
        }
        return $out;
    }

    public function donor($id=null) {
        $uri = $this->_build_query('/donors/'.urlencode($id));
        $response = \Httpful\Request::get($uri)
        ->authenticateWith($this->api_key, $this->api_secret)
        ->send();
        $out = array();
        $tmp = $this->_handle_response($response);
        if(count($tmp)) {
            return new \Kindrid\Donor($tmp[0], $this);
        }
        throw new \Exception("Donor not found");
    }

    public function disbursals($limit=null, $skip=null) {
        $args = array();
        if($limit !== null) $args['limit'] = $limit;
        if($skip !== null) $args['skip'] = $skip;
        $uri = $this->_build_query('/disbursals', $args);
        $response = \Httpful\Request::get($uri)
        ->authenticateWith($this->api_key, $this->api_secret)
        ->send();
        $out = array();
        $tmp = $this->_handle_response($response);
        foreach($tmp as $a) {
            $d = new \Kindrid\Disbursal($a, $this);
            $out[] = $d;
        }
        return $out;
    }

    public function disbursal($id=null) {
        $uri = $this->_build_query('/disbursals/'.urlencode($id));
        $response = \Httpful\Request::get($uri)
        ->authenticateWith($this->api_key, $this->api_secret)
        ->send();
        $out = array();
        $tmp = $this->_handle_response($response);
        if(count($tmp)) {
            return new \Kindrid\Disbursal($tmp[0], $this);
        }
        throw new \Exception("Disbursal not found");
    }

    public function disbursal_donations($id=null) {
        $uri = $this->_build_query('/disbursals/'.urlencode($id).'/donations');
        $response = \Httpful\Request::get($uri)
        ->authenticateWith($this->api_key, $this->api_secret)
        ->send();
        $out = array();
        $tmp = $this->_handle_response($response);
        foreach($tmp as $a) {
            $d = new \Kindrid\Donation($a, $this);
            $out[] = $d;
        }
        return $out;
    }

    public function tags($id=null) {
        $uri = $this->_build_query('/donors/'.urlencode($id).'/tags');
        $response = \Httpful\Request::get($uri)
        ->authenticateWith($this->api_key, $this->api_secret)
        ->send();
        $out = array();
        $tmp = $this->_handle_response($response);
        return $tmp;
    }

    private function _build_query($url, $args=null) {
        $argparts = array();
        $argstring = '';
        if(is_array($args)) {
            foreach($args as $k=>$v) {
                $argparts[] = urlencode($k).'='.urlencode($v);
            }
        }
        if(count($argparts)) $argstring = '?'.implode('&', $argparts);
        if(substr($url, 0, 1) != '/') $url = '/'.$url;
        return Kindrid::BASE_URI.$url.$argstring;
    }

    private function _handle_response($response) {
        if($response->code != 200) {
            if(isset($response->body->error)) {
                $error = $response->body->error;
            }else{
                $error = "Unknown Error";
            }
            throw new \Exception($error, $response->code);   
        }
        return $response->body->results;
    }
}