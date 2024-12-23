<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Quotation $model */

$this->title = $model->quotation_no;
$this->params['breadcrumbs'][] = ['label' => 'ใบเสนอราคา', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="quotation-view">

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
                    //  'id',
                    'quotation_no',
                    'quotation_date',
                    [
                        'attribute' => 'quotation_date',
                        'value' => function ($model) {
                            return date('d-m-Y', strtotime($model->quotation_date));
                        }
                    ],
                    [
                        'attribute' => 'customer_id',
                        'value' => function ($model) {
                            return \backend\models\Customer::findCusFullName($model->customer_id);
                        }
                    ],
                    'attn',

                ],
            ]) ?>
        </div>
        <div class="col-lg-6">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'from',
                    'due_date_amt',
                    [
                        'attribute' => 'status',
                        'value' => function ($model) {
                            return \backend\helpers\QuotationStatus::getTypeById($model->status);
                        }
                    ],
//            'created_at',
//            'created_by',
//            'updated_at',
//            'updated_by',
                    'remark',
                    'description',
                ],
            ]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12" style="padding: 10px;">
            <b>รายการ</b>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table" style="width:100%;border: 1px solid gray">
                <thead>
                <tr>
                    <th style="width: 5%;text-align: center;border: 1px solid grey;padding 8px;">#</th>
                    <th style="border: 1px solid grey;padding 8px;text-align: center;">รหัสสินค้า</th>
                    <th style="border: 1px solid grey;padding 8px;text-align: center;">SerialNo</th>
                    <th style="border: 1px solid grey;padding 8px;text-align: center;">รายละเอียด</th>
                    <th style="border: 1px solid grey;padding 8px;text-align: right;">จำนวน</th>
                    <th style="border: 1px solid grey;padding 8px;text-align: center;">หน่วยนับ</th>
                    <th style="border: 1px solid grey;padding 8px;text-align: right;width:10%">ราคา</th>
                    <th style="border: 1px solid grey;padding 8px;text-align: right;">รวม</th>

                </tr>
                </thead>
                <tbody>
                <?php $line_num = 0;?>
                <?php if ($model_line != null): ?>
                    <?php foreach ($model_line as $value): ?>
                        <?php $line_num +=1;?>
                        <tr data-var="<?= $value->id ?>">
                            <td style="border: 1px solid grey;padding 10px;text-align: center;">
                                <?=$line_num?>
                            </td>
                            <td style="border: 1px solid grey;padding 10px;">
                              <?= \backend\models\Product::findCode($value->product_id) ?>
                            </td>
                            <td style="border: 1px solid grey;padding 10px;">
                               <?= $value->product_name != '' ? $value->product_name: \backend\models\Product::findSerialNo($value->product_id) ?>
                            </td>
                            <td style="border: 1px solid grey;padding 10px;">
                               <?=$value->mat_desc?>
                            </td>
                            <td style="border: 1px solid grey;text-align: right;padding 10px;">
                               <?= $value->qty ?>
                            </td>
                            <td style="border: 1px solid grey;text-align: center;padding 10px;">
                               <?= \backend\models\Unit::findName($value->unit_id)?>
                            </td>
                            <td style="border: 1px solid grey;text-align: right;padding 10px;">
                                <?= $value->line_price?>
                            </td>
                            <td style="border: 1px solid grey;text-align: right;padding 10px;">
                               <?= number_format($value->line_total,2) ?>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
