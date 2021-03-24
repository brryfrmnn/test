<?php
echo findIndex("a (b c (d e (f) g) h) i (j k)", 2);


function findIndex($string, $integer)
{
    $counter = 0;
    $i = 0;
    while ($i++ < strlen($string)) {
        if ($i >= $integer) {
            if ($string[$i] == '(')
                $counter++;
            else if ($string[$i] == ')') {
                $counter--;
                if (!$counter) return $i;
            }
        }
    }    
}

