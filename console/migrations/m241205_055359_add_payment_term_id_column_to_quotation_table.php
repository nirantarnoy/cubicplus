<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%quotation}}`.
 */
class m241205_055359_add_payment_term_id_column_to_quotation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%quotation}}', 'payment_term_id', $this->integer());
        $this->addColumn('{{%quotation}}', 'due_date_amt', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%quotation}}', 'payment_term_id');
        $this->dropColumn('{{%quotation}}', 'due_date_amt');
    }
}
