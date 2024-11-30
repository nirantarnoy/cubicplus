<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%systemlog}}`.
 */
class m241129_053940_add_login_act_type_column_to_system_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%system_log}}', 'login_act_type', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%system_log}}', 'login_act_type');
    }
}
