<?php

use yii\db\Schema;
use yii\db\Migration;

class m150930_202806_create_locations_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%locations}}', [
                'id'            =>  $this->bigPrimaryKey(),
                'name'          =>  $this->string(256)->notNull(),
                'address'       =>  $this->string(1000)->notNull(),
                'created_at'    =>  $this->dateTime()->notNull(),
                'updated_at'    =>  $this->dateTime()->notNull(),
                'created_by'    =>  $this->bigInteger()->notNull(),
                'updated_by'    =>  $this->bigInteger()->notNull(),

            ]);
    }

    public function down()
    {
        $this->dropTable('{{%locations}}');
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
