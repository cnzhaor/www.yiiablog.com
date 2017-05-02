<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\Adminuser',
            'enableAutoLogin' => true,
        ],
        'session'=>[
            'name' => 'PHPBACKSESSION',
            'savePATH' => sys_get_temp_dir(),
        ],
        'request'=>[
            'cookieValidationKey' => 'asfasfasdf87872jk',
            'csrfParam'=>'_adminCSRF',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                //'<controller:\w+>s' => '<controller>/index',
                '<controller:(post|comment)+>s' => '<controller>/index',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<id:\d+>/<action:(create|update|delete)>' => '<controller>/<action>',
            ],
        ],
    ],
    'params' => $params,
    'language' => 'zh-CN',
];
