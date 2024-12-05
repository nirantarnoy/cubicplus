<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%quotation_temp_line}}`.
 */
class m241205_070722_add_product_name_column_to_quotation_temp_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%quotation_temp_line}}', 'product_name', $this->string());
        $this->addColumn('{{%quotation_temp_line}}', 'size_desc', $this->string());
        $this->addColumn('{{%quotation_temp_line}}', 'mat_desc', $this->string());
        $this->addColumn('{{%quotation_temp_line}}', 'photo', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%quotation_temp_line}}', 'product_name');
        $this->dropColumn('{{%quotation_temp_line}}', 'size_desc');
        $this->dropColumn('{{%quotation_temp_line}}', 'mat_desc');
        $this->dropColumn('{{%quotation_temp_line}}', 'photo');
    }
}
