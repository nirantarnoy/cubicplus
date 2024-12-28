<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ars_product_line".
 *
 * @property int $id
 * @property int|null $product_id
 * @property string|null $sku
 * @property string|null $serial_no
 * @property int|null $qty
 */
class ArsProductLine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ars_product_line';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'qty','ars_id'], 'integer'],
            [['sku', 'serial_no'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'sku' => 'Sku',
            'serial_no' => 'Serial No',
            'qty' => 'Qty',
        ];
    }
}
