<?php

use yii\db\Migration;

/**
 * Class m210130_103323_add_allowance_to_company_clock_table
 */
class m210130_103323_add_allowance_to_company_clock_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%company_clock}}', 'allowance', $this->integer()->defaultValue(0)->after('clock_out'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%company_clock}}', 'allowance');
        // echo "m210130_103323_add_allowance_to_company_clock_table cannot be reverted.\n";

        // return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210130_103323_add_allowance_to_company_clock_table cannot be reverted.\n";

        return false;
    }
    */
}
