<?php

use yii\db\Schema;
use yii\db\Migration;

class m160224_055058_add_column_accounts_table extends Migration
{
     public function up()
    {
        $this->addColumn('accounts','deleted_at', $this->date());
        $this->addColumn('accounts','deleted_by', $this->integer());
        $this->addColumn('accounts','group_id', $this->integer());
    }

    public function down()
    {
        $this->dropColumn('accounts','deleted_at', $this->date());
        $this->dropColumn('accounts','deleted_by', $this->integer());
        $this->dropColumn('accounts','group_id', $this->integer());
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
