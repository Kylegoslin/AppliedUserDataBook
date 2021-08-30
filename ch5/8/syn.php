<?php
$term = 'dad';
$result = file_get_contents("https://words.bighugelabs.com/api/2/"
                            ."0c7cc83b387027012538b959c8576cfb/$term/json");
$decoded = json_decode($result, true);
$syn = $decoded['noun']['syn'];
foreach($syn as $item){
    echo $item . '<br>';
}
