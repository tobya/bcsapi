<?php

require_once('BCSBaseApi_Class.php');

class BCSDemoPhotoAPI extends BCSAPIClass
{
    function __construct($APIRootURL) 
    {
        $this->APIRootURL = $APIRootURL;
    }

    public function  AllImages() {

         $apipath =   '/all';
         return $this->CallAPI($apipath);
    }

    public function DemoPhotosInfo($DemoDate){
        $apipath = '/gallery/{demodate}';
        $Fields = ['{demodate}' => $DemoDate];
         return $this->CallAPI($apipath, $Fields);

    }
}

/*


$router->get('/all', 'photoController@AllPhotoInfo');
$router->get('/images/', 'photoController@GalleryAlbum');
$router->get('/gallery/{demodate}', 'photoController@GalleryAlbum');
$router->get('/gallery/{demodate}/html/{template}', 'photoController@HTMLGalleryAlbum');
*/