<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Ars $model */
/** @var yii\widgets\ActiveForm $form */

$product_purch_date = [];

if ($model_line != null) {
    foreach ($model_line as $value) {
        $model_product->product_id = $value->product_id;
        $model_product->period_start_date = $value->period_start_date;
        $model_product->period_end_date = $value->period_end_date;
        $model_product->warranty_year = $value->warranty_year;
        $model_product->install_area_id = $value->install_area_id;
        $model_product->install_address = $value->install_address;
        $model_product->install_province_id = $value->install_province_id;
        $model_product->install_zipcode = $value->install_zipcode;
        $model_product->serial_no = $value->serial_no;

    }
}

if ($model_product->product_id) {
    $product_purch_date = getpurchdata($model_product->product_id);
}

?>

<div class="ars-form">

    <?php $form = ActiveForm::begin(); ?>
    <input type="hidden" name="removelist" class="remove-list" value="">
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
                    'options' => ['placeholder' => 'Select Customer', 'onchange' => 'showcusaddress($(this))'],
                    'pluginOptions' => ['allowClear' => true],
                ]) ?>
            </div>
            <div class="col-lg-3">
                <label for="">ที่อยู่ลูกค้า</label>
                <?= $form->field($model, 'customer_address')->textarea(['class' => 'form-control customer-address'])->label(false) ?>
            </div>
            <div class="col-lg-3">
                <?php $model->issue_date = $model->issue_date == null ? '' : date('d-m-Y', strtotime($model->issue_date)); ?>
                <?= $form->field($model, 'issue_date')->widget(\kartik\date\DatePicker::className(), [
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
                <h4>2. ข้อมูลสินค้า</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <?php //echo $model_product = $model_line != null ? $model_line[0]['product_id']:'';?>
                <?= $form->field($model_product, 'product_id')->widget(\kartik\select2\Select2::className(), [
                    'data' => \yii\helpers\ArrayHelper::map(\common\models\Product::find()->all(), 'id', 'sku'),
                    'options' => ['placeholder' => 'Select Product', 'onchange' => 'getserialno($(this))'],
                    'pluginOptions' => ['allowClear' => true],

                ])->label('รุ่น / Model no.') ?>
            </div>
            <div class="col-lg-3">
                <label for="">หมายเลข Serial no.</label>
                <?= $form->field($model_product, 'serial_no')->textInput(['class' => 'form-control serial-no', 'readonly' => 'readonly'])->label(false) ?>
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
                <?php $model_product->period_start_date = $model_product->period_start_date == null ? '' : date('d-m-Y', strtotime($model_product->period_start_date)); ?>
                <?= $form->field($model_product, 'period_start_date')->widget(\kartik\date\DatePicker::className(), [
                    'type' => \kartik\date\DatePicker::TYPE_COMPONENT_PREPEND,
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'dd-mm-yyyy',
                    ]
                ]) ?>
            </div>
            <div class="col-lg-3">
                <?php $model_product->period_end_date = $model_product->period_end_date == null ? '' : date('d-m-Y', strtotime($model_product->period_end_date)); ?>
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
                <?php //echo $form->field($model, 'other_product')->textarea() ?>
                <table class="table table-bordered" id="table-list">
                    <thead>
                    <tr>
                        <th style="width: 5%;text-align: center;">#</th>
                        <th>Sku</th>
                        <th>Serial no.</th>
                        <th>Qty</th>
                        <th>-</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if ($model->isNewRecord): ?>
                        <tr data-var="">
                            <td style="text-align: center;"></td>
                            <td>
                                <input type="hidden" class="line-product-id" name="line_product_id[]" value="">
                                <input type="text" class="form-control line-sku" name="line_sku[]" value="">
                            </td>
                            <td>
                                <input type="text" class="form-control line-serial-no" name="line_serial_no[]" value="">
                            </td>
                            <td>
                                <input type="number" class="form-control line-qty" name="line_qty[]" min="0">
                            </td>
                            <td>
                                <div class="btn btn-sm btn-danger" onclick="removeline($(this))"><i
                                            class="fa fa-trash"></i></div>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php if ($model_product_line != null): ?>
                        <?php foreach($model_product_line as $valuex):?>
                                <tr data-var="<?=$valuex->id?>">
                                    <td style="text-align: center;"></td>
                                    <td>
                                        <input type="hidden" class="line-rec-id" name="line_rec_id[]" value="<?=$valuex->id?>">
                                        <input type="hidden" class="line-product-id" name="line_product_id[]" value="<?=$valuex->product_id?>">
                                        <input type="text" class="form-control line-sku" name="line_sku[]" value="<?=$valuex->sku?>">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control line-serial-no" name="line_serial_no[]" value="<?=$valuex->serial_no?>">
                                    </td>
                                    <td>
                                        <input type="number" class="form-control line-qty" name="line_qty[]" min="0" value="<?=$valuex->qty?>">
                                    </td>
                                    <td>
                                        <div class="btn btn-sm btn-danger" onclick="removeline($(this))"><i
                                                    class="fa fa-trash"></i></div>
                                    </td>
                                </tr>
                        <?php endforeach;?>
                        <?php else: ?>
                            <tr data-var="">
                                <td style="text-align: center;"></td>
                                <td>
                                    <input type="hidden" class="line-rec-id" name="line_rec_id[]" value="0">
                                    <input type="hidden" class="line-product-id" name="line_product_id[]" value="">
                                    <input type="text" class="form-control line-sku" name="line_sku[]" value="">
                                </td>
                                <td>
                                    <input type="text" class="form-control line-serial-no" name="line_serial_no[]" value="">
                                </td>
                                <td>
                                    <input type="number" class="form-control line-qty" name="line_qty[]" min="0">
                                </td>
                                <td>
                                    <div class="btn btn-sm btn-danger" onclick="removeline($(this))"><i
                                                class="fa fa-trash"></i></div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endif; ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td>
                            <div class="btn btn-sm btn-primary" onclick="finditem($(this))"><i class="fa fa-plus"></i>
                            </div>
                        </td>
                        <td colspan="4"></td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div class="card" style="padding: 10px;">
        <div class="row">
            <div class="col-lg-12">
                <h4>4. ข้อมูลการซื้อสินค้า</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <label for="">Reseller</label>
                <input type="text" class="form-control reseller-name"
                       value="<?= $product_purch_date != null ? $product_purch_date[0]['reseller_name'] : '' ?>"
                       readonly>
            </div>
            <div class="col-lg-4">
                <label for="">PO No.</label>
                <input type="text" class="form-control po-no"
                       value="<?= $product_purch_date != null ? $product_purch_date[0]['po_no'] : '' ?>" readonly>
            </div>
            <div class="col-lg-4">
                <label for="">PO Date</label>
                <input type="text" class="form-control po-date"
                       value="<?= $product_purch_date != null ? $product_purch_date[0]['po_date'] : '' ?>" readonly>
            </div>
        </div>
    </div>

    <!--    <div class="row">-->
    <!--        <div class="col-lg-3">-->
    <!--            --><?php //= $form->field($model, 'status')->textInput() ?>
    <!--        </div>-->
    <!--    </div>-->
    <?php if (!$model->isNewRecord): ?>
        <div class="row">
            <div class="col-lg-8">
                <?= $form->field($model, 'log_text')->textInput() ?>
            </div>
            <div class="col-lg-4">
                <label for="">User</label>
                <input type="text" class="form-control" readonly
                       value="<?= \backend\models\User::findName(\Yii::$app->user->id) ?>">
            </div>
        </div>
    <?php else: ?>
    <?php endif; ?>
    <br/>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<div id="findModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3>รายการสินค้า</h3>
            </div>
            <!--            <div class="modal-body" style="white-space:nowrap;overflow-y: auto">-->
            <!--            <div class="modal-body" style="white-space:nowrap;overflow-y: auto;scrollbar-x-position: top">-->

            <div class="modal-body">
                <input type="hidden" name="line_qc_product" class="line_qc_product" value="">
                <table class="table table-bordered table-striped table-find-list" width="100%">
                    <thead>
                    <tr>
                        <th style="width:10%;text-align: center">เลือก</th>
                        <th style="width: 20%;text-align: center">Sku</th>
                        <th style="width: 20%;text-align: center">Serial no.</th>
                        <th>คลังสินค้า</th>
                        <th>คงเหลือ</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>

            <div class="modal-footer">
                <button class="btn btn-outline-success btn-emp-selected" data-dismiss="modalx" disabled><i
                            class="fa fa-check"></i> ตกลง
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i
                            class="fa fa-close text-danger"></i> ปิดหน้าต่าง
                </button>
            </div>
        </div>

    </div>
</div>

<?php
function getpurchdata($product_id)
{
    $data = [];
    if ($product_id) {
        $model = \common\models\Product::find()->where(['id' => $product_id])->one();
        if ($model) {
            array_push($data, ['reseller_name' => $model->reseller_name, 'po_no' => $model->po_no, 'po_date' => $model->po_date != null ? date('d/m/Y', strtotime($model->po_date)) : '']);
        }
    }
    return $data;
}

?>
<?php
$url_to_get_address = \yii\helpers\Url::to(['customer/getcusfulladdress'], true);
$url_to_get_serialno = \yii\helpers\Url::to(['product/getserialno'], true);
$url_to_get_product_purch = \yii\helpers\Url::to(['product/getpurchdata'], true);
$url_to_find_item = \yii\helpers\Url::to(['product/finditem'], true);

$js = <<<JS
var selecteditem = [];
var selectedorderlineid = [];
var selecteditemgroup = [];
var customer_id = 0;
var removelist = [];
function finditem(e){
     //   alert(customer_id);
        $.ajax({
          type: 'post',
          dataType: 'html',
          url:'$url_to_find_item',
          async: false,
          data: {},
          success: function(data){
             // alert(data);
              $(".table-find-list tbody").html(data);
              $("#findModal").modal("show");
          },
          error: function(err){
              //alert(err);
              alert('error na ja');
          }
        });
}
function showcusaddress(e){
    var id = e.val();
    if(id > 0){
        $.ajax({
            'type': 'post',
            'dataType': 'json',
            'url': '$url_to_get_address',
            'data': {id:id},
            'success':function(data){
                if(data != null){
                    $(".customer-address").val(data[0].address);
                }
            },
            'error': function(){
                console.log("error");
            }
        });
    }
}
function getserialno(e){
    var id = e.val();
    if(id > 0){
        $.ajax({
            'type': 'post',
            'dataType': 'html',
            'url': '$url_to_get_serialno',
            'data': {id:id},
            'success':function(data){
                $(".serial-no").val(data);
            },
            'error': function(){
                console.log("error");
            }
        });
        
        getproductpurch(e);
    }
}

function getproductpurch(e){
    var id = e.val();
    if(id > 0){
        $.ajax({
            'type': 'post',
            'dataType': 'json',
            'url': '$url_to_get_product_purch',
            'data': {id:id},
            'success':function(data){
                if(data!=null){
                    $(".reseller-name").val(data[0].reseller_name);
                    $(".po-no").val(data[0].po_no);
                    $(".po-date").val(data[0].po_date);
                }
            },
            'error': function(){
                console.log("error");
            }
        });
        
    }
}
function addline(e){
    var tr = $("#table-list tbody tr:last");
    
                    var clone = tr.clone();
                    //clone.find(":text").val("");
                    // clone.find("td:eq(1)").text("");
                   clone.find(".line-text").val("0");
                   clone.find(".line-order-no").val("");
                   clone.find(".line-qty").val("0");
                   clone.find(".line-price").val("0");
                   clone.find(".line-total").val("0");
                   
                    clone.attr("data-var", "");
                    clone.find('.line-rec-id').val("0");
                    clone.find('.line-photo').val("");
                   
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
                       // $(this).find(".line-prod-photo").attr('src', '');
                        $(this).find(".line-item-qty").val('');
                        $(this).find(".line-item-price").val('');
                        $(this).find(".line-item-total").val('');
                        $(this).find(".line-qty").val('');
                        $(this).find(".line-photo").val("");
                        // cal_num();
                    });
                } else {
                    e.parent().parent().remove();
                }
                // cal_linenum();
                // cal_all();
                calall();
            }
        
        
}
function addselecteditem(e) {
        var id = e.attr('data-var');
        var item_id = e.closest('tr').find('.line-find-item-id').val();
      
        ///// add new 
         var item_code = e.closest('tr').find('.line-find-item-code').val();
         var item_name = e.closest('tr').find('.line-find-item-name').val();
         var onhand = e.closest('tr').find('.line-find-onhand-qty').val();
         // var warehouse_id = e.closest('tr').find('.line-find-warehouse-id').val();
         // var warehouse_name = e.closest('tr').find('.line-find-warehouse-name').val();
         var price = e.closest('tr').find('.line-find-price').val();
         var unit_id = e.closest('tr').find('.line-find-unit-id').val();
         var unit_name = e.closest('tr').find('.line-find-unit-name').val();
         var is_drummy = e.closest('tr').find('.line-find-is-drummy').val();
        ///////
        if (id) {
            if (checkhas(item_id, is_drummy)){
                alert("รหัสสินค้าซ้ำ");
                return false;
            }
            if (e.hasClass('btn-outline-success')) {
                var obj = {};
                obj['id'] = id;
                obj['item_id'] = item_id;
                obj['item_code'] = item_code;
                obj['item_name'] = item_name;
                obj['qty'] = onhand;
                // obj['warehouse_id'] = warehouse_id;
                // obj['warehouse_name'] = warehouse_name;
                obj['price'] = price;
                obj['unit_id'] = unit_id;
                obj['unit_name'] = unit_name;
                obj['is_drummy'] = is_drummy;
                
                selecteditem.push(obj);
                selectedorderlineid.push(obj['id']);
                    // var obj_after = {};
                    // obj_after['qty'] = order_line_qty;
                    // obj_after['price'] = order_line_price;
                    // obj_after['discount'] = 0;
                    // obj_after['total'] = (order_line_qty * order_line_price);
                    //
                    // alert(obj_after['product_group_id']);
                    // alert(obj_after['product_group_name']);
                    // alert(obj_after['qty']);
                    
            
                e.removeClass('btn-outline-success');
                e.addClass('btn-success');
                disableselectitem();
                console.log(selecteditem);
            } else {
                //selecteditem.pop(id);
                $.each(selecteditem, function (i, el) {
                    if (this.id == id) {
                        var qty = this.qty;
                        selecteditem.splice(i, 1);
                        selectedorderlineid.splice(i,1);
                      //  deleteorderlineselected(product_group_id, qty); // update data in selected list
                        console.log(selecteditemgroup);
                      //  caltablecontent(); // refresh table below
                    }
                });
                e.removeClass('btn-success');
                e.addClass('btn-outline-success');
                
                disableselectitem();
                console.log(selecteditem);
                console.log(selectedorderlineid);
                console.log(selecteditemgroup);
            }
        }
        $(".orderline-id-list").val(selectedorderlineid);
}

