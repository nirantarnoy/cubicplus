<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%quotation}}`.
 */
class m241224_044258_add_commission_amt_column_to_quotation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%quotation}}', 'commission_amt', $this->float());
        $this->addColumn('{{%quotation}}', 'commission_emp_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%quotation}}', 'commission_amt');
        $this->dropColumn('{{%quotation}}', 'commission_emp_id');
    }
}
