<?php

use yii\db\Schema;
use yii\db\Migration;

class m151006_184954_create_photos_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%photos}}', [
                'id'          => $this->bigPrimaryKey(),
                'name'        => $this->string(128)->notNull(),
                'type'        => $this->smallInteger()->notNull(),
                'created_by'  => $this->bigInteger()->notNull(),
                'updated_by'  => $this->bigInteger()->notNull(),   
          ]);

    }

    public function down()
    {
        $this->dropTable('{{%photos}}');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
