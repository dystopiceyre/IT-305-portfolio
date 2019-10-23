<?php

    include "functions.php";

    $lineBreak = '<br>';
    echo "Let's go!";
    echo $lineBreak;
    print "Let's go!";

    print $lineBreak;
    $phrase = ' I like PHP ';

    print $phrase.trim();
    print $lineBreak;
    print 'The length of the string is ' .strlen($phrase);
    print ($lineBreak);
    print 'The position of the word "PHP" in the string is ' .strpos($phrase, 'PHP');
    print $lineBreak;
    print str_replace('like', 'love', $phrase);
    print $lineBreak;
    print strtoupper($phrase);
    print $lineBreak;

    print 'The larger of the two values is' .largest(23, 16);
    print $lineBreak;
    print 'The average of 5 and 27 is ' .average(5, 27);
