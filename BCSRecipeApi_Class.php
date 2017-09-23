<?php

/**
* 
*/

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
			$apipath =	str_replace("$key", $value, $apipath);
		}
		return $apipath;
	}
}

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



	private function CallAPI($APIPath, $APIFields, $PostData = []) {
		$UrlBlock = $this->Replacer($APIPath, $APIFields);
		return $this->CallURL($UrlBlock, $PostData);
	}

	private function CallURL($UrlBlock, $PostData = []) {
		$url = $this->BuildURLString($UrlBlock);

		if (!empty($PostData)){
		
			return $this->POSTCURL($url, $PostData);
		} else {
			$Info = json_decode( file_get_contents($url),true);
			$Info['url'] = $url;
			return $Info;
		} 
				
	}

	private function POSTCURL($UrlBlock,$PostData){

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
		print_R( curl_error($ch));
		$response = curl_exec( $ch );
		print_R( curl_error($ch));
		return $response;		 
	}

	private function BuildURLString($UrlBlock){

		return $this->APIRootURL .   $UrlBlock;
	}


}