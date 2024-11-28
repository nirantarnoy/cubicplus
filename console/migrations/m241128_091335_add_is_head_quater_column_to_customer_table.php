<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%customer}}`.
 */
class m241128_091335_add_is_head_quater_column_to_customer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%customer}}', 'is_head_quater', $this->integer());
        $this->addColumn('{{%customer}}', 'branch_name', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%customer}}', 'is_head_quater');
        $this->dropColumn('{{%customer}}', 'branch_name');
    }
}
