<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%ars_product_line}}`.
 */
class m241228_030444_add_ars_id_column_to_ars_product_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%ars_product_line}}', 'ars_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%ars_product_line}}', 'ars_id');
    }
}
