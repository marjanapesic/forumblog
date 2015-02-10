<?php

class m150210_182545_initial extends EDbMigration {

    public function up() {

        $this->createTable('forum_topic', array(
            'id' => 'pk',
            'guid' => 'varchar(45) DEFAULT NULL',
            'title' => 'varchar(255) DEFAULT NULL',
            'space_id' => 'int(11) DEFAULT NULL',
            'created_at' => 'datetime NOT NULL',
            'created_by' => 'int(11) NOT NULL',
            'updated_at' => 'datetime NOT NULL',
            'updated_by' => 'int(11) NOT NULL',
                ), '');

        $this->createIndex('unique_guid', 'forum_topic', 'guid', true);

        $this->createTable('forum_post', array(
            'id' => 'pk',
            'forum_topic_id' => 'int(11) NOT NULL',
            'message' => 'text NOT NULL',
            'created_at' => 'datetime NOT NULL',
            'created_by' => 'int(11) NOT NULL',
            'updated_at' => 'datetime NOT NULL',
            'updated_by' => 'int(11) NOT NULL',
                ), '');

    }

    public function down() {
        echo "m150210_182545_initial does not support migration down.\n";
        return false;
    }   
}