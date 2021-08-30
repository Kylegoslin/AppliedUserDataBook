<?php
if ($handle = opendir('samplefiles')) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            echo '<input type="radio" id="file" name="file" value="'.$entry.'">' . $entry .'<br>';
        }
    }
    closedir($handle);
}
?>