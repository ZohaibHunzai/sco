<?php

use yii\db\Migration;

class m161114_110019_add_store_id_in_user extends Migration
{
    public function up()
    {
        $this->addColumn('user','store_id',$this->integer());
    }

    public function down()
    {
        $this->addColumn('user','store_id',$this->integer());
        
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
