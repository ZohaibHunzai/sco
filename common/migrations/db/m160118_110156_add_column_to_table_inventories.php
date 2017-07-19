<?php

use yii\db\Schema;
use yii\db\Migration;

class m160118_110156_add_column_to_table_inventories extends Migration
{
    public function up()
    {
        $this->addColumn('inventories', 'price_id', 'integer');

    }

    public function down()
    {

        $this->dropColumn('inventories', 'price_id', 'integer');
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
