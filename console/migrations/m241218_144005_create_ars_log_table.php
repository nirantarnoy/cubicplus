<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ars_log}}`.
 */
class m241218_144005_create_ars_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ars_log}}', [
            'id' => $this->primaryKey(),
            'ars_id' => $this->integer(),
            'detail' => $this->string(),
            'trans_date' => $this->datetime(),
            'issue_by' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%ars_log}}');
    }
}
