<?php
?>
<div id="div1">
    <div class="row">
        <div class="row">
            <div class="col-lg-12">
                <table style="width: 100%">
                    <tr>
                        <td style="width: 10%;text-align: center;vertical-align: middle;">
                            <img src="<?php echo Yii::$app->request->baseUrl; ?>/uploads/logo/LOGO_new150.png" alt="cubic"
                                 width="60%">
                        </td>
                        <td style="width: 50%">
                            <table>
                                <tr>
                                    <td><b>บริษัท คิวบิิค พลัส คอมเมอร์เชียล จำกัด</b> <br> <b>CUBIC PLUS COMMERCIAL CO.,LTD.</b></td>
                                </tr>
                                <tr>
                                    <td>สำนักงานใหญ่ 339/25 หมู่ที่ 5 ถนนพุทธรักษา ตำบลแพรกษาใหม่ อำเภอเมืองสมุทรปราการ จังหวัดสมุทรปราการ 10280</td>
                                </tr>
                                <tr>
                                    <td>เบอร์ติดต่อ: 02-0964662 อีเมล์: sales@cubicplus.co.th เว็บไซต์: https://www.cubicplus.co.th</td>
                                </tr>
                                <tr>
                                    <td>เลขประจำตัวผู้เสียภาษี 0115566012743</td>
                                </tr>

                            </table>
                        </td>
                        <td style="width: 40%;text-align: right;">
                           <table style="width: 100%">
                               <tr>
                                   <td style="text-align: right;">
                                       <b><h5>ใบเสนอราคา</h5></b>
                                   </td>
                               </tr>
                               <tr>
                                   <td style="text-align: right;">
                                       <b><h5>QUOTATION</h5></b>
                                   </td>
                               </tr>
                               <tr>
                                   <td style="text-align: right;">
                                       <b>หน้า <span class="show-page-no">1/1</span></b>
                                   </td>
                               </tr>
                           </table>
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
    <div class="row">
        <div class="col-lg-12">
            <table style="width: 100%;border-collapse: collapse;border: none">
                <tr>
                    <td style="width: 60%;vertical-align: top;">
                        <table style="width: 100%;">
                            <tr>
                                <td><b>นามลูกค้า/Name
                                        </b><span> <?= \backend\models\Customer::findCusFullName($model->customer_id) ?></span>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><b>ที่อยู่/Address:</b><span> <?= \backend\models\Customer::findFullAddress($model->customer_id) ?></span>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Contact Name</b><span> <?= \backend\models\Customer::findAttn($model->attn_id) ?></span>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Project Name</b><span></span>
                                </td>
                                <td></td>
                            </tr>


                        </table>
                    </td>
                    <td style="width: 20%;vertical-align: top;">
                        <table style="width: 100%">
                            <tr>
                                <td><b>เลขที่/Quo No.</b></td>
                                <td><span> <?= $model->quotation_no ?></span></td>
                            </tr>
                            <tr>
                                <td>
                                    <b>วันที่/Date:</b></span>
                                </td>
                                <td><span> <?= date('d-m-Y', strtotime($model->quotation_date)) ?></td>
                            </tr>
                            <tr>
                                <td>
                                    <b>ยืนราคา/Due Date:</b>
                                </td>
                                <td>
                                    <span> <?= $model->due_date_amt. 'วัน'?></span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>ผู้เสนอราคา/Sales</b>
                                </td>
                                <td>
                                    <span> <?= \backend\models\Employee::findNameFromUserId($model->created_by) ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td><b>เบอร์ติดต่อ/Mobile:</b>
                                </td>
                                <td>
                                    <span> <?= \backend\models\Customer::findPhone($model->customer_id) ?></span>
                                </td>
                            </tr>
                        </table>
                    </td>

                </tr>
            </table>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-lg-12">
            <p>บริษัท คิวบิิค พลัส คอมเมอร์เชียล จำกัด มีความยินดีที่จะนำเสนอราคาของสินค้าและบริการตามรายการดังต่อไปนี้</p>
            <p>We are pleased to submit you the following quotation and offer to sell products and services as started below</p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table style="width: 100%;border-collapse: collapse;border: 1px solid lightgrey" id="table-data">
                <thead>
                <tr>
                    <th style="width: 6%;text-align: center;border:1px solid lightgrey;border-bottom: none;">ลำดับที่
                    </th>
                    <th style="width:15%;text-align: center;">
                        รหัสสินค้า
                    </th>
                    <th style="width: 40%;text-align: center;border:1px solid lightgrey;padding: 10px;border-bottom: none;">
                        รายการ
                    </th>
                    <th style="width:10%;text-align: center;border:1px solid lightgrey;border-bottom: none;">รับประกัน
                    </th>
                    <th style="text-align: center;border:1px solid lightgrey;border-bottom: none;width: 10%">จำนวน
                    </th>
                    <th style="width: 10%;text-align: center;border:1px solid lightgrey;border-bottom: none;">ราคาต่อหน่วย
                    </th>
                    <th style="width: 10%;text-align: center;border:1px solid lightgrey;padding: 5px;border-bottom: none;">
                        จำนวนเงิน
                    </th>
                </tr>
                <tr>
                    <th style="text-align: center;border:1px solid lightgrey;border-top: none">No.</th>
                    <th style="text-align: center;border:1px solid lightgrey;border-top: none"> Part No.</th>
                    <th style="text-align: center;border:1px solid lightgrey;padding: 5px;border-top: none">
                        Description
                    </th>
                    <th style="text-align: center;border:1px solid lightgrey;padding: 5px;border-top: none">
                        Warranty
                    </th>
                    <th style="text-align: center;border:1px solid lightgrey;border-top: none">Quantity</th>
                    <th style="text-align: center;border:1px solid lightgrey;border-top: none">Unit Price
                    </th>
                    <th style="text-align: center;border:1px solid lightgrey;padding: 5px;border-top: none">
                        Amount
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php $num_row = 0;
                $total = 0;
                $disc_amount = $model->discount_amt;
                $vat_amount = 0;
                $all_total = 0; ?>
                <?php foreach ($model_line as $value): ?>
                    <?php $num_row++;
                    $total += ($value->qty * $value->line_price);
                    $line_desc = '';
                    if ($value->mat_desc != '') {
                        $line_desc = $value->mat_desc;
                    }
                    ?>
                    <tr>
                        <td style="text-align: center;border:1px solid lightgrey;padding: 5px;"><?= $num_row ?></td>
                        <td style="border:1px solid lightgrey;padding-left: 5px;">
