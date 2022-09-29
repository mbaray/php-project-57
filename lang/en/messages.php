<?php

return [
    'task' => [
        'unique' => 'A task with this name already exists',
        'create' => [
            'success' => 'Task successfully created'
        ],
        'update' => [
            'success' => 'Task changed successfully'
        ],
        'delete' => [
            'success' => 'Task successfully deleted',
            'fail' => 'Failed to delete task'
        ]
    ],
    'task_status' => [
        'unique' => 'A status with this name already exists',
        'create' => [
            'success' => 'Status successfully created'
        ],
        'update' => [
            'success' => 'Status changed successfully'
        ],
        'delete' => [
            'success' => 'Status successfully deleted',
            'fail' => 'Failed to delete status'
        ]
    ],
    'label' => [
        'unique' => 'A label with this name already exists',
        'create' => [
            'success' => 'The label was created successfully'
        ],
        'update' => [
            'success' => 'Label changed successfully'
        ],
        'delete' => [
            'success' => 'Label successfully deleted',
            'fail' => 'Could not delete label'
        ]
    ]
];
