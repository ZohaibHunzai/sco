<?php

use yii\db\Schema;
use yii\db\Migration;

class m160119_092653_create_orders_table extends Migration
{
     public function up()
    {
        $this->createTable('{{%orders}}', [
                'id'             => $this->bigPrimaryKey(),
                'order_by'       => $this->integer(),
                'type'           => $this->smallInteger(),
                'status'         => $this->smallInteger(),
                'date'           => $this->date('d/m/y'),
                'is_delivered'   => $this->smallInteger(),
                'created_by'     => $this->integer(),
                'updated_by'     => $this->integer(),
                'created_at'     => $this->date(),
                'updated_at'     => $this->date(),
            ]);
    }

    public function down()
    {
       $this->dropTable('{{%orders}}');
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
