<?php

use yii\db\Migration;

/**
 * Class m210126_114013_add_company_role_to_user_table
 */
class m210126_114013_add_company_role_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'company_role', $this->string(100)->defaultValue(null)->after('company_id'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'company_role');
        // echo "m210126_114013_add_company_role_to_user_table cannot be reverted.\n";

        // return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210126_114013_add_company_role_to_user_table cannot be reverted.\n";

        return false;
    }
    */
}
