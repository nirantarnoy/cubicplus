<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "quotation".
 *
 * @property int $id
 * @property string|null $quotation_no
 * @property string|null $quotation_date
 * @property int|null $customer_id
 * @property string|null $customer_name
 * @property string|null $attn
 * @property string|null $from
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property string|null $remark
 * @property string|null $description
 */
class Quotation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'quotation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_id'],'required'],
            [['quotation_date'], 'safe'],
            [['customer_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by','attn_id','revise_no','due_date_amt','payment_term_id','commission_emp_id','origin_id'], 'integer'],
            [['quotation_no', 'customer_name', 'attn', 'from', 'remark', 'description','total_text','special_text'], 'string', 'max' => 255],
            [['discount_per','discount_amt','commission_amt'],'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'quotation_no' => 'เลขที่ใบเสนอราคา',
            'quotation_date' => 'วันที่เสนอราคา',
            'customer_id' => 'ลูกค้า',
            'customer_name' => 'ชื่อลูกค้า',
            'attn_id' => 'Attn',
            'attn' => 'Attn Name',
            'from' => 'From',
            'status' => 'สถานะ',
            'discount_per'=>'ส่วนลด %',
            'discount_amt'=>'ส่วนลดเงิน',
            'due_date_amt'=> 'ยืนราคา(วัน)',
            'commission_amt'=> 'คอมมิชชั่น',
            'commission_emp_id'=> 'Sale commission',
            'created_at' => 'สร้างเมื่อ',
            'created_by' => 'สร้างโดย',
            'updated_at' => 'แก้ไขเมื่อ',
            'updated_by' => 'แก้ไขโดย',
            'remark' => 'หมายเหตุ',
            'description' => 'รายละเอียด',
            'special_text' => 'Special Text',
        ];
    }
}
