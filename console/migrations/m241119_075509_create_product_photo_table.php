<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_photo}}`.
 */
class m241119_075509_create_product_photo_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product_photo}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'photo' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product_photo}}');
    }
}
