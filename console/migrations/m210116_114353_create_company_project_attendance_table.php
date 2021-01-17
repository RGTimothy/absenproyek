<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%company_project_attendance}}`.
 */
class m210116_114353_create_company_project_attendance_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%company_project_attendance}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'company_project_id' => $this->integer(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            'deleted_at' => $this->timestamp()->defaultValue(null),
        ]);

        $this->createIndex('idx_company_project', '{{%company_project_attendance%}}', 'company_project_id');
        $this->createIndex('idx_user', '{{%company_project_attendance%}}', 'user_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx_user', '{{%company_project_attendance%}}');
        $this->dropIndex('idx_company_project', '{{%company_project_attendance%}}');
        $this->dropTable('{{%company_project_attendance}}');
    }
}
