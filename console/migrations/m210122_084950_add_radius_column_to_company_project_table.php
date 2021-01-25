<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%company_project}}`.
 */
class m210122_084950_add_radius_column_to_company_project_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%company_project}}', 'radius', $this->integer()->defaultValue(null)->after('longitude'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%company_project}}', 'radius');
    }
}
