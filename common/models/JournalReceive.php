<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "journal_receive".
 *
 * @property int $id
 * @property string|null $journal_no
 * @property string|null $trans_date
 * @property string|null $remark
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class JournalReceive extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'journal_receive';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['trans_date'], 'safe'],
            [['created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['journal_no', 'remark','po_ref_no','reseller_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'journal_no' => 'เลขที่',
            'trans_date' => 'วันทึ่',
            'remark' => 'หมายเหตุ',
            'po_ref_no' => 'เลขที่ PO',
            'reseller_name'=>'ชื่อผู้ขาย/Reseller',
            'created_at' => 'สร้างเมื่อ',
            'created_by' => 'สร้างโดย',
            'updated_at' => 'แก้ไขเมื่อ',
            'updated_by' => 'แก้ไขโดย',
        ];
    }
}
