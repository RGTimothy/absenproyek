<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%company_project}}`.
 */
class m210117_075103_add_clock_columns_to_company_project_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%company_project}}', 'clock_in', $this->time()->defaultValue(null)->after('description'));
        $this->addColumn('{{%company_project}}', 'clock_out', $this->time()->defaultValue(null)->after('clock_in'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%company_project}}', 'clock_in');
        $this->dropColumn('{{%company_project}}', 'clock_out');
    }
}
