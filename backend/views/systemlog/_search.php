<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\SystemlogSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="systemlog-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>


    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'log_type_id')->widget(\kartik\select2\Select2::className(), [
                'data' => \yii\helpers\ArrayHelper::map(\backend\helpers\LogType::asArrayObject(), 'id', 'name'),
            ]) ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'trans_date')->widget(\kartik\date\DatePicker::className(), [
                'options' => [

                ],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd-mm-yyyy',
                    'todayHighlight' => true,
                ]
            ]) ?>
        </div>
        <div class="col-lg-3" style="padding-top: 25px;">
            <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        </div>
        <div class="col-lg-3">

        </div>
    </div>


    <!--    --><?php //= $form->field($model, 'function_name') ?>
    <!---->
    <!--    --><?php //= $form->field($model, 'user_id') ?>


    <?php ActiveForm::end(); ?>

</div>
