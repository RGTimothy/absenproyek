<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%user}}`.
 */
class m210131_045628_add_company_role_id_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'company_role_id', $this->integer()->defaultValue(null)->after('company_id'));

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-user-company_role_id',
            'user',
            'company_role_id',
            'company_role',
            'id',
            'SET NULL'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-user-company_role_id',
            'user'
        );

        $this->dropColumn('{{%user}}', 'company_role_id');
    }
}
