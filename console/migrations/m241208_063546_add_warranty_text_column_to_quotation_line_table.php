<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%quotation_line}}`.
 */
class m241208_063546_add_warranty_text_column_to_quotation_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%quotation_line}}', 'warranty_text', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%quotation_line}}', 'warranty_text');
    }
}
