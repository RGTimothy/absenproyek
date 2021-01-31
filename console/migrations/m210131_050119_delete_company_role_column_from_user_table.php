<?php

use yii\db\Migration;

/**
 * Class m210131_050119_delete_company_role_column_from_user_table
 */
class m210131_050119_delete_company_role_column_from_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('{{%user}}', 'company_role');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%user}}', 'company_role', $this->string(100)->defaultValue(null)->after('company_id'));
        // echo "m210131_050119_delete_company_role_column_from_user_table cannot be reverted.\n";

        // return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210131_050119_delete_company_role_column_from_user_table cannot be reverted.\n";

        return false;
    }
    */
}
