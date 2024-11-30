<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%product}}`.
 */
class m241129_071528_add_is_company_product_column_to_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%product}}', 'is_company_product', $this->integer());
        $this->addColumn('{{%product}}', 'distributor_id', $this->integer());
        $this->addColumn('{{%product}}', 'inventory_status', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%product}}', 'is_company_product');
        $this->dropColumn('{{%product}}', 'distributor_id');
        $this->dropColumn('{{%product}}', 'inventory_status');
    }
}
