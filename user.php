<?php
    $url = $_SERVER[REQUEST_URI];
    $parts = parse_url($url);
    parse_str($parts['query'], $query);
    user = $query['user'];
    if (user == 1) {
        echo "ok";
    } else {
        echo "not found";
    }
?>