<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);


require_once "vendor/autoload.php";
use Hborras\TwitterAdsSDK\TwitterAds;
use Hborras\TwitterAdsSDK\TwitterAds\TailoredAudience\TailoredAudience;
use Hborras\TwitterAdsSDK\TwitterAds\TailoredAudience\TailoredAudienceChanges;
use Hborras\TwitterAdsSDK\TONUpload;


include "config.php";


//----------- tmp debugging function -----------
function debug($obj){ 
	$type = gettype($obj);
	
	if ($type == 'array') {
		foreach ($obj as $value) {
			echo "<pre>"; var_dump($value); echo "</pre>"; echo "<br/><br/>";
		}
	}
	else{
		echo "<pre>"; var_dump($obj); echo "</pre>"; 
	}
}
//--------------------------------------------



// Connexion with Account
$twitterAds = new TwitterAds(CONSUMER_KEY,CONSUMER_SECRET,ACCESS_TOKEN,ACCESS_TOKEN_SECRET);
$account = $twitterAds->getAccounts(ACCOUNT_ID);

// Get Tailored Audiences List
$selected_TA = null;
$TA = new TailoredAudience();
$list_TA = $TA->loadResource($account)->getCollection();

foreach($list_TA as $tailored) {
    if($tailored->getName() == "test Tailored Audiences"){
    	$selected_TA = $tailored;
    	break;
    }
}

if($selected_TA != null){
	//upload
	$upload = new TONUpload($account->getTwitterAds(), 'files/test.csv');
    $location = $upload->perform();

    // Update
    if($location != ''){
   		$TA_changes = new TailoredAudienceChanges($account);
		$TA_changes->updateAudience($selected_TA->getId(), $location, 'EMAIL', 'ADD');
    }
}




?>