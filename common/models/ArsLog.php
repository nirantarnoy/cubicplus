<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ars_log".
 *
 * @property int $id
 * @property int|null $ars_id
 * @property string|null $detail
 * @property string|null $trans_date
 * @property int|null $issue_by
 */
class ArsLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ars_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ars_id', 'issue_by'], 'integer'],
            [['trans_date'], 'safe'],
            [['detail'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ars_id' => 'Ars ID',
            'detail' => 'Detail',
            'trans_date' => 'Trans Date',
            'issue_by' => 'Issue By',
        ];
    }
}
