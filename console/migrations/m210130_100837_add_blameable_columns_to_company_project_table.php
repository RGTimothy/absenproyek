<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%company_project}}`.
 */
class m210130_100837_add_blameable_columns_to_company_project_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%company_project}}', 'created_by', $this->integer()->defaultValue(0)->after('created_at'));
        $this->addColumn('{{%company_project}}', 'updated_by', $this->integer()->defaultValue(0)->after('updated_at'));
        $this->addColumn('{{%company_project}}', 'deleted_by', $this->integer()->defaultValue(0)->after('deleted_at'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%company_project}}', 'created_by');
        $this->dropColumn('{{%company_project}}', 'updated_by');
        $this->dropColumn('{{%company_project}}', 'deleted_by');
    }
}
