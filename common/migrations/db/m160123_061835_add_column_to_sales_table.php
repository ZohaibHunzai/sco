<?php

use yii\db\Schema;
use yii\db\Migration;

class m160123_061835_add_column_to_sales_table extends Migration
{   
    public function up()
    {

        $this->addColumn('sales', 'comment', 'string');
    }

    public function down()
    {      
        $this->dropColumn('sales', 'comment', 'string');
       
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
