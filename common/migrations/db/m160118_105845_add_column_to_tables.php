<?php

use yii\db\Schema;
use yii\db\Migration;

class m160118_105845_add_column_to_tables extends Migration
{
    public function up()
    {

        $this->addColumn('products', 'price_id', 'integer');
    }

    public function down()
    {      
        $this->dropColumn('products', 'price_id', 'integer');
           
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
