<?php

use yii\db\Migration;

/**
 * Class m210117_064447_add_index_to_company_information_table
 */
class m210117_064447_add_index_to_company_information_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex('idx_company', '{{%company_information%}}', 'company_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx_company', '{{%company_information%}}');
        // echo "m210117_064447_add_index_to_company_information_table cannot be reverted.\n";

        // return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210117_064447_add_index_to_company_information_table cannot be reverted.\n";

        return false;
    }
    */
}
