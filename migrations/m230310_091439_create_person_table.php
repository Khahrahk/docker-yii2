<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%person}}`.
 */
class m230310_091439_create_person_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%person}}', [
            'id' => $this->primaryKey(),
            'Full_name' => $this->string()->notNull(),
            'DOB' => $this->dateTime(),
            'Location' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%person}}');
    }
}
