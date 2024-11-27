<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%system_log}}`.
 */
class m241119_071748_create_system_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%system_log}}', [
            'id' => $this->primaryKey(),
            'log_type_id' => $this->integer(),
            'trans_date' => $this->datetime(),
            'function_name' => $this->string(),
            'user_id' => $this->integer(),
            'ipaddress' => $this->string(),
            'message' => $this->string(),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%system_log}}');
    }
}
