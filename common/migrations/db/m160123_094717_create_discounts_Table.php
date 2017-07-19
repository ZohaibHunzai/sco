<?php

use yii\db\Schema;
use yii\db\Migration;

class m160123_094717_create_discounts_Table extends Migration
{
     public function up()
    {
        $this->createTable('{{%discounts}}', [
                'id'             => $this->bigPrimaryKey(),
                'product_id'     => $this->integer(),
                'customer_id'    => $this->integer(),
                'percent'        => $this->float(),
                'amount'         => $this->float(),
                'created_by'     => $this->integer(),
                'updated_by'     => $this->integer(),
                'created_at'     => $this->date(),
                'updated_at'     => $this->date(),
            ]);
    }

    public function down()
    {
       $this->dropTable('{{%discounts}}');
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
