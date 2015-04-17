<?php
return [
    'components' => [
        'db' => require(__DIR__.'/db.php'),
        'request' => [
            'default_controller' => 'user',
        ]
    ]
];