<?php
require('PorterStemmer.php');
$word = 'Houses';
$stem = PorterStemmer::Stem($word);
echo $stem . '<br>';
$word = 'House';
$stem = PorterStemmer::Stem($word);
echo $stem . '<br>';
$word = 'Housing';
$stem = PorterStemmer::Stem($word);
echo $stem . '<br>';