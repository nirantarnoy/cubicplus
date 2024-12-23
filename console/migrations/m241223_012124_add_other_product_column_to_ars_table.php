<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%ars}}`.
 */
class m241223_012124_add_other_product_column_to_ars_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%ars}}', 'other_product', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%ars}}', 'other_product');
    }
}
