<?php
$customer_data = getcusfulladdress($model->customer_id);
?>
<div id="div1">
    <div class="row">
        <div class="row">
            <div class="col-lg-12">
                <table style="width: 100%">
                    <tr>
                        <td style="width: 10%;text-align: center;vertical-align: middle;">
                            <img src="<?php echo Yii::$app->request->baseUrl; ?>/uploads/logo/LOGO_new150.png"
                                 alt="cubic"
                                 width="60%">
                        </td>
                        <td style="width: 50%">
                            <table>
                                <tr>
                                    <td><b>บริษัท คิวบิิค พลัส คอมเมอร์เชียล จำกัด</b> <br> <b>CUBIC PLUS COMMERCIAL
                                            CO.,LTD.</b></td>
                                </tr>
                                <tr>
                                    <td>สำนักงานใหญ่ 339/25 หมู่ที่ 5 ถนนพุทธรักษา ตำบลแพรกษาใหม่ อำเภอเมืองสมุทรปราการ
                                        จังหวัดสมุทรปราการ 10280
                                    </td>
                                </tr>
                                <tr>
                                    <td>เบอร์ติดต่อ: 02-0964662 อีเมล์: sales@cubicplus.co.th เว็บไซต์:
                                        https://www.cubicplus.co.th
                                    </td>
                                </tr>
                                <tr>
                                    <td>เลขประจำตัวผู้เสียภาษี 0115566012743</td>
                                </tr>

                            </table>
                        </td>
                        <td style="width: 40%;text-align: right;">

                        </td>

                    </tr>
                </table>
            </div>
        </div>

    </div>
    <table style="width: 100%;margin-top: 5px;">
        <tr>
            <td style="border-top: 1px solid black;"></td>
        </tr>
    </table>
    <br/>
    <div class="row">
        <div class="col-lg-12">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 100%;text-align: center"></td>
                </tr>
            </table>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-lg-12" style="text-align: center;">
            <p>
            <h3><b style="color: red;">WARRANTY CERTIFICATE</b></h3></p>
            <p><h5><b>SYNOLOGY ADVANCED REPLACEMENT SERVICE</b></h5></p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table">
                <tr>
                    <td style="width: 20%;background-color: lightgrey;border-left: 1px solid lightgrey;border-right: 1px solid lightgrey">
                        ARS Register no.
                    </td>
                    <td><?= $model->ars_no ?></td>
                    <td style="width: 15%;background-color: lightgrey">Date</td>
                    <td style="width: 20%;border-right: 1px solid lightgrey;"><?= date('d/m/Y', strtotime($model->issue_date)) ?></td>
                </tr>
                <tr>
                    <td style="width: 20%;background-color: lightgrey;border-left: 1px solid lightgrey;border-right: 1px solid lightgrey">
                        Company Name
                    </td>
                    <td colspan="3"
                        style="border-right: 1px solid lightgrey;"><?= \backend\models\Customer::findCusName($model->customer_id) ?></td>
                </tr>
                <tr>
                    <td style="width: 20%;background-color: lightgrey;border-left: 1px solid lightgrey;border-right: 1px solid lightgrey">
                        Address
                    </td>
                    <td colspan="3" style="border-right: 1px solid lightgrey;">
                        <?= $model->customer_address ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%;background-color: lightgrey;border-left: 1px solid lightgrey;border-right: 1px solid lightgrey">
                        Province
                    </td>
                    <td colspan="3" style="border-right: 1px solid lightgrey;">
                        <?= $customer_data != null ? $customer_data[0]['province_name'] : '' ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="4"
                        style="padding: 5px;border-left: 1px solid lightgrey;border-left: 1px solid lightgrey;border-right: 1px solid lightgrey">
                        <table class="table">
                            <tr>
                                <td style="width: 33%;background-color: lightgrey;border-left: 1px solid lightgrey">
                                    Contact Person
                                </td>
                                <td style="width: 33%;background-color: lightgrey;border-left: 1px solid lightgrey;">
                                    Mobile no.
                                </td>
                                <td style="width: 33%;background-color: lightgrey;border-right: 1px solid lightgrey">
                                    Email
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 33%;">
                                    <?= $customer_data != null ? $customer_data[0]['contact_name'] : '' ?>
                                </td>
                                <td style="width: 33%;">
                                    <?= $customer_data != null ? $customer_data[0]['mobile_phone'] : '' ?>
                                </td>
                                <td style="width: 33%;border-right: 1px solid lightgrey">
                                    <?= $customer_data != null ? $customer_data[0]['email'] : '' ?>
                                </td>
                            </tr>
                        </table>
                    </td>

                </tr>
                <tr>
                    <td colspan="4"
                        style="background-color: lightgrey;text-align: center;padding-top: 10px;border-left: 1px solid lightgrey;border-right: 1px solid lightgrey">
                        <h6><b>SYSNOLOGY
                                PRODUCT AND SERVICE DESCRIPTION</b></h6></td>
                </tr>
                <tr>
                    <td style="width: 20%;background-color: lightgrey;border-left: 1px solid lightgrey;border-right: 1px solid lightgrey">
                        Model Name
                    </td>
                    <td colspan="3" style="border-right: 1px solid lightgrey;">
                        <?= \backend\models\Product::findSku($model_product->product_id); ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%;background-color: lightgrey;border-left: 1px solid lightgrey;border-right: 1px solid lightgrey">
                        Serial no.
                    </td>
                    <td colspan="3" style="border-right: 1px solid lightgrey;">
                        <?= $model_product->serial_no ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%;background-color: lightgrey;border-left: 1px solid lightgrey;border-right: 1px solid lightgrey">
                        Spare Part
                    </td>
                    <td colspan="3" style="border-right: 1px solid lightgrey;"></td>
                </tr>
                <tr>
                    <td style="width: 20%;background-color: lightgrey;border-left: 1px solid lightgrey;border-right: 1px solid lightgrey">
                        Warranty Period Date
                    </td>
                    <td colspan="3" style="border-right: 1px solid lightgrey;">
                        <table class="table" border="none;">
                            <tr>
                                <td style="text-align: center;background-color: lightgrey;">Start Date</td>
                                <td style="text-align: center;background-color: lightgrey;">End Date</td>
                            </tr>
                            <tr>
                                <td style="text-align: center;"><?= $model_product->period_start_date != null ? date('d/m/Y', strtotime($model_product->period_start_date)) : ''; ?></td>
                                <td style="text-align: center;"><?= $model_product->period_end_date != null ? date('d/m/Y', strtotime($model_product->period_end_date)) : ''; ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td rowspan="2"
                        style="width: 20%;background-color: lightgrey;vertical-align: middle;border-left: 1px solid lightgrey;border-right: 1px solid lightgrey">
                        Package Type
                    </td>
                    <td colspan="3" style="border-right: 1px solid lightgrey;">
                        <?= \backend\models\Arspackagetype::findName($model_product->warranty_year) ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="3"
                        style="border-right: 1px solid lightgrey;border-left: 1px solid lightgrey;border-right: 1px solid lightgrey">
                        <?= \backend\models\Installarea::findName($model_product->install_area_id) ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%;background-color: lightgrey;border-left: 1px solid lightgrey;border-right: 1px solid lightgrey">
                        Installation Location
                    </td>
                    <td colspan="3" style="border-right: 1px solid lightgrey;">
                        <?= $model_product->install_address; ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div style="height: 10px;"></div>
    <div class="row">
        <div class="col-lg-12">
            <table style="width: 100%">
                <tr>
                    <td>1. Call Center: 02-096-4662 กด 1</td>
                    <td style="text-align: right;">
                        Cubic Plus Commercial Co., Ltd.
                        Authorized Signature
                    </td>
                </tr>
                <tr>
                    <td>2. Email Support: support@helpdesk.in.th</td>
                    <td></td>
                </tr>
                <tr>
                    <td>3. Line ID @synology-partner</td>
                    <td></td>
                </tr>
                <tr>
                    <td>***ช่วงเวลาในการให้บริการ*</td>
                    <td></td>
                </tr>
                <tr>
                    <td>จันทร์-ศุกร์ เวลา 09.30-17.30 น.</td>
                    <td style="text-align: right;">Suwimol Kumsap</td>
                </tr>
                <tr>
                    <td>เสาร์-อาทิตย์ เวลา 10.00-15.00 น.</td>
                    <td style="text-align: right;">Managing Director</td>
                </tr>
                <tr>
                    <td>(เว้นวันหยุดนักขัตฤกษ์หรือตามประกาศหยุดพิเศษ)</td>
                    <td style="text-align: right;">
                        Approval date 19 November 2024
                    </td>
                </tr>

            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h3>PREMIUM ADVANCED REPLACEMENT SERVICE</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h3><?= $model->ars_no ?></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <td>Hardware Part No.</td>
                    <td>Serial No.</td>
                    <td>Start Date</td>
                    <td>End Date</td>
                </tr>
                </thead>
                <tbody>
                <?php if ($model_product_line != null): ?>
                    <?php foreach ($model_product_line as $value): ?>
                        <tr>
                            <td><?=$value->sku?></td>
                            <td><?=$value->serial_no?></td>
                            <td><?= $model_product->period_start_date != null ? date('d/m/Y', strtotime($model_product->period_start_date)) : ''; ?></td>
                            <td><?= $model_product->period_end_date != null ? date('d/m/Y', strtotime($model_product->period_end_date)) : ''; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
