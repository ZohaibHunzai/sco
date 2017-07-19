<?php

use yii\db\Schema;
use yii\db\Migration;

class m160118_102530_price_table extends Migration
{ 
    public function up()
    {
        $this->createTable('{{%price}}', [
                'id'            => $this->bigPrimaryKey(),
                'unit_price'    => $this->float()->notNull(),
                'selling_price' => $this->float()->notNull(),
                'date'          => $this->date()->notNull(),
                'created_by'    => $this->integer(),
                'updated_by'    => $this->integer(),   
                'created_at'    => $this->datetime(),
                'updated_at'    => $this->datetime(),   
          ]);

    }

    public function down()
    {
        $this->dropTable('{{%price}}');
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
