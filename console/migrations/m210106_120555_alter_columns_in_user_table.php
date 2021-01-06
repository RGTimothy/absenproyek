<?php

use yii\db\Migration;

/**
 * Class m210106_120555_alter_columns_in_user_table
 */
class m210106_120555_alter_columns_in_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%user}}', 'username', $this->string(255)->defaultValue(null)->unique());
        $this->alterColumn('{{%user}}', 'auth_key', $this->string(32)->defaultValue(null));
        $this->alterColumn('{{%user}}', 'password_hash', $this->string(255)->defaultValue(null));
        $this->alterColumn('{{%user}}', 'email', $this->string(255)->defaultValue(null)->unique());
        $this->alterColumn('{{%user}}', 'created_at', $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'));
        $this->alterColumn('{{%user}}', 'updated_at', $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('{{%user}}', 'username', $this->string(255)->notNull()->unique());
        $this->alterColumn('{{%user}}', 'auth_key', $this->string(32)->notNull());
        $this->alterColumn('{{%user}}', 'password_hash', $this->string(255)->notNull());
        $this->alterColumn('{{%user}}', 'email', $this->string(255)->notNull()->unique());
        $this->alterColumn('{{%user}}', 'created_at', $this->integer(11)->defaultValue(null));
        $this->alterColumn('{{%user}}', 'updated_at', $this->integer(11)->defaultValue(null));

        // echo "m210106_120555_alter_columns_in_user_table cannot be reverted.\n";

        // return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210106_120555_alter_columns_in_user_table cannot be reverted.\n";

        return false;
    }
    */
}
