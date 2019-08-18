<?php

require_once('BCSBaseApi_Class.php');

class BCSDemoPhotoAPI extends BCSAPIClass
{
    function __construct($APIRootURL) 
    {
        $this->APIRootURL = $APIRootURL;
    }

    // This function needs to be deleted, it is named wrong, it doesnt
    // return images it returns galleries
    public function  AllImages() {

         $apipath =   '/all';

         $res = $this->CallAPI($apipath);

         $res['depreciated_message'] = 'calls to function AllImages() will be removed.  Does not return Images';
         return $res;
    }

    // Return all Galleries from PhotoaPI.  Should be cached so fast.
    public function  AllGalleries() {

         $apipath =   '/all';
         return $this->CallAPI($apipath);
    }


    // Returns 1 random image from all galleries and all images.
    public function RandomImage() {
         $apipath =   '/images/random/';
         return $this->CallAPI($apipath);
    }


    public function DemoPhotosInfo($DemoDate, $cached = true){
        if ($cached){
            $apipath = '/gallery/{demodate}';
        } else {
            $apipath = '/gallery/{demodate}/nocache';
        }

        $Fields = ['{demodate}' => $DemoDate];
         return $this->CallAPI($apipath, $Fields);
    }

    public function PurgeCache() {
         $apipath =   '/purgecache/';
         return $this->CallAPI($apipath);
    }
}

