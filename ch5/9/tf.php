<?php
$doc1 = 'I was very happy with the product that I got in the mail. However, the package was handled badly.';
$doc2 = 'I am very happy with the product that I got. I will come back again in the future.';
$doc3 = 'There was a number of issues with the customer service of this company. I will take my business somewhere else. It was a bad experience.';
$doc4 = 'I will never return. I was treated badly by the man on the front desk.';
$doc5 = 'This is a great company, I will never go elsewhere.';

$documents = array();
array_push($documents, $doc1);
array_push($documents, $doc2);
array_push($documents, $doc3);
array_push($documents, $doc4);
array_push($documents, $doc5);
$allWords = array();
foreach($documents as $doc){
    echo '----------docment----------<br>';
    $cleaned = strtr($doc, array('.' => '', ',' => ''));
    $terms = explode(' ', $cleaned);
    foreach($terms as $term){
        array_push($allWords, $term);
       
    }
}
print_r(array_count_values($allWords));

