<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ars".
 *
 * @property int $id
 * @property string|null $ars_no
 * @property string|null $issue_date
 * @property int|null $customer_id
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class Ars extends \yii\db\ActiveRecord
{
    public $log_text;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ars';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['log_text'], 'required'],
            [['issue_date'], 'safe'],
            [['customer_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['ars_no','log_text','other_product'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ars_no' => 'ARS No',
            'issue_date' => 'Issue Date',
            'customer_id' => 'Customer',
            'status' => 'Status',
            'other_product' => 'สินค้าอื่นๆ',
            'created_at' => 'สร้างเมื่อ',
            'created_by' => 'สร้างโดย',
            'updated_at' => 'แก้ไขเมื่อ',
            'updated_by' => 'แก้ไขโดย',
        ];
    }
}
