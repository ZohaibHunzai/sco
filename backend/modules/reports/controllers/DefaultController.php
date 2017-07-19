<?php

namespace backend\modules\reports\controllers;
use Yii;
use yii\web\Controller;
use backend\modules\reports\models\Report;

/**
 * Default controller for the `reports` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    private $report = null;

    /**
     * Initialization
     * @return boolean 
     */
    public function init()
    {
    	parent::init();
    	$this->report = new Report;
    	return true;
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Daily report based on the month provided
     * @param  integer $month 
     * @return mixed
     */
    public function actionDailySales($month=null)
    {
    	if($month == null) {
    		$month = date('F');
    	}
    	$data = $this->report->getDailySales($month);

    	return $this->render('daily-sales',[
    		'data' => $data,
    		'month' => $month,
    	]);
    }

    /**
     * Daily report based on the month provided
     * @param  integer $month 
     * @return mixed
     */
    public function actionBrandSales($month=null)
    {
        if($month == null) {
            $month = date('F');
        }
        $data = $this->report->getBrandSales();

        return $this->render('brand-sales',[
            'data' => $data,
            'month' => $month,
        ]);
    }
    public function actionProductStock()
    {
        
        $brands = \backend\modules\init\models\Brand::find()->all();
        $brands = \yii\helpers\ArrayHelper::map($brands, 'id', 'name');
        $brandSectors = \backend\modules\init\models\BrandSector::find()->all();
        $b_sectors = \yii\helpers\ArrayHelper::map($brandSectors, 'id', 'name');
        
        $data = $this->report->getProductWiseStock(Yii::$app->request->queryParams);
        

        return $this->render('product-stock',[
            'data' => $data,
            'searchModel' => $this->report,
            'brands' => $brands,
            'b_sectors' => $b_sectors,
            // 'month' => $month,
        ]);
    }
    public function actionRecaptulation()
    {
    	return $this->render('recaptulation',[
    		'model' => $this->report
    	]);
    }
}
