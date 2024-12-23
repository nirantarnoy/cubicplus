<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Product $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'สินค้า', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="row">
        <div class="col-lg-6">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    //   'id',
                    'sku',
                    'name',
                    'serial_no',
                    'description',
//            'product_type_id',
//            'product_cat_id',
                    [
                        'attribute' => 'product_category_id',
                        'value' => function ($data) {
                            return \backend\models\Productcategory::findName($data->product_category_id);
                        }
                    ],
                    [
                        'attribute' => 'unit_id',
                        'value' => function ($data) {
                            return \backend\models\Unit::findName($data->unit_id);
                        }
                    ],

                    ['attribute' => 'receive_date', 'value' => function ($data) {
                        return $data->receive_date == null ? '' : date('d-m-Y', strtotime($data->receive_date));
                    }],
                    ['attribute' => 'distributor_id', 'value' => function ($data) {
                        return \backend\models\Distributor::findName($data->distributor_id);
                    }],
                    'cost',
                    'sale_price',
                    'commission',

                ],
            ]) ?>
        </div>
        <div class="col-lg-6">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    ['attribute' => 'warranty_start_date', 'value' => function ($data) {
                        return $data->warranty_start_date == null ? '' : date('d-m-Y', strtotime($data->warranty_start_date));
                    }],

                    ['attribute' => 'warranty_expired_date', 'value' => function ($data) {
                        return $data->warranty_expired_date == null ? '' : date('d-m-Y', strtotime($data->warranty_expired_date));
                    }],

                    [
                        'attribute' => 'status',
                        'format' => 'raw',
                        'value' => function ($data) {
                            if ($data->status == 1) {
                                return '<div class="badge badge-success" >ใช้งาน</div>';
                            } else {
                                return '<div class="badge badge-secondary" >ไม่ใช้งาน</div>';
                            }
                        }
                    ],
                    //  'last_price',

                    [
                        'attribute' => 'inventory_status',
                        'format' => 'raw',
                        'value' => function ($data) {
                            $inv_status = \backend\helpers\InvenStatusType::getTypeById($data->inventory_status);
                            if ($data->inventory_status == 0) {
                                return '<div class="badge badge-success" >'.$inv_status.'</div>';
                            } else {
                                return '<div class="badge badge-secondary" >'.$inv_status.'</div>';
                            }
                        }
                    ],
                    [
                        'attribute' => 'onhand_qty',
                        'label' => 'จำนวนสินค้าคงเหลือ',
                        'value' => function ($data) {
                            $qty = \backend\models\Product::findOnhand($data->id);
                            return number_format($qty);
                        }
                    ],
                    'remark',
                    [
                        'attribute' => 'created_at',
                        'value' => function ($data) {
                            return date('d-m-Y H:i:s', strtotime($data->created_at));
                        }
                    ],
                    [
                        'attribute' => 'created_by',
                        'value' => function ($data) {
                            return \backend\models\User::findName($data->created_by);
                        }
                    ],
                    [
                        'attribute' => 'updated_at',
                        'value' => function ($data) {
                            return date('d-m-Y H:i:s', strtotime($data->created_at));
                        }
                    ],
                    [
                        'attribute' => 'updated_by',
                        'value' => function ($data) {
                            return \backend\models\User::findName($data->updated_by);
                        }
                    ],
                    //  'company_id',
                ],
            ]) ?>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-lg-12">
            <h5>รูปสินค้า</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">

            <div class="row">
                <div class="col-lg-3">
                    <a href="<?= \Yii::$app->getUrlManager()->baseUrl . '/uploads/product_photo/' . $model->photo ?>"
                       target="_blank"><img
                                src="<?= \Yii::$app->getUrlManager()->baseUrl . '/uploads/product_photo/' . $model->photo ?>"
                                style="max-width: 130px;margin-top: 5px;" alt=""></a>
                </div>
                <div class="col-lg-3">
                    <a href="<?= \Yii::$app->getUrlManager()->baseUrl . '/uploads/product_photo/' . $model->photo_2 ?>"
                       target="_blank"><img
                                src="<?= \Yii::$app->getUrlManager()->baseUrl . '/uploads/product_photo/' . $model->photo_2 ?>"
                                style="max-width: 130px;margin-top: 5px;" alt=""></a>
                </div>
                <div class="col-lg-3">
                    <a href="<?= \Yii::$app->getUrlManager()->baseUrl . '/uploads/product_photo/' . $model->photo_3 ?>"
                       target="_blank"><img
                                src="<?= \Yii::$app->getUrlManager()->baseUrl . '/uploads/product_photo/' . $model->photo_3 ?>"
                                style="max-width: 130px;margin-top: 5px;" alt=""></a>
                </div>
            </div>
        </div>
    </div>
</div>
