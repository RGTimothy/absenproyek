<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%company_clock}}`.
 */
class m210130_063653_add_blameable_columns_to_company_clock_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%company_clock}}', 'created_by', $this->integer()->defaultValue(null)->after('created_at'));
        $this->addColumn('{{%company_clock}}', 'updated_by', $this->integer()->defaultValue(null)->after('updated_at'));
        $this->addColumn('{{%company_clock}}', 'deleted_by', $this->integer()->defaultValue(null)->after('deleted_at'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%company_clock}}', 'created_by');
        $this->dropColumn('{{%company_clock}}', 'updated_by');
        $this->dropColumn('{{%company_clock}}', 'deleted_by');
    }
}
