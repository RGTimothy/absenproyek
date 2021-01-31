<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%company_project_attendance}}`.
 */
class m210131_060024_add_remark_column_to_company_project_attendance_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%company_project_attendance}}', 'remark', $this->text()->defaultValue(null)->after('status'));

        $this->addColumn('{{%company_project_attendance}}', 'created_by', $this->integer()->defaultValue(0)->after('created_at'));
        $this->addColumn('{{%company_project_attendance}}', 'updated_by', $this->integer()->defaultValue(0)->after('updated_at'));
        $this->addColumn('{{%company_project_attendance}}', 'deleted_by', $this->integer()->defaultValue(0)->after('deleted_at'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%company_project_attendance}}', 'remark');

        $this->dropColumn('{{%company_project_attendance}}', 'created_by');
        $this->dropColumn('{{%company_project_attendance}}', 'updated_by');
        $this->dropColumn('{{%company_project_attendance}}', 'deleted_by');
    }
}
