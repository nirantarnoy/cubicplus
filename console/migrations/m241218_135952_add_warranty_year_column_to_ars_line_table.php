<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%ars_line}}`.
 */
class m241218_135952_add_warranty_year_column_to_ars_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%ars_line}}', 'warranty_year', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%ars_line}}', 'warranty_year');
    }
}
