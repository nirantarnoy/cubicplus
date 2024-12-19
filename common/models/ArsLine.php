<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ars_line".
 *
 * @property int $id
 * @property int|null $ars_id
 * @property int|null $product_id
 * @property int|null $qty
 * @property string|null $install_location
 * @property string|null $period_start_date
 * @property string|null $period_end_date
 * @property string|null $package_type
 * @property int|null $warranty_year
 */
class ArsLine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ars_line';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ars_id', 'product_id', 'qty', 'warranty_year'], 'integer'],
            [['period_start_date', 'period_end_date'], 'safe'],
            [['install_location', 'package_type'], 'string', 'max' => 255],
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
            'product_id' => 'Product ID',
            'qty' => 'Qty',
            'install_location' => 'Install Location',
            'period_start_date' => 'Period Start Date',
            'period_end_date' => 'Period End Date',
            'package_type' => 'Package Type',
            'warranty_year' => 'Warranty Year',
        ];
    }
}