<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m241119_075422_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'sku' => $this->string(),
            'name' => $this->string(),
            'description' => $this->string(),
            'product_category_id' => $this->integer(),
            'unit_id' => $this->integer(),
            'photo' => $this->string(),
            'cost' => $this->float(),
            'sale_price' => $this->float(),
            'commission' => $this->float(),
            'remark' => $this->string(),
            'status' => $this->integer(),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product}}');
    }
}
