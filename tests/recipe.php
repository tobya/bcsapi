<?php

include_once('env.php');
include_once('../BCSRecipeApi_Class.php');
include_once('https://cdn.rawgit.com/tobya/pprint_r/master/pprint_r.php');

$BCSRecipeAPI = new BCSRecipeAPI($RecipeAPIURL, $RecipeAPIKEY);

$PathInfo = $BCSRecipeAPI->PathInfoByPath('Lists\Courses\2018\12 Week Jan');



$Output['RecipeAPIURL'] = $RecipeAPIURL;

$Output['PathInfo'] = $PathInfo['list']['Path'];
$Output['PathInfoID'] = $PathInfo['list']['PathID'];

//$Booklets = $BCSRecipeAPI->BookletsByPath($PathInfo['list']['PathID'], 2);
$Booklets = $BCSRecipeAPI->BookletsByPath($PathInfo['list']['PathID']);
//$app->get('/{apikey}/lists/{pathid}/booklets/week/{bookletweek}','BookletController@coursebookletsforweek') ;
//print_r($Booklets);
$Output['Booklets Details - Shown Here:'] = "<PRE>" . print_r($Booklets['Booklets'][6],true) . "</PRE>"; 
$PDFUrl = $Booklets['Booklets'][6]['url'];
$Output['Booklet Link'] = "<a href='$PDFUrl'>Booklet PDF </a>";


$SearchString = 'Cheese Tart';
$RecipeSearch = $BCSRecipeAPI->RecipeSearch($SearchString);

$Output['Search String'] = $SearchString;
$FirstRecipe = current($RecipeSearch['recipes']);
$Output['Recipe Search Title Found'] = $FirstRecipe['DocumentTitle'];
$Output['Recipe Search PDF Link'] = "<a href='$FirstRecipe[url_pdf]'>View PDF</a>"; 


$RecipeLists = $BCSRecipeAPI->RecipeLists_ForCourseSelection(2017,'long');
//preprint_R($RecipeLists);
$Output['Long Courses in 2017'] = $RecipeLists['paths'][0]['Path'];


$RecipeSearchStudent = $BCSRecipeAPI->RecipeSearch_ForStudent('Sandwich','28796-53610');
//preprint_R($RecipeSearchStudent);
$Link = $RecipeSearchStudent['recipes'][0]['url_pdf'];
$Output['Search for Recipe Toby Allen'] = "<a href='$Link'>" . $RecipeSearchStudent['recipes'][0]['DocumentTitle'].  "</a>";

$RecGUID = $RecipeSearchStudent['recipes'][0]['VersionIDGUID'];
$RecipeInfo = $BCSRecipeAPI->RecipeInfo($RecGUID);
//preprint_r($RecipeInfo);
$Output['Recipe Info'] = implode('-', $RecipeInfo['recipe']);
// Output all tests.
foreach ($Output as $key => $value) {
    # code...
    echo '<Li>' . $key . ' : ' . $value;
}

// Course Info
$CourseInfo = ['FromDate' => '20190108', 'CourseType' => 1];

$paths = $BCSRecipeAPI->PathsByCourse($CourseInfo, 3, 'Thursday', 'PM');

echo "<P>Path Retrieved via PathsByCourse: " . $paths['path']['Path'] . ' ; ' . $paths['path']['PathID'];


echo '<P>Retrieving Recipes from Path:<ul>';
$Recipes = $BCSRecipeAPI->RecipeList($paths['path']['PathID']);


foreach ($Recipes['recipes'] as $key => $R) {
  # code...
  echo "<li> $R[DocumentTitle] - <a href='$R[url_pdf]'> View PDF</a> | <a href='$R[url_html]'> View html</a> | <a href='$R[url_doc]'> View Word Doc</a> ";
}
echo "</ul>";

