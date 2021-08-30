<?php


        $dt = new DateTime('2011-11-17 05:05');
        $offSet = 5;
        $dt->modify("+{$offSet} minutes");
        $end= $dt->format('Y-m-d H:m');

echo $end;