<?php

namespace backend\modules\accounts\controllers;

use Yii;
use backend\modules\accounts\models\AccGroup;
use backend\modules\accounts\models\GroupAccount;
use backend\modules\accounts\models\AccGroupSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

/**
 * GroupsController implements the CRUD actions for AccGroup model.
 */
class GroupsController extends Controller
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
     * Lists all AccGroup models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AccGroupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AccGroup model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AccGroup model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AccGroup();

        if ($model->loadAll(Yii::$app->request->post()) && $model->saveAll()) {
            Yii::$app->session->setFlash("success", "Added successfully..");
            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AccGroup model.
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
     * Assigns account to the group
     * @param integer $id ID of the group
     * @return mixed
     */

    public function actionAssignAccounts($id)
    {
        $group = $this->findModel($id);
        $accounts = $group->accounts;

        
        if(Yii::$app->request->post("Account")) {
            $data = Yii::$app->request->post("Account");
            # first need to delete all and re-insert those.
            Yii::$app->db->createCommand()->delete(GroupAccount::tableName(), [
                'group_id' => $id,
            ])->execute();

            # now insert everything.
            foreach ($data as $account_id => $on) {
                $m = new GroupAccount();
                $m->group_id = $id;
                $m->account_id = $account_id;
                $m->status = 1;
                $m->save();
            }

            return $this->refresh();
        }

        return $this->render("assign-accounts", [
            'group' => $group,
            'accounts' => $accounts
        ]);
    }

    /**
     * Renders JSON object of currently saved documents
     * @param integer $id group id
     * @return JSON
     */
    public function actionAssignedAccounts($id)
    {
        $models = GroupAccount::find()->with(['account'])->asArray()->where(['group_id' => $id, 'status' => 1])->all();
        return Json::encode($models);
    }
    /**
     * Deletes an existing AccGroup model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->deleteWithRelated();

        return $this->redirect(['index']);
    }
    
    /**
     * Finds the AccGroup model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AccGroup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AccGroup::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
