<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "journal_issue".
 *
 * @property int $id
 * @property string|null $journal_no
 * @property string|null $trans_date
 * @property int|null $issue_for_id
 * @property string|null $remark
 * @property int|null $created_at
 * @property int|null $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 */
class JournalIssue extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'journal_issue';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['trans_date'], 'safe'],
            [['issue_for_id', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['journal_no', 'remark'], 'string', 'max' => 255],
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
            'trans_date' => 'วันที่',
            'issue_for_id' => 'เลขที่คำสั่งซื้อ',
            'remark' => 'หมายเหตุ',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'status'=>'สถานะ',
        ];
    }
}
