<?php

/**
* 
*/

require('BCSBaseApi_Class.php');

class BCSRecipeAPI extends BCSAPIClass
{




	function __construct($APIRootURL, $APIKEY) 
	{
		$this->APIKEY = $APIKEY;
		$this->APIRootURL = $APIRootURL;
	}

	public function  CourseBooklets($CourseID, $Week = '-1') {
		if ($Week == -1) {
			$apipath = '/{apikey}/course/{courseid}/booklets';	
			$APIFields = ['{courseid}' => $CourseID];
		} else {
			$apipath = '/{apikey}/course/{courseid}/booklets/week/{bookletweek}';	
			$APIFields = [	'{courseid}' => $CourseID,
										  '{bookletweek}' => $Week];			
		}
		return $this->CallAPI($apipath, $APIFields);

	}

	public function  RecipeSearch( $SearchString){
		$apipath = '/{apikey}/search/paths/{searchstring}';
		$APIFields = ['{searchstring}' => $SearchString];
		return $this->CallAPI($apipath, $APIFields);
	}

	public function RecipeSearch_ForStudent($SearchString, $BookingID) {

		$apipath = '/{apikey}/search/forstudent/{bookingid}/{searchstring}';
		$APIFields = ['{searchstring}' => $SearchString,
					  			'{bookingid}' => $BookingID	];
		
		return $this->CallAPI($apipath, $APIFields);
	}

	public function RecipeInfo($RecipeGUID){
		$apipath = '/{apikey}/recipe/infowithurls/{recipeguid}/000';
		$fields = ['{recipeguid}'=> $RecipeGUID];
		return $this->CallAPI($apipath,$fields );
	}

	public function UpdateList($ListID, $Updates){
		$apipath = '/{apikey}/lists/{listid}/set';
		$fields = ['{listid}' => $ListID];
		$PostData = $Updates;  //currently only CourseID is set.
		echo $apipath;print_r($PostData);
		return $this->CallAPI($apipath, $fields, $PostData);

	}



	


}