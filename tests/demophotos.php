<?php
include_once('env.php');
include_once('../BCSDemoPhotoApi_Class.php');



$BCSDemoPHotos = new BCSDemoPhotoAPI($DemoPhotoAPIURL);

echo '<PRE>';
$AllGalleries = $BCSDemoPHotos->AllGalleries();
//print_r($AllGalleries);
$RecentGallery = $AllGalleries['recent']['mostrecent'];

echo "<li> AllGalleries Count: " . $AllGalleries['allitems_count'] ;

$OneDemoDate = '20180612';
$OneDemo = $BCSDemoPHotos->DemoPhotosInfo($OneDemoDate);
//print_r($OneDemo);
$OneDemoGallery =$OneDemo['gallery'];
$Image_0 = $OneDemo['images'][0];
echo "
<LI> Getting Info for :  $OneDemoDate 
<LI> $OneDemoGallery[FolderName]
<li> Image Count: $OneDemo[images_count]
<li> Image 1 : <img src='$Image_0[src]' >
<li> Most Recent Gallery : $RecentGallery[FolderName]
";

$RandomImage = $BCSDemoPHotos->RandomImage();

$img = $RandomImage['randomimage'];
echo "
<h3>Random Image </h3> 
<img src=\"$img[src]\" >
";


