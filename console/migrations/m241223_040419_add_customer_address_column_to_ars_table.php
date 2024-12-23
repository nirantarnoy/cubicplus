<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%ars}}`.
 */
class m241223_040419_add_customer_address_column_to_ars_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%ars}}', 'customer_address', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%ars}}', 'customer_address');
    }
}
