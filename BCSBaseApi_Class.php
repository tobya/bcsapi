<?php

class BCSAPIClass {
    protected $APIKEY = '';
    protected $APIRootURL = '';

    protected function Replacer($apipath, $pathfields) {

        //all requests tha thave {apikey} in path should have it replaced
        if (isset($this->APIKEY)){
            $pathfields['{apikey}'] = $this->APIKEY;
        }

        foreach ($pathfields as $key => $value) {
            $value = urlencode($value);
            $apipath =  str_replace("$key", $value, $apipath);
        }
        return $apipath;
    }

    protected function CallAPI($APIPath, $APIFields, $PostData = []) {
        $UrlBlock = $this->Replacer($APIPath, $APIFields);
        return $this->CallURL($UrlBlock, $PostData);
    }

    protected function CallURL($UrlBlock, $PostData = []) {
        $url = $this->BuildURLString($UrlBlock);

        if (!empty($PostData)){
        
            return $this->POSTCURL($url, $PostData);
        } else {
            $Info = json_decode( file_get_contents($url),true);
            $Info['url'] = $url;
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
}