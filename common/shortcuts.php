<?php
/**
 * Yii2 Shortcuts
 * @author Eugene Terentev <eugene@terentev.net>
 * -----
 * This file is just an example and a place where you can add your own shortcuts,
 * it doesn't pretend to be a full list of available possibilities
 * -----
 */

use kartik\date\DatePicker;
use \backend\modules\models\models\AccountSetting;
use common\Constants;
/**
 * @return int|string
 */
function getMyId()
{
    return Yii::$app->user->getId();
}

/**
 * @param string $view
 * @param array $params
 * @return string
 */
function render($view, $params = [])
{
    return Yii::$app->controller->render($view, $params);
}

/**
 * @param $url
 * @param int $statusCode
 * @return \yii\web\Response
 */
function redirect($url, $statusCode = 302)
{
    return Yii::$app->controller->redirect($url, $statusCode);
}

/**
 * @param $form \yii\widgets\ActiveForm
 * @param $model
 * @param $attribute
 * @param array $inputOptions
 * @param array $fieldOptions
 * @return string
 */
function activeTextinput($form, $model, $attribute, $inputOptions = [], $fieldOptions = [])
{
    return $form->field($model, $attribute, $fieldOptions)->textInput($inputOptions);
}


/**
 * As options
 */

function asOptions($class, $key='id', $value='name', $where=[])
{
	$models = $class::find()->where($where)->asArray()->all();
	return \yii\helpers\ArrayHelper::map($models, $key, $value);
}


/**
 * Datepicker settings
 */

 function dps()
{
	return  [
            'options' => [
                'placeholder' => 'Enter Opening Date ...', 
                'value'=>date('Y-m-d')
            ],
            'type' => DatePicker::TYPE_COMPONENT_APPEND,
            'pluginOptions' => [
                'autoclose' => true,
                  'format' => 'yyyy-mm-dd',
            ]
        ];
}


function accountByKey($key)
{
    return (new AccountSetting())->getA($key);
}

function statuses(){
    return Constants::statusArr();
}

function box($title, $value, $icon, $bg='bg-aqua')
{
    return '<div class="info-box '. $bg . '">
            <span class="info-box-icon"><i class="fa ' . $icon . '"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"> ' . $title . ' </span>
              <span class="info-box-number"> ' . $value . '</span>
            </div>
            <!-- /.info-box-content -->
          </div>';
}


function aggregate($class, $attribute, $where=[])
{
    return $class::find()->where($where)->count($attribute);
}

function dateRangeFilter(&$query, $model, $attribute = 'created_at') {
    if($model->{$attribute} !== null && $model->{$attribute} !== ''){
        $t      =   explode(" - ", $model->{$attribute});
        // var_dump($t);
        $start_date = date("Y-m-d", strtotime($t[0]));
        $end_date = date("Y-m-d", strtotime($t[1]));
        // var_dump($start_date);
        // var_dump($end_date);
        // exit;
        $query->andFilterWhere([
            'between',"date($attribute)", $start_date, $end_date
        ]);
    }

    return $query;
}

function dump($var, $exit=true)
{
    echo "<pre>";
    var_dump($var);
    echo "</pre>";

    if ($exit) {
        exit();
    }
}