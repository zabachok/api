<?php

return [
    'cache' => YII_ENV_DEV ? false : 'cache',
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'enableStrictParsing' => true,
    'rules' => [
        '<controller:([\w\-]+)>/<action:([\w\-]+)>' => '<controller>/<action>',
    ],
];
