<?php

use yii\db\Migration;

class m161203_120713_add_receive_date extends Migration
{
    public function up()
    {
        $this->addColumn('purchases','issue_date',$this->date());
    }

    public function down()
    {
        $this->addColumn('purchases','issue_date',$this->date());
        
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
