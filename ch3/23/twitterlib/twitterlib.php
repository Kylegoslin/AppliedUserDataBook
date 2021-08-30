<?php
require_once 'vendor/autoload.php';
use Abraham\TwitterOAuth\TwitterOAuth;
define('CONSUMER_KEY', '1wUmYQ6c2GQFhhh7j7CIYhyaJ6R');
define('CONSUMER_SECRET', 'yPHBqqT9o1lppggiscju0yAjutRclS6sOVysh0rFXXXKTgFE20F3');
define('OAUTH_CALLBACK', 'https://www.kylegoslin.ie/test.php');
$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
$request_token = $connection->oauth('oauth/request_token', 
                                     array('oauth_callback' => OAUTH_CALLBACK));
$results = $connection->get("search/tweets", 
                           ["q" => "Dublin", 
                           "result_type"=> "popular"]);
foreach($results->statuses as $tweet){
    echo $tweet->created_at . '-'. $tweet->text . '<br>';
}