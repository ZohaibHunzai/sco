<?php

use yii\db\Schema;
use yii\db\Migration;

class m160118_104250_create_ulter_table extends Migration
{ 
    public function up()
    {
        $this->dropColumn('price', 'unit_price', 'float');
        $this->addColumn('price', 'purchase_price', 'float');
    }

    public function down()
    {

        $this->dropColumn('price', 'unit_price', 'float');
        $this->addColumn('price', 'purchase_price', 'float');
      
        
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
