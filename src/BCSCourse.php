<?php
namespace BCS\BCSApi;

use BCS\BCSApi\BCSBase

class BCSCourse extends BCSBase
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

    public function AllCourseDates($courseid) {
        $apipath =   '/{apikey}/course/{courseid}/dates';
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




    //---------------------------------------------------------------

    // Given a Course and a Week Day combination - will return the date.
    function CourseWeekDate($CourseID, $Week, $DayofWeek){
        $Dates = $this->AllCourseDates($CourseID) ;

        foreach ($Dates['days'] as $key => $D) {
            # code...
            if ($D['week'] == $Week){
                if ($D['Day'] == $DayofWeek){
                    return $D['Date'];
                }
            }
        }
        return false;

    }


}
