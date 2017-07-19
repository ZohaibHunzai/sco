<?php

use yii\db\Schema;
use yii\db\Migration;

class m150930_204208_create_customers_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%customers}}',[
                'id'            =>  $this->bigPrimaryKey(),
                'name'          =>  $this->string(128)->notNull(),
                'phone_no'      =>  $this->string(14),
                'mobile_no'     =>  $this->string(14),
                'email'         =>  $this->string(128),
                'type'          =>  $this->smallInteger(),
                'address'       =>  $this->string(1000)->notNull(),
            ]);
    }

    public function down()
    {
        $this->dropTable('{{%customers}}');
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
