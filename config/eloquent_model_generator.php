<?php

return [
    'model_defaults' => [
        'namespace'       => 'App\Models',
        'base_class_name' => 'Illuminate\Database\Eloquent\Model',
        'no_timestamps'   => false,
        'output_path' => 'Models'
    ],
    'db_types' => [
        'enum' => 'string',
    ],
];