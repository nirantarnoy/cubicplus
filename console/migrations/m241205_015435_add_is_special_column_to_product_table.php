<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%product}}`.
 */
class m241205_015435_add_is_special_column_to_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%product}}', 'is_special', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%product}}', 'is_special');
    }
}
