<?php

use yii\db\Schema;
use yii\db\Migration;

class m150930_203551_create_suppliers_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%suppliers}}', [
                'id'            =>  $this->bigPrimaryKey(),
                'name'          =>  $this->string(128)->notNull(),
                'email'         =>  $this->string(128),
                'phone_no'      =>  $this->string(14),
                'mobile_no'     =>  $this->string(14),
                'fax_number'    =>  $this->string(128),
                'address'       =>  $this->string(1000),

            ]);
    }

    public function down()
    {
        $this->dropTable('{{%suppliers}}');
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
