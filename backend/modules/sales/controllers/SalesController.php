<?php

namespace backend\modules\sales\controllers;

use Yii;
use backend\modules\sales\models\Sale;
use backend\modules\sales\models\SaleItem;
use backend\modules\sales\models\SaleSearch;
use backend\modules\product\models\Product;
use backend\modules\payments\models\Payment;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use backend\modules\printers\models\Printer;
/**
 * SalesController implements the CRUD actions for Sale model.
 */
class SalesController extends Controller
{
	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['post'],
				],
			],
			'access' => [
				'class' => \yii\filters\AccessControl::className(),
				'rules' => [
					[
						'allow' => true,
						'actions' => ['index', 'view', 'create', 'update','delete'],
						'roles' => ['@']
					],
					[
						'allow' => false
					]
				]
			]
		];
	}

	/**
	 * Lists all Sale models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new SaleSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single Sale model.
	 * @param string $id
	 * @return mixed
	 */
	public function actionView($id)
	{
		$model = $this->findModel($id);
		return $this->render('view', [
			'model' => $this->findModel($id),
		]);
	}


	public function actionSalesReturn()
	{
		$model = new Sale;
		// $items = $sa
		
		if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
			
		}
	}
	/**
	 * Creates a new Sale model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionReturn()
	{
		# find the last_auto_saved
		$this->layout = "/pos";
		$model  = new Sale; 
		$items = new SaleItem;
		$model->store_id = Yii::$app->user->identity->store_id;
		$model->date = date("Y-m-d");
		$model->is_return  = 1;
		if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll() ) {

			$payment                    =       new Payment;
			$payment->payment_type_id   =       $model->payment_type;
			$payment->payment_date      =       date("Y-m-d");
			$payment->sales_return            =       $model->grand_total;

			$payment->save(false);

			$model->payment_id = $payment->id;
			$model->update(['payment_id']);


			$result = Yii::$app->t->entry([
				'dr' => 15015,
				'cr' => 15060,
				'branch_id' => 1,
				'narration' => 'Sales Return Transaction',
				'amount' => $model->grand_total,
			]);


			$model->transaction_group = $result;
			$model->update(['transaction_group']);
			return $this->redirect(['/sales/sale-items/index', 'id' => $model->id]);
		} else {

			return $this->render('create', [
				'model' => $model,
				'items' =>  $items,
				// 'return' => true,
				// 'products' => $products,
			]);
		}
	}

	/**
	 * Creates a new Sale model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate($is_return=null)
	{
		# find the last_auto_saved
		$this->layout = "/pos";
		$model = new Sale; //Sale::findOne(['status' => Sale::LAST_AUTO_CREATED]);

		if($is_return !== true && $is_return == 1) {
			$model->is_return = 1;
		}
		$items = new SaleItem;

		$model->store_id = Yii::$app->user->identity->store_id;
		$model->date = date("Y-m-d");
		// 
		
		if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll() ) {   

			$payment                    =       new Payment;
			$payment->payment_type_id   =       10; # that's cash. Payment model has constants for this.
			$payment->payment_date      =       date("Y-m-d");
			$payment->received          =       $model->cash >= $model->grand_total ? $model->grand_total : $model->cash ;
			$payment->remaining         =       $model->grand_total - $model->cash;   

			$payment->save(false);

			$model->payment_id = $payment->id;
			$model->update(['payment_id']);


			// pass transaction now.
			
			$debits = [];

			$debits[15001] = [ // cash in hand
				'amount' => $payment->received,
			];
			
			// if($payment->received > 0) {
			// }

			// // if($payment->remaining > 0) {
			// // 	$debits[15060] = [ // cash receiveables
			// // 		'amount' => $payment->remaining,
			// // 	];
			// // }

			if($model->discount > 0) {
				$debits[20020] = [ // discount on sales expense
					'amount' => $model->discount + $model->itemsDiscount,
				];
			}


		   
			$cost = Sale::totalCost($model->id);
			$debits[20002] = [  // that's cost of goods sold
				'amount' => $cost,
			];

			$credits = [];

			$credits[50010] = [ // that's sales 
				'amount' => $model->net_total + $model->itemsDiscount //- $model->itemsDiscount,
			];

			$credits[15015] = [ // that's inventory
				'amount' => $cost,
			];



			$result = Yii::$app->t->entry([
				'dr' => $debits,
				'cr' => $credits,
				'branch_id' => 1,
				'narration' => 'SALES Transaction'
			]);

			$model->transaction_group = $result['group'];
			$model->update(['transaction_group']);
			
			if( $model->print == true )
				(new Printer() )->printSaleReceipt($model);

			return $this->redirect(['/sales/sales/create']);
		} else {

			
			return $this->render('create', [
				'model' => $model,
				'items' =>  $items,
				// 'return' => false,
				// 'products' => $products,
			]);
		}
	}


	public function actionPrint($id, $back= null)
	{
		$model = $this->findModel($id);
		(new Printer())->printSaleReceipt($model);
		return $this->redirect($back ? : ['index', 'id' => $id]);
	}
	/**
	 * Updates an existing Sale model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param string $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);

		if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
			return $this->redirect(['view', 'id' => $model->id]);
		} else {
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing Sale model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param string $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		$model = $this->findModel($id);
		$model->status = 0; #that's deleted.
		$model->save(false);
		// var_dump($model->status);
		// exit;
		#now find transactions and update those.
		if($model->transaction_group !== null) 
			Yii::$app->t->delByGroup($model->transaction_group);



		return $this->redirect(['index']);
	}
	
	/**
	 * 
	 * for export pdf at actionView
	 *  
	 * @param type $id
	 * @return type
	 */
	public function actionPdf($id) {
		$model = $this->findModel($id);

		$content = $this->renderAjax('_pdf', [
			'model' => $model,
		]);

		$pdf = new \kartik\mpdf\Pdf([
			'mode' => \kartik\mpdf\Pdf::MODE_CORE,
			'format' => \kartik\mpdf\Pdf::FORMAT_A4,
			'orientation' => \kartik\mpdf\Pdf::ORIENT_PORTRAIT,
			'destination' => \kartik\mpdf\Pdf::DEST_BROWSER,
			'content' => $content,
			'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
			'cssInline' => '.kv-heading-1{font-size:18px}',
			'options' => ['title' => \Yii::$app->name],
			'methods' => [
				'SetHeader' => [\Yii::$app->name],
				'SetFooter' => ['{PAGENO}'],
			]
		]);

		return $pdf->render();
	}


	public function actionItem()
	{


	}
	
	/**
	 * Finds the Sale model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param string $id
	 * @return Sale the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Sale::findOne(['id' => $id, 'status' => 1])) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

	 public function actionProducts($q = null) {
	   
		// $branch_id = Yii::$app->user->identity->branch_id;
		$data = Product::find()
				->joinWith("price")
				->joinWith('unit')
				// ->joinWith('totalSold')
				// ->joinWith('totalPurchased')
				// ->joinWith('openingStock')
				->where('products.name LIKE "%' . $q . '%"')
				->orWhere('products.code LIKE "%' . $q . '%"')
				->orWhere('products.barcode LIKE "%' . $q . '%"')
				// ->
				->andWhere(['products.is_parent' => 0])
				->orderBy('code')
				->asArray()
				->all();

		$out = [];
		
		// echo "<pre>";
		// var_dump($data);
		// echo "</pre>";
		// exit;
			 
		foreach ($data as $d) {
			$stock = Product::findOne($d['id'])->stock;
			$out[] = [
				'value' => $d['name'] . ' ( size: ' .$d['size']  . ") - stock: {$stock}" , 
				'product' => $d,
				'stock' =>  $stock
				// 'customer_id' => $d['customer_id'], 
				// 'account_id' => $d['id'], 
				// 'account_title' => $d->customerDetail->account_title, 
				// 'account_no' => $d['account_no'], 
				// 'balance' => $d['balance'], 'account_type' =>$d['account_type'] ,
				// 'account_typeshow' =>Lookup::item('account_type', $d['account_type']),
				// 'operation_type'=>Lookup::item('operation_type', $d->customerDetail->operation_type),
				// 'signature_img'=>$d->customerDetail->signatureDisplay,
			// 'photo_img'=>$d->customerDetail->imageDisplay
			];
		}

		echo Json::encode($out);
	}


	public function actionAdditem($sale_id, $product)
	{
		$product = Json::decode($product);
		$saleItem = new SaleItem();
		// $saleItem->product_id = 
	}
}
