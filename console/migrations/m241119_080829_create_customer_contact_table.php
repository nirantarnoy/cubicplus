<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%customer_contact}}`.
 */
class m241119_080829_create_customer_contact_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%customer_contact}}', [
            'id' => $this->primaryKey(),
            'customer_id' => $this->integer(),
            'fname' => $this->string(),
            'lname' => $this->string(),
            'position_id' => $this->integer(),
            'position_name' => $this->string(),
            'phone' => $this->string(),
            'email' => $this->string(),
            'remark' => $this->string(),
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
        $this->dropTable('{{%customer_contact}}');
    }
}
