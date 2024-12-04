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
            'code',
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
            'std_price',
          //  'company_id',
        ],
    ]) ?>

</div>
