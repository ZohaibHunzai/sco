<?php

use yii\db\Schema;
use yii\db\Migration;

class m160119_090210_create_ulter extends Migration
{
    public function up()
    {
        $this->dropColumn('order', 'order_id', 'integer');
        $this->addColumn('order', 'order_by', 'integer');
    }

    public function down()
    {
          $this->dropColumn('order', 'order_id', 'integer');
        $this->addColumn('order', 'order_by', 'integer');
        
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
