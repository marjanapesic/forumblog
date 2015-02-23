<?php

class uninstall extends EDbMigration {

    public function up() {

        $this->dropTable('forum_topic');
        $this->dropTable('forum_post');
               
    }

    public function down() {
        echo "m150210_182545_initial does not support migration down.\n";
        return false;
    }   
}