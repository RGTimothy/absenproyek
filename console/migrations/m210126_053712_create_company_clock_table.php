<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%company_clock}}`.
 */
class m210126_053712_create_company_clock_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%company_clock}}', [
            'id' => $this->primaryKey(),
            'company_id' => $this->integer(),
            'name' => $this->string(100),
            'clock_in' => $this->time()->defaultValue(null),
            'clock_out' => $this->time()->defaultValue(null),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            'deleted_at' => $this->timestamp()->defaultValue(null),
        ]);

        $this->createIndex('idx_company', '{{%company_clock%}}', 'company_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx_company', '{{%company_clock%}}');
        $this->dropTable('{{%company_clock}}');
    }
}
