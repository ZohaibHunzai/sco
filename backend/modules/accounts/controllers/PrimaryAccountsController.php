<?php

namespace backend\modules\accounts\controllers;

use Yii;
use backend\modules\accounts\models\PrimaryAccount;
use backend\modules\accounts\models\PrimaryAccountSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use backend\modules\accounts\models\Account;
/**
 * PrimaryAccountsController implements the CRUD actions for PrimaryAccount model.
 */
class PrimaryAccountsController extends Controller
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
     * Lists all PrimaryAccount models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PrimaryAccountSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PrimaryAccount model.
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
     * Creates a new PrimaryAccount model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PrimaryAccount();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PrimaryAccount model.
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
     * Deletes an existing PrimaryAccount model.
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
     * Deletes all records in PrimaryAccount
     * 
     */
    public function actionDeleteAll()
    {
        PrimaryAccount::deleteAll();
        return $this->redirect(['index']);
    }

    /**
     * Finds the PrimaryAccount model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return PrimaryAccount the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PrimaryAccount::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    /**
    * The action created for primary trial balance to show the balances of primary accounts
    * @return primary account loaded model
    * @author zohaib
    */
    public function actionPrimaryTrialbalance()
    {
        $accounts = PrimaryAccount::find()->orderBy('code');
        $dataProvider = new ActiveDataProvider([
            'query' => $accounts
            ]);
        return $this->render('ptb', [
                'dataProvider' => $dataProvider,
            ]);
    }
    /**
    * The action created for to render the income statement view file from primary-accounts view 
    * @return primary accounts loaded model
    * @author zohaib 
    */
    public function actionIncomeStatement()
    {
        $accounts = Account::find()
                    ->joinWith(['transactions'], true, 'RIGHT JOIN')
                    ->where(['primary_account_id' => 8])
                    ->orWhere(['primary_account_id'=> 11])->orderBy('code');
        $dataProvider = new ActiveDataProvider([
            'query' => $accounts,
            'sort'=> ['defaultOrder' => ['code' => SORT_DESC]]
            ]);
        return $this->render('incomestatement',[
                'dataProvider' => $dataProvider
            ]);
    }
}
