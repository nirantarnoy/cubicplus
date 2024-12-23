<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Journalissue $model */

$this->title = $model->journal_no;
$this->params['breadcrumbs'][] = ['label' => 'เบิกสินค้า', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="journalissue-view">

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
            // 'id',
            'journal_no',
//            [
//                'attribute' => 'trans_date',
//                'format' => ['date', 'php:d-m-Y H:i:s'],
//            ],
            'doc_ref_no',
            [
                'attribute' => 'activity_type_id',
                'value' => function ($data) {
                    return \backend\helpers\IssueactivityType::getTypeById($data->activity_type_id);
                }
            ],
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:d-m-Y H:i:s'],
            ],
            [
                'attribute' => 'created_by',
                'value' => function ($data) {
                    return \backend\models\User::findName($data->created_by);
                },
            ],
//            'updated_at',
//            'updated_by',
        ],
    ]) ?>
    <div class="row">
        <div class="col-lg-12">
            <table class="table" style="border: 1px solid grey;">
                <thead>
                <tr>
                    <th style="border: 1px solid grey;width: 15%">รหัสสินค้า</th>
                    <th style="border: 1px solid grey;">รายละเอียด</th>
                    <th style="border: 1px solid grey;width:10%;text-align: center;">คลังสินค้า</th>
                    <th style="border: 1px solid grey;width: 10%;text-align: right;">จำนวนเบิก</th>
                    <th style="border: 1px solid grey;">หมายเหตุ</th>
                </tr>
                </thead>
                <tbody>
                <?php if ($model_line != null): ?>
                <?php foreach ($model_line as $value): ?>
                    <tr>
                        <td style="border: 1px solid grey;"><?=\backend\models\Product::findSku($value->product_id)?></td>
                        <td style="border: 1px solid grey;"><?=\backend\models\Product::findName($value->product_id)?></td>
                        <td style="border: 1px solid grey;text-align: center;"><?=\backend\models\Warehouse::findName($value->warehouse_id)?></td>
                        <td style="border: 1px solid grey;text-align: right;"><?=$value->qty!=null?number_format($value->qty):'0'?></td>
                        <td style="border: 1px solid grey;"><?=$value->remark?></td>
                    </tr>
                <?php endforeach;?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
