<?php
echo "<pre>";
$strings = array(
	1 => 'I am very happy with the staff',
    2 => 'I did not like the staff they are unhelpful',
    3 => 'The food was bad',
);
require_once('vendor/autoload.php');
$sentiment = new \PHPInsight\Sentiment();
foreach ($strings as $string) {
	// calculations:
	$scores = $sentiment->score($string);
	$class = $sentiment->categorise($string);
	// output:
	echo "String: $string\n";
	echo "Dominant: $class, scores: ";
	print_r($scores);
	echo "\n";
}