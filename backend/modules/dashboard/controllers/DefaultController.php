<?php

namespace backend\modules\dashboard\controllers;

use yii\web\Controller;
use backend\modules\dashboard\models\Dashboard;
use common\Constants;

/**
 * Default controller for the `dashboard` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
    	$data = [
    		'totalProducts' => $this->getModel()->totalProducts,
            'worth' => $this->getModel()->worth,
            'totalExpenses' => $this->getModel()->getTotalExpenses(),
            'todayExpenses' => $this->getModel()->getTodayExpenses(),
            'cih' => $this->getModel()->cashInHand,
            'cab' => $this->getModel()->cashAtBank,
            'monthSale' => $this->getModel()->currentMonthSales,
            'todaySale' => $this->getModel()->todaySales,
            'dailySales' => $this->getModel()->dailySales,
            'model' => $this->getModel(),
    	];



        return $this->render('index', $data);
    }

    private function getModel()
    {
    	return new Dashboard;
    }

    


}

