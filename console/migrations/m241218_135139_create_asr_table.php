<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%asr}}`.
 */
class m241218_135139_create_asr_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%asr}}', [
            'id' => $this->primaryKey(),
            'ars_no' => $this->string(),
            'issue_date' => $this->datetime(),
            'customer_id' => $this->integer(),
            'status' => $this->integer(),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%asr}}');
    }
}
