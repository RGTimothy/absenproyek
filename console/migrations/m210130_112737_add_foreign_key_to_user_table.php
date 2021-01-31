<?php

use yii\db\Migration;

/**
 * Class m210130_112737_add_foreign_key_to_user_table
 */
class m210130_112737_add_foreign_key_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-user-company_id',
            'user',
            'company_id',
            'company',
            'id',
            'SET NULL'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-user-company_id',
            'user'
        );
        // echo "m210130_112737_add_foreign_key_to_user_table cannot be reverted.\n";

        // return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210130_112737_add_foreign_key_to_user_table cannot be reverted.\n";

        return false;
    }
    */
}
