<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "product_photo".
 *
 * @property int $id
 * @property int|null $product_id
 * @property string|null $photo
 */
class ProductPhoto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_photo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id'], 'integer'],
            [['photo'], 'string', 'max' => 255],
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
            'photo' => 'Photo',
        ];
    }
}
