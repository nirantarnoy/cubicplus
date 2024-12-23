<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%log}}`.
 */
class m241223_044727_create_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%log}}', [
            'id' => $this->primaryKey(),
            'level' => $this->integer(),
            'category' => $this->string(),
            'log_time' => $this->float(),
            'prefix' => $this->string(),
            'message' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%log}}');
    }
}
