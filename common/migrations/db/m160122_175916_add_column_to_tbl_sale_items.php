<?php

use yii\db\Schema;
use yii\db\Migration;

class m160122_175916_add_column_to_tbl_sale_items extends Migration
{
      public function up()
    {

        $this->dropColumn('sale_items', 'quantity', 'date');
        $this->addColumn('sale_items', 'quantity', 'integer');
    }

    public function down()
    {      
        $this->dropColumn('sale_items', 'quantity', 'date');
        $this->addColumn('sale_items', 'quantity', 'integer');
       
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
