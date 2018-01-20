<?php

require_once('BCSBaseApi_Class.php');

class BCSStudentAPI extends BCSAPIClass
{

    function __construct($APIRootURL, $APIKEY) 
    {
        $this->APIKEY = $APIKEY;
        $this->APIRootURL = $APIRootURL;
    }

    public function  BookingInfo($bookingid) {

         $apipath =   '/{apikey}/booking/{bookingid}';
         $APIFields = ['{bookingid}' => $bookingid];
         return $this->CallAPI($apipath, $APIFields);
    }

    public function StudentInfo($individualid) {
         $apipath =   '/{apikey}/individual/{individualid}';
         $APIFields = ['{individualid}' => $individualid];
         return $this->CallAPI($apipath, $APIFields);   
    }
}