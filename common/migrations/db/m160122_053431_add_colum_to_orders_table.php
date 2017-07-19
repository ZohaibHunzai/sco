<?php

use yii\db\Schema;
use yii\db\Migration;

class m160122_053431_add_colum_to_orders_table extends Migration
{
     public function up()
    {

        $this->addColumn('orders', 'location_id', 'integer');
    }

    public function down()
    {      
        $this->dropColumn('orders', 'location_id', 'integer');
           
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
