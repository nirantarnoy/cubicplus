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
    public $enableCsrfValidation = false;
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
        $model_product = \common\models\ArsLine::find()->where(['ars_id'=>$id])->one();
        $model_log = \common\models\ArsLog::find()->where(['ars_id'=>$id])->orderBy(['trans_date'=>SORT_DESC])->all();
        $model_product_line = \common\models\ArsProductLine::find()->where(['ars_id'=>$id])->all();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'model_product' => $model_product,
            'model_log' => $model_log,
            'model_product_line'=>$model_product_line,
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
        $model_product = new \common\models\ArsLine();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model_product->load($this->request->post())) {

                $line_product_id = \Yii::$app->request->post('line_product_id');
                $line_product_sku = \Yii::$app->request->post('line_sku');
                $line_product_serial_no = \Yii::$app->request->post('line_serial_no');
                $line_product_qty = \Yii::$app->request->post('line_qty');

                $issue_date = date('Y-m-d');
                $exp3 = explode('-',$model->issue_date);
                if($exp3!=null){
                    if(count($exp3)>1){
                        $issue_date = $exp3[2].'-'.$exp3[1].'-'.$exp3[0];
                    }
                }
                $model->status = 0; // waiting
                $model->ars_no = '';
                $model->issue_date = date('Y-m-d',strtotime($issue_date));
                if($model->save(false)){

                    $w_start_date = date('Y-m-d');
                    $w_exp_date = date('Y-m-d');
                    $exp = explode('-',$model_product->period_start_date);
                    $exp2 = explode('-',$model_product->period_end_date);

                    if($exp!=null){
                        if(count($exp)>1){
                            $w_start_date = $exp[2].'-'.$exp[1].'-'.$exp[0];
                        }
                    }
                    if($exp2!=null){
                        if(count($exp2)>1){
                            $w_exp_date = $exp2[2].'-'.$exp2[1].'-'.$exp2[0];
                        }
                    }

                    $model_product->ars_id = $model->id;
                    $model_product->qty = 1;
                    $model_product->period_start_date = date('Y-m-d',strtotime($w_start_date));
                    $model_product->period_end_date = date('Y-m-d',strtotime($w_exp_date));
                    if($model_product->save(false)){

                        if($line_product_id!=null){
                            for($k=0;$k<=count($line_product_id)-1;$k++){
                                $model_product_line = new \common\models\ArsProductLine();
                                $model_product_line->ars_id = $model->id;
                                $model_product_line->product_id = $line_product_id[$k];
                                $model_product_line->sku = $line_product_sku[$k];
                                $model_product_line->serial_no = $line_product_serial_no[$k];
                                $model_product_line->qty = $line_product_qty[$k];
                                $model_product_line->save(false);
                            }
                        }


                        $model_log = new \common\models\ArsLog();
                        $model_log->ars_id = $model->id;
                        $model_log->detail = 'สร้างรายการ';
                        $model_log->trans_date = date('Y-m-d H:i:s');
                        $model_log->issue_by  = \Yii::$app->user->id;
                        $model_log->save(false);
                    }
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'model_product' => $model_product,
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
        $model_product = new \common\models\ArsLine();
        $model_line = \common\models\ArsLine::find()->where(['ars_id' => $id])->all();
        $model_product_line = \common\models\ArsProductLine::find()->where(['ars_id' => $id])->all();

        if ($this->request->isPost && $model->load($this->request->post()) && $model_product->load($this->request->post())) {

            $line_product_id = \Yii::$app->request->post('line_product_id');
            $line_product_sku = \Yii::$app->request->post('line_sku');
            $line_product_serial_no = \Yii::$app->request->post('line_serial_no');
            $line_product_qty = \Yii::$app->request->post('line_qty');
            $line_rec_id = \Yii::$app->request->post('line_rec_id');

            $exp = explode('-',$model_product->period_start_date);
            $exp2 = explode('-',$model_product->period_end_date);
            $exp3 = explode('-',$model->issue_date);
            $w_start_date = date('Y-m-d');
            $w_exp_date = date('Y-m-d');
            $issue_date = date('Y-m-d');
            if($exp!=null){
                if(count($exp)>1){
                    $w_start_date = $exp[2].'-'.$exp[1].'-'.$exp[0];
                }
            }
            if($exp2!=null){
                if(count($exp2)>1){
                    $w_exp_date = $exp2[2].'-'.$exp2[1].'-'.$exp2[0];
                }
            }
            if($exp3!=null){
                if(count($exp3)>1){
                    $issue_date = $exp3[2].'-'.$exp3[1].'-'.$exp3[0];
                }
            }
            $model->issue_date = date('Y-m-d',strtotime($issue_date));
            if($model->save(false)){
                \common\models\ArsLine::deleteAll(['ars_id' => $id]);

                $model_product->ars_id = $model->id;
                $model_product->period_start_date = date('Y-m-d',strtotime($w_start_date));
                $model_product->period_end_date = date('Y-m-d',strtotime($w_exp_date));
                $model_product->qty = 1;
                $model_product->save(false);



                if($line_product_id!=null){
                    \common\models\ArsProductLine::deleteAll(['ars_id' => $id]);
                    for($k=0;$k<=count($line_product_id)-1;$k++){
                        $model_product_line = new \common\models\ArsProductLine();
                        $model_product_line->ars_id = $model->id;
                        $model_product_line->product_id = $line_product_id[$k];
                        $model_product_line->sku = $line_product_sku[$k];
                        $model_product_line->serial_no = $line_product_serial_no[$k];
                        $model_product_line->qty = $line_product_qty[$k];
                        $model_product_line->save(false);
                    }
                }

                $model_log = new \common\models\ArsLog();
                $model_log->ars_id = $model->id;
                $model_log->detail = $model->log_text;
                $model_log->trans_date = date('Y-m-d H:i:s');
                $model_log->issue_by  = \Yii::$app->user->id;
                $model_log->save(false);
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'model_product' => $model_product,
            'model_line' => $model_line,
            'model_product_line'=>$model_product_line,
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

    public function actionPrint($id){

        $model_product = \common\models\ArsLine::find()->where(['ars_id'=>$id])->one();
        return $this->render('_print', [
            'model' => $this->findModel($id),
            'model_product' => $model_product,
        ]);
    }
    public function actionPrintadvance($id){

        $model_product = \common\models\ArsLine::find()->where(['ars_id'=>$id])->one();
        $model_product_line =\common\models\ArsProductLine::find()->where(['ars_id'=>$id])->all();
        return $this->render('_print', [
            'model' => $this->findModel($id),
            'model_product' => $model_product,
            'model_product_line'=> $model_product_line,
        ]);
    }

    public function actionApprove($id){
      //  $id = \Yii::$app->request->post('id');
        if($id){
            $model = \backend\models\Ars::find()->where(['id'=>$id])->one();
            if($model){
                $model->status = 1;
                $model->ars_no = $this->getLastNo($model->customer_id,date('d-m-Y'),substr(date('Y'),2,2));
                if($model->save(false)){
                    $this->createProductIssue($model->id,$model->ars_no);

                    $model_log = new \common\models\ArsLog();
                    $model_log->ars_id = $model->id;
                    $model_log->detail = 'Approved';
                    $model_log->trans_date = date('Y-m-d H:i:s');
                    $model_log->issue_by  = \Yii::$app->user->id;
                    $model_log->save(false);

                    return $this->redirect(['view', 'id' => $id]);
                }
            }else{
                return $this->redirect(['view', 'id' => $id]);
            }
        }else{
            return $this->redirect(['view', 'id' => $id]);
        }
    }
    public function getLastNo($customer_id,$warranty_start_date,$year_end_warranty){
        $runno = '';
        $s_date = '';
        $x_date = explode('-',$warranty_start_date);
        if($x_date!=null){
            if(count($x_date)>1){
                $s_date = $x_date[0].$x_date[1].substr($x_date[2],2,2);
            }
        }
        $prefix = 'ARP'.$customer_id.'-'.$s_date.'-'.$year_end_warranty;
        $model = \backend\models\Ars::find()->MAX('id');
        if($model){
            $prefix.='-'.$model+1;
        }
        $runno = $prefix;

        return $runno;
    }
    public function createProductIssue($ars_id,$ars_no){
        if($ars_id){
            $model_ars_line = \common\models\ArsLine::find()->where(['ars_id'=>$ars_id])->one();
            if($model_ars_line){
                if($model_ars_line->product_id != null){
                    $model_journal = new \backend\models\Journalissue();
                    $model_journal->journal_no = $model_journal::getLastNo();
                    $model_journal->trans_date = date('Y-m-d H:i:s');
                    $model_journal->activity_type_id = 2; // 2 is issue ARS
                    $model_journal->doc_ref_no = $ars_no;
                    if($model_journal->save(false)){
                        $model_journal_line = new \common\models\JouranlIssueLine();
                        $model_journal_line->journal_issue_id = $model_journal->id;
                        $model_journal_line->product_id = $model_ars_line->product_id;
                        $model_journal_line->qty = $model_ars_line->qty;
                        if($model_journal_line->save(false)){
                            $model_trans = new \backend\models\Stocktrans();
                            $model_trans->journal_no = $model_journal->journal_no;//$model_trans::getIssueLastNo();
                            $model_trans->trans_date = date('Y-m-d H:i:s');
                            $model_trans->product_id = $model_journal_line->product_id;
                            $model_trans->qty = (float)$model_journal_line->qty;
                            $model_trans->activity_type_id = 2; // 2 is deduct issue
                            $model_trans->stock_type_id = 2; // 1 = in , 2 = out
                            $model_trans->trans_ref_id = $model_journal->id;
                            $model_trans->warehouse_id = 1;
                            if($model_trans->save(false)){
                                $model_stock = \backend\models\Stocksum::find()->where(['product_id' => $model_journal_line->product_id])->andFilterWhere(['>=','qty',(float)$model_journal_line->qty])->one();
                                if ($model_stock) {
                                    if ($model_stock->qty >= $model_journal_line->qty) {
                                        $model_stock->qty = (float)$model_stock->qty - (float)$model_journal_line->qty;
                                        $model_stock->save(false);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
