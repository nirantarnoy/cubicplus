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
            [['issue_date'], 'safe'],
            [['customer_id', 'status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['ars_no'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ars_no' => 'Ars No',
            'issue_date' => 'Issue Date',
            'customer_id' => 'Customer ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
}
