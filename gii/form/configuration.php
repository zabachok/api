<?php

return [
    'class' => 'Layout',
    'fields' => [
        'name' => [['string']],
        'container' => [['string'], ['in', 'range' => ['container', 'container-fluid']]],
    ],
    'labels' => [
        'name' => 'Название',
        'container' => 'Контейнер',
    ],
    'forms' => [
        'header' => [
            'class' => 'Header',
            'fields' => [
                'enabled' => [['boolean']],
                'fixedTop' => [['boolean']],
                'scheme' => [['string'], ['default', 'value' => 'default']],
                'container' => [['string'], ['in', 'range' => ['container', 'container-fluid']]],
                'colorScheme' => [['string'], ['in', 'range' => ['light', 'dark']]],
            ],
            'types' => [
                'enabled' => 'boolean',
                'fixedTop' => 'boolean',
            ],
            'labels' => [
                'enabled' => 'Включен',
                'scheme' => 'Схема',
                'container' => 'Контейнер',
                'colorScheme' => 'Цвет',
            ],
            'forms' => [
                'logo' => [
                    'class' => 'Logo',
                    'fields' => [
                        'text' => [['string']],
                        'image' => [['string']],
                        'link' => [['string'], ['default', 'value' => 'MainPage']],
                    ],
                    'labels' => [
                        'text' => 'Название',
                        'image' => 'Логотип',
                        'link' => 'Ссылка',
                    ],
                ],
            ],
        ],
        'footer' => [
            'class' => 'Footer',
            'fields' => [
                'enabled' => [['boolean']],
                'scheme' => [['string'], ['default', 'value' => 'default']],
                'container' => [['string'], ['in', 'range' => ['container', 'container-fluid']]],
                'colorScheme' => [['string'], ['in', 'range' => ['light', 'dark']]],
            ],
            'types' => [
                'enabled' => 'boolean',
            ],
            'labels' => [
                'enabled' => 'Включен',
                'scheme' => 'Схема',
                'container' => 'Контейнер',
                'colorScheme' => 'Цвет',
            ],
            'forms' => [
                'copyright' => [
                    'class' => 'Copyright',
                    'fields' => [
                        'since' => [['string', 'length' => 4]],
                        'label' => [['string']],
                    ],
                    'labels' => [
                        'since' => 'Дата начала',
                        'label' => 'Подпись',
                    ],
                ],
            ],
        ],
    ],
];
