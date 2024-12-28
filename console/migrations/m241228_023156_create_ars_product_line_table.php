<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ars_product_line}}`.
 */
class m241228_023156_create_ars_product_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ars_product_line}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'sku' => $this->string(),
            'serial_no' => $this->string(),
            'qty' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%ars_product_line}}');
    }
}
