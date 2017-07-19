<?php

use yii\db\Migration;

class m161115_073155_addcolumn_to_dispacthes extends Migration
{
    public function up()
    {
        $this->addColumn('dispacthes','transaction_group',$this->integer());
    }

    public function down()
    {
        $this->addColumn('dispacthes','transaction_group',$this->integer());
        
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
