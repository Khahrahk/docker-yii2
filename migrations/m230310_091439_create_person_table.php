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
            'fullName' => $this->string(256)->notNull(),
            'date' => $this->dateTime(),
            'location' => $this->string(256),
            'personGroup' => $this->string(256)->defaultValue(0),
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
