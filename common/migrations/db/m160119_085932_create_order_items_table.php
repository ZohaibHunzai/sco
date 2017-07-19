<?php

use yii\db\Schema;
use yii\db\Migration;

class m160119_085932_create_order_items_table extends Migration
{
   public function up()
    {
        $this->createTable('{{%order_items}}', [
                'id'             => $this->bigPrimaryKey(),
                'order_id'       => $this->integer(),
                'product_id'         => $this->integer(),
                'quantity'       => $this->integer(),
                'date'           => $this->date('d/m/y'),
                'created_by'     => $this->integer(),
                'updated_by'     => $this->integer(),
                'created_at'     => $this->date(),
                'updated_at'     => $this->date(),
            ]);
    }

    public function down()
    {
       $this->dropTable('{{%order_items}}');
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
