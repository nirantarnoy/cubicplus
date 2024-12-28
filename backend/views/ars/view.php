<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var backend\models\Ars $model */

$this->title = $model->ars_no;
$this->params['breadcrumbs'][] = ['label' => 'Ars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$product_purch_data = [];
if($model_product->product_id){
    $product_purch_data = getpurchdata($model_product->product_id);
}

$customer_data = getcusfulladdress($model->customer_id);
?>
<div class="ars-view">
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Approve', ['approve', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Print', ['print', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <p class="text-danger"><b>**กรุณาตรวจสอบความถูกต้องของข้อมูล ก่อนบันทึกทุกครั้ง</b></p>
    <div class="row">
        <div class="col-lg-12">
            <table class="table">
                <tr>
                    <td style="width: 20%;background-color: lightgrey;"><b>Status</b></td>
                    <td colspan="3" style="border-right: 1px solid lightgrey;">
                        <?php if($model->status == 0):?>
                            <span><div class="badge badge-warning"><i class="fa fa-check"></i> Waiting</div></span>
                        <?php elseif($model->status == 1):?>
                            <span> <div class="badge badge-success"><i class="fa fa-check"></i> Approve</div></span>
                        <?php endif;?>

                    </td>
                </tr>
                <tr>
                    <td style="width: 20%;background-color: lightgrey;"><b>ARS Register no.</b></td>
                    <td colspan="3" style="border-right: 1px solid lightgrey;"><?= $model->ars_no; ?></td>
                </tr>
                <tr>
                    <td style="width: 20%;background-color: lightgrey;"><b>Issued Date</b></td>
                    <td style="width: 25%"><?= date('d/m/Y', strtotime($model->issue_date)); ?></td>
                    <td style="width: 15%;background-color: lightgrey;"><b>Updated Date</b></td>
                    <td style="border-right: 1px solid lightgrey;">
                        <?=$model->updated_at!=null?date('d/m/Y H:i:s',$model->updated_at):''?>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="background-color: lightblue;"><h6><b>1.
                                ข้อมูลบริษัท/ห้างร้าน/หน่วยงาน/องค์กร</b></h6></td>
                </tr>
                <tr>
                    <td style="width: 20%;background-color: lightgrey;"><b>Company Name</b></td>
                    <td colspan="3"
                        style="border-right: 1px solid lightgrey;"><?= \backend\models\Customer::findCusName($model->customer_id); ?></td>
                </tr>
                <tr>
                    <td style="width: 20%;background-color: lightgrey;"><b>Address</b></td>
                    <td colspan="3" style="border-right: 1px solid lightgrey;"><?=$model->customer_address?></td>
                </tr>
                <tr>
                    <td style="width: 20%;background-color: lightgrey;"><b>Province</b></td>
                    <td style="width: 25%"><?=$customer_data!=null?$customer_data[0]['province_name']:''?></td>
                    <td style="width: 15%;background-color: lightgrey;"><b>Post Code</b></td>
                    <td style="border-right: 1px solid lightgrey;"><?=$customer_data!=null?$customer_data[0]['postcode']:''?></td>
                </tr>
                <tr>
                    <td style="width: 20%;background-color: lightgrey;"><b>Contact Name</b></td>
                    <td colspan="3" style="border-right: 1px solid lightgrey;"><?=$customer_data!=null?$customer_data[0]['contact_name']:''?></td>
                </tr>
                <tr>
                    <td style="width: 20%;background-color: lightgrey;"><b>Mobile no.</b></td>
                    <td style="width: 25%"><?=$customer_data!=null?$customer_data[0]['mobile_phone']:''?></td>
                    <td style="width: 15%;background-color: lightgrey;"><b>Email</b></td>
                    <td style="border-right: 1px solid lightgrey;"><?=$customer_data!=null?$customer_data[0]['email']:''?></td>
                </tr>
                <tr>
                    <td colspan="4" style="background-color: lightblue;"><h6><b>2. ข้อมูลสินค้า Synology</b></h6></td>
                </tr>
                <tr>
                    <td style="width: 20%;background-color: lightgrey;"><b>Model Name</b></td>
                    <td style="width: 25%"><?= \backend\models\Product::findSku($model_product->product_id); ?></td>
                    <td style="width: 15%;background-color: lightgrey;"><b>Serial no.</b></td>
                    <td style="border-right: 1px solid lightgrey;"><?= $model_product->serial_no; ?></td>
                </tr>
                <tr>
                    <td style="width: 20%;background-color: lightgrey;"><b>Warrantee</b></td>
                    <td style="width: 25%">
                        <?=\backend\models\Arspackagetype::findName($model_product->warranty_year)?>
                    </td>
                    <td style="width: 15%;background-color: lightgrey;"><b>Package Type</b></td>
                    <td style="border-right: 1px solid lightgrey;"><?= \backend\models\Installarea::findName($model_product->install_area_id) ?></td>
                </tr>
                <tr>
                    <td style="width: 20%;background-color: lightgrey;"><b>Period Start Date</b></td>
                    <td style="width: 25%"><?= $model_product->period_start_date != null ? date('d/m/Y', strtotime($model_product->period_start_date)) : ''; ?></td>
                    <td style="width: 15%;background-color: lightgrey;"><b>Period End Date</b></td>
                    <td style="border-right: 1px solid lightgrey;"><?= $model_product->period_end_date != null ? date('d/m/Y', strtotime($model_product->period_end_date)) : ''; ?></td>
                </tr>
                <tr>
                    <td style="width: 20%;background-color: lightgrey;"><b>Installation Location</b></td>
                    <td colspan="3" style="border-right: 1px solid lightgrey;">
                        <?= $model_product->install_address; ?>
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%;background-color: lightgrey;"><b>Province</b></td>
                    <td style="width: 25%">
                        <?= \backend\models\Province::findProvinceName($model_product->install_province_id) ?>
                    </td>
                    <td style="width: 15%;background-color: lightgrey;"><b>Post Code</b></td>
                    <td style="border-right: 1px solid lightgrey;">
                        <?= $model_product->install_zipcode ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="background-color: lightblue;"><h6><b>3.
                                ข้อมูลสินค้าอื่นๆที่ให้บริการรับประกัน</b></h6></td>

                </tr>
                <tr>
                    <td style="width: 20%;background-color: lightgrey;"><b>Product Detail</b></td>
                    <td colspan="3" style="border-right: 1px solid lightgrey;">
                        <?php //echo $model->other_product; ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th style="text-align: center;width: 5%">#</th>
                                        <th>Sku</th>
                                        <th>Serial no.</th>
                                        <th>Qty</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if($model_product_line!=null):?>
                                    <?php $line_num = 0;?>
                                    <?php foreach($model_product_line as $valuex):?>
                                            <?php $line_num +=1;?>
                                    <tr>
                                        <td style="text-align: center"><?=$line_num?></td>
                                        <td><?=$valuex->sku?></td>
                                        <td><?=$valuex->serial_no?></td>
                                        <td><?=$valuex->qty?></td>
                                    </tr>
                                    <?php endforeach;?>
                                    <?php endif;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="background-color: lightblue;"><h6><b>4.
                                ข้อมูลการซื้อ</b></h6></td>

                </tr>
                <tr>
                    <td style="width: 20%;background-color: lightgrey;"><b>ผู้ขายสินค้า/Reseller</b></td>
                    <td colspan="3" style="border-right: 1px solid lightgrey;"><?=$product_purch_data!=null?$product_purch_data[0]['reseller_name']:''?></td>
                </tr>
                <tr>
                    <td style="width: 20%;background-color: lightgrey;"><b>SIS PO no.</b></td>
                    <td style="width: 25%"><?=$product_purch_data!=null?$product_purch_data[0]['po_no']:''?></td>
                    <td style="width: 15%;background-color: lightgrey;"><b>PO Date</b></td>
                    <td style="border-right: 1px solid lightgrey;"><?=$product_purch_data!=null?$product_purch_data[0]['po_date']:''?></td>
                </tr>
            </table>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="col-lg-12">
            <h6><b>ARS Log</b></h6>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table class="table">
                <thead>
                <tr>
                    <th>รายละเอียด</th>
                    <th>วันที่ทำรายการ</th>
                    <th>ทำรายการโดย</th>
                </tr>
                </thead>
                <tbody>
                <?php if ($model_log != null): ?>
                    <?php foreach ($model_log as $log): ?>
                        <tr>
                            <td><?=$log->detail ?></td>
                            <td><?= date('d/m/Y H:i:s', strtotime($log->trans_date)) ?></td>
                            <td><?= \backend\models\User::findName($log->issue_by) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" style="text-align: center">Not found data</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
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

function getcusfulladdress($id){
        $data = [];
        $address = '';
        $province_id = 0;
        $province_name = '';
        $postcode = '';
        $contact_name = '';
        $mobile_phone = '';
        $email = '';
        $data_province = [];
        if($id){
            $address = \backend\models\Customer::findFullAddress($id);
            $mobile_phone = \backend\models\Customer::findPhone($id);
            $email = \backend\models\Customer::findEmail($id);
            $contact_name = \backend\models\Customer::findContactName($id);
            $data_province = \backend\models\Customer::findCustomerProvince($id);

            if($data_province != null){
                $province_id = $data_province[0]['province_id'];
                $province_name = $data_province[0]['province_name'];
                $postcode = $data_province[0]['zipcode'];
            }

            array_push($data,['address'=>$address,'province_name'=>$province_name,'postcode'=>$postcode,'contact_name'=>$contact_name,'mobile_phone'=>$mobile_phone,'email'=>$email]);
        }

        return $data;
    }
?>
