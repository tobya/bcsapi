<?php

include_once('env.php');
include_once('../BCSRecipeBrowseApi_Class.php');
include_once('https://cdn.rawgit.com/tobya/pprint_r/master/pprint_r.php');

$BCSRecipeBAPI = new BCSRecipeBrowseAPI($RecipeAPIURL, $RecipeAPIKEY);

$Path = isset($_GET['path'])?$_GET['path']:'Lists\Courses\2018\\';
$PathID = isset($_GET['pathid'])?$_GET['pathid']:0;



$PathInfo = $BCSRecipeBAPI->BrowsePath($Path);

if ($PathID > 0){
  $BCSRecipeAPI = new BCSRecipeAPI($RecipeAPIURL, $RecipeAPIKEY);

  $PathInfo  = $BCSRecipeAPI->PathByPathID($PathID);
}

foreach ($PathInfo['nextpath'] as $key => &$P) {
  # code...
  $url = "https://backoffice.cookingisfun.ie/vendor/tobya/bcsapi/tests/recipebrowse.php?path=" . urlencode($P['Path']);
  $PathInfo['nextpath'][$key]['url'] = $url;
  echo " <a href='$url'>$url</a>  <BR><li>\n";
}

preprint_r($PathInfo);

