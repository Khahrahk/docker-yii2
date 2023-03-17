<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m230314_114516_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'login' => $this->string(256)->notNull(),
            'password' => $this->string(256)->notNull(),
            'isAdmin' => $this->integer()->defaultValue(0),
            'email' => $this->string(256)->notNull(),
            'number' => $this->string(256)->notNull(),
            'patronymic' => $this->string(256),
            'authKey' => $this->string(256),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
