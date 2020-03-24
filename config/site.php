<?php

return [
    'site_settings' => (object) array(
        'site_name' => (object) array(
            'ru' => env('SITE_NAME_RU', 'NOT_SET'),
            'en' => env('SITE_NAME_EN', 'NOT_SET'),
            'oz' => env('SITE_NAME_OZ', 'NOT_SET'),
            'uz' => env('SITE_NAME_UZ', 'NOT_SET'),
        )
    )
];
