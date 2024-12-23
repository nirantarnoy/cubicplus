<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%ars_line}}`.
 */
class m241222_120534_add_install_area_id_column_to_ars_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%ars_line}}', 'install_area_id', $this->integer());
        $this->addColumn('{{%ars_line}}', 'install_address', $this->string());
        $this->addColumn('{{%ars_line}}', 'install_province_id', $this->integer());
        $this->addColumn('{{%ars_line}}', 'install_zipcode', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%ars_line}}', 'install_area_id');
        $this->dropColumn('{{%ars_line}}', 'install_address');
        $this->dropColumn('{{%ars_line}}', 'install_province_id');
        $this->dropColumn('{{%ars_line}}', 'install_zipcode');
    }
}
