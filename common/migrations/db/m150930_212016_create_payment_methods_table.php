<?php

use yii\db\Schema;
use yii\db\Migration;

class m150930_212016_create_payment_methods_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%payment_methods}}', [
                'id'            =>  $this->bigPrimaryKey(),
                'name'          =>  $this->string(128)->notNull(),
            ]);
    }

    public function down()
    {
        $this->dropTable('{{%payment_methods}}');
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
