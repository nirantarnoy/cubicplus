<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Ars $model */

$this->title = $model->ars_no;
$this->params['breadcrumbs'][] = ['label' => 'Ars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="ars-view">
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
            'ars_no',
            [
                'attribute' => 'issue_date',
                'value' => function ($model) {
                    return $model->issue_date !=null ? date('d/m/Y', strtotime($model->issue_date)):'';
                }
            ],
            [
                'attribute' => 'customer_id',
                'value' => function ($model) {
                    return backend\models\Customer::findCusFullName($model->customer_id);
                }
            ],
            'status',
            [
                'attribute' => 'created_at',
                'value' => function ($model) {
                    return $model->created_at !=null ? date('d/m/Y H:i:s', $model->created_at): '';
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
                    return $model->updated_at!=null ? date('d/m/Y H:i:s', $model->updated_at):'';
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
