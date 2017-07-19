<?php

use yii\db\Migration;

class m160615_153708_rename_location_id_in_inventory extends Migration
{
    public function up()
    {
        $this->renameColumn("inventories", 'location_id', 'store_id');
    }

    public function down()
    {
        $this->renameColumn("inventories", 'store_id', 'store_id');
        // echo "m160615_153708_rename_location_id_in_inventory cannot be reverted.\n";

        // return false;
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
