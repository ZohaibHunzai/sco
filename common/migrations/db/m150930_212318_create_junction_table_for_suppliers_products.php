<?php

use yii\db\Schema;
use yii\db\Migration;

class m150930_212318_create_junction_table_for_suppliers_products extends Migration
{
    public function up()
    {
        $this->createTable('{{%products_suppliers}}', [

                'id'                =>  $this->bigPrimaryKey(),
                'product_id'        =>  $this->bigInteger()->notNull(),
                'supplier_id'       =>  $this->bigInteger()->notNull(),

            ]);
    }

    public function down()
    {
        $this->dropTable('{{%products_suppliers}}');
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
