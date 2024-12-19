<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Usergroup */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'กลุ่มผู้ใช้งาน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="usergroup-view">
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
            'code',
            'name',
            'description',
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
