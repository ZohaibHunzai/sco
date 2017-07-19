<?php

use yii\db\Schema;
use yii\db\Migration;

class m160122_130634_create_sales_items_tables extends Migration
{
    public function up()
    {
        $this->createTable('{{%sale_items}}', [
                'id'         => $this->bigPrimaryKey(),
                'sale_id'    => $this->integer(),
                'product_id' => $this->integer(),
                'quantity'   => $this->date(),
                'created_by' => $this->integer(),
                'updated_by' => $this->integer(),   
                'created_at' => $this->dateTime(),
                'updated_at' => $this->dateTime(),   
          ]);

    }

    public function down()
    {
        $this->dropTable('{{%sale_items}}');
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
