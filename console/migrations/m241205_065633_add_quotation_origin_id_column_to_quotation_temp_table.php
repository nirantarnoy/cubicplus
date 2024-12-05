<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%quotation_temp}}`.
 */
class m241205_065633_add_quotation_origin_id_column_to_quotation_temp_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%quotation_temp}}', 'quotation_origin_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%quotation_temp}}', 'quotation_origin_id');
    }
}
