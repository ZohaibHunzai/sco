<?php

namespace backend\modules\accounts\controllers;

use Yii;
use backend\modules\accounts\models\SecondaryAccount;
use backend\modules\accounts\models\SecondaryAccountSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use backend\modules\accounts\models\Account;

/**
 * SecondaryAccountsController implements the CRUD actions for SecondaryAccount model.
 */
class SecondaryAccountsController extends Controller
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
     * Lists all SecondaryAccount models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SecondaryAccountSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SecondaryAccount model.
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
     * Creates a new SecondaryAccount model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SecondaryAccount();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing SecondaryAccount model.
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
     * Deletes an existing SecondaryAccount model.
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
     * Finds the SecondaryAccount model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return SecondaryAccount the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SecondaryAccount::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    public function actionTrialbalance()
    {
        $accounts = SecondaryAccount::find()->orderBy('code');
        $dataProvider = new ActiveDataProvider([
            'query' => $accounts
            ]);
        return $this->render('trialbalance', [
                'dataProvider' => $dataProvider,
            ]);
    }
    /**
    * The action created for grender balncesheet
    * @author zohaib
    */
    public function actionBalanceSheet()
    {
        $accounts =SecondaryAccount::find()->where(['primary_account_id'=>7])->orWhere(['primary_account_id' =>9])->orWhere(['primary_account_id' =>10])->all();

        return $this->render('balancesheet',[
                'accounts' => $accounts
            ]);
    }
}
