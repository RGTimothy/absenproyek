<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%company_project_attendance}}`.
 */
class m210122_085814_add_image_column_to_company_project_attendance_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%company_project_attendance}}', 'image', $this->binary(4294967295)->defaultValue(null)->after('status'));
        $this->addColumn('{{%company_project_attendance}}', 'image_filename', $this->string(100)->defaultValue(null)->after('image'));
        $this->addColumn('{{%company_project_attendance}}', 'image_filetype', $this->string(50)->defaultValue(null)->after('image_filename'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%company_project_attendance}}', 'image');
        $this->dropColumn('{{%company_project_attendance}}', 'image_filename');
        $this->dropColumn('{{%company_project_attendance}}', 'image_filetype');
    }
}
