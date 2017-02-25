<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);


require_once "vendor/autoload.php";
use Hborras\TwitterAdsSDK\TwitterAds;
use Hborras\TwitterAdsSDK\TwitterAds\TailoredAudience\TailoredAudience;


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



// Create twitter ads client
$twitterAds = new TwitterAds(CONSUMER_KEY,CONSUMER_SECRET,ACCESS_TOKEN,ACCESS_TOKEN_SECRET);

// Retrieve account information
$account = $twitterAds->getAccounts(ACCOUNT_ID);


$TA = new TailoredAudience();
$list_TA = $TA->loadResource($account)->getCollection();

foreach($list_TA as $tailored) {
    debug($tailored->getName());
}



?>