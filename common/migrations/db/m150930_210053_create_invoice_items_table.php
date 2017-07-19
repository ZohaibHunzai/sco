<?php

use yii\db\Schema;
use yii\db\Migration;

class m150930_210053_create_invoice_items_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%invoice_items}}', [

                'id'                =>  $this->bigPrimaryKey(),
                'invoice_id'        =>  $this->bigInteger()->notNull(),
                'product_id'        =>  $this->bigInteger()->notNull(),
                'quantity'          =>  $this->integer()->notNull(),
                'comment'           =>  $this->string(128),
                'discount_percent'  =>  $this->integer(),
                'created_at'        =>  $this->dateTime()->notNull(),
                'updated_at'        =>  $this->dateTime()->notNull(),
                'created_by'        =>  $this->bigInteger()->notNull(),
                'updated_by'        =>  $this->bigInteger()->notNull(),

            ]);
    }

    public function down()
    {
        $this->dropTable('{{%invoice_items}}');
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
