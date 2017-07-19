<?php

use yii\db\Schema;
use yii\db\Migration;

class m160119_092509_drop_order_tbele extends Migration
{
    public function up()
    {
        $this->dropTable('order');
    }

    public function down()
    {
        $this->dropTable('order');
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
