<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Company $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'ข้อมูลบริษัท', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="company-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <p>
        <?= Html::a('แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('ลบ', ['delete', 'id' => $model->id], [
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
//            'id',
            'name',
            'description',
            'taxid',
            'address',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->status == 1) {
                        return '<div class="badge badge-success">ใช้งาน</div>';
                    } else {
                        return '<div class="badge badge-default">ไม่ใช้งาน</div>';
                    }
                }
            ],
            [
                'attribute' => 'created_at',
                'value' => function ($model) {
                    return $model->created_at != null ? date('d/m/Y H:i:s', $model->created_at) : '';
                }
            ],
            [
                'attribute' => 'created_by',
                'value' => function ($model) {
                    return backend\models\User::findName($model->created_by);
                }
            ],
            [
                'attribute' => 'updated_at',
                'value' => function ($model) {
                    return $model->updated_at != null ? date('d/m/Y H:i:s', $model->updated_at) : '';
                }
            ],
            [
                'attribute' => 'updated_by',
                'value' => function ($model) {
                    return backend\models\User::findName($model->updated_by);
                }
            ],
        ],
    ]) ?>

</div>
