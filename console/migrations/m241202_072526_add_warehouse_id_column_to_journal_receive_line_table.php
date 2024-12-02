<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%journal_receive_line}}`.
 */
class m241202_072526_add_warehouse_id_column_to_journal_receive_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%journal_receive_line}}', 'warehouse_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%journal_receive_line}}', 'warehouse_id');
    }
}
