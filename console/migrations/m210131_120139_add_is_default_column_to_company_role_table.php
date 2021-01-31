<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%company_role}}`.
 */
class m210131_120139_add_is_default_column_to_company_role_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%company_role}}', 'is_default', $this->boolean()->defaultValue(false)->after('company_id'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%company_role}}', 'is_default');
    }
}
