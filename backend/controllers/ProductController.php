<?php

namespace backend\controllers;

use backend\models\Product;
use backend\models\ProductSearch;
use backend\models\WarehouseSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\web\ForbiddenHttpException;
use yii\filters\AccessControl;
use yii\web\Session;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
                        'delete' => ['POST', 'GET'],
                    ],
                ],
//                'access' => [
//                    'class' => AccessControl::className(),
//                    'denyCallback' => function ($rule, $action) {
//                        throw new ForbiddenHttpException('คุณไม่ได้รับอนุญาติให้เข้าใช้งาน!');
//                    },
//                    'rules' => [
//                        [
//                            'allow' => true,
//                            'roles' => ['@'],
//                            'matchCallback' => function ($rule, $action) {
//                                $currentRoute = \Yii::$app->controller->getRoute();
//                                if (\Yii::$app->user->can($currentRoute)) {
//                                    return true;
//                                }
//                            }
//                        ]
//                    ]
//                ],
            ]
        );
    }

    /**
     * Lists all Product models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $viewstatus = 1;

        if (\Yii::$app->request->get('viewstatus') != null) {
            $viewstatus = \Yii::$app->request->get('viewstatus');
        }

        $pageSize = \Yii::$app->request->post("perpage");
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
//        if($viewstatus ==1){
//            $dataProvider->query->andFilterWhere(['status'=>$viewstatus]);
//        }
//        if($viewstatus == 2){
//            $dataProvider->query->andFilterWhere(['status'=>0]);
//        }

        $dataProvider->setSort(['defaultOrder' => ['id' => SORT_DESC]]);
        $dataProvider->pagination->pageSize = $pageSize;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'perpage' => $pageSize,
            'viewstatus' => $viewstatus,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id){
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Product();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $line_warehouse = \Yii::$app->request->post('warehouse_id');
                $line_qty = \Yii::$app->request->post('line_qty');
                $line_exp_date = \Yii::$app->request->post('line_exp_date');

                $exp = explode('-',$model->warranty_expired_date);
                $exp2 = explode('-',$model->warranty_start_date);
                $exp3 = explode('-',$model->receive_date);
                $exp4 = explode('-',$model->po_date);
                $w_start_date = date('Y-m-d');
                $w_exp_date = date('Y-m-d');
                $rec_date = date('Y-m-d');
                $po_date = date('Y-m-d');
                if($exp!=null){
                    if(count($exp)>1){
                        $w_exp_date = $exp[2].'-'.$exp[1].'-'.$exp[0];
                    }
                }
                if($exp2!=null){
                    if(count($exp2)>1){
                        $w_start_date = $exp2[2].'-'.$exp2[1].'-'.$exp2[0];
                    }
                }
                if($exp3!=null){
                    if(count($exp3)>1){
                        $rec_date = $exp3[2].'-'.$exp3[1].'-'.$exp3[0];
                    }
                }
                if($exp4!=null){
                    if(count($exp4)>1){
                        $po_date = $exp4[2].'-'.$exp4[1].'-'.$exp4[0];
                    }
                }


                //  $model->code = $model->sku;
               //  $model->is_special = 0;
                $model->warranty_expired_date = date('Y-m-d',strtotime($w_exp_date));
                $model->warranty_start_date = date('Y-m-d',strtotime($w_start_date));
                $model->po_date = date('Y-m-d',strtotime($po_date));
                $model->receive_date = date('Y-m-d H:i:s');
                $model->inventory_status = 0; // ว่าง
                if ($model->save(false)) {
                    $uploaded = UploadedFile::getInstanceByName('product_photo');
                    $uploaded2 = UploadedFile::getInstanceByName('product_photo_2');
                    $uploaded3 = UploadedFile::getInstanceByName('product_photo_3');

                    if (!empty($uploaded)) {
                        $upfiles = "photo_" . time() . "." . $uploaded->getExtension();
                        if ($uploaded->saveAs('uploads/product_photo/' . $upfiles)) {
                            \backend\models\Product::updateAll(['photo' => $upfiles], ['id' => $model->id]);
                        }

                    }
                    if (!empty($uploaded2)) {
                        $upfiles2 = "photo_" . time() . "." . $uploaded2->getExtension();
                        if ($uploaded2->saveAs('uploads/product_photo/' . $upfiles2)) {
                            \backend\models\Product::updateAll(['photo_2' => $upfiles2], ['id' => $model->id]);
                        }

                    }
                    if (!empty($uploaded3)) {
                        $upfiles3 = "photo_" . time() . "." . $uploaded3->getExtension();
                        if ($uploaded3->saveAs('uploads/product_photo/' . $upfiles3)) {
                            \backend\models\Product::updateAll(['photo_3' => $upfiles3], ['id' => $model->id]);
                        }

                    }

                    if($line_warehouse != null){
                        for($i=0;$i<count($line_warehouse);$i++){
                            if($line_qty[$i] == 0){
                                continue;
                            }

                            $model_trans = new \backend\models\Stocktrans();
                            $model_trans->product_id = $model->id;
                            $model_trans->trans_date = date('Y-m-d H:i:s');
                            $model_trans->activity_type_id = 1; // 1 ปรับสต๊อก 2 รับเข้า 3 จ่ายออก
                            $model_trans->warehouse_id = 1;
                            $model_trans->qty = $line_qty[$i];
                            $model_trans->status = 1;
                            if($model_trans->save(false)){
                                $model_sum = \backend\models\Stocksum::find()->where(['product_id'=>$model->id,'warehouse_id'=>$line_warehouse[$i]])->one();
                                if($model_sum){
                                    $model_sum->qty = $line_qty[$i];
                                    $model_sum->save(false);
                                }else{
                                    $model_sum = new \backend\models\Stocksum();
                                    $model_sum->product_id = $model->id;
                                    $model_sum->warehouse_id = $line_warehouse[$i];
                                    $model_sum->qty = $line_qty[$i];
                                    $model_sum->save(false);
                                }
                            }
                        }
                    }
                }

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
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model_line = \common\models\StockSum::find()->where(['product_id'=>$id])->all();
      //  $model_customer_line = \common\models\CustomerProductPrice::find()->where(['product_id'=>$id])->all();
        $model_customer_line= null;
        $work_photo = '';
        if ($this->request->isPost && $model->load($this->request->post())) {

            $line_warehouse = \Yii::$app->request->post('warehouse_id');
            $line_qty = \Yii::$app->request->post('line_qty');
            $line_exp_date = \Yii::$app->request->post('line_exp_date');

            $uploaded = UploadedFile::getInstanceByName('product_photo');
            $uploaded2 = UploadedFile::getInstanceByName('product_photo_2');
            $uploaded3 = UploadedFile::getInstanceByName('product_photo_3');

            $line_rec_id = \Yii::$app->request->post('line_rec_id');
            $removelist = \Yii::$app->request->post('remove_list');



            /// customer price

            $line_customer_rec_id = \Yii::$app->request->post('line_customer_rec_id');
            $line_product_customer_id = \Yii::$app->request->post('line_product_customer_id');
            $line_customer_price = \Yii::$app->request->post('line_customer_price');
            $line_include_vat = \Yii::$app->request->post('line_include_vat');
            $removecustomerlist = \Yii::$app->request->post('remove_customer_list');

            $exp = explode('-',$model->warranty_expired_date);
            $exp2 = explode('-',$model->warranty_start_date);
            $exp3 = explode('-',$model->receive_date);
            $exp4 = explode('-',$model->po_date);
            $w_start_date = date('Y-m-d');
            $w_exp_date = date('Y-m-d');
            $rec_date = date('Y-m-d');
            $po_date = date('Y-m-d');
            if($exp!=null){
                if(count($exp)>1){
                    $w_exp_date = $exp[2].'-'.$exp[1].'-'.$exp[0];
                }
            }
            if($exp2!=null){
                if(count($exp2)>1){
                    $w_start_date = $exp2[2].'-'.$exp2[1].'-'.$exp2[0];
                }
            }
            if($exp3!=null){
                if(count($exp3)>1){
                    $rec_date = $exp3[2].'-'.$exp3[1].'-'.$exp3[0];
                }
            }
            if($exp4!=null){
                if(count($exp4)>1){
                    $po_date = $exp4[2].'-'.$exp4[1].'-'.$exp4[0];
                }
            }


            //  $model->code = $model->sku;
            //  $model->is_special = 0;
            $model->warranty_expired_date = date('Y-m-d',strtotime($w_exp_date));
            $model->warranty_start_date = date('Y-m-d',strtotime($w_start_date));
            $model->receive_date = date('Y-m-d H:i:s',strtotime($rec_date));
            $model->po_date = date('Y-m-d H:i:s',strtotime($po_date));
            if ($model->save(false)) {
                if (!empty($uploaded)) {
                    $upfiles = "photo_1" . time() . "." . $uploaded->getExtension();
                    if ($uploaded->saveAs('uploads/product_photo/' . $upfiles)) {
                        \backend\models\Product::updateAll(['photo' => $upfiles], ['id' => $model->id]);
                    }

                }
                if (!empty($uploaded2)) {
                    $upfiles2 = "photo_2" . time() . "." . $uploaded2->getExtension();
                    if ($uploaded2->saveAs('uploads/product_photo/' . $upfiles2)) {
                        \backend\models\Product::updateAll(['photo_2' => $upfiles2], ['id' => $model->id]);
                    }

                }
                if (!empty($uploaded3)) {
                    $upfiles3 = "photo_3" . time() . "." . $uploaded3->getExtension();
                    if ($uploaded3->saveAs('uploads/product_photo/' . $upfiles3)) {
                        \backend\models\Product::updateAll(['photo_3' => $upfiles3], ['id' => $model->id]);
                    }

                }

                for($i=0;$i<count($line_warehouse);$i++){
                    if($line_qty[$i] == 0){
                        continue;
                    }

                    $model_trans = new \backend\models\Stocktrans();
                    $model_trans->product_id = $model->id;
                    $model_trans->trans_date = date('Y-m-d H:i:s');
                    $model_trans->activity_type_id = 1; // 1 ปรับสต๊อก 2 เบิก 3 คำสั่งซื้อ
                    $model_trans->qty = $line_qty[$i];
                    $model_trans->status = 1;
                    if($model_trans->save()){
                  //      $model_sum = \backend\models\Stocksum::find()->where(['product_id'=>$model->id,'warehouse_id'=>$line_warehouse[$i],'expired_date'=>date('Y-m-d',strtotime($exp_date))])->one();
                       if($line_rec_id[$i] != 0){

                           $model_sum = \backend\models\Stocksum::find()->where(['product_id'=>$model->id,'id'=>$line_rec_id[$i]])->one();
                           if($model_sum){
                               $model_sum->warehouse_id = $line_warehouse[$i];
                               $model_sum->qty = $line_qty[$i];
                               $model_sum->save(false);
                           }
                       }else{
                           $model_sum_new = new \backend\models\Stocksum();
                           $model_sum_new->product_id = $model->id;
                           $model_sum_new->warehouse_id = $line_warehouse[$i];
                           $model_sum_new->qty = $line_qty[$i];
                           $model_sum_new->save(false);
                       }

                    }
                }


                if($line_product_customer_id!=null){

                    for($i=0;$i<count($line_product_customer_id);$i++){
                        if($line_customer_price[$i] == 0){
                            continue;
                        }
                       // echo "ok";return;
                        $model_check = \common\models\CustomerProductPrice::find()->where(['id'=>$line_customer_rec_id[$i]])->one();
                        if($model_check){
                            $model_check->customer_id = $line_product_customer_id[$i];
                            $model_check->sale_price = $line_customer_price[$i];
                            $model_check->include_vat = $line_include_vat[$i];
                            $model_check->save(false);
                        }else{
                            $model_customer = new \common\models\CustomerProductPrice();
                            $model_customer->product_id = $model->id;
                            $model_customer->customer_id = $line_product_customer_id[$i];
                            $model_customer->sale_price = $line_customer_price[$i];
                            $model_customer->include_vat = $line_include_vat[$i];
                            $model_customer->status = 0;
                            $model_customer->price_date = date('Y-m-d H:i:s');
                            $model_customer->save(false);
                        }

                    }
                }


                if($removelist!=null){
                    $xdel = explode(',', $removelist);
                    for($i=0;$i<count($xdel);$i++){
                        \backend\models\Stocksum::deleteAll(['id'=>$xdel[$i]]);
                    }
                }

                if($removecustomerlist!=null){
                    $xdel2 = explode(',', $removecustomerlist);
                    for($i=0;$i<count($xdel2);$i++){
                        \common\models\CustomerProductPrice::deleteAll(['id'=>$xdel2[$i]]);
                    }
                }
            }
            \Yii::$app->session->setFlash("msg-success","ทำรายการสำเร็จ");
            return $this->redirect(['product/update', 'id' => $model->id]);
           // return $this->redirect(['product/index']);
        }

        return $this->render('update', [
            'model' => $model,
            'work_photo' => $work_photo,
            'model_line' => $model_line,
            'model_customer_line'=>$model_customer_line,
        ]);
    }

    /**
     * Deletes an existing Product model.
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
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionImportpage()
    {
        return $this->render('_import');
    }
    public function actionImportproduct()
    {
        $uploaded = UploadedFile::getInstanceByName('file_import');
        if (!empty($uploaded)) {
            //echo "ok";return;
            $upfiles = time() . "." . $uploaded->getExtension();
            // if ($uploaded->saveAs(Yii::$app->request->baseUrl . '/uploads/files/' . $upfiles)) {
            if ($uploaded->saveAs('../web/uploads/files/products/' . $upfiles)) {
                //  echo "okk";return;
                // $myfile = Yii::$app->request->baseUrl . '/uploads/files/' . $upfiles;
                $myfile = '../web/uploads/files/products/' . $upfiles;
                $file = fopen($myfile, "r+");
                fwrite($file, "\xEF\xBB\xBF");

                setlocale(LC_ALL, 'th_TH.TIS-620');
                $i = -1;
                $res = 0;
                $data = [];
                while (($rowData = fgetcsv($file, 10000, ",")) !== FALSE) {
                    $i += 1;
                    $catid = 0;
                    $qty = 0;
                    $price = 0;
                    $cost = 0;
                    if ($rowData[1] == '' || $i == 0) {
                        continue;
                    }

                    $model_dup = \backend\models\Product::find()->where(['sku' => trim($rowData[1])])->one();
                    if ($model_dup != null) {
                        continue;
                    }


                    $modelx = new \backend\models\Product();
                    // $modelx->code = $rowData[0];
                    $modelx->code = $rowData[2];
                    $modelx->sku = $rowData[2];
                    $modelx->name = $rowData[1];
                    $modelx->barcode = $rowData[3];
                    $modelx->total_qty = $rowData[4];
                    $modelx->sale_price = $rowData[5];
                    $modelx->status = 1;
                    if ($modelx->save(false)) {
                        $res += 1;
                    }
                }
                //    print_r($qty_text);return;

                if ($res > 0) {
                    $session = \Yii::$app->session;
                    $session->setFlash('msg', 'นำเข้าข้อมูลเรียบร้อย');
                    return $this->redirect(['index']);
                } else {
                    $session = \Yii::$app->session;
                    $session->setFlash('msg-error', 'พบข้อมผิดพลาดนะ');
                    return $this->redirect(['index']);
                }
                // }
                fclose($file);
//            }
//        }
            }
            echo "ok";
        }
    }

    public function actionFinditem()
    {
        $html = '';
        $has_data = 0;
        //$model = \backend\models\Workqueue::find()->where(['is_invoice' => 0])->all();
        // $model = \backend\models\Stocksum::find()->where(['warehouse_id' => 7])->all();
        $model = \backend\models\Product::find()->where(['status'=>1])->all();
        if ($model) {
            $has_data = 1;
            foreach ($model as $value) {
                $onhand_qty = $this->getProductOnhand($value->id);
                $code = $value->sku;
                $name = $value->serial_no;
                $price = 0;
                $unit_id = $value->unit_id;
                $unit_name = \backend\models\Unit::findName($unit_id);
              //  $is_drummy  = $value->is_special;
                $is_drummy =0;
                $html .= '<tr>';
                $html .= '<td style="text-align: center">
                            <div class="btn btn-outline-success btn-sm" onclick="addselecteditem($(this))" data-var="' . $value->id . '">เลือก</div>
                            <input type="hidden" class="line-find-item-id" value="' . $value->id . '">
                            <input type="hidden" class="line-find-item-code" value="' . $code . '">
                            <input type="hidden" class="line-find-item-name" value="' . $name . '">
                            <input type="hidden" class="line-find-price" value="' . $price . '">
                            <input type="hidden" class="line-find-unit-id" value="' . $unit_id . '">
                            <input type="hidden" class="line-find-unit-name" value="' . $unit_name . '">
                            <input type="hidden" class="line-find-is-drummy" value="' . $is_drummy . '">
                           </td>';
                $html .= '<td style="text-align: left">' . $code . '</td>';
                $html .= '<td style="text-align: left">' . $name . '</td>';
                $html .= '<td style="text-align: left">' . $unit_name . '</td>';
                $html .= '<td style="text-align: left">' . $onhand_qty . '</td>';
                $html .= '</tr>';
            }
        }

        if ($has_data == 0) {
            $html .= '<tr>';
            $html .= '<td colspan="5" style="text-align: center;color: red;">ไม่พบข้อมูล</td>';
            $html .= '</tr>';
        }
        echo $html;
    }

    function getProductOnhand($product_id){
        return \common\models\StockSum::find()->where(['product_id' => $product_id])->sum('qty');
    }
    public function actionGetserialno(){
        $name = '';
        $product_id = \Yii::$app->request->post('id');
        if($product_id){
            $model = \common\models\Product::find()->where(['id' => $product_id])->one();
            $name = $model == null ? '':$model->serial_no;
        }
        echo $name;
    }
    public function actionGetpurchdata(){
        $data = [];
        $product_id = \Yii::$app->request->post('id');
        if($product_id){
            $model = \common\models\Product::find()->where(['id' => $product_id])->one();
            if($model){
                array_push($data, ['reseller_name'=>$model->reseller_name,'po_no'=>$model->po_no,'po_date'=>$model->po_date !=null ?date('d/m/Y',strtotime($model->po_date)):'']);
            }
        }
        echo json_encode($data);
    }
}
