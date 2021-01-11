<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%company_information}}`.
 */
class m210111_091640_create_company_information_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%company_information}}', [
            'id' => $this->primaryKey(),
            'company_id' => $this->integer(),
            'title' => $this->string(100),
            'description' => $this->text(),
            'start_time' => $this->timestamp()->defaultValue(null),
            'end_time' => $this->timestamp()->defaultValue(null),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            'deleted_at' => $this->timestamp()->defaultValue(null)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%company_information}}');
    }
}
