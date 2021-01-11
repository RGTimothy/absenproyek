<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%user}}`.
 */
class m210111_085044_add_company_id_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'company_id', $this->integer()->defaultValue(null)->after('username'));
        $this->createIndex('idx_company', '{{%user%}}', 'company_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx_company', '{{%user%}}');
        $this->dropColumn('{{%user}}', 'company_id');
    }
}
