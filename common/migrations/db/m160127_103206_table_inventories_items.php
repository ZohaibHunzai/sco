<?php

use yii\db\Schema;
use yii\db\Migration;

class m160127_103206_table_inventories_items extends Migration
{
    public function up()
    {
        $this->createTable('{{%inventory_items}}', [
                'id'             => $this->bigPrimaryKey(),
                'inventory_id'   => $this->integer(),
                'product_id'     => $this->integer(),
                'price_id'       => $this->integer(),
                'created_by'     => $this->integer(),
                'updated_by'     => $this->integer(),
                'created_at'     => $this->date(),
                'updated_at'     => $this->date(),
            ]);
    }

    public function down()
    {
       $this->dropTable('{{%inventory_items}}');
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