<!--                            --><?php //if($value->photo !=null || $value->photo !=''):?>
<!--                                <img src="--><?php //= \Yii::$app->getUrlManager()->baseUrl . '/uploads/quotation_photo/' . $value->photo ?><!--" style="width: 20%" alt="">-->
<!--                            --><?php //endif;?>
                            <?= $value->product_name != '' ? $value->product_name : \backend\models\Product::findName($value->product_id) ?>
                        </td>
                        <td style="border:1px solid lightgrey;padding-left: 5px;"><?=$line_desc?></td>
                        <td style="text-align: center;border:1px solid lightgrey;">-</td>
                        <td style="text-align: center;border:1px solid lightgrey;width: 10%"><?= $value->qty ?></td>
                        <td style="text-align: right;border:1px solid lightgrey;padding-right: 5px;"><?= number_format($value->line_price, 2) ?></td>
                        <td style="text-align: right;border:1px solid lightgrey;padding-right: 5px;"><?= number_format($value->qty * $value->line_price, 2) ?></td>
                    </tr>
                <?php endforeach; ?>
                <?php if ($model_line != null): ?>
                    <?php if (count($model_line) < 10): ?>
                        <?php for ($i = 1; $i <= 10 - count($model_line); $i++): ?>
                            <tr>
                                <td style="text-align: center;border:1px solid lightgrey;padding: 5px;color: transparent">
                                    1
                                </td>
                                <td style="border:1px solid lightgrey;"></td>
                                <td style="text-align: center;border:1px solid lightgrey;width: 10%"></td>
                                <td style="border:1px solid lightgrey;padding-left: 5px;"></td>
                                <td style="text-align: center;border:1px solid lightgrey;"></td>
                                <td style="text-align: center;border:1px solid lightgrey;"></td>
                                <td style="text-align: center;border:1px solid lightgrey;"></td>
                            </tr>
                        <?php endfor; ?>
                    <?php endif; ?>
                <?php endif; ?>
                </tbody>
                <tfoot>
                <?php
                $vat_amount = (($total - $disc_amount) * 7) / 100;
                $all_total = ($total - $disc_amount) + $vat_amount;
                ?>
                <tr>
                    <td colspan="4" style="border:1px solid lightgrey;border-top:none;border-bottom: none;text-align: center">

                    </td>
                    <td colspan="2" style="border:1px solid lightgrey;padding:5px;text-align: right"><b>ราคารวม/Sub Total</b></td>
                    <td style="border:1px solid lightgrey;text-align: right;padding-right: 5px;"><?= number_format($total, 2) ?></td>
                </tr>
