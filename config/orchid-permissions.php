<?php

return [
    'platform' => [
        'sections' => [
            'threads' => [
                'name' => 'Треды',
                'permissions' => [
                    'view' => 'Просмотр',
                    'create' => 'Создание',
                    'update' => 'Обновление',
                    'delete' => 'Удаление'
                ],
            ],

            'threads_commentaries' => [
                'name' => 'Комментарии тредов',
                'permissions' => [
                    'view' => 'Просмотр',
                    'delete' => 'Удаление'
                ]
            ]
        ]
    ],
    'platform-check' => [
        'threads' => [
            'view' => 'threads.view',
            'create' => 'threads.create',
            'update' => 'threads.update',
            'delete' => 'threads.delete'
        ],
        'threads_commentaries' => [
            'view' => 'threads_commentaries.view',
            'delete' => 'threads_commentaries.delete'
        ]
    ]
];
