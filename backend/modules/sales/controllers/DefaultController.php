<?php

namespace backend\modules\sales\controllers;
use Yii;
use yii\web\Controller;
use backend\modules\sales\models\Sale;
use backend\modules\sales\models\InvoiceItem;
use yii\helpers\Html;
use yii\web\Response;
use backend\modules\customers\models\Customer;
use backend\modules\product\models\Product;
/**
 * Default controller for the `sales` module
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

    public function actionData()
    {
        $what = !isset($_GET['what']) ? : $_GET['what'];
        $return  = [
            'success' => 0,
            'message' => 'failed',
            'data' => [],
        ];
        if(!$what) {
            return $return;
        }

        $data = [];

        if($what == 'customers') {
            $data = Customer::find()->asArray()->all();
            
            $return['data'] = $data;
        } else if($what == 'products') {
            $data = Product::find()->joinWith('price')->asArray()->all();
            $return['data'] = $data;
        }

        $return['success'] = 1;
        $return['message'] = 'fetched customers';

        
        Yii::$app->response->format = Response::FORMAT_JSON;
        Yii::$app->response->data = $data;
        return Yii::$app->response->send();
        // return $return;

    }
    /**
     * Create new sale
     * @return mixed
     */

    public function actionCreate()
    {
        $model = new Sale;
        $this->layout = "//simple";

    	return $this->render("create", [
            'model' => $model,
        ]);
    }

    
    // public function actionItem()
    // {
    //     $model = new InvoiceItem;

    //     return Html::activeTextInput($model, )
    // }
}
