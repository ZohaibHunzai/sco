<?php

use yii\db\Schema;
use yii\db\Migration;

class m150930_192050_create_products_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%products}}',[
                'id'                =>  $this->bigPrimaryKey(),
                'name'              =>  $this->string(128)->notNull(),  
                'barcode'           =>  $this->string(500),
                'description'       =>  $this->string(500),
                'category_id'       =>  $this->bigInteger()->notNull(),
                'image_id'          =>  $this->bigInteger(),
                'unit_price'        =>  $this->float()->notNull(),
                'selling_price'     =>  $this->float()->notNull(),
                'unit'              =>  $this->integer(),
            ]);      
    }

    public function down()
    {
       $this->dropTable("{{%products}}");
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
