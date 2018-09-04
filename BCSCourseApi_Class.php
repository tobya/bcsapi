<?php

require_once('BCSBaseApi_Class.php');

class BCSCourseAPI extends BCSAPIClass
{

    function __construct($APIRootURL, $APIKEY) 
    {
        $this->APIKEY = $APIKEY;
        $this->APIRootURL = $APIRootURL;
    }

    public function  CourseInfo($courseid) {

         $apipath =   '/{apikey}/course/{courseid}';
         $APIFields = ['{courseid}' => $courseid];
         return $this->CallAPI($apipath, $APIFields);
    }

    public function CourseBookings($courseid) {
        
         $apipath =   '/{apikey}/course/{courseid}/bookings';
         $APIFields = [ '{courseid}' => $courseid];
         return $this->CallAPI($apipath, $APIFields);
    }

    public function CourseDescription($courseid) {
        $apipath =   '/{apikey}/course/{courseid}/description';
        $APIFields = [ '{courseid}' => $courseid];
        return $this->CallAPI($apipath, $APIFields);  
    }

    public function RunningCourses($onDate = 'today', $coursetypes = '0,1') {
        
         $apipath =   '/{apikey}/courses/running/{coursedate}/{coursetypes}';
         $APIFields = [ '{coursedate}' => $onDate,
                        '{coursetypes}' => $coursetypes];
         return $this->CallAPI($apipath, $APIFields);
    }

    public function AllRunningEvents($onDate = 'today') {
        return $this->RunningCourses($onDate, 'All');
    }

}
