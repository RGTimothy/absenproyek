<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%company_clock}}`.
 */
class m210202_053258_add_break_hour_column_to_company_clock_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%company_clock}}', 'break_hour', $this->integer()->defaultValue(0)->after('clock_out'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%company_clock}}', 'break_hour');
    }
}
