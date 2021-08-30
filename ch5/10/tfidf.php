<?php
$doc1 = 'I was very happy with the product that I got in the mail. However, the package was handled badly.';
$doc2 = 'I am very happy with the product that I got. I will come back again in the future.';

$documents = array();
array_push($documents, $doc1);
array_push($documents, $doc2);

foreach($documents as $doc){
    echo '----------docment----------<br>';
    $cleaned = strtr($doc, array('.' => '', ',' => ''));
    $terms = explode(' ', $cleaned);
    $len = count($terms);
    foreach($terms as $term){
        $count  =substr_count($doc,$term);
        echo ' term: ' .$term;
        echo ' count: ' . $count;
        echo ' length: ' . $len;
        $tf = $count / $len;
        echo ' - TF: ' . $tf;
        $idf = log((count($documents) / countInDocs($term)), 10);
        echo ' IDF ' . $idf;
        $score = $tf * $idf;
        echo ' - TF-IDF: ' . $score . '<br>';
    }
}
function countInDocs($term){
    global $documents;
    $count = 0;
    foreach($documents as $doc){
        if(substr_count($doc,$term) > 0){
            $count = $count + 1;
        }
    }
    return $count;
}
