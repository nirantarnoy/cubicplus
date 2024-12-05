<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "quotation_temp".
 *
 * @property int $id
 * @property string|null $quotation_no
 * @property string|null $quotation_date
 * @property int|null $customer_id
 * @property string|null $customer_name
 * @property string|null $attn
 * @property string|null $from
 * @property int|null $status
 * @property int|null $revise_no
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property string|null $remark
 * @property string|null $description
 */
class QuotationTemp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'quotation_temp';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['quotation_date'], 'safe'],
            [['customer_id', 'status', 'revise_no', 'created_at', 'created_by', 'updated_at', 'updated_by','quotation_origin_id'], 'integer'],
            [['quotation_no', 'customer_name', 'attn', 'from', 'remark', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'quotation_no' => 'Quotation No',
            'quotation_date' => 'Quotation Date',
            'customer_id' => 'Customer ID',
            'customer_name' => 'Customer Name',
            'attn' => 'Attn',
            'from' => 'From',
            'status' => 'Status',
            'revise_no' => 'Revise No',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'remark' => 'Remark',
            'description' => 'Description',
        ];
    }
}
