<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%product}}`.
 */
class m241224_024752_add_reseller_id_column_to_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%product}}', 'reseller_id', $this->integer());
        $this->addColumn('{{%product}}', 'reseller_name', $this->string());
        $this->addColumn('{{%product}}', 'po_no', $this->string());
        $this->addColumn('{{%product}}', 'po_date', $this->datetime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%product}}', 'reseller_id');
        $this->dropColumn('{{%product}}', 'reseller_name');
        $this->dropColumn('{{%product}}', 'po_no');
        $this->dropColumn('{{%product}}', 'po_date');
    }
}
