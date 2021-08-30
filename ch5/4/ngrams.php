<?php
$sentence = 'The staff are horrible here';
$tokens = explode(' ', $sentence);
$gram = '';
$n = 2;
for ($x = 0; $x <= sizeof($tokens) -1; $x++) {
    $counter = 0;
    for ($y = $x; $y <= sizeof($tokens) -1; $y++) {
        $counter++;
        $gram .= ' '. $tokens[$y];
        if($counter == $n){
            echo $gram . '<br>';
            $gram='';
            break;
        }
    }
}
