<?php

class BCSAPIClass {
    protected $APIKEY = '';
    protected $APIRootURL = '';
    protected $LastCalledURL = '';
    public $JSONAsArray = true;

    function __construct($APIRootURL, $APIKEY, $AsArray = true) 
    {
        $this->APIKEY = $APIKEY;
        $this->APIRootURL = $APIRootURL;
        $this->JSONAsArray = $AsArray;
    }

    protected function Replacer($apipath, $pathfields) {

        // all requests that have {apikey} in path should have it replaced
        // add it to list of fields to be replaced
        if (isset($this->APIKEY)){
            $pathfields['{apikey}'] = $this->APIKEY;
        }

        foreach ($pathfields as $key => $value) {
            $value = urlencode($value);
            $apipath =  str_replace("$key", $value, $apipath);
        }
        return $apipath;
    }

    protected function CallAPI($APIPath, $APIFields = [], $PostData = []) {
        $UrlBlock = $this->Replacer($APIPath, $APIFields);
        return $this->CallURL($UrlBlock, $PostData);
    }

    protected function CallURL($UrlBlock, $PostData = []) {
        $url = $this->BuildURLString($UrlBlock);
        //echo $url;
        $this->LastCalledURL = $url;
        // Only call POST when required.
        if (!empty($PostData)){
            return $this->POSTCURL($url, $PostData);
        } else {

            /*
                  $Info = json_decode( file_get_contents($url),$this->JSONAsArray);
            if ($this->JSONAsArray){                
            $Info['url'] = $url;
            } else {
            $Info->url = $url;
            }

            */
            $a = file_get_contents($url);
          
            $Info = json_decode($a,$this->JSONAsArray);
          
             if ($this->JSONAsArray){  

            if (is_null( $Info)) { // json decode error
               // echo 'Info is empty';
                $Info = [];
                $Info['jsonerror'] = json_last_error();
                $Info['jsonerrormsg'] = json_last_error_msg();
            } 
          
            $Info['url'] = $url;
                } else {

                    if (is_null( $Info)) { // json decode error
                       // echo 'Info is empty';
                        
                        $Info->jsonerror = json_last_error();
                        $Info->jsonerrormsg = json_last_error_msg();
                    } 
                  
                    $Info->url = $url;
                }
            
            return $Info;
        } 
                
    }

    protected function POSTCURL($UrlBlock,$PostData){

        $datastring = '';
        foreach ($PostData as $key => $value) {
            $datastring .= "$key=" . urlencode($value) . '&';
        }
        $ch = curl_init( $UrlBlock );
        curl_setopt( $ch, CURLOPT_POST, 1);
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $datastring);
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt( $ch, CURLOPT_HEADER, 0);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        //print_R( curl_error($ch));
        $response = curl_exec( $ch );
        //print_R( curl_error($ch));
        return $response;        
    }



    protected function BuildURLString($UrlBlock){

        return $this->APIRootURL .   $UrlBlock;
    }

    public function LastURL()  {
        return $this->LastCalledURL;
    }
}
