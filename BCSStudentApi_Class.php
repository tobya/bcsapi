<?php

require_once('BCSBaseApi_Class.php');

class BCSStudentAPI extends BCSAPIClass
{
        


    public function  BookingInfo($bookingid) {

         $apipath =   '/{apikey}/booking/{bookingid}';
         $APIFields = ['{bookingid}' => $bookingid];
         return $this->CallAPI($apipath, $APIFields);
    }

    public function DutyInfo($bookingid, $week){

         $apipath =   '/{apikey}/booking/{bookingid}/rota/week/{week}/details';
         $APIFields = ['{bookingid}' => $bookingid,'{week}' => $week ];
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

    
    public  function findOrAddUserbyEmail($email, $firstname, $lastname)
    {
        $APIPath = '/{apikey}/individual/findorcreate';

        $PostData = ['email' => $email, 'firstname' => $firstname,'lastname' => $lastname];
        
        return $this->CallAPI($APIPath, [], $PostData);
        
    }    

    public function CreateBooking($IndividualID, $CourseID)  {
            $APIPath = '/{apikey}/individual/{individualid}/bookings/create';
            $APIFields = ['{individualid}' => $IndividualID];
            $PostData = ['courseid' => $CourseID];
            return $this->CallAPI($APIPath, $APIFields,$PostData);  
  

      }

      /*
    Apply payment transactions to a Booking.
    Named functions for most common types, here we have a Stripe Payment.
       */

  public function createStripePayment($BookingID, $AmountasFloat, $Comments)  { 
    return $this->CreatePayment($BookingID, $AmountasFloat, $Comments, 'StripeCreditCard');
  }


  public function CreatePayment($BookingID, $AmountasFloat, $Comments, $PaymentType){
          $APIPath = '/{apikey}/bookings/{bookingid}/payment/create';
          $APIFields = ['{bookingid}' => $BookingID]; 

          // I think maybe I can just pass this straight through!
          $paymentPostData = ['paymenttype' => $PaymentType, 'amount' => $AmountasFloat, 'comments' => $Comments];

            return $this->CallAPI($APIPath, $APIFields, $paymentPostData);  
  }      
  

    public function AuthKeyLogin($authkey) {
         $apipath =   '/{apikey}/individual/remotelogin/{authkey}';
         $APIFields = ['{authkey}' => $authkey];
         return $this->CallAPI($apipath, $APIFields);      
    }
}
