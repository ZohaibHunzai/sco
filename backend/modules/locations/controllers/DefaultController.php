<?php

namespace backend\modules\locations\controllers;

use yii\web\Controller;

/**
 * Default controller for the `locations` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