<br/>
<table width="100%" class="table-title">
    <td style="text-align: right">
        <!--        <button id="btn-export-excel" class="btn btn-secondary">Export Excel</button>-->
        <button id="btn-print" class="btn btn-warning" onclick="printContent('div1')">Print</button>
    </td>
</table>

<br/>

<?php
function getcusfulladdress($id)
{
    $data = [];
    $address = '';
    $province_id = 0;
    $province_name = '';
    $postcode = '';
    $contact_name = '';
    $mobile_phone = '';
    $email = '';
    $data_province = [];
    if ($id) {
        $address = \backend\models\Customer::findFullAddress($id);
        $mobile_phone = \backend\models\Customer::findPhone($id);
        $email = \backend\models\Customer::findEmail($id);
        $contact_name = \backend\models\Customer::findContactName($id);
        $data_province = \backend\models\Customer::findCustomerProvince($id);

        if ($data_province != null) {
            $province_id = $data_province[0]['province_id'];
            $province_name = $data_province[0]['province_name'];
            $postcode = $data_province[0]['zipcode'];
        }

        array_push($data, ['address' => $address, 'province_name' => $province_name, 'postcode' => $postcode, 'contact_name' => $contact_name, 'mobile_phone' => $mobile_phone, 'email' => $email]);
    }

    return $data;
}

