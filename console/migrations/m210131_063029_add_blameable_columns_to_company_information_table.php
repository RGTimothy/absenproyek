<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%company_information}}`.
 */
class m210131_063029_add_blameable_columns_to_company_information_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%company_information}}', 'created_by', $this->integer()->defaultValue(0)->after('created_at'));
        $this->addColumn('{{%company_information}}', 'updated_by', $this->integer()->defaultValue(0)->after('updated_at'));
        $this->addColumn('{{%company_information}}', 'deleted_by', $this->integer()->defaultValue(0)->after('deleted_at'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%company_information}}', 'created_by');
        $this->dropColumn('{{%company_information}}', 'updated_by');
        $this->dropColumn('{{%company_information}}', 'deleted_by');
    }
}
