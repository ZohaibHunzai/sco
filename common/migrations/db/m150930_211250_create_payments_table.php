<?php

use yii\db\Schema;
use yii\db\Migration;

class m150930_211250_create_payments_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%payments}}', [

                'id'                =>  $this->bigPrimaryKey(),
                'invoice_id'        =>  $this->bigInteger()->notNull(),
                'customer_id'       =>  $this->bigInteger()->notNull(),
                'payment_date'      =>  $this->dateTime()->notNull(),
                'payment_type_id'   =>  $this->bigInteger()->notNull(),
                'created_at'        =>  $this->dateTime()->notNull(),     
                'updated_at'        =>  $this->dateTime()->notNull(),     
                'created_by'        =>  $this->bigInteger()->notNull(),
                'updated_by'        =>  $this->bigInteger()->notNull(),

            ]);
    }

    public function down()
    {
        $this->dropTable('{{%payments}}');
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
