<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%number}}`.
 */
class m230310_173448_create_number_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%number}}', [
            'id' => $this->primaryKey(),
            'personId' => $this->integer()->notNull(),
            'number' => $this->string(256)->notNull(),
        ]);

        $this->addForeignKey('fk_person_number', 'number', 'personId', 'person', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%number}}');
    }
}
