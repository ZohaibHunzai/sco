<?php

use yii\db\Migration;

class m161203_121835_add_bill_no_in_purchases extends Migration
{
    public function up()
    {
        $this->addColumn('purchases','bill_no',$this->string());
    }

    public function down()
    {
        $this->addColumn('purchases','bill_no',$this->string());
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
