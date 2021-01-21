<?php

use yii\db\Migration;

/**
 * Class m210121_104500_add_coordinates_to_company_project_table
 */
class m210121_104500_add_coordinates_to_company_project_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%company_project}}', 'latitude', $this->decimal(10, 8)->defaultValue(null)->after('description'));
        $this->addColumn('{{%company_project}}', 'longitude', $this->decimal(11, 8)->defaultValue(null)->after('latitude'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%company_project}}', 'latitude');
        $this->dropColumn('{{%company_project}}', 'longitude');
        // echo "m210121_104500_add_coordinates_to_company_project_table cannot be reverted.\n";

        // return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210121_104500_add_coordinates_to_company_project_table cannot be reverted.\n";

        return false;
    }
    */
}
