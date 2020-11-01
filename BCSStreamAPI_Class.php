<?php 
require_once('BCSBaseApi_Class.php');

class BCSStreamAPI extends BCSAPIClass
{
  public function CanView($StreamID, $IndividualID){
       $apipath =   '/{apikey}/stream/{streamid}/canview/{individualid}';
         $APIFields = ['{streamid}' => $StreamID. '{individualid}' => $IndividualID];
         return $this->CallAPI($apipath, $APIFields);
  }
}