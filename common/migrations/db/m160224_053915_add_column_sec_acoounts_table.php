<?php

use yii\db\Schema;
use yii\db\Migration;

class m160224_053915_add_column_sec_acoounts_table extends Migration
{
    public function up()
    {
        $this->addColumn('secondary_accounts','deleted_at', $this->date());
        $this->addColumn('secondary_accounts','deleted_by', $this->integer());
    }

    public function down()
    {
        $this->addColumn('secondary_accounts','deleted_at', $this->date());
        $this->addColumn('secondary_accounts','deleted_by', $this->integer());

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
