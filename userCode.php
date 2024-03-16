<?php
    $parts = parse_url($url);
    parse_str($parts['query'], $query);
    userCode = $query['userCode'];
    if (userCode == 1) {
        echo "ok";
    } else {
        echo "not found";
    }
?>