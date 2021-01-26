<?php

use yii\db\Migration;

/**
 * Class m210126_094949_add_foreign_key_to_company_project_attendance_table
 */
class m210126_094949_add_foreign_key_to_company_project_attendance_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // add foreign key for table `company_project_attendance`
        $this->addForeignKey(
            'fk-company_project_attendance-user_id',
            'company_project_attendance',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );

        // add foreign key for table `company_project_attendance`
        $this->addForeignKey(
            'fk-company_project_attendance-company_project_id',
            'company_project_attendance',
            'company_project_id',
            'company_project',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `company_information`
        $this->dropForeignKey(
            'fk-company_project_attendance-user_id',
            'company_project_attendance'
        );

        $this->dropForeignKey(
            'fk-company_project_attendance-company_project_id',
            'company_project_attendance'
        );

        // echo "m210126_094949_add_foreign_key_to_company_project_attendance_table cannot be reverted.\n";

        // return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210126_094949_add_foreign_key_to_company_project_attendance_table cannot be reverted.\n";

        return false;
    }
    */
}
