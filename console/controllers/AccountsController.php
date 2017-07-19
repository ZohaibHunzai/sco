<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;
use yii\helpers\Console; 
use \backend\modules\accounts\models\Transaction as T;

/**
* 			
*/
class AccountsController extends Controller
{
	
	public function actionEntry($account_no, $amount, $dr_or_cr, $narration = '')
	{
			
		if($narration ===  '') {
			$narration = 'Console Transaction';
		}


		$data = ['branch_id' => 1, 'narration' => $narration];


		if($dr_or_cr === 'dr') {
			$data['dr'] = [
				$account_no => [
					'amount' => $amount
				],
			];

			$data['cr'] = [];
		} else {
			$data['cr'] = [
				$account_no => [
					'amount' => $amount
				],
			];

			$data['dr'] = [];

		}

		try {
			Yii::$app->t->entry($data);
		} catch (Exception $e) {
			echo $e->getMessage();
		}

	}
	
}
 ?>