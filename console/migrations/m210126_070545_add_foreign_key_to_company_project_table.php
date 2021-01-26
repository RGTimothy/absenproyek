<?php

use yii\db\Migration;

/**
 * Class m210126_070545_add_foreign_key_to_company_project_table
 */
class m210126_070545_add_foreign_key_to_company_project_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // add foreign key for table `company_project`
        $this->addForeignKey(
            'fk-company_project-company_id',
            'company_project',
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
        // drops foreign key for table `company_project`
        $this->dropForeignKey(
            'fk-company_project-company_id',
            'company_project'
        );
        // echo "m210126_070545_add_foreign_key_to_company_project_table cannot be reverted.\n";

        // return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210126_070545_add_foreign_key_to_company_project_table cannot be reverted.\n";

        return false;
    }
    */
}
