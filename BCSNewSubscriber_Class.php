<?php

require_once('BCSBaseApi_Class.php');

class BCSNewSubscriberAPI extends BCSAPIClass
{

	 function __construct($APIRootURL, $APIKEY) 
    {
        $this->APIKEY = $APIKEY;
        $this->APIRootURL = $APIRootURL;
    }

	// I think passing the user data here as array works
	public  function findOrAddUser(Array $user_data)
	{
		$APIPath = '/{apikey}/individual/findorcreate?email={email}&firstname={firstname}&lastname={lastname}';
         
		$email = $user_data['email'];
		$firstname = $user_data['firstName'];
		$lastname = $user_data['lastName']; 

        $APIFields = ['{email}' => $email, '{firstname}' => $firstname,'{lastname}' => $lastname];

        return $this->CallAPI($APIPath, $APIFields);
		
	}

  public function CreateBooking($IndividualID, $CourseID)
  {
    $APIPath = '/{apikey}/individual/{individualid}/bookings/create?courseid={courseid}';
          $APIFields = ['{individualid}' => $IndividualID, '{courseid}' => $CourseID];

        return $this->CallAPI($APIPath, $APIFields);  
  }

  public function createPayment($paymentData,$bookingID)
  { 
          $APIPath = '/{apikey}/bookings/{bookingid}/payment/create';
          $APIFields = ['{bookingid}' => $bookingID]; 
          // I think maybe I can just pass this straight through!
          $paymentPostData = ['paymenttype' => $paymentData['paymenttype'], 'amount' => $paymentData['amount'],'comments' => $paymentData['comments']];

        return $this->CallAPI($APIPath, $APIFields, $paymentPostData);  
  }

    public function createPayout($payoutData,$bookingID)
  { 
          $APIPath = '/{apikey}/bookings/{bookingid}/payout/create';
          $APIFields = ['{bookingid}' => $bookingID]; 
          // I think maybe I can just pass this straight through!
          $payoutPostData = ['payouttype' => $payoutData['payouttype'], 'amount' => $payoutData['amount'],'expected_by' => $payoutData['expected_by'] ,['payout_id' => $payoutData['payout_id']];

        return $this->CallAPI($APIPath, $APIFields, $paymentPostData);  
  } 

}