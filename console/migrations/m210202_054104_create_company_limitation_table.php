<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%company_limitation}}`.
 */
class m210202_054104_create_company_limitation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%company_limitation}}', [
            'id' => $this->primaryKey(),
            'company_id' => $this->integer(),
            'max_user' => $this->integer()->defaultValue(1),
            'max_project' => $this->integer()->defaultValue(1),
            'max_unrestricted_project' => $this->integer()->defaultValue(0),
            'max_grade' => $this->integer()->defaultValue(1),
            'max_subscription_time' => $this->timestamp()->defaultValue(null),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'created_by' => $this->integer()->defaultValue(0),
            'updated_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            'updated_by' => $this->integer()->defaultValue(0),
            'deleted_at' => $this->timestamp()->defaultValue(null),
            'deleted_by' => $this->integer()->defaultValue(0),
        ]);

        // add foreign key for table `company_limitation`
        $this->addForeignKey(
            'fk-company_limitation-company_id',
            'company_limitation',
            'company_id',
            'company',
            'id',
            'SET NULL'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `company_limitation`
        $this->dropForeignKey(
            'fk-company_limitation-company_id',
            'company_limitation'
        );

        $this->dropTable('{{%company_limitation}}');
    }
}
