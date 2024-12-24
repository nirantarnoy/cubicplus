<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string|null $sku
 * @property string|null $name
 * @property string|null $description
 * @property int|null $product_category_id
 * @property int|null $unit_id
 * @property string|null $photo
 * @property float|null $cost
 * @property float|null $sale_price
 * @property float|null $commission
 * @property string|null $remark
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','sku'],'required'],
            [['serial_no'],'unique', 'targetAttribute' => ['serial_no']],
            [['product_category_id', 'unit_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by','is_company_product','distributor_id','inventory_status','brand_id','invent_status','reseller_id'], 'integer'],
            [['cost', 'sale_price', 'commission'], 'number'],
            [['description', 'photo', 'remark','photo_2','photo_3','brand_name','serial_no','reseller_name','po_no'], 'string', 'max' => 255],
            [['receive_date','warranty_expired_date','warranty_start_date','po_date'],'safe'],
           // 'skipOnEmpty' => false,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sku' => 'Sku',
            'name' => 'ชื่อสินค้า',
            'description' => 'รายละเอียด',
            'product_category_id' => 'หมวดหมู่สินค้า',
            'unit_id' => 'หน่วยนับ',
            'photo' => 'รูปภาพ',
            'cost' => 'ราคาทุน',
            'sale_price' => 'ราคาขาย',
            'commission' => 'Commission',
            'remark' => 'Remark',
            'status' => 'สถานะใช้งาน',
            'is_company_product'=>'is_company_product',
            'distributor_id'=>'ผู้จัดจำหน่าย',
            'inventory_status'=>'สถานะคลัง',
            'serial_no'=>'Serial No',
            'receive_date'=> 'วันที่รับสินค้า',
            'brand_id'=>'ยี่ห้อ',
            'branch_name'=>'ชื่อยี่ห้อ',
            'po_no' => 'SIS PO no.',
            'po_date'=>'วันที่เอกสาร PO',
            'reseller_id'=> 'reseller_id',
            'reseller_name'=>'ชื่อผู้ขาย/Reseller',
            'created_at' => 'สร้างเมื่อ',
            'created_by' => 'สร้างโดย',
            'updated_at' => 'แก้ไขเมื่อ',
            'updated_by' => 'แก้ไขโดย',
        ];
    }
}
