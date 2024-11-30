<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%user}}`.
 */
class m241129_045342_add_is_distributor_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'is_distributor', $this->integer());
        $this->addColumn('{{%user}}', 'distributor_id', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'is_distributor');
        $this->dropColumn('{{%user}}', 'distributor_id');
    }
}
