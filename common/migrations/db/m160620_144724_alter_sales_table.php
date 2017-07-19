<?php

use yii\db\Migration;

class m160620_144724_alter_sales_table extends Migration
{
    public function up()
    {
        $this->renameColumn("sales", "location_id", "store_id");

    }

    public function down()
    {
        $this->renameColumn("sales", "store_id", "location_id");
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
