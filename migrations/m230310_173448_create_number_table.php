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
            'PersonId' => $this->integer()->notNull(),
            'number' => $this->string()->notNull(),
        ]);

        $this->addForeignKey('fk_person_number', 'number', 'PersonId', 'person', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%number}}');
    }
}