?>

<?php
$this->registerJsFile(\Yii::$app->request->baseUrl . '/js/jquery.table2excel.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$url_to_convert_num = \yii\helpers\Url::to(['order/convertnumtostring'], true);
$js = <<<JS
$(function(){
    var total_amt = $(".all-total-amt").val();
    if(total_amt != null){
      //  alert(total_amt);
      //  converNumToStr(8.03);
    }
});
function converNumToStr(num){
    $.ajax({
          type: 'post',
          dataType: 'html',
          url:'$url_to_convert_num',
          async: false,
          data: {"amount": num},
          success: function(data){
            $(".show-total-string").html(data);
          },
          error: function(err){
              alert(err);
          }
        });
}
 $("#btn-export-excel").click(function(){
  $("#table-data").table2excel({
    // exclude CSS class
    exclude: ".noExl",
    name: "Excel Document Name"
  });
});
$(".btn-order-date").click(function(){
    $(".btn-order-type").val(1);
    if($(".btn-order-price").hasClass("btn-success")){
        $(".btn-order-price").removeClass("btn-success");
        $(".btn-order-price").addClass("btn-default");
    }
    if($(this).hasClass("btn-default")){
        $(this).removeClass("btn-default")
        $(this).addClass("btn-success");
    }
    
});
$(".btn-order-price").click(function(){
    $(".btn-order-type").val(2);
      if($(".btn-order-date").hasClass("btn-success")){
        $(".btn-order-date").removeClass("btn-success");
        $(".btn-order-date").addClass("btn-default");
    }
    if($(this).hasClass("btn-default")){
        $(this).removeClass("btn-default")
        $(this).addClass("btn-success");
    }
});
function printContent(el)
      {
         var restorepage = document.body.innerHTML;
         var printcontent = document.getElementById(el).innerHTML;
         document.body.innerHTML = printcontent;
         window.print();
         document.body.innerHTML = restorepage;
     }
JS;
$this->registerJs($js, static::POS_END);
?>
