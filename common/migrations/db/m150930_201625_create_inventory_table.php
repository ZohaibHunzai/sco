<?php

use yii\db\Schema;
use yii\db\Migration;

class m150930_201625_create_inventory_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%inventories}}', [
                'id'            =>  $this->bigPrimaryKey(),
                'product_id'    =>  $this->bigInteger()->notNull(),
                'quantity'      =>  $this->bigInteger()->notNull(),
                'location_id'   =>  $this->bigInteger()->notNull(),
                'created_by'    =>  $this->bigInteger()->notNull(),
                'updated_by'    =>  $this->bigInteger()->notNull(),
                'created_at'    =>  $this->dateTime()->notNull(),
                'updated_at'    =>  $this->dateTime()->notNull(),
            ]);
    }   

    public function down()
    {
        $this->dropTable('{{%inventories}}');
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
