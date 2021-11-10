<?php

use yii\db\Migration;

/**
 * Class m211110_041312_drop_image_column_from_company_project_attendance
 */
class m211110_041312_drop_image_column_from_company_project_attendance extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%company_project_attendance}}', 'image');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%company_project_attendance}}', 'image', $this->binary(4294967295)->defaultValue(null)->after('status'));
        // echo "m211110_041312_drop_image_column_from_company_project_attendance cannot be reverted.\n";

        // return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m211110_041312_drop_image_column_from_company_project_attendance cannot be reverted.\n";

        return false;
    }
    */
}
