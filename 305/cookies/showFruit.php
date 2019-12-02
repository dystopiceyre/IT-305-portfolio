<?php
    if (isset($_COOKIE["name"]) && isset($_COOKIE["fruit"])) {
        echo $_COOKIE["name"]."'s favorite fruit is ".
            $_COOKIE["fruit"];
    }
    else if (isset($_COOKIE["fruit"])) {
        echo "Your favorite fruit is ".
            $_COOKIE["fruit"];
    }
    else {
        echo "I dunno your favorite fruit.";
    }