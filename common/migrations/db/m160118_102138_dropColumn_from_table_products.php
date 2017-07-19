<?php

use yii\db\Schema;
use yii\db\Migration;

class m160118_102138_dropColumn_from_table_products extends Migration
{
    public function up()
    {
        $this->dropColumn('products', 'unit_price', 'float');
        $this->dropColumn('products', 'selling_price', 'float');
    }

    public function down()
    {
        $this->dropColumn('products', 'unit_price', 'float');

        $this->dropColumn('products', 'selling_price', 'float');
        
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
