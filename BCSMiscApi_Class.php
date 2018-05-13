<?php

require_once('BCSBaseApi_Class.php');

class BCSMiscAPI extends BCSAPIClass
{

    function __construct($APIRootURL, $APIKEY) 
    {
        $this->APIKEY = $APIKEY;
        $this->APIRootURL = $APIRootURL;
    }

    public function  GetKeyValue($key) {

         $apipath =   '/{apikey}/keyvalue/get/{key}';
         $APIFields = ['{key}' => $key];
         return $this->CallAPI($apipath, $APIFields);
    }

    public function SetKeyValue($key,$data) {
         $apipath =   '/{apikey}/keyvalue/set/{key}';
         $APIFields = ['{key}' => $key];
         return $this->CallAPI($apipath, $APIFields, ['info' => $data]);  
    }
}