function checkhas(item_id , is_drummy){
    var has = 0;
    $("#table-list tbody tr").each(function () {
       var id = $(this).closest("tr").find(".line-product-id").val();
       if (id == item_id && is_drummy != 1){
           has = 1;
       }
    });
    return has;
}

function disableselectitem() {
        if (selecteditem.length > 0) {
            $(".btn-emp-selected").prop("disabled", "");
            $(".btn-emp-selected").removeClass('btn-outline-success');
            $(".btn-emp-selected").addClass('btn-success');
        } else {
            $(".btn-emp-selected").prop("disabled", "disabled");
            $(".btn-emp-selected").removeClass('btn-success');
            $(".btn-emp-selected").addClass('btn-outline-success');
        }
}

$(".btn-emp-selected").click(function () {
        var linenum = 0;
        var line_count = 0;
      
        if(selecteditem.length >0){
             var tr = $("#table-list tbody tr:last");
             var last_line_photo_id = tr.closest("tr").find(".line-photo").attr("id");
    //alert(last_line_photo_id);
             for(var i=0;i<=selecteditem.length-1;i++){
               //  var new_text = selecteditem[i]['line_work_type_name'] + "\\n" + "Order No."+selecteditem[i]['line_order_no'];
                   if (tr.closest("tr").find(".line-product-id").val() == "") {
                  //  alert(line_prod_code);
            
                    tr.closest("tr").find(".line-product-id").val(selecteditem[i]['item_id']);
                    tr.closest("tr").find(".line-sku").val(selecteditem[i]['item_code']);
                    tr.closest("tr").find(".line-serial-no").val(selecteditem[i]['item_name']);
                    tr.closest("tr").find(".line-qty").val(1);
                    
                    //console.log(line_prod_code);
                    } else {
                       
                        var clone = tr.clone();
                        clone.closest("tr").find(".line-rec-id").val('0');
                        clone.closest("tr").find(".line-product-id").val(selecteditem[i]['item_id']);
                        clone.closest("tr").find(".line-sku").val(selecteditem[i]['item_code']);
                        clone.closest("tr").find(".line-serial-no").val(selecteditem[i]['item_name']);
                        clone.closest("tr").find(".line-qty").val(1);
                        
                        tr.after(clone);
                    } 
             }
                
          
        }
        
        $("#table-list tbody tr").each(function () {
           linenum += 1;
            $(this).closest("tr").find("td:eq(0)").text(linenum);
            // $(this).closest("tr").find(".line-prod-code").val(line_prod_code);
        });
        
        selecteditem = [];
        selectedorderlineid = [];
        selecteditemgroup = [];

        $("#table-find-list tbody tr").each(function () {
            $(this).closest("tr").find(".btn-line-select").removeClass('btn-success');
            $(this).closest("tr").find(".btn-line-select").addClass('btn-outline-success');
        });
        
        $(".btn-emp-selected").removeClass('btn-success');
        $(".btn-emp-selected").addClass('btn-outline-success');
        $("#findModal").modal('hide'); 
});
JS;
$this->registerJs($js, static::POS_END);
?>
