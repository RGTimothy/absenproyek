<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%company_project}}`.
 */
class m210117_062926_create_company_project_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%company_project}}', [
            'id' => $this->primaryKey(),
            'company_id' => $this->integer(),
            'name' => $this->string(200),
            'description' => $this->text(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            'deleted_at' => $this->timestamp()->defaultValue(null)
        ]);

        $this->createIndex('idx_company', '{{%company_project%}}', 'company_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx_company', '{{%company_project%}}');
        $this->dropTable('{{%company_project}}');
    }
}
