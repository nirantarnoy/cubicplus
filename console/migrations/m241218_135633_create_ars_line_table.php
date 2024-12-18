<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ars_line}}`.
 */
class m241218_135633_create_ars_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ars_line}}', [
            'id' => $this->primaryKey(),
            'ars_id' => $this->integer(),
            'product_id' => $this->integer(),
            'qty' => $this->integer(),
            'install_location' => $this->string(),
            'period_start_date' => $this->datetime(),
            'period_end_date' => $this->datetime(),
            'package_type' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%ars_line}}');
    }
}
