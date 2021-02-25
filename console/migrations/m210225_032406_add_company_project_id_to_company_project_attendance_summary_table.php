<?php

use yii\db\Migration;

/**
 * Class m210225_032406_add_company_project_id_to_company_project_attendance_summary_table
 */
class m210225_032406_add_company_project_id_to_company_project_attendance_summary_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%company_project_attendance_summary}}', 'company_project_id', $this->integer()->defaultValue(null)->after('company_role_id'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%company_project_attendance_summary}}', 'company_project_id');
        // echo "m210225_032406_add_company_project_id_to_company_project_attendance_summary_table cannot be reverted.\n";

        // return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210225_032406_add_company_project_id_to_company_project_attendance_summary_table cannot be reverted.\n";

        return false;
    }
    */
}
