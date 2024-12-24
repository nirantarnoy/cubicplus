<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%journal_receive}}`.
 */
class m241224_030946_add_reseller_name_column_to_journal_receive_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%journal_receive}}', 'reseller_name', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%journal_receive}}', 'reseller_name');
    }
}
