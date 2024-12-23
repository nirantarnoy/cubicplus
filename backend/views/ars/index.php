<?php

use backend\models\Ars;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;

//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap4\LinkPager;

/** @var yii\web\View $this */
/** @var backend\models\ArsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'ARS';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ars-index">
    <?php Pjax::begin(); ?>
    <div class="row">
        <div class="col-lg-10">
            <p>
                <?= Html::a(Yii::t('app', '<i class="fa fa-plus"></i> สร้างใหม่'), ['create'], ['class' => 'btn btn-success']) ?>
            </p>
        </div>
        <div class="col-lg-2" style="text-align: right">
            <form id="form-perpage" class="form-inline" action="<?= Url::to(['position/index'], true) ?>"
                  method="post">
                <div class="form-group">
                    <label>แสดง </label>
                    <select class="form-control" name="perpage" id="perpage">
                        <option value="20" <?= $perpage == '20' ? 'selected' : '' ?>>20</option>
                        <option value="50" <?= $perpage == '50' ? 'selected' : '' ?> >50</option>
                        <option value="100" <?= $perpage == '100' ? 'selected' : '' ?>>100</option>
                    </select>
                    <label> รายการ</label>
                </div>
            </form>
        </div>
    </div>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'emptyCell' => '-',
        'layout' => "{items}\n{summary}\n<div class='text-center'>{pager}</div>",
        'summary' => "แสดง {begin} - {end} ของทั้งหมด {totalCount} รายการ",
        'showOnEmpty' => false,
        'responsive' => true,
        //    'bordered' => true,
        //     'striped' => false,
        //    'hover' => true,
        'id' => 'product-grid',
        //'tableOptions' => ['class' => 'table table-hover'],
        'emptyText' => '<div style="color: red;text-align: center;"> <b>ไม่พบรายการไดๆ</b> <span> เพิ่มรายการโดยการคลิกที่ปุ่ม </span><span class="text-success">"สร้างใหม่"</span></div>',
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'headerOptions' => ['style' => 'text-align: center'],
                'contentOptions' => ['style' => 'text-align: center'],
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'headerOptions' => ['style' => 'text-align: center'],
                'contentOptions' => ['style' => 'text-align: center'],
                'value' => function ($data) {
                    if ($data->status == 1) {
                        return '<div class="badge badge-success"><i class="fa fa-check"></i> Approve</div>';
                    } else {
                        return '<div class="badge badge-warning"><i class="fa fa-clock"></i> Waiting</div>';
                    }
                }
            ],
            'ars_no',
            [
                'attribute' => 'issue_date',
                'value' => function ($data) {
                    return $data->issue_date !=null ? date('d/m/Y',strtotime($data->issue_date)) : '';
                }
            ],
            [
                'attribute' => 'customer_id',
                'value' => function ($data) {
                    return \backend\models\Customer::findCusFullName($data->customer_id);
                }
            ],
            [
                'attribute' => 'productars.product_id',
                'value' => function ($data) {
                    //  return \backend\models\Product::findSku($data->productars->product_id);
                    return $data->productars ? \backend\models\Product::findSku($data->productars->product_id) : '';
                }
            ],
            'productars.serial_no',
            [
                'attribute' => 'productars.warranty_year',
                'value' => function ($data) {
                    //  return \backend\models\Product::findSku($data->productars->product_id);
                    return $data->productars ? \backend\models\Arspackagetype::findName($data->productars->warranty_year) : '';
                }
            ],
            [
                'attribute' => 'productars.period_start_date',
                'value' => function ($data) {
                    return $data->productars ? date('d/m/Y', strtotime($data->productars->period_start_date)) : '';
                }
            ],
            [
                'attribute' => 'productars.period_end_date',
                'value' => function ($data) {
                    return $data->productars ? date('d/m/Y', strtotime($data->productars->period_end_date)) : '';
                }
            ],
            [
                'label' => 'Expire Days',
                'contentOptions' => ['style' => 'text-align: center'],
                'value' => function ($data) {
                    $left_date = null;
                    if($data->productars){
                        if($data->productars->period_start_date != null && $data->productars->period_end_date != null){
                            $date1 = date_create(date('Y-m-d',strtotime($data->productars->period_start_date)));
                            $date2 = date_create(date('Y-m-d', strtotime($data->productars->period_end_date)));
                            $left_date = $date1->diff($date2)->days;
                        }
                    }


                    return $left_date;
                }
            ],
            [
                'attribute' => 'productars.install_area_id',
                'value' => function ($data) {
                    return $data->productars ? \backend\models\Installarea::findName($data->productars->install_area_id) : '';
                }
            ],
            [
                'attribute' => 'productars.install_province_id',
                'value' => function ($data) {
                    return $data->productars ? \backend\models\Province::findProvinceName($data->productars->install_province_id) : '';
                }
            ],
            [
                'header' => 'ตัวเลือก',
                'headerOptions' => ['style' => 'text-align:center;', 'class' => 'activity-view-link',],
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'text-align: center'],
                'template' => '{view} {update}{delete}',
                'buttons' => [
                    'view' => function ($url, $data, $index) {
                        $options = [
                            'title' => Yii::t('yii', 'View'),
                            'aria-label' => Yii::t('yii', 'View'),
                            'data-pjax' => '0',
                        ];
                        return Html::a(
                            '<span class="fas fa-eye btn btn-xs btn-default"></span>', $url, $options);
                    },
                    'update' => function ($url, $data, $index) {
                        $options = array_merge([
                            'title' => Yii::t('yii', 'Update'),
                            'aria-label' => Yii::t('yii', 'Update'),
                            'data-pjax' => '0',
                            'id' => 'modaledit',
                        ]);
                        return Html::a(
                            '<span class="fas fa-edit btn btn-xs btn-default"></span>', $url, [
                            'id' => 'activity-view-link',
                            //'data-toggle' => 'modal',
                            // 'data-target' => '#modal',
                            'data-id' => $index,
                            'data-pjax' => '0',
                            // 'style'=>['float'=>'rigth'],
                        ]);
                    },
                    'delete' => function ($url, $data, $index) {
                        $options = array_merge([
                            'title' => Yii::t('yii', 'Delete'),
                            'aria-label' => Yii::t('yii', 'Delete'),
                            //'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                            //'data-method' => 'post',
                            //'data-pjax' => '0',
                            'data-url' => $url,
                            'data-var' => $data->id,
                            'onclick' => 'recDelete($(this));'
                        ]);
                        return Html::a('<span class="fas fa-trash-alt btn btn-xs btn-default"></span>', 'javascript:void(0)', $options);
                    }
                ]
            ],
        ],
        'pager' => ['class' => LinkPager::className()],
    ]); ?>

    <?php Pjax::end(); ?>

</div>