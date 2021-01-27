<?php
require_once('BCSBaseApi_Class.php');

class BCSLaravelStudentAPI extends BCSAPIClass
{
        function __construct($APIRootURL, $APIKEY)
    {
        parent::__construct($APIRootURL, $APIKEY, false);

    }

    Public function ActivateBooking($BookingID){

         $apipath =   '/api/v3/subscriptions/booking/{bookingid}/activate';
         $APIFields = ['{bookingid}' => $BookingID];
         return $this->CallAPI($apipath, $APIFields);
    }



    public function SubscriptionCourseInfo($subscriptioncourseid){

      //   https://bkoffice.azure.cookingisfun.ie/api/v3/subscriptions/subscribercourse/8
         $apipath =   '/api/v3/subscriptions/subscribercourse/{subscribercourseid}';
         $APIFields = ['{subscribercourseid}' => $subscriptioncourseid];
         return $this->CallAPI($apipath, $APIFields);
    }

    public function SubscriberDetails($IndividualID){
        $apipath =  '/api/v3/subscriber/details/{individualid}';
        $APIFields = ['{individualid}' => $IndividualID];
        return $this->CallAPI($apipath,$APIFields);
        }


}
