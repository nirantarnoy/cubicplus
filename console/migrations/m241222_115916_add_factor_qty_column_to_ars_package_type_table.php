<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%ars_package_type}}`.
 */
class m241222_115916_add_factor_qty_column_to_ars_package_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%ars_package_type}}', 'factor_qty', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%ars_package_type}}', 'factor_qty');
    }
}
