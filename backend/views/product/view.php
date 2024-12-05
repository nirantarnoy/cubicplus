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
            ['attribute' => 'receive_date','value'=>function($data){
               return $data->receive_date == null ? '': date('d-m-Y',strtotime($data->receive_date));
            }],
            ['attribute' => 'warranty_start_date','value'=>function($data){
                return $data->warranty_start_date == null ? '': date('d-m-Y',strtotime($data->warranty_start_date));
            }],

            ['attribute' => 'warranty_expired_date','value'=>function($data){
                return $data->warranty_expired_date == null ? '': date('d-m-Y',strtotime($data->warranty_expired_date));
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
            'cost',
            'sale_price',
            'commission',
            'inventory_status',
            'remark',
          //  'company_id',
        ],
    ]) ?>

</div>
