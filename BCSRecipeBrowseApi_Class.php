<?php

// ApiVersion : 1.0.1
require_once('BCSBaseApi_Class.php');
require_once('BCSRecipeApi_Class.php');

class BCSRecipeBrowseAPI extends BCSRecipeAPI
{
  const RECIPEPATH_LEVEL_ROOT =  1;
  const RECIPEPATH_LEVEL_COURSETEXT =  2;
  const RECIPEPATH_LEVEL_YEAR =  3;
  const RECIPEPATH_LEVEL_COURSE =  4;
  const RECIPEPATH_LEVEL_WEEK =  5;
  const RECIPEPATH_LEVEL_DAY =  6;
  const RECIPEPATH_LEVEL_DEMO =  7;


  public function BrowsePath($Path) {
    $Browse  = $this->PathsByPath($Path);

     $PathLevel = substr_count($Path, '\\');
     $NextPathLevel = $PathLevel +1;
    pprint_r($Browse);
     //exit;
    //

     $RetrievedPath = $Browse['path'];

     if ($RetrievedPath['RecipeCount'] > 0 && $Browse['paths_count'] == 0){
        $ListInfo = $this->PathByPathID($p['PathID']);

        $Paths['path'] = $RetrievedPath;
        $Paths['recipes'] = $ListInfo['recipes'];      
        return $Paths;
     }

     $Paths = ['parentpath' => $Path, 'parent' => $RetrievedPath, 'children' => [] , 'children_count' => ($Browse['paths_count'] -1)];

    foreach ($Browse['paths'] as $key => $p) {
      # code...


     if (substr_count($p['Path'], '\\') == $NextPathLevel){ 
     
        $Paths['children'][] = $p;

      }
      }

       if ($Paths['parent']['RecipeCount'] > 0) {

         

        $ListInfo = $this->PathByPathID($Paths['parent']['PathID']);

        $Paths['recipes'] = $ListInfo['recipes'];

        }

        return $Paths;

    }
}