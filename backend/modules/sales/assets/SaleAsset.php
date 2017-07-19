<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\modules\sales\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class SaleAsset extends AssetBundle
{
    // public $basePath = '@webroot';
    // public $baseUrl = '@web';
    public $sourcePath = "@backend/modules/sales/assets";

    // public $css = [
    //     'css/style.css',
    // ];

    public $js = [
        'js/lodash.min.js',
        'js/vue.js',
        'js/app.js',
    ];

    public $depends = [
       'backend\assets\BackendAsset'
    ];
}
