<?php

use yii\db\Schema;
use yii\db\Migration;

class m160126_113243_add_column_to_inventories extends Migration
{
     public function up()
    {

        $this->dropColumn('inventories', 'mfg-date', 'date(d-m-y)');
        $this->dropColumn('inventories', 'expirity-date', 'date(d-m-y)');
        $this->addColumn('inventories', 'mfg_date', 'date(d-m-y)');
        $this->addColumn('inventories', 'expirity_date', 'date(d-m-y)');
    }

    public function down()
    {      
        $this->dropColumn('inventories', 'mfg-date', 'date(d-m-y)');
        $this->dropColumn('inventories', 'expirity-date', 'date(d-m-y)');
        $this->dropColumn('inventories', 'mfg-date', 'date(d-m-y)');
        $this->dropColumn('inventories', 'expirity-date', 'date(d-m-y)');
           
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
