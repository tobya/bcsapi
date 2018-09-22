<?php
include_once('env.php');
include_once('../BCSDemoPhotoApi_Class.php');


$BCSDemoPHotos = new BCSDemoPhotoAPI($DemoPhotoAPIURL);

echo '<PRE>';
$AllImages = $BCSDemoPHotos->AllImages();

echo "<li> AllImages Count: " . (count($AllImages['AllItems']) );

$OneDemoDate = '20180612';
$OneDemo = $BCSDemoPHotos->DemoPhotosInfo($OneDemoDate);

$OneDemoGallery =$OneDemo['gallery'];
$Image_0 = $OneDemo['images'][0];
echo "
<LI> Getting Info for :  $OneDemoDate 
<LI> $OneDemoGallery[FolderName]
<li> Image Count: $OneDemo[images_count]
<li> Image 1 : <img src='$Image_0[src]' >

";


