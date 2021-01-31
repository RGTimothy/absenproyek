<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%company_role}}`.
 */
class m210131_091717_add_company_id_column_to_company_role_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%company_role}}', 'company_id', $this->integer()->defaultValue(null)->after('code'));

        // add foreign key for table `company_role`
        $this->addForeignKey(
            'fk-company_role-company_id',
            'company_role',
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
        $this->dropForeignKey(
            'fk-company_role-company_id',
            'company_role'
        );

        $this->dropColumn('{{%company_role}}', 'company_id');
    }
}
