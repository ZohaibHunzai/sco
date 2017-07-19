<?php

namespace backend\modules\accounts\controllers;

use Yii;
use backend\modules\accounts\models\Account;
use backend\modules\accounts\models\SecondaryAccount;
use backend\modules\accounts\models\AccountSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;
/**
 * AccountsController implements the CRUD actions for Account model.
 */
class AccountsController extends Controller
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
        ];
    }

    /**
     * Lists all Account models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AccountSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Account model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Account model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Account();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Account model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Account list for ajax reponse.
     */
    public function actionLists($id) {

        $sec_account = SecondaryAccount::find()
         ->where(['primary_account_id' => $id])
         ->count();

        $accounts = SecondaryAccount::find()
         ->where(['primary_account_id' => $id])
         ->orderBy('id DESC')
         ->all();

         if($sec_account > 0){
            
            echo "<option> Choose Secondary account</option>";
            foreach($accounts as $items){
                echo "<option value='".$items->id."'>".$items->name."</option>";
            }
         }
         else{
            echo "<option>No secondary account available</option>";
        }

    }

    public function actionAccountJson($id)
    {
        $model = $this->findModel($id);
        return Json::encode($model);
    }

    /**
     * Deletes an existing Account model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    /**
     * Render settings for the accoutns.
     * @return mixed
     */

    public function actionSetting()
    {
        return $this->render("setting");
    }

    /**
     * Finds the Account model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Account the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Account::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    /**
    * This function is created for to show balances of account model
    */
    public function actionTrialbalance()
    {
        $accounts = Account::find()
                    ->joinWith(['transactions t'], true, "RIGHT JOIN")

                    ->orderBy('code');
        
        $dataProvider = new ActiveDataProvider([
            'query' => $accounts
        ]);
        return $this->render('acctrialbalance', [
                'dataProvider' => $dataProvider,
            ]);
    }


    public function actionTest()
    {
        try {
            return Yii::$app->t->api(['dr' => '10002', 'cr' => '15001', 'amount' => 1000, 'branch_id' => 3]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
