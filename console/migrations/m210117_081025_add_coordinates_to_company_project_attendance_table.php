<?php

use yii\db\Migration;

/**
 * Class m210117_081025_add_coordinates_to_company_project_attendance_table
 */
class m210117_081025_add_coordinates_to_company_project_attendance_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%company_project_attendance}}', 'latitude', $this->decimal(10, 8)->defaultValue(null)->after('company_project_id'));
        $this->addColumn('{{%company_project_attendance}}', 'longitude', $this->decimal(11, 8)->defaultValue(null)->after('latitude'));
        $this->addColumn('{{%company_project_attendance}}', 'status', $this->string(20)->defaultValue(null)->after('longitude'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%company_project_attendance}}', 'latitude');
        $this->dropColumn('{{%company_project_attendance}}', 'longitude');
        $this->dropColumn('{{%company_project_attendance}}', 'status');
        // echo "m210117_081025_add_coordinates_to_company_project_attendance_table cannot be reverted.\n";

        // return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210117_081025_add_coordinates_to_company_project_attendance_table cannot be reverted.\n";

        return false;
    }
    */
}
