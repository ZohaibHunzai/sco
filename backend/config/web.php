<?php
$config = [
	'homeUrl'=>Yii::getAlias('@backendUrl'),
	'controllerNamespace' => 'backend\controllers',
	'defaultRoute'=>'timeline-event/index',
	'controllerMap'=>[
		'file-manager-elfinder' => [
			'class' => 'mihaildev\elfinder\Controller',
			'access' => ['manager'],
			'disabledCommands' => ['netmount'],
			'roots' => [
				[
					'baseUrl' => '@storageUrl',
					'basePath' => '@storage',
					'path'   => '/',
					'access' => ['read' => 'manager', 'write' => 'manager']
				]
			]
		]
	],
	'components'=>[
		'errorHandler' => [
			'errorAction' => 'site/error',
		],
		't' => [
			'class' => '\backend\modules\accounts\models\Api',
		],
		'request' => [
			'cookieValidationKey' => getenv('BACKEND_COOKIE_VALIDATION_KEY')
		],
		'user' => [
			'class'=>'yii\web\User',
			'identityClass' => 'common\models\User',
			'loginUrl'=>['sign-in/login'],
			'enableAutoLogin' => true,
			'as afterLogin' => 'common\behaviors\LoginTimestampBehavior'
		],
		'formatter' => [
			'class' => 'yii\i18n\Formatter',
			'nullDisplay' => '-',
		],
	],
	'modules'=>[
		'i18n' => [
			'class' => 'backend\modules\i18n\Module',
			'defaultRoute'=>'i18n-message/index'
		],
		'inbox' => [
            'class' => 'backend\modules\inbox\Module',
        ],
	 	'expenses' => [
          'class' => 'backend\modules\expenses\Module',
    	],
    	'reports' => [
            'class' => 'backend\modules\reports\Module',
        ],
		'cash' => [
			'class' => 'backend\modules\cash\Module',
		],
		'accounts' => [
			'class' => 'backend\modules\accounts\Module',
			'defaultRoute'=>'primary-accounts/index'
		],
		'printers' => [
	        'class' => 'backend\modules\printers\Module',
	    ],
		'dashboard' => [
			'class' => 'backend\modules\dashboard\Module',
		],
		'purchases' => [
			'class' => 'backend\modules\purchases\Module',
		],
		'inventory' => [
			'class' => 'backend\modules\inventory\Module',
			'defaultRoute'=>'inventory/index'
		],
		'sales' => [
			'class' => 'backend\modules\sales\Module',
			'defaultRoute'=>'default/index'
		],
		'payments' => [
			'class' => 'backend\modules\payments\Module',
		],
		'location' => [
			'class' => 'backend\modules\locations\Module',
			'defaultRoute'=>'locations/index'

		],
		'products' => [
			'class' => 'backend\modules\product\Module',
			'defaultRoute'=>'products/index'

		],
		'categories' => [
			'class' => 'backend\modules\categories\Module',
			'defaultRoute'=>'categories/index'

		],
		'price' => [
			'class' => 'backend\modules\price\Module',
			'defaultRoute'=>'prices/index'

		],
		'supplier' => [
			'class' => 'backend\modules\supplier\Module',
			'defaultRoute'=>'suppliers/index'

		],
		'customers' => [
			'class' => 'backend\modules\customers\Module',
			'defaultRoute'=>'default/index'

		],
		'business' => [
            'class' => 'backend\modules\business\Module',
        ],
		'init' => [
			'class' => 'backend\modules\init\Module',
			'defaultRoute'=>'regions/index'

		],
		'dispacthe' => [
            'class' => 'backend\modules\dispacthe\Module',
            // 'defaultRoute'=> 'dispacthes/index'
        ],


		'gridview' =>  [
			'class' => '\kartik\grid\Module',
			// enter optional module parameters below - only if you need to  
			// use your own export download action or custom translation 
			// message source
			// 'downloadAction' => 'gridview/export/download',
			// 'i18n' => []
		]



	],
	'as globalAccess'=>[
		'class'=>'\common\behaviors\GlobalAccessBehavior',
		'rules'=>[
			[
				'controllers'=>['sign-in'],
				'allow' => true,
				'roles' => ['?'],
				'actions'=>['login']
			],
			[
				'controllers'=>['sign-in'],
				'allow' => true,
				'roles' => ['@'],
				'actions'=>['logout']
			],
			[
				'controllers'=>['site'],
				'allow' => true,
				'roles' => ['?', '@'],
				'actions'=>['error']
			],
			[
				'controllers'=>['debug/default'],
				'allow' => true,
				'roles' => ['?'],
			],
			[
				'controllers'=>['user'],
				'allow' => true,
				'roles' => ['administrator'],
			],
			[
				'controllers'=>['user'],
				'allow' => false,
			],
			[
				'allow' => true,
				'roles' => ['manager'],
			]
		]
	]
];

if (YII_ENV_DEV) {
	$config['modules']['gii'] = [
		'class'=>'yii\gii\Module',
		'generators' => [
			'crud' => [
				'class'=>'yii\gii\generators\crud\Generator',
				'templates'=>[
					'yii2-starter-kit' => Yii::getAlias('@backend/views/_gii/templates')
				],
				'template' => 'yii2-starter-kit',
				'messageCategory' => 'backend'
			]
		]
	];
}

return $config;
