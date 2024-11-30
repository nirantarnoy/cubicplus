<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%product}}`.
 */
class m241130_012042_add_serial_no_column_to_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%product}}', 'serial_no', $this->string());
        $this->addColumn('{{%product}}', 'receive_date', $this->datetime());
        $this->addColumn('{{%product}}', 'warranty_expired_date', $this->datetime());
        $this->addColumn('{{%product}}', 'brand_id', $this->integer());
        $this->addColumn('{{%product}}', 'brand_name', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%product}}', 'serial_no');
        $this->dropColumn('{{%product}}', 'receive_date');
        $this->dropColumn('{{%product}}', 'warranty_expired_date');
        $this->dropColumn('{{%product}}', 'brand_id');
        $this->dropColumn('{{%product}}', 'brand_name');
    }
}
