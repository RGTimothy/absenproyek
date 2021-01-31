<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%company_role}}`.
 */
class m210131_044709_create_company_role_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%company_role}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string(100),
            'description' => $this->text(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'created_by' => $this->integer()->defaultValue(0),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            'updated_by' => $this->integer()->defaultValue(0),
            'deleted_at' => $this->timestamp()->defaultValue(null),
            'deleted_by' => $this->integer()->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%company_role}}');
    }
}
