<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%user}}`.
 */
class m210130_110106_add_blameable_columns_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'created_by', $this->integer()->defaultValue(0)->after('created_at'));
        $this->addColumn('{{%user}}', 'updated_by', $this->integer()->defaultValue(0)->after('updated_at'));
        $this->addColumn('{{%user}}', 'deleted_at', $this->timestamp()->defaultValue(null)->after('updated_by'));
        $this->addColumn('{{%user}}', 'deleted_by', $this->integer()->defaultValue(0)->after('deleted_at'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'created_by');
        $this->dropColumn('{{%user}}', 'updated_by');
        $this->dropColumn('{{%user}}', 'deleted_by');
        $this->dropColumn('{{%user}}', 'deleted_at');
    }
}
