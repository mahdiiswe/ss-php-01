<?php

$day = 'saturday';
$time = '12';

if ($day === 'saturday') {
    echo 'We have class today';

    if ($time === '2') {
        echo 'Class will start now';
    } else {
        echo 'Class will start later';
    }
} elseif ($day === 'friday') {
    echo 'We have exam today';
} else {
    echo 'We do not have class today';
}