<!--                <tr>-->
<!--                    <td colspan="4"-->
<!--                        style="border:1px solid lightgrey;border-top:none;border-bottom: none;text-align: center;">-->
<!---->
<!--                    </td>-->
<!--                    <td colspan="2" style="border:1px solid lightgrey;padding:5px;text-align: right">ส่วนลด/Discount-->
<!--                    </td>-->
<!--                    <td style="border:1px solid lightgrey;text-align: center;">--><?php //= number_format($disc_amount, 2) ?><!--</td>-->
<!--                </tr>-->
                <tr>
                    <td colspan="4"
                        style="border:1px solid lightgrey;border-top:none;border-bottom: none;text-align: center;">
                        <b><span
                                    class="show-total-string"><?=$model->total_text?></span></b>
                    </td>
                    <td colspan="2" style="border:1px solid lightgrey;padding:5px;text-align: right"><b>ภาษีมูลค่าเพิ่ม/VAT
                        7%</b>
                    </td>
                    <td style="border:1px solid lightgrey;text-align: right;padding-right: 5px;"><?= number_format($vat_amount, 2) ?></td>
                </tr>
                <tr>
                    <td colspan="4"
                        style="border:1px solid lightgrey;border-top:none;border-bottom: none;text-align: center"></td>
                    <td colspan="2" style="border:1px solid lightgrey;padding:5px;text-align: right"><b>ยอดรวมสุทธิ/Grand
                        Total</b>
                    </td>
                    <td style="border:1px solid lightgrey;text-align: right;padding-right: 5px;">
                        <b><?= number_format($all_total, 2) ?></b>
                        <input type="hidden" class="all-total-amt"
                               value="<?= $all_total ?>">
                    </td>
                </tr>

                </tfoot>
            </table>

        </div>
    </div>
    <div style="height: 10px;"></div>
    <div class="row">
        <div class="col-lg-12">
            <table style="width: 100%">
                <!--                <tr>-->
                <!--                    <td style="padding: 10px;">-->
                <!--                      <p>1. ระยะเวลาการผลิต 15 วันหลังรับใบสั่งซื้อ</p>-->
                <!--                      <p>2. ระยะเวลาการชำระเงิน 30 วันจากวันส่งมอบสินค้า</p>-->
                <!--                    </td>-->
                <!--                </tr>-->
                <tr>
                    <td style="padding: 10px;width:75%;vertical-align: top;">
                        <b><p>หมายเหตุ/Remark:</b> <b><?= $model->remark ?></b></p>
                    </td>
                    <td>
                       <table width="100%">
                           <tr>
                               <td style="border: 1px solid grey;padding: 10px;">
                                   <b><p>Authorized Signature</p></b>
                                   <b><p style="margin-top: -10px;">Cubic Plus Commercial Co.,Ltd.</p></b>
                                   <br/>
                                   <br/>
                                   <p></p>
                                   <div style="text-align: center;"><p>ลงวันที่ <?=date('d/m/Y')?></p></div>
                               </td>
                           </tr>
                       </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div style="height: 10px;"></div>
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
