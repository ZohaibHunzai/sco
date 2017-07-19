<?php

use yii\db\Schema;
use yii\db\Migration;

class m160122_130621_create_sales_tables extends Migration
{
   public function up()
    {
        $this->createTable('{{%sales}}', [
                'id'          => $this->bigPrimaryKey(),
                'order_id'    => $this->integer(),
                'location_id'    => $this->integer(),
                'date'        => $this->date(),
                'created_by'  => $this->integer(),
                'updated_by'  => $this->integer(),   
                'created_at'  => $this->dateTime(),
                'updated_at'  => $this->dateTime(),   
          ]);

    }

    public function down()
    {
        $this->dropTable('{{%sales}}');
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
