<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `{{%company_project_user}}`.
 */
class m210126_094614_drop_company_project_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('{{%company_project_user}}');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->createTable('{{%company_project_user}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'company_project_id' => $this->integer(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            'deleted_at' => $this->timestamp()->defaultValue(null)
        ]);

        $this->createIndex('idx_company_project', '{{%company_project_user%}}', 'company_project_id');
        $this->createIndex('idx_user', '{{%company_project_user%}}', 'user_id');
    }
}
