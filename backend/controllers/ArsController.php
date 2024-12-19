<?php

namespace backend\controllers;

use backend\models\Ars;
use backend\models\ArsSearch;
use backend\models\Systemlog;
use backend\models\UnitSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ArsController implements the CRUD actions for Ars model.
 */
class ArsController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        $action_id = $action->id;
        $controller_name = $this->id;
        $mothod_name = \Yii::$app->request->method;
        $params =  json_encode(\Yii::$app->request->bodyParams ?: \Yii::$app->request->queryParams);
        $ip_address = \Yii::$app->request->userIP;

        $log = new Systemlog();
        $log->trans_date = date('Y-m-d H:i:s');
        $log->function_name = $controller_name.'/'.$action_id.'/'.$mothod_name.'/'.$params;
        $log->user_id = \Yii::$app->user->id;
        $log->ipaddress = $ip_address;
        $log->log_type_id = 2;
        $log->save(false);



        // Log the user action
//        $log = new Systemlog();
//        $log->user_id = \Yii::$app->user->isGuest ? null : \Yii::$app->user->id;
//        $log->action = $action->id;
//        $log->controller = $this->id;
//        $log->method = Yii::$app->request->method;
//        $log->params = json_encode(Yii::$app->request->bodyParams ?: Yii::$app->request->queryParams);
//        $log->ip_address = Yii::$app->request->userIP;
//        $log->created_at = date('Y-m-d H:i:s');
//        $log->save(false); // Save without validation to avoid exceptions

        return true;
    }

    /**
     * Lists all Ars models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $pageSize = \Yii::$app->request->post("perpage");
        $searchModel = new ArsSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        $dataProvider->setSort(['defaultOrder' => ['id' => SORT_DESC]]);
        $dataProvider->pagination->pageSize = $pageSize;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'perpage' => $pageSize,
        ]);
    }

    /**
     * Displays a single Ars model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Ars model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Ars();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Ars model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Ars model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Ars model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Ars the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ars::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
