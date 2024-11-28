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
            [['product_category_id', 'unit_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['cost', 'sale_price', 'commission'], 'number'],
            [['sku', 'name', 'description', 'photo', 'remark'], 'string', 'max' => 255],
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
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
