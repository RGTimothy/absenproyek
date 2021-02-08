<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%company}}`.
 */
class m210202_112524_add_blameable_columns_to_company_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%company}}', 'created_by', $this->integer()->defaultValue(0)->after('created_at'));
        $this->addColumn('{{%company}}', 'updated_by', $this->integer()->defaultValue(0)->after('updated_at'));
        $this->addColumn('{{%company}}', 'deleted_by', $this->integer()->defaultValue(0)->after('deleted_at'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%company}}', 'created_by');
        $this->dropColumn('{{%company}}', 'updated_by');
        $this->dropColumn('{{%company}}', 'deleted_by');
    }
}
