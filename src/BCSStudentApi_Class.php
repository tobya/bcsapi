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

    public function  StudentBookings($individualid) {
         $apipath =   '/{apikey}/individual/{individualid}/bookings';
         $APIFields = ['{individualid}' => $individualid];
         return $this->CallAPI($apipath, $APIFields);   
    }

    public function StudentInfoByID($individualid) {
         $apipath =   '/{apikey}/individual/exists/id/{individualid}';
         $APIFields = ['{individualid}' => $individualid];
         return $this->CallAPI($apipath, $APIFields);   
    }
    public function StudentInfo($individualid) {
         $apipath =   '/{apikey}/individual/{individualid}';
         $APIFields = ['{individualid}' => $individualid];
         return $this->CallAPI($apipath, $APIFields);   
    }
    
    public function StudentLogin($email, $passwordhash) {
         $apipath =   '/{apikey}/individual/exists/{email}/{passwordhash}';
         $APIFields = ['{email}' => $email, '{passwordhash}' => $passwordhash];
         return $this->CallAPI($apipath, $APIFields);   
    }

  

    public function AuthKeyLogin($authkey) {
         $apipath =   '/{apikey}/individual/remotelogin/{authkey}';
         $APIFields = ['{authkey}' => $authkey];
         return $this->CallAPI($apipath, $APIFields);      
    }
}
