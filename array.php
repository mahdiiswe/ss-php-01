<?php

$students = [
    [
        'name' => 'John Doe',
        'id' => 1,
        'address' => [
            'permanent_address' => [
                'street' => '1020 Banani',
                'city' => 'Dhaka',
            ],
            'country' => 'Bangladesh',
        ],
    ],
    [
        'name' => 'Jane Doe',
        'id' => 2,
        'address' => [
            'permanent_address' => [
                'street' => '1020 Gulshan',
                'city' => 'Dhaka',
                'state' => [
                    'state_name' => 'Dhaka',
                    'postal_code' => 1229,
                ],
            ],
            'country' => 'Bangladesh',
        ],
    ],
];

foreach ($students as $student) {
    foreach ($student as $key => $data) {
        if (is_array($data)) {
            array_iterate($data);
        } else {
            echo ucwords(str_replace('_', ' ', $key)).': '.$data.'<br/>';
        }
    }
    echo '<hr/>';
}

function array_iterate(array $array = [])
{
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            array_iterate($value);
        } else {
            echo ucwords(str_replace('_', ' ', $key)).': '.$value.'<br/>';
        }
    }
}
