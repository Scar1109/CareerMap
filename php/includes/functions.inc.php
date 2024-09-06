<?php

//generate greeting by time
function generateGreeting() {
    $hour = date('G');

    if ($hour >= 5 && $hour < 12) {
        return "Good morning !";
    } elseif ($hour >= 12 && $hour < 17) {
        return "Good afternoon !";
    } else {
        return "Good evening !";
    }
}

