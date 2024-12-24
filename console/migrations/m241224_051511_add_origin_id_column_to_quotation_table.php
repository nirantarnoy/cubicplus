<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%quoatation}}`.
 */
class m241224_051511_add_origin_id_column_to_quotation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%quotation}}', 'origin_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%quotation}}', 'origin_id');
    }
}
