<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JqueryAsset;
use yii\widgets\ActiveForm;
use yii\web\Session;

/** @var yii\web\View $this */
/** @var backend\models\Product $model */
/** @var yii\widgets\ActiveForm $form */
$data_warehouse = \backend\models\Warehouse::find()->all();
$data_customer = \backend\models\Customer::find()->all();

$yesno = [['id' => 1, 'YES'], ['id' => 0, 'NO']];
$msg = 0;
if (\Yii::$app->session->hasFlash('msg-success')) {
    $msg = 1;
}
if (\Yii::$app->session->hasFlash('msg-error')) {
    $msg = 2;
}
//echo $msg;
?>

    <div class="product-form">
        <input type="hidden" class="msg-result" value="<?= $msg ?>">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <input type="hidden" class="remove-list" name="remove_list" value="">
        <input type="hidden" class="remove-customer-list" name="remove_customer_list" value="">
        <div class="row">
            <div class="col-lg-3">
                <?= $form->field($model, 'sku')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'serial_no')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'product_category_id')->widget(\kartik\select2\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(\backend\models\Productcategory::find()->all(), 'id', 'name'),
                    'options' => [

                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ]
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <?= $form->field($model, 'unit_id')->widget(\kartik\select2\Select2::className(), [
                    'data' => ArrayHelper::map(\backend\models\Unit::find()->all(), 'id', 'name'),
                    'options' => [
                        'placeholder' => '-- เลือกหน่วยนับ --',
                    ]
                ]) ?>
            </div>
            <div class="col-lg-6">
                <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>
            </div>

            <div class="col-lg-3">
                <?= $form->field($model, 'receive_date')->widget(\kartik\date\DatePicker::className(), [
                    'options' => [
                        'readonly' => true,
                    ],
                    'pluginOptions' => [
                        'format' => 'dd-mm-yyyy',
                        'autoclose' => true,
                    ]
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <?= $form->field($model, 'cost')->textInput() ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'sale_price')->textInput() ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'commission')->textInput() ?>
            </div>
            <div class="col-lg-3">
                <?php $model->warranty_start_date = $model->isNewRecord ? date('d-m-Y') : date('d-m-Y', strtotime($model->warranty_start_date)); ?>
                <?= $form->field($model, 'warranty_start_date')->widget(\kartik\date\DatePicker::className(), [
                    'options' => [
                       // 'format' => 'dd-mm-yyyy',
                    ],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'todayHighlight' => true,
                        'format' => 'dd-mm-yyyy',
                    ]
                ]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <?php $model->warranty_expired_date = $model->isNewRecord ? date('d-m-Y') : date('d-m-Y', strtotime($model->warranty_expired_date)); ?>
                <?= $form->field($model, 'warranty_expired_date')->widget(\kartik\date\DatePicker::className(), [
                    'pluginOptions' => [
                        'format' => 'dd-mm-yyyy',
                        'autoclose' => true,
                        'todayHighlight' => true,
                    ]
                ]) ?>
            </div>
            <div class="col-lg-3">
                <?php echo $form->field($model, 'status')->widget(\toxor88\switchery\Switchery::className(), ['options' => ['label' => '', 'class' => 'form-control']])->label() ?>
            </div>

                <div class="col-lg-3">
                    <?= $form->field($model, 'inventory_status')->textInput(['readonly'=>'readonly']) ?>
                </div>


        </div>
        <br/>
        <div class="row">
            <div class="col-lg-4">
                <label for="">รูปภาพ</label>
                <?php if ($model->isNewRecord): ?>
                    <table style="width: 100%">
                        <tr>
                            <td style="border: 1px dashed grey;height: 250px;text-align: center;">
                                <i class="fa fa-ban fa-lg" style="color: grey"></i>
                                <span style="color: lightgrey">ไม่พบไฟล์แนบ</span>
                            </td>
                        </tr>
                    </table>
                <?php else: ?>
                    <table style="width: 100%">
                        <tr>
                            <?php if ($model->photo != ''): ?>
                                <td style="border: 1px dashed grey;height: 250px;text-align: center;">
                                    <a href="<?= \Yii::$app->getUrlManager()->baseUrl . '/uploads/product_photo/' . $model->photo ?>"
                                       target="_blank"><img
                                                src="<?= \Yii::$app->getUrlManager()->baseUrl . '/uploads/product_photo/' . $model->photo ?>"
                                                style="max-width: 130px;margin-top: 5px;" alt=""></a>
                                </td>
                            <?php else: ?>
                                <td style="border: 1px dashed grey;height: 250px;text-align: center;">
                                    <i class="fa fa-ban fa-lg" style="color: grey"></i>
                                    <span style="color: lightgrey">ไม่พบไฟล์แนบ</span>
                                </td>
                            <?php endif; ?>
                        </tr>
                    </table>
                <?php endif; ?>
                <input type="file" name="product_photo" class="form-control">
            </div>
            <div class="col-lg-4">
                <label for="">รูปภาพ</label>
                <?php if ($model->isNewRecord): ?>
                    <table style="width: 100%">
                        <tr>
                            <td style="border: 1px dashed grey;height: 250px;text-align: center;">
                                <i class="fa fa-ban fa-lg" style="color: grey"></i>
                                <span style="color: lightgrey">ไม่พบไฟล์แนบ</span>
                            </td>
                        </tr>
                    </table>
                <?php else: ?>
                    <table style="width: 100%">
                        <tr>
                            <?php if ($model->photo_2 != ''): ?>
                                <td style="border: 1px dashed grey;height: 250px;text-align: center;">
                                    <a href="<?= \Yii::$app->getUrlManager()->baseUrl . '/uploads/product_photo/' . $model->photo_2 ?>"
                                       target="_blank"><img
                                                src="<?= \Yii::$app->getUrlManager()->baseUrl . '/uploads/product_photo/' . $model->photo_2 ?>"
                                                style="max-width: 130px;margin-top: 5px;" alt=""></a>
                                </td>
                            <?php else: ?>
                                <td style="border: 1px dashed grey;height: 250px;text-align: center;">
                                    <i class="fa fa-ban fa-lg" style="color: grey"></i>
                                    <span style="color: lightgrey">ไม่พบไฟล์แนบ</span>
                                </td>
                            <?php endif; ?>
                        </tr>
                    </table>
                <?php endif; ?>
                <input type="file" name="product_photo_2" class="form-control">
            </div>
            <div class="col-lg-4">
                <label for="">รูปภาพ</label>
                <?php if ($model->isNewRecord): ?>
                    <table style="width: 100%">
                        <tr>
                            <td style="border: 1px dashed grey;height: 250px;text-align: center;">
                                <i class="fa fa-ban fa-lg" style="color: grey"></i>
                                <span style="color: lightgrey">ไม่พบไฟล์แนบ</span>
                            </td>
                        </tr>
                    </table>
                <?php else: ?>
                    <table style="width: 100%">
                        <tr>
                            <?php if ($model->photo_3 != ''): ?>
                                <td style="border: 1px dashed grey;height: 250px;text-align: center;">
                                    <a href="<?= \Yii::$app->getUrlManager()->baseUrl . '/uploads/product_photo/' . $model->photo_3 ?>"
                                       target="_blank"><img
                                                src="<?= \Yii::$app->getUrlManager()->baseUrl . '/uploads/product_photo/' . $model->photo_3 ?>"
                                                style="max-width: 130px;margin-top: 5px;" alt=""></a>
                                </td>
                            <?php else: ?>
                                <td style="border: 1px dashed grey;height: 250px;text-align: center;">
                                    <i class="fa fa-ban fa-lg" style="color: grey"></i>
                                    <span style="color: lightgrey">ไม่พบไฟล์แนบ</span>
                                </td>
                            <?php endif; ?>
                        </tr>
                    </table>
                <?php endif; ?>
                <input type="file" name="product_photo_3" class="form-control">
            </div>

        </div>
        <br/>
        <div class="row">
            <div class="col-lg-12">
                <h4>จัดการสต๊อกสินค้า</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered table-striped" id="table-list">
                    <thead>
                    <tr>
                        <th style="text-align: center;">ที่จัดเก็บ</th>
                        <th style="text-align: center;">จำนวนคงเหลือ</th>
                        <th>-</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if ($model_line != null): ?>
                        <?php foreach ($model_line as $value): ?>
                            <tr data-var="<?= $value->id; ?>">
                                <td>
                                    <input type="hidden" class="form-control line-rec-id" name="line_rec_id[]"
                                           value="<?= $value->id ?>">
                                    <select name="warehouse_id[]" id="" class="form-control line-warehouse-id">
                                        <option value="-1">--เลือก-</option>
                                        <?php foreach ($data_warehouse as $xvalue): ?>
                                            <?php
                                            $selected = '';
                                            if ($value->warehouse_id == $xvalue->id) {
                                                $selected = 'selected';
                                            }
                                            ?>
                                            <option value="<?= $xvalue->id ?>" <?= $selected ?>><?= $xvalue->name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="form-control line-qty" name="line_qty[]"
                                           value="<?= $value->qty ?>">
                                </td>
                                <td>
                                    <div class="btn btn-danger" onclick="removeline($(this))"><i
                                                class="fa fa-trash"></i></div>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr data-var="">
                            <td>
                                <!--                            <input type="text" class="form-control line-warehouse-id" name="warehouse_id[]" value="">-->
                                <input type="hidden" class="form-control line-rec-id" name="line_rec_id[]" value="0">
                                <select name="warehouse_id[]" id="" class="form-control line-warehouse-id">
                                    <option value="-1">--เลือก-</option>
                                    <?php foreach ($data_warehouse as $xvalue): ?>
                                        <option value="<?= $xvalue->id ?>"><?= $xvalue->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td>
                                <input type="text" class="form-control line-qty" name="line_qty[]" value="">
                            </td>
                            <td>
                                <div class="btn btn-danger" onclick="removeline($(this))"><i class="fa fa-trash"></i>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>

                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="3" style="text-align: left;">
                            <div class="btn btn-sm btn-primary" onclick="addline($(this))">เพิ่ม</div>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <br/>


        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
<?php
$url = Url::base();
$this->registerJsFile("$url/js/custom/showsweetalert.js", ['depends' => JqueryAsset::class]);
$js = <<<JS
var removelist = [];
var removecustomerpricelist = [];
$(function(){
  // $(".line-exp-date").datepicker(); 
  var msg_status = $(".msg-result").val();
  //alert(msg_status);
  if(msg_status == 1){
      showAlert("success","ทำรายการสำเร็จ");
  }else if(msg_status == 2){
      showAlert("error","ทำรายการไม่สำเร็จ");
  }
});
function addline(e){
    var tr = $("#table-list tbody tr:last");
    var clone = tr.clone();
                    //clone.find(":text").val("");
                    // clone.find("td:eq(1)").text("");
    clone.find(".line-warehouse-id").val("-1").change();
    clone.find(".line-qty").val("");
    clone.find(".line-exp-date").val("");
    clone.find(".line-rec-id").val("0");

    tr.after(clone);
     
}
function removeline(e) {
        if (confirm("ต้องการลบรายการนี้ใช่หรือไม่?")) {
            if (e.parent().parent().attr("data-var") != '') {
                removelist.push(e.parent().parent().attr("data-var"));
                $(".remove-list").val(removelist);
            }
            // alert(removelist);
            // alert(e.parent().parent().attr("data-var"));

            if ($("#table-list tbody tr").length == 1) {
                $("#table-list tbody tr").each(function () {
                    $(this).find(":text").val("");
                    $(this).find(".line-warehouse-id").val("-1").change();
                    $(this).find(".line-qty").val("");
                    $(this).find(".line-exp-date").val("");
                    $(this).find(".line-rec-id").val("0");
                });
            } else {
                e.parent().parent().remove();
            }
            // cal_linenum();
            // cal_all();
        }
}
function removecustomerpriceline(e) {
        if (confirm("ต้องการลบรายการนี้ใช่หรือไม่?")) {
            if (e.parent().parent().attr("data-var") != '') {
                removecustomerpricelist.push(e.parent().parent().attr("data-var"));
                $(".remove-customer-list").val(removecustomerpricelist);
            }
            // alert(removelist);
            // alert(e.parent().parent().attr("data-var"));

            if ($("#table-list2 tbody tr").length == 1) {
                $("#table-list2 tbody tr").each(function () {
                    $(this).find(":text").val("");
                    $(this).find(".line-product-customer-id").val("-1").change();
                    $(this).find(".line-customer-price").val("0");
                });
            } else {
                e.parent().parent().remove();
            }
            // cal_linenum();
            // cal_all();
        }
}
function addcustomerpriceline(e){
    var tr = $("#table-list2 tbody tr:last");
    var clone = tr.clone();
                    //clone.find(":text").val("");
                    // clone.find("td:eq(1)").text("");
    clone.find(".line-product-customer-id").val("-1").change();
    clone.find(".line-customer-price").val("0");

    tr.after(clone);
     
}

JS;
$this->registerJs($js, static::POS_END);
?>