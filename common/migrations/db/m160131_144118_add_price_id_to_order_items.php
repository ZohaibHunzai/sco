<?php

use yii\db\Schema;
use yii\db\Migration;

class m160131_144118_add_price_id_to_order_items extends Migration
{
    public function up()
    {
        $this->addColumn('order_items', 'selling_price', $this->float());
        $this->addColumn('order_items', 'purchase_price', $this->float());
    }

    public function down()
    {
        $this->dropColumn('order_items','selling_price');
        $this->dropColumn('order_items','purchase_price');
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
