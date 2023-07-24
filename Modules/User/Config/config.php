<?php

return [
    'name' => 'User',
    'permissions' => [
        'users' => [
            'all' => 'users.*',
            'create' => 'users.create',
            'update' => 'users.update',
            'view' => 'users.view',
            'delete' => 'users.delete',
        ]
    ]
];
