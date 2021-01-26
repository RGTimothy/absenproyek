<?php

use yii\db\Migration;

/**
 * Class m210126_065734_add_foreign_key_to_company_information_table
 */
class m210126_065734_add_foreign_key_to_company_information_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // add foreign key for table `company_information`
        $this->addForeignKey(
            'fk-company_information-company_id',
            'company_information',
            'company_id',
            'company',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `company_information`
        $this->dropForeignKey(
            'fk-company_information-company_id',
            'company_information'
        );
        // echo "m210126_065734_add_foreign_key_to_company_information_table cannot be reverted.\n";

        // return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210126_065734_add_foreign_key_to_company_information_table cannot be reverted.\n";

        return false;
    }
    */
}
