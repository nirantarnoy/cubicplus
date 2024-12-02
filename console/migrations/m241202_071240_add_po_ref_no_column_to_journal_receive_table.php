<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%journal_receive}}`.
 */
class m241202_071240_add_po_ref_no_column_to_journal_receive_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%journal_receive}}', 'po_ref_no', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%journal_receive}}', 'po_ref_no');
    }
}
