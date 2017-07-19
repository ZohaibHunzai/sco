<?php

use yii\db\Schema;
use yii\db\Migration;

class m151004_202831_create_lookup_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%lookup}}', [
                'id'            => $this->bigPrimaryKey(),
                'name'          => $this->string()->notNull(),
                'code'          => $this->smallInteger()->notNull(),
                'type'          => $this->string()->notNull(),
            ]);
    }

    public function down()
    {
       $this->dropTable('{{%lookup}}');
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
