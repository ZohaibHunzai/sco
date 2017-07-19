<?php

use yii\db\Schema;
use yii\db\Migration;

class m150930_205238_create_invoices_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%invoices}}', [

                'id'            =>  $this->bigPrimaryKey(),
                'customer_id'   =>  $this->bigInteger()->notNull(),
                'type'          =>  $this->smallInteger(),
                'created_at'    =>  $this->dateTime()->notNull(),
                'updated_at'    =>  $this->dateTime()->notNull(),
                'created_by'    =>  $this->bigInteger()->notNull(),
                'updated_by'    =>  $this->bigInteger()->notNull(),
            ]);
    }

    public function down()
    {
        $this->dropTable('{{%invoices}}');
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
