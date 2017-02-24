<?php 
require_once "vendor/autoload.php";
use Hborras\TwitterAdsSDK\TwitterAds;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "config.php";


// Create twitter ads client
$twitterAds = new TwitterAds(CONSUMER_KEY,CONSUMER_SECRET,ACCESS_TOKEN,ACCESS_TOKEN_SECRET);

try{
	// Retrieve account information
	$account = $twitterAds->getAccounts(ACCOUNT_ID);
	var_dump($account);
}catch(Exception $e){
	echo $e->getMessage();
}



?>