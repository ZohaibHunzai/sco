<?php

use yii\db\Schema;
use yii\db\Migration;

class m160224_072958_drop_column extends Migration
{
    public function up()
    {
        $this->dropColumn('transactions','transaction_type', $this->string());

    }

    public function down()
    {
        $this->dropColumn('transactions','transaction_type', $this->string());
        
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
