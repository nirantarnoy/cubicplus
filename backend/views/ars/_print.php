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
            <p><h3><b style="color: red;">WARRANTY CERTIFICATE</b></h3></p>
            <p><h5><b>SYNOLOGY ADVANCED REPLACEMENT SERVICE</b></h5></p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table">
                <tr>
                    <td style="width: 20%;background-color: lightgrey;">
                        ARS Register no.
                    </td>
                    <td></td>
                    <td style="width: 15%;background-color: lightgrey">Date</td>
                    <td style="width: 20%;border-right: 1px solid lightgrey;"></td>
                </tr>
                <tr>
                    <td style="width: 20%;background-color: lightgrey;">
                        Company Name
                    </td>
                    <td colspan="3" style="border-right: 1px solid lightgrey;"></td>
                </tr>
                <tr>
                    <td style="width: 20%;background-color: lightgrey;">
                        Address
                    </td>
                    <td colspan="3" style="border-right: 1px solid lightgrey;"></td>
                </tr>
                <tr>
                    <td style="width: 20%;background-color: lightgrey;">
                        Province
                    </td>
                    <td colspan="3" style="border-right: 1px solid lightgrey;"></td>
                </tr>
                <tr>
                    <td colspan="4" style="padding: 5px;">
                        <table class="table">
                            <tr>
                                <td style="width: 33%;background-color: lightgrey;">
                                    Contact Person
                                </td>
                                <td style="width: 33%;background-color: lightgrey;">
                                    Mobile no.
                                </td>
                                <td style="width: 33%;background-color: lightgrey;">
                                    Email
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 33%;">
                                    Contact Person
                                </td>
                                <td style="width: 33%;">
                                    Mobile no.
                                </td>
                                <td style="width: 33%;">
                                    Email
                                </td>
                            </tr>
                        </table>
                    </td>

                </tr>
                <tr>
                    <td colspan="4" style="background-color: lightgrey;text-align: center;padding-top: 10px;"><h6><b>SYSNOLOGY PRODUCT AND SERVICE DESCRIPTION</b></h6></td>
                </tr>
                <tr>
                    <td style="width: 20%;background-color: lightgrey;">
                        Model Name
                    </td>
                    <td colspan="3" style="border-right: 1px solid lightgrey;"></td>
                </tr>
                <tr>
                    <td style="width: 20%;background-color: lightgrey;">
                        Serial no.
                    </td>
                    <td colspan="3" style="border-right: 1px solid lightgrey;"></td>
                </tr>
                <tr>
                    <td style="width: 20%;background-color: lightgrey;">
                        Spare Part
                    </td>
                    <td colspan="3" style="border-right: 1px solid lightgrey;"></td>
                </tr>
                <tr>
                    <td style="width: 20%;background-color: lightgrey;">
                        Warranty Period Date
                    </td>
                    <td colspan="3" style="border-right: 1px solid lightgrey;"></td>
                </tr>
                <tr>
                    <td rowspan="2" style="width: 20%;background-color: lightgrey;">
                        Package Type
                    </td>
                    <td colspan="3" style="border-right: 1px solid lightgrey;"></td>
                </tr>
                <tr>
                    <td colspan="3" style="border-right: 1px solid lightgrey;"></td>
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
