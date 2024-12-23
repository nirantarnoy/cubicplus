<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Ars $model */
/** @var yii\widgets\ActiveForm $form */


if($model_line!=null){
    foreach ($model_line as $value) {
        $model_product->product_id = $value->product_id;
        $model_product->period_start_date = $value->period_start_date;
        $model_product->period_end_date = $value->period_end_date;
        $model_product->warranty_year = $value->warranty_year;
        $model_product->install_area_id = $value->install_area_id;
        $model_product->install_address = $value->install_address;
        $model_product->install_province_id = $value->install_province_id;
        $model_product->install_zipcode = $value->install_zipcode;

    }
}

?>

<div class="ars-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="card" style="padding: 10px;">
        <div class="row">
            <div class="col-lg-12">
                <h4>1. ข้อมูลบริษัท/ห้างร้าน/หน่วยงาน/องค์กร</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <?= $form->field($model, 'ars_no')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'customer_id')->widget(\kartik\select2\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(\common\models\Customer::find()->all(), 'id', function ($data) {
                        return $data->name;
                    }),
                    'options' => ['placeholder' => 'Select Customer'],
                    'pluginOptions' => ['allowClear' => true],
                ]) ?>
            </div>
            <div class="col-lg-3">
                <label for="">ที่อยู่ลูกค้า</label>
                <textarea name="customer_address" class="form-control" id="" cols="30" rows="2"></textarea>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'issue_date')->textInput() ?>
            </div>
        </div>
    </div>
    <div class="card" style="padding: 10px;">
        <div class="row">
            <div class="col-lg-12">
                <h4>2. ข้อมูลสินค้า</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <?php //echo $model_product = $model_line != null ? $model_line[0]['product_id']:'';?>
                <?= $form->field($model_product, 'product_id')->widget(\kartik\select2\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(\common\models\Product::find()->all(), 'id', 'sku'),
                    'options' => ['placeholder' => 'Select Product'],
                    'pluginOptions' => ['allowClear' => true],

                ])->label('รุ่น / Model no.') ?>
            </div>
            <div class="col-lg-3">
                <label for="">หมายเลข Serial no.</label>
                <input type="text" class="form-control" name="product_serial_no" value="" readonly>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model_product, 'warranty_year')->widget(\kartik\select2\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(\common\models\ArsPackageType::find()->all(), 'id', 'name'),
                    'options' => ['placeholder' => 'Select Package Type'],
                    'pluginOptions' => ['allowClear' => true],
                ]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model_product, 'install_area_id')->widget(\kartik\select2\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(\common\models\InstallArea::find()->all(), 'id', 'name'),
                    'options' => ['placeholder' => 'Select Area Zone '],
                    'pluginOptions' => ['allowClear' => true],
                ]) ?>
            </div>


        </div>
        <div class="row">
            <div class="col-lg-6">
                <?= $form->field($model_product, 'install_address')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model_product, 'install_province_id')->widget(\kartik\select2\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(\common\models\Province::find()->all(), 'PROVINCE_ID', 'PROVINCE_NAME'),
                    'options' => ['placeholder' => 'Select Province '],
                    'pluginOptions' => ['allowClear' => true],
                ]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model_product, 'install_zipcode')->textInput() ?>
            </div>

        </div>
        <div class="row">
            <div class="col-lg-3">
                <?php //echo $model_product->period_start_date = $model->isNewRecord ? date('d-m-Y') : date('d-m-Y', strtotime($model_product->period_start_date)); ?>
                <?= $form->field($model_product, 'period_start_date')->widget(\kartik\date\DatePicker::className(), [
                    'type' => \kartik\date\DatePicker::TYPE_COMPONENT_PREPEND,
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd-mm-yyyy',
                    ]
                ]) ?>
            </div>
            <div class="col-lg-3">
                <?php //echo $model_product->period_end_date = $model->isNewRecord ? date('d-m-Y') : date('d-m-Y', strtotime($model_product->period_end_date)); ?>
                <?= $form->field($model_product, 'period_end_date')->widget(\kartik\date\DatePicker::className(), [
                    'type' => \kartik\date\DatePicker::TYPE_COMPONENT_PREPEND,
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd-mm-yyyy',
                    ]
                ]) ?>
            </div>
        </div>
    </div>
    <div class="card" style="padding: 10px;">
        <div class="row">
            <div class="col-lg-12">
                <h4>3. ข้อมูลสินค้าอื่นๆที่ให้บริการรับประกัน</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <?= $form->field($model, 'other_product')->textarea() ?>
            </div>
        </div>
    </div>

<!--    <div class="row">-->
<!--        <div class="col-lg-3">-->
<!--            --><?php //= $form->field($model, 'status')->textInput() ?>
<!--        </div>-->
<!--    </div>-->
    <?php if(!$model->isNewRecord):?>
    <div class="row">
        <div class="col-lg-8">
            <?= $form->field($model, 'log_text')->textInput() ?>
        </div>
        <div class="col-lg-4">
            <label for="">User</label>
            <input type="text" class="form-control" readonly value="<?=\backend\models\User::findName(\Yii::$app->user->id)?>">
        </div>
    </div>
    <?php else:?>
    <?php endif;?>
    <br />

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
