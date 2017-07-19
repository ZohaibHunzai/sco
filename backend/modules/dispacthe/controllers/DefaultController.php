<?php

namespace backend\modules\dispacthe\controllers;


use Yii;
use backend\modules\dispacthe\models\Dispacthe;
use backend\modules\dispacthe\models\DispactheItem;
use backend\modules\dispacthe\models\DispatcheSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * Default controller for the `dispacthe` module
 */
class DefaultController extends Controller
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
     * Lists all Dispacthe models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DispatcheSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

     /**
     * Displays a single Dispacthe model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider'=>$model->runQuery($id),
        ]);
    }

    /**
     * Creates a new Dispacthe model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Dispacthe();

        if ($model->loadAll(Yii::$app->request->post())) {
            
                $model->transaction($model->getTotal(),$model->type);
                $model->saveAll();

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Dispacthe model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
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
     * Deletes an existing Dispacthe model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model =    $this->findModel($id);
        $model->status = 0; #that's deleted.
        $model->update(['status']);

        if($model->transaction_group !== null) 
            Yii::$app->t->delByGroup($model->transaction_group);
        return $this->redirect(['index']);
    }
    
    /**
     * Finds the Dispacthe model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Dispacthe the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Dispacthe::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
 	
}
