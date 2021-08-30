<?php
function stripStopWords($input){
    $cleaned = '';
    $stopwords = array("a","about","an","are","as","at","be",
    "by","com","de","en", "for","from","how","I","in","is","it",
    "la","of","on","or", "that","the","this","to","was","what",
    "when","where","who", "will","with","und","the","www");
    $inputArray = explode(' ', strtolower($input));
    foreach ($inputArray as $inputword) {
        $isStopWord = False;
        foreach ($stopwords as $word) {
            if($inputword == $word){
                $isStopWord = True;
            }
        }    
        if($isStopWord == False){
            $cleaned .= ' ' . $inputword;
        }
    }
   return $cleaned;
}

$input = 'I am really happy with the service';
echo 'Input:' . $input . '<br>';
$result = stripStopWords($input);
echo 'Result: '. $result;
