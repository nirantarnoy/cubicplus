<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%ars_line}}`.
 */
class m241223_045705_add_serial_no_column_to_ars_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%ars_line}}', 'serial_no', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%ars_line}}', 'serial_no');
    }
}
