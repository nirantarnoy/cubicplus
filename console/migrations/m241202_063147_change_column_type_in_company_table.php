<?php

use yii\db\Migration;

/**
 * Class m241202_063147_change_column_type_in_company_table
 */
class m241202_063147_change_column_type_in_company_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Change the column data type
        $this->alterColumn('company', 'taxid', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Revert the column data type back to integer
        $this->alterColumn('company', 'taxid', $this->integer());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241202_063147_change_column_type_in_company_table cannot be reverted.\n";

        return false;
    }
    */
}
