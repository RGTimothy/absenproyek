<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%company_project_attendance_summary}}`.
 */
class m210202_055504_create_company_project_attendance_summary_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%company_project_attendance_summary}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'company_role_id' => $this->integer(),
            'projects' => $this->text()->defaultValue(null),
            'work_duration' => $this->integer()->defaultValue(0),
            'overtime_duration_1' => $this->integer()->defaultValue(0),
            'overtime_duration_2' => $this->integer()->defaultValue(0),
            'overtime_duration_3' => $this->integer()->defaultValue(0),
            'total_allowance' => $this->integer()->defaultValue(0),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'created_by' => $this->integer()->defaultValue(0),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            'updated_by' => $this->integer()->defaultValue(0),
            'deleted_at' => $this->timestamp()->defaultValue(null),
            'deleted_by' => $this->integer()->defaultValue(0),
        ]);

        $this->addForeignKey(
            'fk-company_project_attendance_summary-user_id',
            'company_project_attendance_summary',
            'user_id',
            'user',
            'id',
            'SET NULL'
        );

        $this->addForeignKey(
            'fk-company_project_attendance_summary-company_role_id',
            'company_project_attendance_summary',
            'company_role_id',
            'company_role',
            'id',
            'SET NULL'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%company_project_attendance_summary}}');
    }
}
