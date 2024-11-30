<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "system_log".
 *
 * @property int $id
 * @property int|null $log_type_id
 * @property string|null $trans_date
 * @property string|null $function_name
 * @property int|null $user_id
 * @property string|null $ipaddress
 * @property string|null $message
 * @property int|null $created_at
 * @property int|null $created_by
 */
class SystemLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'system_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['log_type_id', 'user_id', 'created_at', 'created_by','login_act_type'], 'integer'],
            [['trans_date'], 'safe'],
            [['function_name', 'ipaddress', 'message'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'log_type_id' => 'ประเภท Log',
            'trans_date' => 'วันเวลา',
            'function_name' => 'Function Name',
            'user_id' => 'ผู้ใช้งาน',
            'ipaddress' => 'IP Address',
            'message' => 'Message',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }
}
